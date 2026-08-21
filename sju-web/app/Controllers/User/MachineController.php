<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Services\MonitoringService;
use App\Models\UserModel;
use App\Services\QrCodeService;

class MachineController extends BaseController
{
    protected MonitoringService $monitoringService;
    protected UserModel $userModel;
    protected QrCodeService $qrCodeService;

    public function __construct()
    {
        $this->monitoringService = new MonitoringService();
        $this->userModel = new UserModel();
        $this->qrCodeService = new QrCodeService();
    }

    /**
     * Daftar machine
     */
    public function index()
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        if (session()->get('role') !== 'user') {
            return redirect()->to('/dashboard');
        }

        $machines = $this->monitoringService->getMachineList();

        return view('user/machine/index', [
            'title'        => 'Machine',
            'pageTitle'    => 'Machine',
            'pageSubtitle' => 'Pilih Reverse Vending Machine yang tersedia.',
            'machines'     => $machines,
        ]);
    }

    /**
     * Detail machine
     */
    public function show(int $id)
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        if (session()->get('role') !== 'user') {
            return redirect()->to('/dashboard');
        }

        $machine = $this->monitoringService->getMachineDetail($id);

        if (! $machine) {
            return redirect()
                ->to('/user/machine')
                ->with('error', 'Machine tidak ditemukan.');
        }

        return view('user/machine/show', [
            'title'        => 'Detail Machine',
            'pageTitle'    => 'Detail Machine',
            'pageSubtitle' => 'Informasi Reverse Vending Machine.',
            'machine'      => $machine,
        ]);
    }

    /**
     * Halaman penggunaan machine
     */
    public function use(int $id)
    {
        if (! session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        if (session()->get('role') !== 'user') {
            return redirect()->to('/dashboard');
        }

        $machine = $this->monitoringService->getMachineDetail($id);

        if (! $machine) {
            return redirect()
                ->to('/user/machine')
                ->with('error', 'Machine tidak ditemukan.');
        }

        // Machine tidak boleh digunakan jika maintenance
        if ($machine['realtime_status'] === 'maintenance') {
            return redirect()
                ->to('/user/machine/' . $id)
                ->with('error', 'Machine sedang dalam maintenance.');
        }

        // Machine tidak boleh digunakan jika offline
        if ($machine['realtime_status'] !== 'online') {
            return redirect()
                ->to('/user/machine/' . $id)
                ->with('error', 'Machine sedang offline.');
        }

        // Ambil user yang sedang login
        $user = $this->userModel->find(session()->get('userId'));

        if (! $user) {
            session()->destroy();
            return redirect()->to('/auth/login');
        }

        // Generate QR Code dari UUID user
        $qrCode = $this->qrCodeService->generate($user['uuid']);

        return view('user/machine/use', [
            'title'        => 'Gunakan Machine',
            'pageTitle'    => 'Gunakan Machine',
            'pageSubtitle' => 'Gunakan Reverse Vending Machine.',
            'machine'      => $machine,
            'user'         => $user,
            'qrCode'       => $qrCode,
        ]);
    }
}