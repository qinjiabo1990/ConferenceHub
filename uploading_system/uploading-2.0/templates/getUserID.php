<?php
include('account.php');
$Admin_EM = $_SESSION['Email'];

$sql = "SELECT * FROM USERS_INFO WHERE email = '$Admin_EM'";

if($result = mysqli_query($conn, $sql)){
  if (mysqli_num_rows($result) > 0) {
      // output data
      $row = mysqli_fetch_assoc($result);
      //if(password_verify($Password, $row['Admin_Password'])){
        $_SESSION['id'] = $row["id"];
    } else {
      echo "fail";
  }
}else{
  echo mysqli_error($conn);
}
?>
