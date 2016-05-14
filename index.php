<?php
require_once 'in/init.php';

$redisdb = new Redis();
$redisdb ->connect('127.0.0.1', 6379);
   		

 if(!empty($_POST['body']))
{

	 	$redisdb->lpush("anymsg",$_POST['body']);
   		echo 'the messege is sended';
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
		<form action="index.php" method="post">
		<textarea name="body" rows="8" placeholder="insert any messege"></textarea ><br>
		
		<input type="submit" value="Submit"><br>
		</form>

		<br>
		<br>
		<form action="index.php" method="GET">
		<textarea name="show" rows="8" placeholder="insert any key value in this column to search the data"></textarea><br>
		
		<input type="submit" value="Submit"><br>
		</form>
	</body>

</html>
<?php
if(!empty($_GET['show']))
{
	 $arraylist = $redis->lrange($_GET['show'], 0 ,8);
   echo "<b>messeges in database:: </b><br>";
  foreach($arraylist as $arr)
  {
  	echo $arr.'<br>';
  }
}
?>