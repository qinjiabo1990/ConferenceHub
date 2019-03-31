<?php
include 'config.php';
$json = file_get_contents('php://input');
$obj = json_decode($json,true);
$email = $obj['email'];
if($email!=""){
  $sql= "SELECT * FROM USERS_INFO WHERE email='$email'";
  $result = $conn->query($sql);
  if ($result->num_rows >0) {
    while($row[] = $result->fetch_assoc()) {
      $item = $row;
      $json = json_encode($item);
    }
  }
  else {
    echo "No Results Found.";
  }
}
echo $json;
?>
