<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Services\MonitoringService;
use App\Services\MachineSessionService;
use App\Services\MachineService;
use App\Services\AiDetectionService;
use App\Libraries\AiService;

class MachineApiController extends BaseController
{
    protected MonitoringService $monitoringService;
    protected MachineSessionService $machineSessionService;
    protected MachineService $machineService;
    protected AiDetectionService $aiDetectionService;

    public function __construct()
    {
        $this->monitoringService = new MonitoringService();
        $this->machineSessionService = new MachineSessionService();
        $this->machineService = new MachineService();
        $this->aiDetectionService = new AiDetectionService();
    }

    public function heartbeat()
    {
        // Support JSON dan form-data
        $data = $this->request->getJSON(true);

        $machineCode =
            $data['machine_code']
            ?? $this->request->getPost('machine_code')
            ?? '';

        $firmwareVersion =
            $data['firmware_version']
            ?? $this->request->getPost('firmware_version')
            ?? null;

        $ipAddress =
            $data['ip_address']
            ?? $this->request->getPost('ip_address')
            ?? null;

        if (empty($machineCode)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Machine Code wajib diisi.'
                ]);
        }

        $result = $this->monitoringService->updateHeartbeat(
            $machineCode,
            $firmwareVersion,
            $ipAddress
        );

        if (!$result) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'success' => false,
                    'message' => 'Machine tidak ditemukan.'
                ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Heartbeat berhasil diterima.',
            'machine_code' => $machineCode,
            'firmware_version' => $firmwareVersion,
            'ip_address' => $ipAddress
        ]);
    }

    public function sensor()
    {
        // Support JSON dan Form-Data
        $data = $this->request->getJSON(true);

        $machineCode =
            $data['machine_code']
            ?? $this->request->getPost('machine_code')
            ?? '';

        $weight =
            $data['weight']
            ?? $this->request->getPost('weight')
            ?? 0;

        $binLevel =
            $data['bin_level']
            ?? $this->request->getPost('bin_level')
            ?? 0;

        $temperature =
            $data['temperature']
            ?? $this->request->getPost('temperature')
            ?? 0;

        $wifiRssi =
            $data['wifi_rssi']
            ?? $this->request->getPost('wifi_rssi')
            ?? 0;

        $voltage =
            $data['voltage']
            ?? $this->request->getPost('voltage')
            ?? 0;

        if (empty($machineCode)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Machine Code wajib diisi.'
                ]);
        }

        $result = $this->monitoringService->updateSensorData(
            $machineCode,
            (float) $weight,
            (int) $binLevel,
            (float) $temperature,
            (int) $wifiRssi,
            (float) $voltage
        );

        if (!$result) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'success' => false,
                    'message' => 'Machine tidak ditemukan.'
                ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Data sensor berhasil diterima.',
            'machine_code' => $machineCode,
            'data' => [
                'weight' => (float) $weight,
                'bin_level' => (int) $binLevel,
                'temperature' => (float) $temperature,
                'wifi_rssi' => (int) $wifiRssi,
                'voltage' => (float) $voltage
            ]
        ]);
    }

    /**
     * Botol terdeteksi oleh Sensor E18
     */
    public function bottleDetected()
    {
        // Mendukung request JSON maupun Form-Data dari ESP32
        $data = $this->request->getJSON(true);
        $machineCode = $data['machine_code'] ?? $this->request->getPost('machine_code') ?? '';

        if (empty($machineCode)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'allowed' => false,
                    'message' => 'Machine Code wajib diisi.'
                ]);
        }

        // Cari machine
        $machine = $this->machineService->getByMachineCode($machineCode);

        if (!$machine) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'success' => false,
                    'allowed' => false,
                    'message' => 'Machine tidak ditemukan.'
                ]);
        }

        // Cari session aktif
        $session = $this->machineSessionService->getActiveMachine((int) $machine['id']);

        if (!$session) {
            return $this->response->setJSON([
                'success' => false,
                'allowed' => false,
                'message' => 'Tidak ada session aktif.'
            ]);
        }

        // Cegah botol baru masuk jika masih ada proses sebelumnya
        if (
            isset($session['bottle_status']) &&
            in_array($session['bottle_status'], ['pending', 'processing'], true)
        ) {
            return $this->response->setJSON([
                'success' => true,
                'allowed' => false,
                'message' => 'Masih ada botol yang sedang diproses.',
                'bottle_status' => $session['bottle_status']
            ]);
        }

        // Update progress dasar
        $updated = $this->machineSessionService->updateProgress(
            (int) $session['id'],
            (int) $session['total_bottle'],
            (float) $session['total_weight'],
            (int) $session['total_point']
        );

        if (!$updated) {
            return $this->response->setJSON([
                'success' => false,
                'allowed' => false,
                'message' => 'Gagal memperbarui session.'
            ]);
        }

        // Set status botol menjadi pending (Menunggu ESP32-CAM)
        $this->machineSessionService->setBottleStatus((int) $session['id'], 'pending');

        return $this->response->setJSON([
            'success' => true,
            'allowed' => true,
            'message' => 'Botol terdeteksi. Menunggu ESP32-CAM.',
            'machine_code' => $machineCode,
            'session' => [
                'id' => $session['id'],
                'session_token' => $session['session_token'],
                'user_id' => $session['user_id'],
                'machine_id' => $session['machine_id'],
                'status' => $session['status'],
                'bottle_status' => 'pending',
            ]
        ]);
    }

    /**
     * Cek status botol untuk ESP32-CAM & ESP32 Main
     */
    public function bottleStatus($machineCode)
    {
        $machine = $this->machineService->getByMachineCode($machineCode);

        if (!$machine) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'success' => false,
                    'process' => false,
                    'message' => 'Machine tidak ditemukan.'
                ]);
        }

        $session = $this->machineSessionService->getActiveMachine((int) $machine['id']);

        if (!$session) {
            return $this->response->setJSON([
                'success' => true,
                'process' => false,
                'bottle_status' => 'none',
                'message' => 'Tidak ada session aktif.'
            ]);
        }

        $bottleStatus = $session['bottle_status'] ?? 'none';

        return $this->response->setJSON([
            'success' => true,
            'process' => ($bottleStatus === 'pending'),
            'bottle_status' => $bottleStatus,
            'session_token' => $session['session_token'],
            'session_id' => $session['id'],
            'message' => 'Status botol saat ini: ' . $bottleStatus
        ]);
    }

    /**
     * Endpoint untuk ESP32-CAM mengirim foto & diproses oleh AiService
     */
    public function processBottle()
    {
        $machineCode = $this->request->getPost('machine_code');
        $file = $this->request->getFile('image');

        if (empty($machineCode) || !$file || !$file->isValid()) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Machine Code dan File Gambar wajib diisi.'
            ]);
        }

        $machine = $this->machineService->getByMachineCode($machineCode);
        if (!$machine) {
            return $this->response->setStatusCode(404)->setJSON([
                'success' => false,
                'message' => 'Machine tidak ditemukan.'
            ]);
        }

        $session = $this->machineSessionService->getActiveMachine((int) $machine['id']);
        if (!$session) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tidak ada session aktif.'
            ]);
        }

        // Tandai botol sedang diproses
        $this->machineSessionService->setBottleStatus((int) $session['id'], 'processing');

        // Simpan gambar sementara untuk diuji AI
        $uploadPath = WRITEPATH . 'uploads/ai';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }
        $fileName = $file->getRandomName();
        $file->move($uploadPath, $fileName);
        $imagePath = $uploadPath . DIRECTORY_SEPARATOR . $fileName;

        // Deteksi dengan AiService
        $ai = new AiService();
        $result = $ai->detect($imagePath);

        if (!($result['success'] ?? false)) {
            $this->machineSessionService->setBottleStatus((int) $session['id'], 'rejected');
            return $this->response->setJSON([
                'success' => false,
                'bottle_status' => 'rejected',
                'message' => 'Gagal mendeteksi gambar / AI error.'
            ]);
        }

        // Cek hasil deteksi botol
        $bottleCount = $result['summary']['bottle'] ?? 0;
        $confidence  = $result['confidence'] ?? 0;

        // Kriteria kelayakan botol plastik
        if ($bottleCount > 0 && $confidence >= 0.5) {
            // Status DITERIMA
            $this->machineSessionService->setBottleStatus((int) $session['id'], 'accepted');

            // Tambah jumlah botol dan poin
            $newTotalBottle = (int) ($session['total_bottle'] ?? 0) + 1;
            $newTotalPoint  = (int) ($session['total_point'] ?? 0) + 20; // Tambah 20 Poin per botol

            $this->machineSessionService->updateProgress(
                (int) $session['id'],
                $newTotalBottle,
                (float) ($session['total_weight'] ?? 0),
                $newTotalPoint
            );

            return $this->response->setJSON([
                'success' => true,
                'bottle_status' => 'accepted',
                'message' => 'Botol Plastik Valid!',
                'data' => $result
            ]);
        } else {
            // Status DITOLAK
            $this->machineSessionService->setBottleStatus((int) $session['id'], 'rejected');

            return $this->response->setJSON([
                'success' => true,
                'bottle_status' => 'rejected',
                'message' => 'Objek bukan botol plastik yang sesuai.',
                'data' => $result
            ]);
        }
    }

    /**
     * Autentikasi User melalui QR Code
     * Membuat session machine untuk user
     */
    public function authenticate()
    {
        $data = $this->request->getJSON(true);

        $machineCode = $data['machine_code'] ?? '';
        $userUuid    = $data['user_uuid'] ?? '';

        if (empty($machineCode) || empty($userUuid)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Machine Code dan User UUID wajib diisi.'
                ]);
        }

        // =====================================================
        // CARI MACHINE
        // =====================================================

        $machine = $this->machineService
            ->getByMachineCode($machineCode);

        if (!$machine) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'success' => false,
                    'message' => 'Machine tidak ditemukan.'
                ]);
        }

        // =====================================================
        // CARI USER BERDASARKAN UUID QR
        // =====================================================

        $userService = new \App\Services\UserService();

        $user = $userService->getByUuid($userUuid);

        if (!$user) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'success' => false,
                    'message' => 'User tidak ditemukan.'
                ]);
        }

        // =====================================================
        // CEK STATUS MACHINE
        // =====================================================

        if ($machine['status'] !== 'online') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Machine sedang tidak dapat digunakan.',
                'status' => $machine['status']
            ]);
        }

        // =====================================================
        // CEK SESSION AKTIF DI MACHINE
        // =====================================================

        $activeMachineSession =
            $this->machineSessionService
                ->getActiveMachine((int) $machine['id']);

        if ($activeMachineSession) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Machine masih memiliki session aktif.',
                'status' => 'in_use'
            ]);
        }

        // =====================================================
        // CEK SESSION AKTIF USER
        // =====================================================

        $activeUserSession =
            $this->machineSessionService
                ->getActiveUser((int) $user['id']);

        if ($activeUserSession) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User masih memiliki session aktif.',
                'status' => 'active_session'
            ]);
        }

        // =====================================================
        // BUAT SESSION BARU
        // =====================================================

        $session = $this->machineSessionService->create(
            (int) $machine['id'],
            (int) $user['id']
        );

        if (!$session) {
            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'success' => false,
                    'message' => 'Gagal membuat machine session.'
                ]);
        }

        // =====================================================
        // RESPONSE
        // =====================================================

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Session berhasil dibuat.',
            'session' => [
                'id' => $session['id'],
                'uuid' => $session['uuid'],
                'session_token' => $session['session_token'],
                'status' => $session['status'],
                'started_at' => $session['started_at'],
            ]
        ]);
    }

    public function session($machineCode)
    {
        $machine = $this->machineService->getByMachineCode($machineCode);

        if (!$machine) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Machine tidak ditemukan.'
            ]);
        }

        $session = $this->machineSessionService->getActiveMachine($machine['id']);

        if (!$session) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Tidak ada session aktif.'
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'session' => [
                'id' => $session['id'],
                'session_token' => $session['session_token'],
                'user_id' => $session['user_id'],
                'status' => $session['status']
            ]
        ]);
    }
}