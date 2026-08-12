<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Services\AuthService;
use App\Services\WalletService;

class WalletController extends BaseController
{
    protected AuthService $authService;

    protected WalletService $walletService;

    public function __construct()
    {
        $this->authService = new AuthService();

        $this->walletService = new WalletService();
    }

    /**
     * Halaman Wallet User
     */
    public function index()
    {
        $userId = $this->authService->getUserId();

        if (!$userId) {

            return redirect()
                ->to('/auth/login')
                ->with('error', 'Silakan login terlebih dahulu.');

        }

        return view('user/wallet/index', [

            'title'         => 'Wallet',

            'pageTitle'     => 'Wallet',

            'pageSubtitle'  => 'Saldo dan riwayat transaksi.',

            'wallet'        => $this->walletService->getByUser($userId),

            'histories'     => $this->walletService->getHistory($userId),

        ]);
    }
}