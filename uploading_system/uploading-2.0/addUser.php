<?php
$sql = "INSERT INTO USERS_INFO" . "(username, password, email)"
. "VALUES" . "('$adName', '$adPassword', '$adEmail')";
if (mysqli_query($conn, $sql)) {
  echo "";
} else {
  echo "<script language=\"JavaScript\">alert(\"Registered Failed, Please check validation!\");</script>";
}
?>
