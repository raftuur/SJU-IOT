<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Services\VoucherService;

class VoucherController extends BaseController
{
    protected VoucherService $voucherService;

    public function __construct()
    {
        $this->voucherService = new VoucherService();
    }

    /**
     * Daftar Voucher
     */
    public function index()
    {
        return view('user/voucher/index', [

            'title'         => 'Voucher',

            'pageTitle'     => 'Voucher',

            'pageSubtitle'  => 'Tukarkan point Anda dengan voucher yang tersedia.',

            'vouchers'      => $this->voucherService->getActive(),

        ]);
    }

    /**
     * Detail Voucher
     */
    public function show(int $id)
    {
        $voucher = $this->voucherService->getDetail($id);

        if (!$voucher) {

            return redirect()
                ->to('/user/voucher')
                ->with('error', 'Voucher tidak ditemukan.');

        }

        return view('user/voucher/show', [

            'title'         => 'Detail Voucher',

            'pageTitle'     => 'Detail Voucher',

            'pageSubtitle'  => 'Informasi voucher.',

            'voucher'       => $voucher,

        ]);
    }

    /**
     * Tukarkan voucher
     */
    public function redeem(int $id)
    {
        if (! session()->get('isLoggedIn')) {

            return redirect()->to('/auth/login');

        }

        $userId = session()->get('userId');

        $result = $this->voucherService
            ->redeemVoucher(
                $userId,
                $id
            );

        if (!$result['success']) {

            return redirect()
                ->back()
                ->with('error', $result['message']);

        }

        return redirect()
            ->to('/user/reward')
            ->with('success', $result['message']);
    }
}