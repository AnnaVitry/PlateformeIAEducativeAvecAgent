<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Wizard</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
    <div class="dashboard-wrapper">
        <?php include __DIR__ . '/../App/Views/sidebar.php'; ?>

        <div class="main-section">
            <?php include __DIR__ . '/../App/Views/dashboardMain.php'; ?>
        </div>
    </div>

    <?php if (!empty($users)): ?>
    <div class="users-list">
        <h3>Users :</h3>
        <ul>
            <?php foreach ($users as $u): ?>
                <li><?= htmlspecialchars($u['firstname'] . ' ' . $u['lastname']) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <script src="js/style.js"></script>
</body>
</html>