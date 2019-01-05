<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/breakdown.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$breakdown = new Breakdown($db);
 
// set ID property of record to read
$breakdown->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$breakdown->readOne();
 
// check if more than 0 record found
if($breakdown->id!=null){
 
    // products array
    $breakdowns_arr=array(
        "id" => $breakdown->id,
        "fname" => $breakdown->fname,
        "lname" => $breakdown->lname,
        "type" => $breakdown->type,
        "longitude" => $breakdown->longitude,
        "lattitude" => $breakdown->lattitude,
        "garage_name" => $breakdown->garage_name,
        "garage_address" => $breakdown->garage_address,
        "speciality" => $breakdown->speciality,
        "contact" => $breakdown->contact,
        "byte_image" => $breakdown->byte_image
    );
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($breakdowns_arr);
}
 
// no breakdown found will be here

else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No breakdowns found.")
    );
}
?>