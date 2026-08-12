<?php

namespace App\Controllers;

use App\Repositories\WalletRepository;
use App\Repositories\WalletHistoryRepository;

class WalletController extends BaseController
{
    protected WalletRepository $walletRepository;
    protected WalletHistoryRepository $walletHistoryRepository;

    public function __construct()
    {
        $this->walletRepository = new WalletRepository();
        $this->walletHistoryRepository = new WalletHistoryRepository();
    }

    public function index()
    {
        $wallets = $this->walletRepository->findAllWithUser();

        return view('admin/wallet/index', [

            'title'         => 'Wallet',

            'pageTitle'     => 'Wallet',

            'pageSubtitle'  => 'Kelola wallet seluruh pengguna.',

            'wallets'       => $wallets,

        ]);
    }

    public function show($id)
    {
        $wallet = $this->walletRepository->findDetailById($id);

        if (!$wallet) {
            return redirect()
                ->to('/wallet')
                ->with('error', 'Wallet tidak ditemukan.');
        }

        $histories = $this->walletHistoryRepository->findByWalletId($id);

        return view('admin/wallet/show', [
            'title'         => 'Detail Wallet',
            'pageTitle'     => 'Detail Wallet',
            'pageSubtitle'  => 'Informasi wallet pengguna.',
            'wallet'        => $wallet,
            'histories'     => $histories,
        ]);
    }
}