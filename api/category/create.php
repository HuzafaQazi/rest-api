<?php

//headers

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');





include_once('../../config/Database.php');
include_once('../../models/category.php');

//Instantiate DB and connect

$database=new Database();
$db=$database->connect();

//Instantiate blog category object
$category=new category($db);


//Get raw category data
$data=json_decode(file_get_contents("php://input"));

$category->name=$data->name;
//Create category
if ($category->create()) {
	echo json_encode(
		array('Message'=>'category Created')
		);
}
else{
echo json_encode(
		array('Message'=>'category Not Created')
		);

}



?>