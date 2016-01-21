<style type="text/css">
	.block  {
		border-top: 1px solid #777777;
		/* 70 92 be */
		padding: 12px;
		position: relative;
		width: 35%;
	}
	.subblock{
		border-top: 1px solid #777777;
		padding: 12px;
		position: relative;
		width: 20%;
		font-size: 12px;
	}
</style>
<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
<script>
	$(document).ready(function(){

		$(".block").click(function(){
			if(!$("div").is(".slideDown")){
				$("<div class='slideDown' hidden='true'></div>").insertAfter("#" + this.id);
				$.ajax({
					url: "/main/load/",
					type: 'POST',
					data: "subname=" + this.id,

					success: function(html){
						$(".slideDown").html(html);
						$("div.slideDown").slideDown("slow");
					}
				});


            } else {
				$("div.slideDown").slideUp("slow",function() {
					$(this).remove();
				});
            }
		});

	});
</script>
<?php
	if(!isset($_SESSION["username"])){
	echo '<form method="POST" action="/login"><br>
	<input type="text" name="login" placeholder="login"/><br>
	<input type="password" name="password"/>
	<input type="submit" value="Login">
	</form>';
	} else
	{
		echo '<form method="POST" action="/subscription">
		<input type="text" name="stock" placeholder="stock"/>
		<input type="submit" value="Add">
		</form>';

		//echo "имя акции   сокращенное   рынок   цена   дата";
		foreach($data as $st){
			echo '<div id=' . $st[1] . ' class="block">';
			foreach($st as $row)
			{
				echo $row . "   ";
			}
			echo "</div>";
		}

	}
?>
</table>