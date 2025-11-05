<?php
namespace App\Views;

require_once __DIR__ . '/../App/Config/Autoloader.php';
require_once __DIR__ . "/../App/Config/config.php";

use App\Config\Autoloader;
use App\Config;

// Autoload de toutes les classes
Autoloader::register();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/register.css">
    <script src="/js/style.js"></script>
    <title>Madame IrmIA</title>
    
</head>
<body>

<?php
include __DIR__ . '/../App/Views/user_registration.php'; 
?>

</body>
</html>