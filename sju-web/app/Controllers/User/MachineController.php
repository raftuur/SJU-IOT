<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Services\MachineService;

class MachineController extends BaseController
{
    protected MachineService $machineService;

    public function __construct()
    {
        $this->machineService = new MachineService();
    }

    /**
     * Halaman Machine User
     */
    public function index()
    {
        return view('user/machine/index', [

            'title'         => 'Machine',

            'pageTitle'     => 'Machine',

            'pageSubtitle'  => 'Monitoring Reverse Vending Machine.',

            'machines'      => $this->machineService->getAll(),

        ]);
    }

    /**
     * Detail Machine
     */
    public function show(int $id)
    {
        $machine = $this->machineService->getDetail($id);

        if (!$machine) {

            return redirect()
                ->to('/user/machine')
                ->with('error', 'Machine tidak ditemukan.');

        }

        return view('user/machine/show', [

            'title'         => 'Detail Machine',

            'pageTitle'     => 'Detail Machine',

            'pageSubtitle'  => 'Informasi mesin.',

            'machine'       => $machine,

        ]);
    }
}