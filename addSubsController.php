<?php

require 'vendor/autoload.php';

use App\Connection;

$pdo = (new Connection())->connectSQL();

$type = $_POST['type'];
$user = $_POST['user'];
$subsStart = $_POST['subsStart'];
$subsEnd = $_POST['subsEnd'];

$sql = "INSERT INTO Subscription (type, start_date, end_date, user_id) VALUES (?,?,?,?)";
if ($pdo->prepare($sql)->execute([$type, $subsStart, $subsEnd, $user])) {
    echo 0;
    $pdo = null;
    return;
}
echo 1;

$pdo = null;
