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

//Set ID to delete
$category->id=$data->id;


//delete category
if ($category->delete()) {
	echo json_encode(
		array('Message'=>'Category Deleted')
		);
}
else{
echo json_encode(
		array('Message'=>'Category Not Deleted')
		);

}



?>

