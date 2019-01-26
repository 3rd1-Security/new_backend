<?php 

include_once 'app/config.php';
include 'emailCredential.php';

function SQLInjFilter(&$unfilteredString){
	$unfilteredString = mb_convert_encoding($unfilteredString, 'UTF-8', 'UTF-8');
	$unfilteredString = htmlentities($unfilteredString, ENT_QUOTES, 'UTF-8');
	// return $unfilteredString;
}
$error = "";
$msg = "";
$status = 0;
$ret = array();


// Compulsory credentials to be filled on registration page 
if (!isset($_POST['name']) || $_POST['name']=="") {
	$error .= "Name invalid.";
	$status = 400;
}
if (!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ) {
	$error .= "EmailID invalid. ";
	$status = 400;
}
if (!isset($_POST['password']) || $_POST['password']=='' ) {
        $error .= "Password empty ";
        $status = 400;
}
if (!isset($_POST['catagory']) || $_POST['catagory']=="") {
	$error .= "Catagory invalid.";
	$status = 400;
}
if (!isset($_POST['gender']) || $_POST['gender']=="" ) {
	$error .= "Gender invalid.";
	$status = 400;
}

// Set values that were not compulsory on frontend
if (!isset($_POST['employ']) || $_POST['employ']=="") {
	$error .= "Employment invalid.";
	$status = 400;
}
if (!isset($_POST['qualif']) || $_POST['qualif']=="") {
	$_POST['qualif'] = "N/A";
}
if (!isset($_POST['occupation']) || $_POST['occupation']=="") {
	$_POST['occupation'] = "N/A";
}

// Database Interactions begins 
if($status!=400){
	
	SQLInjFilter($_POST['email']);
	SQLInjFilter($_POST['name']);
	SQLInjFilter($_POST['password']);
	SQLInjFilter($_POST['catagory']);
	SQLInjFilter($_POST['gender']);
	SQLInjFilter($_POST['occupation']);
	SQLInjFilter($_POST['employ']);
	SQLInjFilter($_POST['qualif']);
	SQLInjFilter($_POST['aim']);

	//db stuff here
	$dbCon = new mysqli($servername, $dbusername, $password, $dbname);
	$user = new User();
	$user->arrToUser($_POST);
	$ret_temp = $user->registerUser($dbCon);
	if ($ret_temp['status']==200) {

		// Verification link sent via mail
		$mail_to = $_POST['email'];
		$subject = 'SakshamBharat Account Verification';
		$mail_body = 'Hello '. $_POST['name'] .'!<br> Thank you for registering on SakshamBharat. Click <a href="http://localhost/hack/index/?confirm?email='. urlencode($_POST['email']) .'&id='. sha1($_POST['password']) .'">here</a> to confirm your account. :)';
		$alternate_msg = 'Hello '. $_POST['name'] .'! Thank you for registering on SakshamBharat. Click on the link given to confirm your account. http://localhost/hack/index/?confirm?id='. sha1($_POST['password']) .'';
		if ( mailTo($mail_to, $subject, $mail_body, $alternate_msg) ) {
	    	$status = 200;
	    	$msg = "Verification link sent";
	    } else {
	    	$status = 201;
	    	$msg = "Verification link send failed";
	    }
	} else {
		$status = $ret_temp['status'];
		$ret = $ret_temp;
	} 
}

if ($status==200 || $status==201) {
	$ret['status'] = $status;
	$ret['message'] = $msg;
} else if ($status==400) {
	$ret['status'] = $status;
	$ret['message'] = $error;
}

echo json_encode($ret);
?>
