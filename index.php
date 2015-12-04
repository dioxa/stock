<?php
session_start();

if(!isset($_SESSION["username"])){
	echo '<form method="POST" action="login.php">
<input type="text" id="u" placeholder="username" name="u"/>
<input type="password" id="p" placeholder="password" name="p"/>
<input type="submit" value="Login"></form>';
	}
	else{
		echo' Hello,' . $_SESSION["username"] . '
		<form method="POST" action="logout.php">
		<input type="submit" value="Logout"></form>';
		
		echo '<form method="POST" action="parse.php">
		<input type="text" id="stock" placeholder="stock" name="stock"/>
		<input type="submit" value="search"></form>';
		
		$dsn = 'mysql:dbname=main;host=127.0.0.1:3300';
		$user = 'root';
		$pass = '655776';
		$PDO = new PDO($dsn, $user, $pass);
		$stmt = $PDO->prepare('select st.*, stock_info.price, stock_info.date from stocks as st join subscriptions as s on st.subname=s.stock_subname join users on s.user_id=users.id join stock_info on st.subname = stock_info.subname  WHERE users.id  = :id');
		$stmt->bindParam(':id',$_SESSION["id"]);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_NUM);
		
		foreach($result as $row){
				foreach($row as $value)
					echo $value . "   ";
				echo"<br/>";
				}
			$PDO = null;
	}
?>