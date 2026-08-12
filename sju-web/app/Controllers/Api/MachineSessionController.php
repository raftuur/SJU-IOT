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
     * Status Session
     */
    public function status($token)
    {
        $session = $this->machineSessionService->getByToken($token);

        if (!$session) {

            return $this->response->setJSON([

                'success' => false,

                'message' => 'Session tidak ditemukan.'

            ]);

        }

        return $this->response->setJSON([

            'success' => true,

            'session' => [

                'id' => $session['id'],

                'status' => $session['status'],

                'machine_id' => $session['machine_id'],

                'user_id' => $session['user_id'],

                'total_bottle' => $session['total_bottle'],

                'total_weight' => $session['total_weight'],

                'total_point' => $session['total_point'],

                'started_at' => $session['started_at'],

                'completed_at' => $session['completed_at'],

            ]

        ]);
    }
}