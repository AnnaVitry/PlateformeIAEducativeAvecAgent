<?php

require_once __Dir__ . ' /../controllers/UserController.php';
$userController = new \Controllers\UserController();
$users = $userController->getUsers();

