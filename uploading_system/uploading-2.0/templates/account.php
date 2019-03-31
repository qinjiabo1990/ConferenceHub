<?php
session_start();
require_once("config.php");
if (isset($_POST["Username"])){
  $Username = $_REQUEST["Username"];
  $Password = $_REQUEST["Password"];
  $sql = "SELECT * FROM ADMIN WHERE Admin_Name = '$Username'";

  if($result = mysqli_query($conn, $sql)){
    if (mysqli_num_rows($result) > 0) {
        // output data
        $row = mysqli_fetch_assoc($result);
        //if(password_verify($Password, $row['Admin_Password'])){
        if($Password == $row['Admin_Password']){
          $_SESSION['Username'] = $row["Admin_Name"];
          $_SESSION['User_ID'] = $row["Admin_ID"];
          $_SESSION['Password'] = $row["Admin_Password"];
          $_SESSION['Email'] = $row["Admin_Email"];
        }
        else{
          echo "<script language=\"JavaScript\">alert(\"Username or Password is wrong!\");</script>";
          echo "<script>location.href='index.php'</script>";
        }
      } else {
        echo "<script language=\"JavaScript\">alert(\"Username or Password is wrong!\");</script>";
        echo "<script>location.href='index.php'</script>";
    }
  }else{
    echo mysqli_error($conn);
  }
}
?>
