<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Services\WithdrawalService;

class WithdrawalController extends BaseController
{
    protected WithdrawalService $withdrawalService;

    public function __construct()
    {
        $this->withdrawalService = new WithdrawalService();
    }

    /**
     * Riwayat withdrawal
     */
    public function index()
    {
        if (! session()->get('isLoggedIn')) {

            return redirect()->to('/auth/login');

        }

        $userId = session()->get('userId');

        return view('user/withdrawal/index', [

            'title'         => 'Withdrawal',

            'pageTitle'     => 'Withdrawal',

            'pageSubtitle'  => 'Riwayat penarikan saldo.',

            'withdrawals'   => $this->withdrawalService
                ->getByUser($userId),

        ]);
    }

    /**
     * Form pengajuan withdrawal
     */
    public function create()
    {
        return view('user/withdrawal/create', [

            'title'         => 'Ajukan Withdrawal',

            'pageTitle'     => 'Ajukan Withdrawal',

            'pageSubtitle'  => 'Ajukan pencairan point ke rekening atau e-wallet.',

        ]);
    }

    /**
     * Simpan pengajuan withdrawal
     */
    public function store()
    {
        if (! session()->get('isLoggedIn')) {

            return redirect()->to('/auth/login');

        }

        $result = $this->withdrawalService->submitWithdrawal(

            (int) session()->get('userId'),

            $this->request->getPost()

        );

        if (! $result['success']) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $result['message']);

        }

        return redirect()
            ->to('/user/withdrawal')
            ->with('success', 'Pengajuan withdrawal berhasil dibuat.');

    }

    /**
     * Detail withdrawal
     */
    public function show(int $id)
    {
    }
}