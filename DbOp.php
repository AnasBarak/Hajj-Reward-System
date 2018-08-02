<?php

class DBOp
{
    private $conn;

    function __construct(){
        require_once('DbConn.php');
        $db = new DbConnect();
        $this->conn = $db->connect();
    }
    
     public function doesItemExist($hajjiID){
        $stmt = $this->conn->prepare("SELECT hajji_SYSID FROM  `hajji-table` WHERE hajji_SYSID = ?");
        $stmt->bind_param("s", $hajjiID);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->affected_rows > 0;
    }
    
    public function getItemByBarcode($itemCode){
        $stmt = $this->conn->prepare("SELECT hajji_points FROM  `hajji-table` WHERE hajji_SYSID = ?");
        $stmt->bind_param("s", $itemCode);
        $stmt->execute();
        $stmt->bind_result($hajjiPoints);
        $stmt->fetch();
        return $hajjiPoints;
    }
}