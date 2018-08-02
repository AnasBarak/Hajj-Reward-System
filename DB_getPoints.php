<?php
require_once('DbOp.php');
$response = array();
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['ID'])) {
        $hajjiID = ($_POST['ID']);

        $db = new DBOp();
 
        if ($db->doesItemExist($hajjiID)) {
            $response['state'] = "yes";
            $response['info'] = $db->getItemByBarcode($hajjiID);
        } else {
            $response['state'] = "no";
            $response['message'] = 'Invalid ID';
        }
 
    
    } else {
        $response['state'] = "no";
        $response['message'] = 'Parameters are missing';
    }

 
} else {
    $response['state'] = "no";
    $response['message'] = "Request not allowed";
}
 
echo json_encode($response);
