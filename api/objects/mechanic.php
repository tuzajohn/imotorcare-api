<?php
class Mechanic{
 
    // database connection and table name
    private $conn;
 
    // object properties
    public $id;
    public $fname;
    public $lname;
    public $type;
    public $longitude;
    public $lattitude;
    public $garage_name;
    public $garage_address;
    public $speciality;
    public $contact;
    public $byte_image;
    
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
    function read(){
    
        // select all query
        $query = "SELECT * FROM `personel_table` WHERE `type` = 'mechanic'";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
    function readOne(){
    
        // query to read single record
        $query = "SELECT * FROM `personel_table` WHERE `type` = 'mechanic' AND `id` = ?";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->id);
    
        // execute query
        $stmt->execute();
    
        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // set values to object properties
        $this->id = $row['id'];
        $this->fname = $row['fname'];
        $this->lname = $row['lname'];
        $this->type = $row['type'];
        $this->longitude = $row['longitude'];
        $this->lattitude = $row['lattitude'];
        $this->garage_name = $row['garage_name'];
        $this->garage_address = $row['garage_address'];
        $this->speciality = $row['speciality'];
        $this->contact = $row['contact'];
        $this->byte_image = $row['byte_image'];
    }
}