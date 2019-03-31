<?php
include 'config.php';
	$json = file_get_contents('php://input');
	$obj = json_decode($json,true);
	// name store into $name.
	$name = $obj['name'];
	// same with $email.
	$email = $obj['email'];
	// same with $password.
	$password = $obj['password'];

	if($email!="")
	{
    $sql= "SELECT * FROM USERS_INFO WHERE email='$email'";
    $result = $conn->query($sql);
		if($result->num_rows > 0){
      echo json_encode('email already exist');  // alert msg in react native
		}
		else
		{
      $add = "INSERT INTO USERS_INFO (username,password,email) VALUES ('$name','$password','$email')";
			if(mysqli_query($conn, $add)){
        echo json_encode('User Registered Successfully'); // alert msg in react native
			}
			else{
        echo json_encode('check internet connection'); // our query fail
			}
		}
	}
	else{
    echo json_encode('try again');
	}

?>
