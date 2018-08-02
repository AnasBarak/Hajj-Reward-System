<?php
require_once('DbOp.php');
$response = array();
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['company'])) {
        $hajji = ($_POST['company']);

        $db = new DBOp();
 
        if ($db->doesCompExist($hajjiID)) {
            $response['state'] = "yes";
            $response['rewards'] = $db->getRewardsByCompany($hajjiID);
        } else {
            $response['state'] = "no";
            $response['message'] = 'Invalid Company';
        }
 
    
    } else {
        $response['state'] = "yes";
    $response['companies'] = $db->getCompanies();
    }

 
} else {
    $response['state'] = "no";
    $response['message'] = "Request not allowed";
}
 
echo json_encode($response);
