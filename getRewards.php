<?php
require_once('DbOp.php');
$response = array();
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['company'])) {
        $hajji = ($_POST['company']);

        $db = new DBOp();
 
        if ($db->doesCompExist($hajjiID)) {
            $response['state'] = "yes";
            $response['companies'] = $db->getRewardsByCompany($hajjiID);
        } else {
            $response['state'] = "no";
            $response['message'] = 'Invalid Company';
        }
 
    
    } else {
        $response['state'] = "no";
        $response['message'] = 'Parameters are missing';
    }

 
} else {
    $response['state'] = "yes";
    $response['rewards'] = $db->getCompanies();
}
 
echo json_encode($response);
