<?php

namespace App\Controllers\User;

use App\Controllers\BaseController;
use App\Models\UserModel;

class ProfileController extends BaseController
{
    protected UserModel $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // Cek login
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        // Hanya user
        if (session()->get('role') !== 'user') {
            return redirect()->to('/dashboard');
        }

        $userId = session()->get('userId');

        $user = $this->userModel->find($userId);

        if (!$user) {
            session()->destroy();

            return redirect()->to('/auth/login');
        }

        return view('user/profile/index', [
            'title'       => 'Profile',
            'pageTitle'   => 'Profile Saya',
            'pageSubtitle' => 'Kelola informasi akun kamu.',
            'user'        => $user,
        ]);
    }

    public function updateAvatar()
    {
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/auth/login');
        }

        if (session()->get('role') !== 'user') {
            return redirect()->to('/dashboard');
        }

        $userId = session()->get('userId');

        $user = $this->userModel->find($userId);

        if (!$user) {
            session()->destroy();

            return redirect()->to('/auth/login');
        }

        $file = $this->request->getFile('avatar');

        if (!$file || !$file->isValid()) {
            return redirect()
                ->to('/user/profile')
                ->with('error', 'File avatar tidak valid.');
        }

        // Validasi format
        $allowedTypes = [
            'image/jpeg',
            'image/png',
            'image/webp',
        ];

        if (!in_array($file->getMimeType(), $allowedTypes, true)) {
            return redirect()
                ->to('/user/profile')
                ->with('error', 'Avatar harus berupa JPG, PNG, atau WebP.');
        }

        // Validasi ukuran maksimal 2 MB
        if ($file->getSize() > 2 * 1024 * 1024) {
            return redirect()
                ->to('/user/profile')
                ->with('error', 'Ukuran avatar maksimal 2 MB.');
        }

        $uploadPath = FCPATH . 'uploads/avatar';

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // Hapus avatar lama
        if (!empty($user['avatar'])) {

            $oldAvatar = $uploadPath . DIRECTORY_SEPARATOR . $user['avatar'];

            if (is_file($oldAvatar)) {
                unlink($oldAvatar);
            }
        }

        // Nama file baru
        $newName = $file->getRandomName();

        $file->move($uploadPath, $newName);

        // Simpan ke database
        $this->userModel->update($userId, [
            'avatar' => $newName,
        ]);

        // Update session avatar
        session()->set('avatar', $newName);

        return redirect()
            ->to('/user/profile')
            ->with('success', 'Avatar berhasil diperbarui.');
    }
}