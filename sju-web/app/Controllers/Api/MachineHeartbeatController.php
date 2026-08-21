<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Services\MonitoringService;

class MachineHeartbeatController extends BaseController
{
    protected MonitoringService $monitoringService;

    public function __construct()
    {
        $this->monitoringService = new MonitoringService();
    }

    public function heartbeat()
    {
        $data = $this->request->getJSON(true);

        if (!$data) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'JSON tidak valid.',
                ]);
        }

        $machineCode = trim($data['machine_code'] ?? '');
        $firmwareVersion = $data['firmware_version'] ?? null;
        $ipAddress = $data['ip_address'] ?? null;

        if ($machineCode === '') {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Machine Code wajib diisi.',
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
                    'message' => 'Machine tidak ditemukan.',
                    'machine_code' => $machineCode,
                ]);
        }

        return $this->response
            ->setStatusCode(200)
            ->setJSON([
                'success' => true,
                'message' => 'Heartbeat berhasil diterima.',
                'machine_code' => $machineCode,
                'firmware_version' => $firmwareVersion,
                'ip_address' => $ipAddress,
            ]);
    }
}