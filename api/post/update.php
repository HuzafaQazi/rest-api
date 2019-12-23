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

//Set ID to update
$post->id=$data->id;


$post->title=$data->title;
$post->body=$data->body;
$post->author=$data->author;
$post->category_id=$data->category_id;

//Update post
if ($post->update()) {
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

