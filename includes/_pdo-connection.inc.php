<?php
require_once '_constants.inc.php';
define('DB_NAME', 'miniblog');
define('DB_HOST', 'localhost');
define('DB_CHARSET', 'utf8');
define('DB_USER', _DB_USER);
define('DB_PASSWORD', _DB_PASSWORD);

try {
  $pdo = new PDO('mysql:dbname=' . DB_NAME . ';host=' . DB_HOST . ';charset=' . DB_CHARSET, DB_USER, DB_PASSWORD);
} catch (PDOException $e) {
  die('ERROR:<br>' . $e->getMessage());
}
