<table>
<?php
	if(!isset($_SESSION["username"])){
	echo '<form method="POST" action="/login"><br>
	<input type="text" name="login" placeholder="login"/><br>
	<input type="password" name="password"/>
	<input type="submit" value="Login">
	</form>';
	} else
	{
		echo"<tr><td>имя акции</td><td>сокращенное</td><td>рынок</td><td>цена</td><td>дата</td></tr>";
		foreach($data as $st){
			echo'<tr>';
			foreach($st as $row)
			{
				echo '<td>'.$row.'</td>';
			}
			echo '</tr>';
		}
	}
?>
</table>