<?php 

require 'rb.php';
R::setup( 'mysql:host=localhost;dbname=firstdb','root', '33Xddy2fNWDW5NQG' );

$user = R::dispense('users');
$user->name = 'bob';
$user->username = 'bob' . rand(124, 1000);
$user->password = password_hash('password', PASSWORD_DEFAULT);
R::store($user);
echo($user->username);
R::close();



?>