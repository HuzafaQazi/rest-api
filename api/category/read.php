<?php

//headers

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');

include_once('../../config/Database.php');
include_once('../../models/category.php');

//Instantiate DB and connect

$database=new Database();
$db=$database->connect();

//Instantiate blog Category object
$category=new category($db);

//Blog Category query
$result=$category->read($db);

//Get Row count
$num=$result->rowCount();

//check if any categories
if($num>0){
	//category array
	$cat_arr=array();
	$cats_arr['data']=array();

	while($row=$result->fetch(PDO::FETCH_ASSOC)){

		extract($row);

		$cat_item=array(
			'id'=>$id,
			'name'=>$name
		);

		//push to data
		array_push($cats_arr['data'], $cat_item);
	}
	//Turn to JSON and display output

	echo json_encode($cats_arr);

}
else{
	//No Categories

	echo json_encode(
		array('Message'=>'No Categories Found')
	);



}


?>