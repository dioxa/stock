<?php

 
function parse($name, $start,$finish) {
	$position = strpos($name, $start);
	
	$name = substr($name, $position);
	$position = strpos($name, $finish);
	
	$name = substr($name, 0, $position);
	$name = strip_tags($name);

	$position = "";

	return $name;
} 

function adding($subname){
	
	$dsn = 'mysql:dbname=main;host=127.0.0.1:3300';
	$user = 'root';
	$pass = '655776';

	$PDO = new PDO($dsn, $user, $pass);
	
	$url = 'http://finance.yahoo.com/q?s=' . $subname;
		
	$start = '<div class="title"><h2>';
	$finish = '<span class="up_g time_rtq_content"';
	$content = file_get_contents($url);  
	$position = strpos($content, $start);

	$content = substr($content, $position);
	$position = strpos($content, $finish);
	$content = substr($content, 0, $position);

	$info[] = substr(parse($content, '<div class="title"><h2>', '</h2> <span class="rtq_exch">'), 0 ,-6);
	$info[] = strtoupper($subname);
	$info[] = substr(parse($content, '<span class="rtq_dash">-</span>', '</span><span class="wl_sign">'), 1);
	$info[] = parse($content, '<div> <span class="time_rtq_ticker">', '</span></span>');
	$info[] = date("Y-m-d");

	$stmt = $PDO->prepare("INSERT INTO stocks(name, subname, market) VALUES (:name, :subname, :mark);INSERT INTO stock_info(subname, price, date) VALUES(:subname, :price, :date)");
	$stmt->bindParam(':name', $info[0]);
	$stmt->bindParam(':subname', $info[1]);
	$stmt->bindParam(':mark', $info[2]);	
	$stmt->bindParam(':price', $info[3]);
	$stmt->bindParam(':date', $info[4]);
	
	$stmt->execute();
	
	print_r($stmt->errorInfo());
	
	update($info[1]);
	
	print_r($stmt->errorInfo());
	
	$PDO = null;
	header("location: index.php");
}

function update($subname){
	$dsn = 'mysql:dbname=main;host=127.0.0.1:3300';
	$user = 'root';
	$pass = '655776';
	$PDO = new PDO($dsn, $user, $pass); 
	
	$stmt = $PDO->prepare("INSERT INTO subscriptions(user_id, stock_subname) VALUES(:id, :sub)");
	$stmt->bindParam(':id', $_SESSION["id"]);	
	$stmt->bindParam(':sub', $subname);
	
	$stmt->execute();
	$PDO = null;
	
}

session_start(); 

$dsn = 'mysql:dbname=main;host=127.0.0.1:3300';
$user = 'root';
$pass = '655776';

$PDO = new PDO($dsn, $user, $pass);

$stock_subname = $_POST["stock"];
$stmt = $PDO->prepare('SELECT * FROM stocks WHERE subname=:sub ');
$stmt->bindParam(':sub', $stock_subname);
$stmt->execute();

$numrows = $stmt->rowCount();

if($numrows == 1){
		update($stock_subname);
		header("location: index.php");
} else{
		adding($stock_subname);
	}
?>