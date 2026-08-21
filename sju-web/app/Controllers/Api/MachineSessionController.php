<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Services\MachineSessionService;
use App\Services\MachineService;
use App\Services\UserService;
use App\Services\TransactionService;
use App\Services\WalletService;

class MachineSessionController extends BaseController
{
    protected MachineSessionService $machineSessionService;
    protected MachineService $machineService;
    protected UserService $userService;
    protected TransactionService $transactionService;
    protected WalletService $walletService;

    public function __construct()
    {
        $this->machineSessionService = new MachineSessionService();
        $this->machineService = new MachineService();
        $this->userService = new UserService();
        $this->transactionService = new TransactionService();
        $this->walletService = new WalletService();
    }

    /**
     * Mulai Session
     */
    public function start()
    {
        $this->machineSessionService->expireOldSessions();

        $data = $this->request->getJSON(true);

        $machineCode = $data['machine_code'] ?? '';
        $userUuid = $data['user_uuid'] ?? '';

        if (empty($machineCode) || empty($userUuid)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Machine Code dan User UUID wajib diisi.'
            ]);
        }

        $machine = $this->machineService->getByMachineCode($machineCode);

        if (!$machine) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Machine tidak ditemukan.'
            ]);
        }

        $user = $this->userService->getByUuid($userUuid);

        if (!$user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'User tidak ditemukan.'
            ]);
        }

        if ($machine['status'] !== 'online') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Machine sedang tidak dapat digunakan.',
                'status' => $machine['status']
            ]);
        }

        $activeMachineSession = $this->machineSessionService
            ->getActiveMachine($machine['id']);

        if ($activeMachineSession) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Machine sedang digunakan oleh pengguna lain.',
                'status' => 'in_use'
            ]);
        }

        $activeUserSession = $this->machineSessionService
            ->getActiveUser($user['id']);

        if ($activeUserSession) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Anda masih memiliki sesi yang sedang berjalan.',
                'status' => 'active_session'
            ]);
        }

        $session = $this->machineSessionService->create(
            (int) $machine['id'],
            (int) $user['id']
        );

        if (!$session) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal membuat session.'
            ]);
        }

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

    /**
     * Verifikasi QR Code User
     * Endpoint khusus untuk verifikasi QR dari aplikasi/user
     */
    public function verifyQr()
    {
        $data = $this->request->getJSON(true);

        $machineCode = $data['machine_code'] ?? '';
        $userUuid = $data['user_uuid'] ?? '';

        if (empty($machineCode) || empty($userUuid)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Machine Code dan User UUID wajib diisi.'
                ]);
        }

        // Cari machine
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

        // Cek realtime machine berdasarkan heartbeat
        $heartbeatAt = $machine['heartbeat_at'] ?? null;

        $machineOnline = false;

        if (!empty($heartbeatAt)) {
            $machineOnline = strtotime($heartbeatAt) >= strtotime('-30 seconds');
        }

        if (!$machineOnline) {
            return $this->response
                ->setStatusCode(409)
                ->setJSON([
                    'success' => false,
                    'message' => 'Machine sedang tidak tersedia.',
                    'status' => 'offline'
                ]);
        }

        // Cari user berdasarkan UUID QR
        $user = $this->userService
            ->getByUuid($userUuid);

        if (!$user) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'success' => false,
                    'message' => 'QR User tidak valid.'
                ]);
        }

        // Cek machine sedang dipakai
        $activeMachineSession = $this->machineSessionService
            ->getActiveMachine((int) $machine['id']);

        if ($activeMachineSession) {
            return $this->response
                ->setStatusCode(409)
                ->setJSON([
                    'success' => false,
                    'message' => 'Machine sedang digunakan oleh pengguna lain.',
                    'status' => 'in_use'
                ]);
        }

        // Cek user sudah punya session
        $activeUserSession = $this->machineSessionService
            ->getActiveUser((int) $user['id']);

        if ($activeUserSession) {
            return $this->response
                ->setStatusCode(409)
                ->setJSON([
                    'success' => false,
                    'message' => 'User masih memiliki session aktif.',
                    'status' => 'active_session'
                ]);
        }

        // Buat session
        $session = $this->machineSessionService->create(
            (int) $machine['id'],
            (int) $user['id']
        );

        if (!$session) {
            return $this->response
                ->setStatusCode(500)
                ->setJSON([
                    'success' => false,
                    'message' => 'Gagal membuat session.'
                ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'QR User berhasil diverifikasi.',
            'session' => [
                'id' => $session['id'],
                'uuid' => $session['uuid'],
                'session_token' => $session['session_token'],
                'status' => $session['status'],
                'user_id' => $session['user_id'],
                'machine_id' => $session['machine_id'],
                'started_at' => $session['started_at'],
            ]
        ]);
    }

    /**
     * Verifikasi Machine Session dari QR
     */
    public function verify()
    {
        $data = $this->request->getJSON(true);

        $sessionToken = trim($data['session_token'] ?? '');

        if (empty($sessionToken)) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Session token wajib diisi.'
                ]);
        }

        // Cari session berdasarkan token
        $session = $this->machineSessionService
            ->getByToken($sessionToken);

        if (!$session) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'success' => false,
                    'message' => 'Session tidak ditemukan.'
                ]);
        }

        // Session harus masih aktif
        if ($session['status'] !== 'active') {
            return $this->response
                ->setStatusCode(409)
                ->setJSON([
                    'success' => false,
                    'message' => 'Session sudah tidak aktif.',
                    'status' => $session['status']
                ]);
        }

        // Ambil informasi machine
        $machine = $this->machineService
            ->getDetail((int) $session['machine_id']);

        if (!$machine) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'success' => false,
                    'message' => 'Machine tidak ditemukan.'
                ]);
        }

        // Machine harus online
        if ($machine['status'] !== 'online') {
            return $this->response
                ->setStatusCode(409)
                ->setJSON([
                    'success' => false,
                    'message' => 'Machine sedang tidak tersedia.',
                    'status' => $machine['status']
                ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Machine session berhasil diverifikasi.',
            'session' => [
                'id' => $session['id'],
                'uuid' => $session['uuid'],
                'session_token' => $session['session_token'],
                'status' => $session['status'],
                'user_id' => $session['user_id'],
                'machine_id' => $session['machine_id'],
                'started_at' => $session['started_at'],
            ],
            'machine' => [
                'id' => $machine['id'],
                'machine_code' => $machine['machine_code'],
                'machine_name' => $machine['machine_name'],
                'status' => $machine['status'],
            ]
        ]);
    }

    /**
     * Update Progress
     */
    public function progress()
    {
        $data = $this->request->getJSON(true);

        $sessionToken = $data['session_token'] ?? '';
        $totalBottle = (int) ($data['total_bottle'] ?? 0);
        $totalWeight = (float) ($data['total_weight'] ?? 0);
        $totalPoint = (int) ($data['total_point'] ?? 0);

        if (empty($sessionToken)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Session token wajib diisi.'
            ]);
        }

        $session = $this->machineSessionService
            ->getByToken($sessionToken);

        if (!$session) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Session tidak ditemukan.'
            ]);
        }

        $this->machineSessionService->updateProgress(
            (int) $session['id'],
            $totalBottle,
            $totalWeight,
            $totalPoint
        );

        $updatedSession = $this->machineSessionService
            ->getDetail((int) $session['id']);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Progress berhasil diperbarui.',
            'session' => [
                'id' => $updatedSession['id'],
                'status' => $updatedSession['status'],
                'total_bottle' => $updatedSession['total_bottle'],
                'total_weight' => $updatedSession['total_weight'],
                'total_point' => $updatedSession['total_point'],
            ]
        ]);
    }

    /**
     * Selesaikan Session
     */
    public function finish()
    {
        $data = $this->request->getJSON(true);

        $sessionToken = $data['session_token'] ?? '';

        if (empty($sessionToken)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Session token wajib diisi.'
            ]);
        }

        $session = $this->machineSessionService
            ->getByToken($sessionToken);

        if (!$session) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Session tidak ditemukan.'
            ]);
        }

        $transaction = $this->transactionService
            ->createTransaction([
                'machine_session_id' => $session['id'],
                'user_id' => $session['user_id'],
                'machine_id' => $session['machine_id'],
                'weight' => $session['total_weight'],
                'bottle_count' => $session['total_bottle'],
                'point_earned' => $session['total_point'],
                'processing_time' => 0,
            ]);

        if (!$transaction) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal membuat transaksi.'
            ]);
        }

        $this->walletService->addPoint(
            (int) $session['user_id'],
            (int) $transaction['id'],
            (int) $transaction['point_earned'],
            'Point dari Reverse Vending Machine'
        );

        $this->machineSessionService->finish(
            (int) $session['id'],
            (int) $transaction['id']
        );

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Transaksi berhasil dibuat.',
            'transaction' => $transaction
        ]);
    }

    /**
     * Batalkan Session
     */
    public function cancel()
    {
        //
    }

    /**
     * Status Session berdasarkan Machine Code
     *
     * @param string $machineCode
     * @return \CodeIgniter\HTTP\Response
     */
    public function status($machineCode)
    {
        $machine = $this->machineService
            ->getByMachineCode($machineCode);

        if (!$machine) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'success' => false,
                    'message' => 'Machine tidak ditemukan.',
                ]);
        }

        $session = $this->machineSessionService
            ->getActiveMachine((int) $machine['id']);

        if (!$session) {
            return $this->response->setJSON([
                'success' => true,
                'machine_code' => $machineCode,
                'session_active' => false,
                'session' => null,
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'machine_code' => $machineCode,
            'session_active' => true,
            'session' => [
                'id' => $session['id'],
                'uuid' => $session['uuid'],
                'session_token' => $session['session_token'],
                'user_id' => $session['user_id'],
                'machine_id' => $session['machine_id'],
                'status' => $session['status'],
                'started_at' => $session['started_at'],
            ],
        ]);
    }
}