<?php

namespace App\Config;

require_once __DIR__. '/../App/Config/Database.php';

use App\Config\Database;

$db = new Database();
$db->connect();
$db->importSQL();
$db->showTables();
