<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/mechanic.php';
 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
// prepare product object
$mechanic = new Mechanic($db);
 
// set ID property of record to read
$mechanic->id = isset($_GET['id']) ? $_GET['id'] : die();
 
// read the details of product to be edited
$mechanic->readOne();
 
// check if more than 0 record found
if($mechanic->id!=null){
 
    // products array
    $mechanics_arr=array(
        "id" => $mechanic->id,
        "fname" => $mechanic->fname,
        "lname" => $mechanic->lname,
        "type" => $mechanic->type,
        "longitude" => $mechanic->longitude,
        "lattitude" => $mechanic->lattitude,
        "garage_name" => $mechanic->garage_name,
        "garage_address" => $mechanic->garage_address,
        "speciality" => $mechanic->speciality,
        "contact" => $mechanic->contact,
        "byte_image" => $mechanic->byte_image
    );
    // set response code - 200 OK
    http_response_code(200);
 
    // show products data in json format
    echo json_encode($mechanics_arr);
}
 
// no mechanic found will be here

else{
 
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user no products found
    echo json_encode(
        array("message" => "No mechanics found.")
    );
}
?>