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
		
		$dsn = 'mysql:dbname=main;host=127.0.0.1:3300';
		$user = 'root';
		$pass = '655776';
		$PDO = new PDO($dsn, $user, $pass);
		$stmt = $PDO->prepare('select st.* from stocks as st join subscriptions as s on st.id=s.stock_id join users on s.user_id=users.id WHERE users.id  = :id');
		$stmt->bindParam(':id',$_SESSION["id"]);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_NUM);
		
		if ($stmt->rowCount()>1){
			foreach($result as $row){
				foreach($row as $value)
					echo $value . " ";
				echo"<br/>";
				}
			} else{
				foreach($result as $value){
					echo $value . " ";
				}
			}
	}
?>