<?php
session_start();
require '../../database.php';

$response = array(
	'status' => 'fail',
	'code' => 300,
	'message' => '',
	'errror' => ''
);

if (!isset($_POST['username'])) {
	$response['error'] = "username is missing";
	echo json_encode($response);
	return;
}

if (!isset($_POST['password'])) {
	$response['error'] = "password is missing";
	echo json_encode($response);
	return;
}

$username = $_POST['username'];
$password = $_POST['password'];

$query = "select * from user where username = '$username'";
$result = $mysql -> query ($query);

if($result -> num_rows < 1){
	$response['error'] = "No user found";
	echo json_encode($response);
	return;
}

$row = $result -> fetch_object();

$h_password =   $row-> password;

if (! password_verify($password,$h_password)){
	$response['error'] = "Wrong username or password";
	echo json_encode($response);
	
}else{
	$_SESSION['username'] = $row -> username;
	$_SESSION['is_log'] = "yes";

	$response['message'] = "Login success";
	$response['status'] = "success";
	$response['code'] = 200;
	echo json_encode($response);
	return;

}



?>