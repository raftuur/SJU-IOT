<?php

namespace App\Controllers;

use App\Services\WithdrawalService;

class WithdrawalController extends BaseController
{
    protected WithdrawalService $withdrawalService;

    public function __construct()
    {
        $this->withdrawalService = new WithdrawalService();
    }

    /**
     * Daftar Withdrawal
     */
    public function index()
    {
        $keyword = trim($this->request->getGet('keyword') ?? '');

        return view('admin/withdrawal/index', [

            'title'        => 'Withdrawal',

            'pageTitle'    => 'Withdrawal',

            'pageSubtitle' => 'Kelola permintaan pencairan saldo pengguna.',

            'keyword'      => $keyword,

            'statistics'   => $this->withdrawalService->getStatistics(),

            'withdrawals'  => $this->withdrawalService->getAll($keyword),

        ]);
    }

    /**
     * Approve Withdrawal
     */
    public function approve($id)
    {
        if ($this->withdrawalService->approve((int) $id)) {

            return redirect()
                ->to('/withdrawal')
                ->with('success', 'Withdrawal berhasil di-approve.');

        }

        return redirect()
            ->to('/withdrawal')
            ->with('error', 'Withdrawal gagal di-approve.');
    }

    /**
     * Detail Withdrawal
     */
    public function show($id)
    {
        $withdrawal = $this->withdrawalService->getDetail((int) $id);

        if (!$withdrawal) {

            return redirect()
                ->to('/withdrawal')
                ->with('error', 'Data withdrawal tidak ditemukan.');

        }

        return view('admin/withdrawal/show', [

            'title'         => 'Detail Withdrawal',

            'pageTitle'     => 'Detail Withdrawal',

            'pageSubtitle'  => 'Informasi detail withdrawal pengguna.',

            'withdrawal'    => $withdrawal,

        ]);
    }
}