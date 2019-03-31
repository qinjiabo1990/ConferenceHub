<?php
include('templates/account.php');
$username = $_SESSION['Username'];
$Admin_ID = $_SESSION['User_ID'];

$all_username = "SELECT Admin_Name FROM ADMIN";
$result_user = $conn->query($all_username);

$sql = "SELECT * FROM SPEAKERS, EXHIBITORS, SPONSORS, CONFERENCE_INFO
WHERE CONFERENCE_INFO.Con_ID = '$Admin_ID' AND CONFERENCE_INFO.Con_ID = EXHIBITORS.Con_ID
AND CONFERENCE_INFO.Con_ID = SPONSORS.Con_ID AND CONFERENCE_INFO.Con_ID = SPEAKERS.Con_ID";

if($result_user->num_rows > 0){
  while($row = $result_user->fetch_assoc()){
    if($row["Admin_Name"] == $username){
    echo "<script language=\"JavaScript\">location.replace(\"admin_list.php\");\r\n</script>";
    }
    else{
      if($result = mysqli_query($conn, $sql)){
        if (mysqli_num_rows($result) > 0) {
            echo "<script language=\"JavaScript\">location.replace(\"main_page.php\");\r\n</script>";
          } else {
            echo "<script language=\"JavaScript\">location.replace(\"main_page.php\");\r\n</script>";
        }
      }else{
        echo mysqli_error($conn);
      }
    }
  }
}
?>
