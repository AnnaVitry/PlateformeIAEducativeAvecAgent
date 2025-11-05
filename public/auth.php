<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Wizard</title>
    <link rel="stylesheet" href="css/log_register.css">
</head>
<body>
     <div class="login-wrapper">
        <?php include __DIR__ . '/../App/Views/login.php'; ?>
    </div>
    <div class="register-wrapper">
        <?php include __DIR__ . '/../App/Views/user_registration.php'; ?>
    </div>
</body>