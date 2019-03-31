<?php
include('getUserID.php');
$id = $_SESSION['id'];
$Admin_ID = $_SESSION['User_ID'];
$date = date("Y-m-d");

$sql = "INSERT INTO FEEDBACK" . "(Con_ID, id, Feedback_Content, Feedback_Time)"
. "VALUES" . "('$Admin_ID', '$id', 'Welcome Everyone', '$date')";
if (mysqli_query($conn, $sql)) {
  echo "";
} else {
  echo "<script language=\"JavaScript\">alert(\"Registered Failed, Please check validation!\");</script>";
}
?>
