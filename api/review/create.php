<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// get database connection
include_once '../config/database.php';
 
// instantiate product object
include_once '../objects/review.php';
 
$database = new Database();
$db = $database->getConnection();
 
$review = new Review($db);
 
// get posted data
$data = json_decode(file_get_contents("php://input"));
 
// make sure data is not empty
if(
    !empty($data->personelid) &&
    !empty($data->stars) &&
    !empty($data->comment)
){
 
    // set review property values
    $review->personelid = $data->personelid;
    $review->stars = $data->stars;
    $review->comment = $data->comment;
 
    // create the product
    if($review->create()){
 
        // set response code - 201 created
        http_response_code(201);
 
        // tell the user
        echo json_encode(array("message" => "Review has been created."));
    }
 
    // if unable to create the product, tell the user
    else{
 
        // set response code - 503 service unavailable
        http_response_code(503);
 
        // tell the user
        echo json_encode(array("message" => "Unable to create review."));
    }
}
 
// tell the user data is incomplete
else{
 
    // set response code - 400 bad request
    http_response_code(400);
 
    // tell the user
    if (empty($personelid->personelid)) {
        echo json_encode(array("message" => "Unable to create review. Data is incomplete. [personelid]"));
    } else if (empty($stars->stars)){
        echo json_encode(array("message" => "Unable to create review. Data is incomplete. [stars]"));
    }else{
        echo json_encode(array("message" => "Unable to create review. Data is incomplete. [comment]"));
    }
}
?>