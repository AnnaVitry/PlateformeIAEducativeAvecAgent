<?php

namespace App\Views;

require_once __DIR__ . '/../Controllers/UserController.php';

use App\Controllers\UserController;

$userController = new UserController();
$users = $userController->getUser();

