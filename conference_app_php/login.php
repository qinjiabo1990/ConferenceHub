<?php
include 'config.php';
$json = file_get_contents('php://input');
	$obj = json_decode($json,true);
	$email = $obj['email'];
	$password = $obj['password'];

	if($email!=""){
    $sql= "SELECT * FROM USERS_INFO WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);
    if($result->num_rows==0){
      echo json_encode('Wrong Details');
    }
    else{
      echo json_encode('ok');
    }
  }
  else{
    echo json_encode('try again');
	}
?>
