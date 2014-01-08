<?php
error_reporting(E_ALL);
if(isset($_GET['format'])) 
{
 
	//Set our variables
	$format = strtolower($_GET['format']);
 
	//Connect to the Database
	$dbh = new PDO("mysql:host=localhost;dbname=hello", 'root', '');

	//Run our query
	$statement = $dbh->prepare('SELECT * FROM product ORDER BY `product_id` ASC');
	$records = $statement->execute();
	$results = $statement->fetchAll(PDO::FETCH_ASSOC);
	header('Content-type: application/json');
	$data = array();
	foreach ($results as $r) {
		$data[] = array(
			'product_id' => htmlspecialchars($r['product_id']),
			'product_name' => htmlspecialchars($r['product_name']),
			'product_description' => htmlspecialchars($r['product_desc'])
		);
	}
	echo json_encode($data);
	exit;
}
 
?>