<?php

namespace App\Controllers;

use App\Services\AuthService;

class AuthController extends BaseController
{
    protected AuthService $authService;

    public function __construct()
    {
        $this->authService = new AuthService();
    }

    public function index()
    {
        return redirect()->to('/auth/login');
    }

    public function login()
    {
        // Jika sudah login, arahkan sesuai role
        if ($this->authService->isLoggedIn()) {

            if ($this->authService->getRole() === 'admin') {
                return redirect()->to('/dashboard');
            }

            if ($this->authService->getRole() === 'user') {
                return redirect()->to('/user/dashboard');
            }
        }

        return view('auth/login');
    }

    public function register()
    {
        //
    }

    public function forgotPassword()
    {
        //
    }

    public function google()
    {
        //
    }

    public function googleCallback()
    {
        //
    }

    public function attemptLogin()
    {
        $rules = $this->authService->loginRules();

        if (! $this->validate($rules)) {

            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $user = $this->authService->findUserByEmail(
            $this->request->getPost('email')
        );

        if (! $user) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Email atau password salah.');
        }

        if (! $this->authService->verifyPassword(
            $this->request->getPost('password'),
            $user['password']
        )) {

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Email atau password salah.');
        }

        // Simpan session
        $this->authService->createSession($user);

        // Redirect sesuai role
        switch ($user['role']) {

            case 'admin':
                return redirect()->to('/dashboard');

            case 'user':
                return redirect()->to('/user/dashboard');

            default:
                $this->authService->destroySession();

                return redirect()
                    ->back()
                    ->with('error', 'Role user tidak dikenali.');
        }
    }

    public function attemptRegister()
    {
        //
    }

    public function logout()
    {
        $this->authService->destroySession();

        return redirect()->to('/auth/login');
    }
}