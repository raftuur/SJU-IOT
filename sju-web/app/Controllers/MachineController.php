<?php

namespace App\Controllers;

use App\Models\MachineModel;
use App\Services\MonitoringService;

class MachineController extends BaseController
{
    protected $machineModel;
    protected $monitoringService;

    public function __construct()
    {
        $this->machineModel = new MachineModel();
        $this->monitoringService = new MonitoringService();
    }

    public function index()
    {
        $search = trim($this->request->getGet('search') ?? '');
        $status = $this->request->getGet('status') ?? '';

        $builder = $this->machineModel;

        if ($search !== '') {
            $builder = $builder->groupStart()
                ->like('machine_code', $search)
                ->orLike('machine_name', $search)
                ->orLike('location', $search)
                ->groupEnd();
        }

        if ($status !== '') {
            $builder = $builder->where('status', $status);
        }

        // Clone builder untuk menghitung total sebelum paginate
        $totalBuilder = clone $builder;
        $totalMachines = $totalBuilder->countAllResults();

        $perPage = 10;

        $machines = $builder
            ->orderBy('id', 'ASC')
            ->paginate($perPage);

        $pager = $this->machineModel->pager;

        return view('admin/machine/index', [
            'title'        => 'Machine Management',
            'pageTitle'    => 'Machine Management',
            'pageSubtitle' => 'Kelola seluruh mesin Reverse Vending Machine.',
            'machines'     => $machines,
            'pager'        => $pager,
            'totalMachines' => $totalMachines,
            'search'       => $search,
            'status'       => $status,
            'trashCount'   => $this->machineModel->onlyDeleted()->countAllResults(),
        ]);
    }

    public function create()
    {
        return view('admin/machine/create', [
            'title'        => 'Tambah Machine',
            'pageTitle'    => 'Tambah Machine',
            'pageSubtitle' => 'Tambahkan mesin Reverse Vending Machine.',
            'machineCode'  => $this->generateMachineCode(),
        ]);
    }

    public function store()
    {
        $rules = [
            'machine_code' => 'required|is_unique[machines.machine_code]',
            'machine_name' => 'required',
            'location'     => 'required',
            'status'       => 'required',
        ];

        if (! $this->validate($rules)) {

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->machineModel->insert([

            'uuid'              => $this->generateUuid(),
            'machine_code'      => $this->request->getPost('machine_code'),
            'machine_name'      => $this->request->getPost('machine_name'),
            'location'          => $this->request->getPost('location'),
            'latitude'          => $this->request->getPost('latitude'),
            'longitude'         => $this->request->getPost('longitude'),
            'ip_address'        => $this->request->getPost('ip_address'),
            'firmware_version'  => $this->request->getPost('firmware_version'),
            'status'            => $this->request->getPost('status'),

        ]);

        return redirect()
            ->to(site_url('machine'))
            ->with('success', 'Machine berhasil ditambahkan.');
    }

    public function show($id)
    {
        $machine = $this->monitoringService->getMachineDetail((int) $id);

        if (!$machine) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Machine tidak ditemukan.'
            );
        }

        return view('admin/machine/show', [
            'title'        => 'Detail Machine',
            'pageTitle'    => 'Detail Machine',
            'pageSubtitle' => 'Informasi lengkap mesin Reverse Vending Machine.',
            'machine'      => $machine,
        ]);
    }

    public function edit($id)
    {
        $machine = $this->machineModel->find($id);

        if (!$machine) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Machine tidak ditemukan.'
            );
        }

        return view('admin/machine/edit', [
            'title'        => 'Edit Machine',
            'pageTitle'    => 'Edit Machine',
            'pageSubtitle' => 'Perbarui informasi mesin.',
            'machine'      => $machine,
        ]);
    }

    public function update($id)
    {
        $machine = $this->machineModel->find($id);

        if (!$machine) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Machine tidak ditemukan.'
            );
        }

        $rules = [
            'machine_code' => "required|is_unique[machines.machine_code,id,{$id}]",
            'machine_name' => 'required',
            'location'     => 'required',
            'status'       => 'required',
        ];

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->machineModel->update($id, [

            'machine_code'     => $this->request->getPost('machine_code'),
            'machine_name'     => $this->request->getPost('machine_name'),
            'location'         => $this->request->getPost('location'),
            'latitude'         => $this->request->getPost('latitude'),
            'longitude'        => $this->request->getPost('longitude'),
            'ip_address'       => $this->request->getPost('ip_address'),
            'firmware_version' => $this->request->getPost('firmware_version'),
            'status'           => $this->request->getPost('status'),

        ]);

        return redirect()
            ->to(site_url('machine'))
            ->with('success', 'Machine berhasil diperbarui.');
    }

    public function delete($id)
    {
        $machine = $this->machineModel->find($id);

        if (!$machine) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'Machine tidak ditemukan.'
            );
        }

        if ($machine['status'] === 'online') {
            return redirect()
                ->to(site_url('machine'))
                ->with('error', 'Machine yang sedang online tidak dapat dihapus.');
        }

        $this->machineModel->delete($id);

        return redirect()
            ->to(site_url('machine'))
            ->with('success', 'Machine berhasil dihapus.');
    }

    public function trash()
    {
        $machines = $this->machineModel
            ->onlyDeleted()
            ->findAll();

        return view('admin/machine/trash', [
            'title'        => 'Trash Machine',
            'pageTitle'    => 'Trash Machine',
            'pageSubtitle' => 'Daftar machine yang telah dihapus.',
            'machines'     => $machines,
        ]);
    }

    public function restore($id)
    {
        $this->machineModel
            ->where('id', $id)
            ->set('deleted_at', null)
            ->update();

        return redirect()
            ->to(site_url('machine/trash'))
            ->with('success', 'Machine berhasil dipulihkan.');
    }

    public function forceDelete($id)
    {
        $this->machineModel->delete($id, true);

        return redirect()
            ->to(site_url('machine/trash'))
            ->with('success', 'Machine berhasil dihapus permanen.');
    }

    private function generateUuid(): string
    {
        $data = random_bytes(16);

        $data[6] = chr((ord($data[6]) & 0x0f) | 0x40);
        $data[8] = chr((ord($data[8]) & 0x3f) | 0x80);

        return vsprintf(
            '%s%s-%s-%s-%s-%s%s%s',
            str_split(bin2hex($data), 4)
        );
    }

    private function generateMachineCode(): string
    {
        $lastMachine = $this->machineModel
            ->orderBy('id', 'DESC')
            ->withDeleted()
            ->first();

        if (!$lastMachine) {
            return 'RVM001';
        }

        $lastNumber = (int) substr($lastMachine['machine_code'], 3);

        return 'RVM' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    }
}