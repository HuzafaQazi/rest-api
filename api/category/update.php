<?php


//headers

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:PUT');
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

//Set ID to update
$category->id=$data->id;


$category->name=$data->name;

//Update category
if ($category->update()) {
	echo json_encode(
		array('Message'=>'Post Updated')
		);
}
else{
echo json_encode(
		array('Message'=>'Post Not updated')
		);

}



?>

