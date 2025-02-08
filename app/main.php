<?php

require_once __DIR__ . "/../vendor/autoload.php";

use Models\Requests\LoginRequest;
use Models\Requests\RegisterRequest;
use Services\AuthService;

$di = new DI();
$authService = $di->container->get(AuthService::class);

$request = new RegisterRequest();
$request->username = 'test_new';
$request->password = 'test12345';
$request->email = 'test@test.com';
$request->firstName = 'Test';
$request->lastName = 'Test2';
$request->interests = [];
$request->state = 1;

try {
    print_r($authService->register($request));
} catch (Exception $e) {
    print_r($e);
}

$request = new LoginRequest();
$request->email = 'test@test.com';
$request->password = 'test12345';

try {
    print_r($authService->login($request));
} catch (Exception $e) {
    print_r($e);
}




