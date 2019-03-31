<?php
include 'config.php';
	$json = file_get_contents('php://input');
	$obj = json_decode($json,true);

	$Con_ID = $obj['con_id'];
	$id = $obj['ID'];
	$Content = $obj['content'];
	$Time = $obj['time'];

	if($Content!="")
	{
    $add = "INSERT INTO FEEDBACK (Con_ID,id,Feedback_Content,Feedback_Time) VALUES ('$Con_ID','$id','$Content','$Time')";
		if(mysqli_query($conn, $add)){
      echo json_encode('Comment Successfully'); // alert msg in react native
		}
		else{
      echo json_encode('Check Internet Connection'); // our query fail
		}
	}
	else{
    echo json_encode('Feedback cannot be empty');
	}

?>
