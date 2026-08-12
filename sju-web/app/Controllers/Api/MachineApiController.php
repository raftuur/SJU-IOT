<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Services\MonitoringService;
use App\Services\MachineSessionService;
use App\Services\MachineService;

class MachineApiController extends BaseController
{
    protected MonitoringService $monitoringService;
    protected MachineSessionService $machineSessionService;
    protected MachineService $machineService;

    public function __construct()
    {
        $this->monitoringService = new MonitoringService();
        $this->machineSessionService = new MachineSessionService();
        $this->machineService = new MachineService();
    }

    public function heartbeat()
    {
        $machineCode = $this->request->getPost('machine_code');

        if (empty($machineCode)) {

            return $this->response->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Machine Code wajib diisi.'
                ]);

        }

        $result = $this->monitoringService->updateHeartbeat(
            $machineCode,
            $this->request->getPost('firmware_version'),
            $this->request->getPost('ip_address')
        );

        if (!$result) {

            return $this->response->setStatusCode(404)
                ->setJSON([
                    'success' => false,
                    'message' => 'Machine tidak ditemukan.'
                ]);

        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Heartbeat berhasil diterima.'
        ]);
    }

    public function sensor()
    {
        $machineCode = $this->request->getPost('machine_code');

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

            (float) $this->request->getPost('weight'),

            (int) $this->request->getPost('bin_level'),

            (float) $this->request->getPost('temperature'),

            (int) $this->request->getPost('wifi_rssi'),

            (float) $this->request->getPost('voltage')

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
            'message' => 'Data sensor berhasil diterima.'
        ]);
    }

    public function authenticate()
    {
        $machineCode = $this->request->getPost('machine_code');
        $qrCode      = $this->request->getPost('qr_code');

        if (empty($machineCode) || empty($qrCode)) {

            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Machine Code dan QR Code wajib diisi.'
                ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Endpoint authenticate siap digunakan.'
        ]);
    }

    public function session($machineCode)
    {
        $machine = $this->machineService
            ->getByMachineCode($machineCode);

        if (!$machine) {

            return $this->response->setJSON([
                'success' => false,
                'message' => 'Machine tidak ditemukan.'
            ]);

        }

        $session = $this->machineSessionService
            ->getActiveMachine($machine['id']);

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