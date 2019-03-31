<?php
include('getUserID.php');
$id = $_SESSION['id'];
$Admin_ID = $_SESSION['User_ID'];

$sql = "INSERT INTO USERS_ATTENDANCE" . "(Con_ID, id)"
. "VALUES" . "('$Admin_ID', '$id')";
if (mysqli_query($conn, $sql)) {
  echo "";
} else {
  echo "<script language=\"JavaScript\">alert(\"Registered Failed, Please check validation!\");</script>";
}
?>
