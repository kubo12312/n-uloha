<?php

require 'vendor/autoload.php';

use App\Connection;

$pdo = (new Connection())->connectSQL();  

$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$date = $_POST['date'];

$sql = "INSERT INTO User (email, password, reg_date) VALUES (?,?,?)";
if($pdo->prepare($sql)->execute([$email, $password, $date])) {
    echo 0;
    return;
}

echo 1;

$pdo = null;