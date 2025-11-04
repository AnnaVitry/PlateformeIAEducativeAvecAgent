<?php
namespace App\Views;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/dashboard.css">
    <script src="/js/style.js"></script>
    <title>Madame IrmIA</title>
    
</head>
<body>

<?php
include __DIR__ . '/../App/Views/sidebar.php'; 
include __DIR__ . '/../App/Views/dashboardMain.php'; 
?>

</body>
</html>