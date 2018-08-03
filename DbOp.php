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
        $stmt = $this->conn->prepare("SELECT hajji_points, hajji_name FROM  `hajji-table` WHERE hajji_SYSID = ?");
        $stmt->bind_param("s", $itemCode);
        $stmt->execute();
        $stmt->bind_result($hajjiPoints, $hajjiName);
        $stmt->fetch();
        $info = array();
        $info['points'] = $hajjiPoints;
        $info['name'] = $hajjiName;
        return $info;
    }
    
    public function getCompanies(){
        $stmt = $this->conn->prepare("SELECT DISTINCT reward_company FROM `rewards-table`");
        $stmt->execute();
        $stmt->bind_result($rewardComp);
        $rewardComps = array();
        $i = 0;
        while ($stmt->fetch()) {
            $rewardComps[$i] = $rewardComp;
            $i++;
        }
        return $rewardComps;
    }
    
    public function getRewardsByCompany($rewardComp){
        $stmt = $this->conn->prepare("SELECT `reward_name`,`reward_price`FROM `rewards-table` WHERE reward_company = ?;");
        $stmt->bind_param("s", $rewardComp);
        $stmt->execute();
        $stmt->bind_result($rewardName, $rewardPrice);
        $rewards = array();
        $i = 0;
        while ($stmt->fetch()) {
            $info = array();
            $info['price'] = $rewardPrice;
            $info['name'] = $rewardName;
            $rewards[$i] = $info;
            $i++;
        }
        return $rewards;
    }
    
    public function doesCompExist($rewardComp){
        $stmt = $this->conn->prepare("SELECT DISTINCT reward_company FROM `rewards-table` where reward_company = ?;");
        $stmt->bind_param("s", $rewardComp);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->affected_rows > 0;
    }
    
    public function setPoint($ID, $points){
        $stmt = $this->conn->prepare("UPDATE `hajji-table` SET `hajji_points` = hajji_points + ? WHERE `hajji_SYSID` = ?;");
        $stmt->bind_param("is", $points, $ID);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->affected_rows > 0;
        
    }
}