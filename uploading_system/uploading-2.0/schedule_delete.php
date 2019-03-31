<?php
require_once("templates/config.php");
$sch_ID = $_POST['ID'];
$sql = "DELETE FROM SCHEDULE WHERE Schedule_ID = '$sch_ID'";

if (mysqli_query($conn, $sql)) {
    echo "<script language=\"JavaScript\">alert(\"Record deleted successfully!\");</script>";
    echo "<script language=\"JavaScript\">location.replace(\"schedule_list.php\");\r\n</script>";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}

?>
