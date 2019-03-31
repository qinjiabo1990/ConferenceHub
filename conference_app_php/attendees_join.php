<?php
include 'config.php';
	$json = file_get_contents('php://input');
	$obj = json_decode($json,true);

	$Con_ID = $obj['con_id'];
	$id = $obj['ID'];

  $sql = "SELECT * FROM USERS_ATTENDANCE WHERE Con_ID='$Con_ID' AND id='$id'";
  $result = $conn->query($sql);

	if($result->num_rows == 0)//need to be changed
	{
    $add = "INSERT INTO USERS_ATTENDANCE (id,Con_ID) VALUES ('$id','$Con_ID')";
		if(mysqli_query($conn, $add)){
      echo json_encode('Join Successfully'); // alert msg in react native
		}
		else{
      echo json_encode('Check Internet Connection'); // our query fail
		}
	}
	else{
    echo json_encode('You have joined the conference');
	}

?>
