<?php

require_once '/var/www/html/poomvc/app/config/config.php';
require_once '/var/www/html/poomvc/app/libraries/Database.php';

$db = new Database;

$db->query("SELECT * FROM posts");

print_r($db->resultSet());

?>