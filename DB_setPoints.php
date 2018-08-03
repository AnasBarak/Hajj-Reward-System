<?php
require_once('DbOp.php');
$response = array();
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['ID'])) {
        $ID = ($_POST['ID']);

        $db = new DBOp();
 
        if ($db->doesCompExist($ID)) {
            $response['state'] = "yes";
            $response['return'] = $db->setPoint($ID,1);
        } else {
            $response['state'] = "no";
            $response['message'] = 'Invalid Company';
        }
 
    
    } else {

        $response['state'] = "no";
        $response['message'] = 'Invalid Paramater';
    }

 
} else {
    $response['state'] = "no";
    $response['message'] = "Request not allowed";
}
 
echo json_encode($response);
