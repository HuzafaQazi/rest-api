<?php

//headers

header('Access-Control-Allow-Origin:*');
header('Content-Type:application/json');

include_once('../../config/Database.php');
include_once('../../models/category.php');

//Instantiate DB and connect

$database=new Database();
$db=$database->connect();

//Instantiate blog category object
$category=new category($db);

//Get ID
$category->id=isset($_GET['id']) ? $_GET['id'] : die();

//Get Post
$category->read_single();

//Create Array
$cat_arr=array(
	'id'=>$category->id,
	'name'=>$category->name

	
);

//Make JSON
print_r(json_encode($cat_arr));






?>