<?php


//headers

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');
header('Access-Control-Allow-Methods:PUT');
header('Access-Control-Allow-Headers:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');





include_once('../../config/Database.php');
include_once('../../models/post.php');

//Instantiate DB and connect

$database=new Database();
$db=$database->connect();

//Instantiate blog post object
$post=new post($db);


//Get raw post data
$data=json_decode(file_get_contents("php://input"));

//Set ID to delete
$post->id=$data->id;


//delete post
if ($post->delete()) {
	echo json_encode(
		array('Message'=>'Post Deleted')
		);
}
else{
echo json_encode(
		array('Message'=>'Post Not Deleted')
		);

}



?>

