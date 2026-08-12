<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $search = trim($this->request->getGet('search') ?? '');
        $role   = $this->request->getGet('role') ?? '';
        $status = $this->request->getGet('status') ?? '';

        $builder = $this->userModel;

        if ($search !== '') {
            $builder = $builder->groupStart()
                ->like('fullname', $search)
                ->orLike('username', $search)
                ->orLike('email', $search)
                ->groupEnd();
        }

        if ($role !== '') {
            $builder = $builder->where('role', $role);
        }

        if ($status !== '') {
            $builder = $builder->where('status', $status);
        }

        $perPage = 10;

        $users = $builder
            ->orderBy('id', 'ASC')
            ->paginate($perPage);

        $pager = $this->userModel->pager;

        return view('admin/user/index', [
            'title'        => 'User Management',
            'pageTitle'    => 'User Management',
            'pageSubtitle' => 'Kelola seluruh pengguna sistem SJU.',
            'users'        => $users,
            'pager'        => $pager,
            'search'       => $search,
            'role'         => $role,
            'status'       => $status,
        ]);
    }

    public function create()
    {
        return view('admin/user/create', [
            'title' => 'Tambah User',
            'pageTitle' => 'Tambah User',
            'pageSubtitle' => 'Tambahkan pengguna baru ke sistem SJU.'
        ]);
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'username' => 'required|min_length[3]|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
            'role' => 'required',
            'status' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $this->userModel->insert([
            'uuid'     => $this->generateUuid(),
            'fullname' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'password' => password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            ),
            'role'     => $this->request->getPost('role'),
            'status'   => $this->request->getPost('status'),
        ]);

        return redirect()
            ->to(site_url('user'))
            ->with('success', 'User berhasil ditambahkan.');
    }

    public function show($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'User tidak ditemukan.'
            );
        }

        return view('admin/user/show', [
            'title'        => 'Detail User',
            'pageTitle'    => 'Detail User',
            'pageSubtitle' => 'Informasi lengkap pengguna.',
            'user'         => $user,
        ]);
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'User tidak ditemukan.'
            );
        }

        return view('admin/user/edit', [
            'title'        => 'Edit User',
            'pageTitle'    => 'Edit User',
            'pageSubtitle' => 'Perbarui informasi pengguna.',
            'user'         => $user,
        ]);
    }

    public function update($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'User tidak ditemukan.'
            );
        }

        $rules = [
            'name' => 'required|min_length[3]|max_length[100]',
            'username' => "required|min_length[3]|is_unique[users.username,id,{$id}]",
            'email' => "required|valid_email|is_unique[users.email,id,{$id}]",
            'role' => 'required',
            'status' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $data = [
            'fullname' => $this->request->getPost('name'),
            'username' => $this->request->getPost('username'),
            'email'    => $this->request->getPost('email'),
            'role'     => $this->request->getPost('role'),
            'status'   => $this->request->getPost('status'),
        ];

        if ($this->request->getPost('password') !== '') {
            $data['password'] = password_hash(
                $this->request->getPost('password'),
                PASSWORD_DEFAULT
            );
        }

        $this->userModel->update($id, $data);

        return redirect()
            ->to(site_url('user'))
            ->with('success', 'User berhasil diperbarui.');
    }

    public function delete($id)
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                'User tidak ditemukan.'
            );
        }

        if ($user['id'] == 1) {
            return redirect()
                ->to(site_url('user'))
                ->with('error', 'Administrator utama tidak dapat dihapus.');
        }

        $this->userModel->delete($id);

        return redirect()
            ->to(site_url('user'))
            ->with('success', 'User berhasil dihapus.');
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
}