<?php
require_once 'in/init.php';
$redisdb = new Redis();
$redisdb->connect('127.0.0.1', 6379);
   		
 if(!empty($_POST['body']))
{

   		$redisdb->lpush("anymsg",$_POST['body']);
   		echo 'sended';
		$indexed=$es->index([
		'index'=>'edatabase',
		'type'=>'etable',
		'body'=>[
		
		'body'=>$_POST['body'],
		
		]]);
	}
?>

<html>
	<body>
		<form action="add.php" method="post">
		<textarea name="body" rows="7" placeholder="insert any messege"></textarea ><br>
		
		<input type="submit" value="Submit"><br>
		</form>

		<br>
		<br>
		<form action="add.php" method="GET">
		<textarea name="show" rows="8" placeholder="insert any key value in this column to search the data"></textarea><br>
		
		<input type="submit" value="Submit"><br>
		</form>
	</body>

</html>
<?php
if(!empty($_GET['show']))
{
	 $arraylist = $redisdb->lrange($_GET['show'], 0 ,6);
   echo "<b>inserted messeged are:: </b><br>";
  foreach($arraylist as $arr)
  {
  	echo $arr.'<br>';
  }
}
?>