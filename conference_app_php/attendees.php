<?php
include 'config.php';
$json = file_get_contents('php://input');
$obj = json_decode($json,true);
$id = $obj['ID'];
// Creating SQL command to fetch all records from Table.
$sql = "SELECT * FROM USERS_ATTENDANCE, USERS_INFO WHERE Con_ID='$id' AND USERS_ATTENDANCE.id = USERS_INFO.id";

$result = $conn->query($sql);

if ($result->num_rows >0) {
  while($row[] = $result->fetch_assoc()) {
    $item = $row;
    $json = json_encode($item);
  }
}
else {
  echo json_encode("No Results Found.");
}
echo $json;

?>