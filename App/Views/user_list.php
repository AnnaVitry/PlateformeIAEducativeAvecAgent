<?php

namespace App\Views;

use App\Controllers\UserController;

$userController = new UserController();
$users = $userController->getUser();

