<?php 
require_once 'in/init.php';
  
if(isset($_GET['find']))
	{
		$q=$_GET['find'];
		$query=$es->search([
		'body'=>[
		'query'=>[
		'bool'=>[
		'should'=>[
		
		'match'=>['body'=>$q]
		]]]]]
		);
	}
if($query['hits']['total']>=1)
	{
		$results=$query['hits']['hits'];

}	
?>

<html>
	<body>
		<form action="search.php"method="get" autocomplete="off">
			<input type="text" name="find">
			<input type="submit" value="find">		</form>
	</body>
<?php
foreach($results as $result)
{
	
	 echo '<b>'.$result['_source']['body'].'<b><br>';
	

}
?>
</html>