<?php
require_once('DbOp.php');
$response = array();
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['company'])) {
        $company = ($_POST['company']);

        $db = new DBOp();
 
        if ($db->doesCompExist($company)) {
            $response['state'] = "yes";
            $response['rewards'] = $db->getRewardsByCompany($company);
        } else {
            $response['state'] = "no";
            $response['message'] = 'Invalid Company';
        }
 
    
    } else {
                $db = new DBOp();

        $response['state'] = "yes";
        $response['companies'] = $db->getCompanies();
    }

 
} else {
    $response['state'] = "no";
    $response['message'] = "Request not allowed";
}
 
echo json_encode($response);
