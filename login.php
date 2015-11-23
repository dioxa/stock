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
	$user_info = $stmt->fetch(PDO::FETCH_NUM);
	$_SESSION["id"] = $user_info[0];
	$_SESSION["username"] = $user_info[1]; 
	$_SESSION["password"] = $user_info[2];
	$PDO = null;
header("location: index.php");
}
 else {
	$PDO = null;
	header("location: index.php");
 } 
 ?>