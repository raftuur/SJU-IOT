<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\MachineModel;
use App\Services\RedisSessionService;

class MachineAuthController extends BaseController
{
    protected UserModel $userModel;
    protected MachineModel $machineModel;
    protected RedisSessionService $redisSession;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->machineModel = new MachineModel();
        $this->redisSession = new RedisSessionService();
    }

    public function authenticate()
    {
        $machineCode = trim($this->request->getPost('machine_code'));
        $uuid        = trim($this->request->getPost('uuid'));

        if (empty($machineCode) || empty($uuid)) {

            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'success' => false,
                    'message' => 'Machine Code dan UUID wajib diisi.'
                ]);
        }

        // Cari machine
        $machine = $this->machineModel
            ->where('machine_code', $machineCode)
            ->first();

        if (!$machine) {

            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'success' => false,
                    'message' => 'Machine tidak ditemukan.'
                ]);
        }

        // Cari user berdasarkan UUID
        $user = $this->userModel
            ->where('uuid', $uuid)
            ->first();

        if (!$user) {

            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'success' => false,
                    'message' => 'User tidak ditemukan.'
                ]);
        }

        // Cek status user
        if ($user['status'] !== 'active') {

            return $this->response
                ->setStatusCode(403)
                ->setJSON([
                    'success' => false,
                    'message' => 'User tidak aktif.'
                ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Validasi berhasil.',
            'user' => [
                'id'       => $user['id'],
                'fullname' => $user['fullname'],
                'uuid'     => $user['uuid'],
                'role'     => $user['role'],
            ]
        ]);
    }
}