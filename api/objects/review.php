<?php
class Review{
 
    // database connection and table name
    private $conn;
 
    // object properties
    public $id;
    public $stars;
    public $comment;
    public $personelid;
    


    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
    function read(){
    
        // select all query
        //$query = "SELECT * FROM `rating_table` WHERE `personelid` = '$personelid'";
        $query = "SELECT * FROM `rating_table`";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
    // create review
    function create(){
    
        // query to insert record
        //$query = "INSERT INTO `rating_table` (`personelid`, `stars`, `comment`)
        //VALUES(personelid=:personelid, stars=:stars, comment=:comment)";
        $query = "INSERT INTO `rating_table` 
         set personelid=:personelid, stars=:stars, comment=:comment";
    
        // prepare query
        $stmt = $this->conn->prepare($query);
    
        // sanitize
        $this->personelid=htmlspecialchars(strip_tags($this->personelid));
        $this->stars=htmlspecialchars(strip_tags($this->stars));
        $this->comment=htmlspecialchars(strip_tags($this->comment));
    
        // bind values
        $stmt->bindParam(":personelid", $this->personelid);
        $stmt->bindParam(":stars", $this->stars);
        $stmt->bindParam(":comment", $this->comment);

        // execute query
        if($stmt->execute()){
            return true;
        }
    
        return false;
        
    }
    function readOne(){
    
        // query to read single record
        $query = "SELECT * FROM `rating_table` WHERE  `personelid` = ?";
    
        // prepare query statement
        $stmt = $this->conn->prepare($query);
    
        // bind id of product to be updated
        $stmt->bindParam(1, $this->personelid);
    
        // execute query
        $stmt->execute();
    
        return $stmt;
    }
}