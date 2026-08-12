<?php

namespace App\Controllers;

use App\Services\VoucherService;
use Ramsey\Uuid\Uuid;

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
        return view('admin/voucher/index', [

            'title'         => 'Voucher',

            'pageTitle'     => 'Voucher',

            'pageSubtitle'  => 'Kelola voucher penukaran point.',

            'vouchers'      => $this->voucherService->getAll(),

        ]);
    }

    /**
     * Detail Voucher
     */
    public function show($id)
    {
        $voucher = $this->voucherService->getDetail((int) $id);

        if (!$voucher) {

            return redirect()
                ->to('/voucher')
                ->with('error', 'Voucher tidak ditemukan.');

        }

        return view('admin/voucher/show', [

            'title'         => 'Detail Voucher',

            'pageTitle'     => 'Detail Voucher',

            'pageSubtitle'  => 'Informasi voucher.',

            'voucher'       => $voucher,

        ]);
    }

    /**
     * Form tambah voucher
     */
    public function create()
    {
        return view('admin/voucher/create', [

            'title'         => 'Tambah Voucher',

            'pageTitle'     => 'Tambah Voucher',

            'pageSubtitle'  => 'Buat voucher baru.',

        ]);
    }

    /**
     * Simpan voucher baru
     */
    public function store()
    {
        $rules = [

            'title' => [
                'label' => 'Nama Voucher',
                'rules' => 'required|min_length[3]|max_length[150]',
            ],

            'code' => [
                'label' => 'Kode Voucher',
                'rules' => 'required|is_unique[vouchers.code]',
            ],

            'point' => [
                'label' => 'Point',
                'rules' => 'required|integer|greater_than[0]',
            ],

            'stock' => [
                'label' => 'Stok',
                'rules' => 'required|integer|greater_than_equal_to[0]',
            ],

            'image' => [
                'label' => 'Gambar Voucher',
                'rules' => 'if_exist|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png]|max_size[image,2048]',
            ],

            'start_date' => [
                'label' => 'Tanggal Mulai',
                'rules' => 'permit_empty|valid_date[Y-m-d\TH:i]',
            ],

            'end_date' => [
                'label' => 'Tanggal Berakhir',
                'rules' => 'permit_empty|valid_date[Y-m-d\TH:i]',
            ],

        ];

        if (!$this->validate($rules)) {

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());

        }

        $startDate = $this->request->getPost('start_date');
        $endDate   = $this->request->getPost('end_date');

        if (!empty($startDate) && !empty($endDate)) {

            if (strtotime($endDate) <= strtotime($startDate)) {

                return redirect()
                    ->back()
                    ->withInput()
                    ->with('error', 'Tanggal berakhir harus lebih besar dari tanggal mulai.');

            }

        }

        $data = [

            'uuid' => Uuid::uuid4()->toString(),

            'code' => $this->request->getPost('code'),

            'title' => $this->request->getPost('title'),

            'description' => $this->request->getPost('description'),

            'point' => (int) $this->request->getPost('point'),

            'stock' => (int) $this->request->getPost('stock'),

            'redeemed' => 0,

            'start_date' => $this->request->getPost('start_date'),

            'end_date' => $this->request->getPost('end_date'),

            'status' => $this->request->getPost('status'),

        ];

        $image = $this->request->getFile('image');

        if ($image && $image->isValid() && !$image->hasMoved()) {

            if (!is_dir(FCPATH . 'uploads/vouchers')) {
                mkdir(FCPATH . 'uploads/vouchers', 0777, true);
            }

            $imageName = $image->getRandomName();

            $image->move(
                FCPATH . 'uploads/vouchers',
                $imageName
            );

            $data['image'] = $imageName;
        }

        $this->voucherService->create($data);

        return redirect()
            ->to('/voucher')
            ->with('success', 'Voucher berhasil ditambahkan.');
    }

    /**
     * Form edit voucher
     */
    public function edit($id)
    {
        $voucher = $this->voucherService->getDetail((int) $id);

        if (!$voucher) {

            return redirect()
                ->to('/voucher')
                ->with('error', 'Voucher tidak ditemukan.');

        }

        return view('admin/voucher/edit', [

            'title'        => 'Edit Voucher',

            'pageTitle'    => 'Edit Voucher',

            'pageSubtitle' => 'Ubah data voucher.',

            'voucher'      => $voucher,

        ]);
    }

    /**
     * Update voucher
     */
    public function update($id)
    {
        $voucher = $this->voucherService->getDetail((int) $id);

        if (!$voucher) {

            return redirect()
                ->to('/voucher')
                ->with('error', 'Voucher tidak ditemukan.');

        }

        $data = [

            'code'        => $this->request->getPost('code'),

            'title'       => $this->request->getPost('title'),

            'description' => $this->request->getPost('description'),

            'point'       => (int) $this->request->getPost('point'),

            'stock'       => (int) $this->request->getPost('stock'),

            'start_date'  => $this->request->getPost('start_date'),

            'end_date'    => $this->request->getPost('end_date'),

            'status'      => $this->request->getPost('status'),

        ];

        $image = $this->request->getFile('image');

        if ($image && $image->isValid() && !$image->hasMoved()) {

            if (!is_dir(FCPATH . 'uploads/vouchers')) {
                mkdir(FCPATH . 'uploads/vouchers', 0777, true);
            }

            // Hapus gambar lama
            if (!empty($voucher['image'])) {

                $oldImage = FCPATH . 'uploads/vouchers/' . $voucher['image'];

                if (is_file($oldImage)) {
                    unlink($oldImage);
                }

            }

            $imageName = $image->getRandomName();

            $image->move(
                FCPATH . 'uploads/vouchers',
                $imageName
            );

            $data['image'] = $imageName;
        }

        $this->voucherService->update((int) $id, $data);

        return redirect()
            ->to('/voucher')
            ->with('success', 'Voucher berhasil diperbarui.');
    }

    /**
     * Hapus voucher
     */
    public function delete($id)
    {
        $voucher = $this->voucherService->getDetail((int) $id);

        if (!$voucher) {

            return redirect()
                ->to('/voucher')
                ->with('error', 'Voucher tidak ditemukan.');

        }

        // Hapus file gambar jika ada
        if (!empty($voucher['image'])) {

            $imagePath = FCPATH . 'uploads/vouchers/' . $voucher['image'];

            if (is_file($imagePath)) {
                unlink($imagePath);
            }

        }

        $this->voucherService->delete((int) $id);

        return redirect()
            ->to('/voucher')
            ->with('success', 'Voucher berhasil dihapus.');
    }
}