<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\WalletModel;
use App\Models\TransactionModel;
use App\Models\RewardRedemptionModel;

class DashboardController extends BaseController
{
    protected UserModel $userModel;
    protected WalletModel $walletModel;
    protected TransactionModel $transactionModel;
    protected RewardRedemptionModel $redemptionModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->walletModel = new WalletModel();
        $this->transactionModel = new TransactionModel();
        $this->redemptionModel = new RewardRedemptionModel();
    }

    public function index()
    {
        // Cek login
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        // Hanya role user yang boleh masuk
        if (session()->get('role') !== 'user') {
            return redirect()->to('/dashboard');
        }

        $userId = session()->get('userId');

        // Ambil data user
        $user = $this->userModel->find($userId);

        if (! $user) {
            session()->destroy();
            return redirect()->to('/auth/login');
        }

        // Ambil wallet
        $wallet = $this->walletModel
            ->where('user_id', $userId)
            ->first();

        // Jika wallet belum ada, buat otomatis
        if (! $wallet) {
            $this->walletModel->insert([
                'uuid'            => bin2hex(random_bytes(16)),
                'user_id'         => $userId,
                'balance'         => 0,
                'total_earned'    => 0,
                'total_redeemed'  => 0,
            ]);

            $wallet = $this->walletModel
                ->where('user_id', $userId)
                ->first();
        }

        // Ambil 5 transaksi terakhir
        $transactions = $this->transactionModel
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->limit(5)
            ->findAll();

        // Ambil total botol (berhasil)
        $totalBottles = $this->transactionModel
            ->where('user_id', $userId)
            ->where('status', 'success')
            ->selectSum('bottle_count')
            ->get()
            ->getRow()
            ->bottle_count ?? 0;

        // Ambil jumlah transaksi
        $transactionCount = $this->transactionModel
            ->where('user_id', $userId)
            ->countAllResults();

        // Ambil jumlah penukaran (redemption)
        $redemptionCount = $this->redemptionModel
            ->where('user_id', $userId)
            ->where('status', 'completed')
            ->countAllResults();

        return view('user/dashboard/index', [
            'title'            => 'Dashboard User',
            'pageTitle'        => 'Dashboard',
            'pageSubtitle'     => 'Selamat datang, ' . ($user['fullname'] ?? 'User'),
            'user'             => $user,
            'wallet'           => $wallet,
            'totalPoint'       => (int) ($wallet['balance'] ?? 0),
            'totalBottle'      => (int) $totalBottles,
            'totalTransaction' => (int) $transactionCount,
            'totalReward'      => (int) $redemptionCount,
            'transactions'     => $transactions,
        ]);
    }
}