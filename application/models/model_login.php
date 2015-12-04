<?php
class Model_Login extends Model
{
	public function login($username, $password)
	{
		include 'application/core/connect_db.php';
		$stmt = $PDO->prepare('SELECT * FROM users  WHERE login = :user AND password = :pass');
		$stmt->bindParam(':user', $username);
		$stmt->bindParam(':pass', $password);
		$stmt->execute();
		$numrows = $stmt->rowCount();
		if($numrows == 1){
			$user_info = $stmt->fetch(PDO::FETCH_NUM);
			$_SESSION["id"] = $user_info[0];
			$_SESSION["username"] = $user_info[1]; 
		}
		$PDO = null;
	}
}
?>