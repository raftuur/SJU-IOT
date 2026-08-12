<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Services\TransactionService;

class TransactionController extends BaseController
{
    protected TransactionService $transactionService;

    public function __construct()
    {
        $this->transactionService = new TransactionService();
    }

    /**
     * Daftar transaksi user
     */
    public function index()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        $userId = session()->get('userId');

        $search = trim($this->request->getGet('search') ?? '');
        $status = trim($this->request->getGet('status') ?? '');

        $transactions = $this->transactionService
            ->getUserTransactions(
                $userId,
                $search,
                $status
            );

        return view('user/transaction/index', [
            'title'         => 'Transaction',
            'pageTitle'     => 'Transaction',
            'pageSubtitle'  => 'Riwayat transaksi Reverse Vending Machine.',
            'transactions'  => $transactions,
            'search'        => $search,
            'status'        => $status,
        ]);
    }

    /**
     * Detail transaksi
     */
    public function show(int $id)
    {
        $transaction = $this->transactionService
            ->getDetail($id);

        if (!$transaction) {
            return redirect()
                ->to('/user/transaction')
                ->with('error', 'Transaction tidak ditemukan.');
        }

        return view('user/transaction/show', [
            'title'         => 'Detail Transaction',
            'pageTitle'     => 'Detail Transaction',
            'pageSubtitle'  => 'Informasi transaksi.',
            'transaction'   => $transaction,
        ]);
    }
}