<?php
session_start();
if (isset($_SESSION['Username'])){
  session_destroy();
  echo "<script>location.href='../index.php'</script>";
}
?>
