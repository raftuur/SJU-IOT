<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'AuthController::index');

$routes->group('auth', static function ($routes) {
    $routes->get('login', 'AuthController::login');
    $routes->get('register', 'AuthController::register');
    $routes->get('forgot-password', 'AuthController::forgotPassword');
    $routes->get('google', 'AuthController::google');
    $routes->get('google/callback', 'AuthController::googleCallback');
    
    $routes->post('login', 'AuthController::attemptLogin');
    $routes->post('register', 'AuthController::attemptRegister');
    $routes->post('logout', 'AuthController::logout');
    $routes->get('logout', 'AuthController::logout');
});

$routes->get('dashboard', 'Admin\DashboardController::index', [
    'filter' => 'auth'
]);

$routes->get('user', 'UserController::index', [
    'filter' => 'auth'
]);

$routes->get('user/create', 'UserController::create', [
    'filter' => 'auth'
]);

$routes->post('user/create', 'UserController::store', [
    'filter' => 'auth'
]);

$routes->get('user/(:num)', 'UserController::show/$1', [
    'filter' => 'auth'
]);

$routes->get('user/edit/(:num)', 'UserController::edit/$1', [
    'filter' => 'auth'
]);

$routes->post('user/edit/(:num)', 'UserController::update/$1', [
    'filter' => 'auth'
]);

$routes->post('user/delete/(:num)', 'UserController::delete/$1', [
    'filter' => 'auth'
]);

$routes->get('machine', 'MachineController::index', [
    'filter' => 'auth'
]);

$routes->get('machine/create', 'MachineController::create', [
    'filter' => 'auth'
]);

$routes->post('machine/create', 'MachineController::store', [
    'filter' => 'auth'
]);

$routes->get('machine/(:num)', 'MachineController::show/$1', [
    'filter' => 'auth'
]);

$routes->get('machine/edit/(:num)', 'MachineController::edit/$1', [
    'filter' => 'auth'
]);

$routes->post('machine/edit/(:num)', 'MachineController::update/$1', [
    'filter' => 'auth'
]);

$routes->post('machine/delete/(:num)', 'MachineController::delete/$1', [
    'filter' => 'auth'
]);

$routes->get('machine/trash', 'MachineController::trash', [
    'filter' => 'auth'
]);

$routes->post('machine/restore/(:num)', 'MachineController::restore/$1', [
    'filter' => 'auth'
]);

$routes->post('machine/force-delete/(:num)', 'MachineController::forceDelete/$1', [
    'filter' => 'auth'
]);

$routes->get('monitoring', 'MonitoringController::index', [
    'filter' => 'auth'
]);

$routes->get('monitoring/(:num)', 'MonitoringController::show/$1', [
    'filter' => 'auth'
]);

$routes->get('wallet', 'WalletController::index', [
    'filter' => 'auth'
]);

$routes->get('wallet/(:num)', 'WalletController::show/$1', [
    'filter' => 'auth'
]);

$routes->get('voucher', 'VoucherController::index', [
    'filter' => 'auth'
]);

$routes->get('voucher/create', 'VoucherController::create', [
    'filter' => 'auth'
]);

$routes->post('voucher/create', 'VoucherController::store', [
    'filter' => 'auth'
]);

$routes->get('voucher/edit/(:num)', 'VoucherController::edit/$1', [
    'filter' => 'auth'
]);

$routes->post('voucher/edit/(:num)', 'VoucherController::update/$1', [
    'filter' => 'auth'
]);

$routes->post('voucher/delete/(:num)', 'VoucherController::delete/$1', [
    'filter' => 'auth'
]);

$routes->get('voucher/(:num)', 'VoucherController::show/$1', [
    'filter' => 'auth'
]);

$routes->get('redemption', 'RedemptionController::index', [
    'filter' => 'auth'
]);

$routes->get('redemption/(:num)', 'RedemptionController::show/$1', [
    'filter' => 'auth'
]);

$routes->post('redemption/approve/(:num)', 'RedemptionController::approve/$1', [
    'filter' => 'auth'
]);

$routes->post('redemption/reject/(:num)', 'RedemptionController::reject/$1', [
    'filter' => 'auth'
]);

/*
|--------------------------------------------------------------------------
| Withdrawal
|--------------------------------------------------------------------------
*/

$routes->get('withdrawal', 'WithdrawalController::index', [
    'filter' => 'auth'
]);

$routes->get('withdrawal/(:num)', 'WithdrawalController::show/$1', [
    'filter' => 'auth'
]);

$routes->post('withdrawal/approve/(:num)', 'WithdrawalController::approve/$1', [
    'filter' => 'auth'
]);

/*
|--------------------------------------------------------------------------
| AI Detection
|--------------------------------------------------------------------------
*/

$routes->get('ai-detection', 'AiDetectionController::index', [
    'filter' => 'auth'
]);

$routes->get('ai-detection/(:num)', 'AiDetectionController::show/$1', [
    'filter' => 'auth'
]);

$routes->post('ai-detection/test', 'AiDetectionController::test', [
    'filter' => 'auth'
]);

$routes->group('api', static function ($routes) {

    $routes->post(
        'machine/heartbeat',
        'Api\MachineHeartbeatController::heartbeat'
    );

    $routes->post(
        'machine/sensor',
        'Api\MachineApiController::sensor'
    );

    $routes->post(
        'machine/auth',
        'Api\MachineApiController::authenticate'
    );

    $routes->get(
        'machine/session/(:any)',
        'Api\MachineApiController::session/$1'
    );

    // BOTOL
    $routes->post(
        'machine/bottle-detected',
        'Api\MachineApiController::bottleDetected'
    );

    $routes->get(
        'machine/bottle-status/(:any)',
        'Api\MachineApiController::bottleStatus/$1'
    );

    $routes->post(
        'machine/process-bottle',
        'Api\MachineApiController::processBottle'
    );

    // MACHINE SESSION
    $routes->group('machine-session', static function ($routes) {
        $routes->post('start', 'Api\MachineSessionController::start');
        $routes->post('verify', 'Api\MachineSessionController::verify');
        $routes->post('verify-qr', 'Api\MachineSessionController::verifyQr');
        $routes->post('progress', 'Api\MachineSessionController::progress');
        $routes->post('finish', 'Api\MachineSessionController::finish');
        $routes->post('cancel', 'Api\MachineSessionController::cancel');
        $routes->get(
            'status/(:any)',
            'Api\MachineSessionController::status/$1'
        );
    });
});

$routes->group('user', ['filter' => 'auth'], function ($routes) {
    $routes->get('dashboard', 'User\DashboardController::index');
    $routes->get('qrcode', 'User\QrCodeController::index');
    $routes->get('machine', 'User\MachineController::index');
    $routes->get('machine/(:num)', 'User\MachineController::show/$1');
    $routes->get('machine/(:num)/use', 'User\MachineController::use/$1');
    $routes->get('wallet', 'User\WalletController::index');

    /*
    |--------------------------------------------------------------------------
    | Transaction
    |--------------------------------------------------------------------------
    */

    $routes->get('transaction', 'User\TransactionController::index');
    $routes->get('transaction/(:num)', 'User\TransactionController::show/$1');
    
    /*
    |--------------------------------------------------------------------------
    | Voucher
    |--------------------------------------------------------------------------
    */
    
    $routes->get('voucher', 'User\VoucherController::index');
    $routes->get('voucher/(:num)', 'User\VoucherController::show/$1');
    $routes->post('voucher/redeem/(:num)', 'User\VoucherController::redeem/$1');

    /*
    |--------------------------------------------------------------------------
    | Reward
    |--------------------------------------------------------------------------
    */

    $routes->get('reward', 'User\RewardController::index');
    $routes->get('reward/(:num)', 'User\RewardController::show/$1');

    /*
    |--------------------------------------------------------------------------
    | Withdrawal
    |--------------------------------------------------------------------------
    */

    $routes->get('withdrawal', 'User\WithdrawalController::index');
    $routes->get('withdrawal/create', 'User\WithdrawalController::create');
    $routes->post('withdrawal/create', 'User\WithdrawalController::store');
    $routes->get('withdrawal/(:num)', 'User\WithdrawalController::show/$1');

    $routes->get('profile', 'User\ProfileController::index');
});