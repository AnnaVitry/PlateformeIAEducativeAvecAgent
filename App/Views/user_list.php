<?php

require_once __Dir__ . ' /../controllers/UserController.php';
$userController = new App\Controllers\UserController();
$users = $userController->getUser();

