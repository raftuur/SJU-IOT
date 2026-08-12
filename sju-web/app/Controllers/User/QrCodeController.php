<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Services\QrCodeService;

class QrCodeController extends BaseController
{
    protected UserModel $userModel;
    protected QrCodeService $qrCodeService;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->qrCodeService = new QrCodeService();
    }

    public function index()
    {
        // Cek login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        // Hanya user yang boleh masuk
        if (session()->get('role') !== 'user') {
            return redirect()->to('/dashboard');
        }

        $user = $this->userModel->find(session('userId'));

        if (!$user) {
            session()->destroy();
            return redirect()->to('/auth/login');
        }

        $qrCode = $this->qrCodeService->generate($user['uuid']);

        return view('user/qrcode/index', [
            'title'         => 'QR Code',
            'pageTitle'     => 'QR Code',
            'pageSubtitle'  => 'Gunakan QR Code untuk mengakses Reverse Vending Machine.',
            'user'          => $user,
            'qrCode'        => $qrCode,
        ]);
    }
}