<?php
session_start();

$username =$_POST["u"];
$password =$_POST["p"];

$dsn = 'mysql:dbname=main;host=127.0.0.1:3300';
$user = ;
$pass = ;
$PDO = new PDO($dsn, $user, $pass);
$stmt = $PDO->prepare("SELECT login, password FROM users  WHERE login = '$username' AND password = '$password'");

$stmt->execute();

$numrows = $stmt->rowCount();

if($numrows == 1){ 
$_SESSION["username"] = $stmt->fetchColumn(0); $_SESSION["password"] = $stmt->fetchColumn(1);
header("location: index.php");
}
 else {header("location: index.php");
 } 
 ?>