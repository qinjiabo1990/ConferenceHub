<?php
include 'config.php';
$json = file_get_contents('php://input');
$obj = json_decode($json,true);
$id = $obj['ID'];
// Creating SQL command to fetch all records from Table.
$sql = "SELECT * FROM EXHIBITORS WHERE Con_ID='$id'";

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
