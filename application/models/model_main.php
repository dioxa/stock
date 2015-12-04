<?php
class Model_Main extends Model
{
	public function get_data()
	{	
		if(isset($_SESSION["username"])){
			include 'application/core/connect_db.php';
			$stmt = $PDO->prepare('select st.*, stock_info.price, stock_info.date from stocks as st join subscriptions as s on st.subname=s.stock_subname join users on s.user_id=users.id join stock_info on st.subname = stock_info.subname  WHERE users.id  = :id');
			$stmt->bindParam(':id', $_SESSION["id"]);
			$stmt->execute();
			$result = $stmt->fetchAll(PDO::FETCH_NUM);
		} else
		{
			$result = "Сначало залогинтесь";
		}
		return $result;
	}
}
?>