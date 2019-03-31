<!DOCTYPE HTML>
<html>
<head>
  <title>Exhibitors</title>
  <style>
  .error {color: #FF0000;}
  </style>
  <?php
  include('templates/header.php');
  include('templates/nav.php');
  $Admin_ID = $_SESSION['User_ID'];
  $sch_ID = $_POST['ID'];
  ?>
<div class="container">
  <?php
  $exID = $exName = $exDescription = $exWebsite = "";
  $exIDErr = $exNameErr = $exDescriptionErr = $exWebsiteErr = "";

  $sql_ask="SELECT * FROM EXHIBITORS WHERE Exhibitors_ID = '$sch_ID'";
  $result_ask = mysqli_query($conn, $sql_ask);

    if (mysqli_num_rows($result_ask) > 0) {
        // output data
        $row = mysqli_fetch_assoc($result_ask);
        $exID = $row["Exhibitors_ID"];
        //$exName = $row["Exhibitors_Name"];
        $exDescription = $row["Exhibitors_Description"];
        $exWebsite = $row["Exhibitors_Website"];
      }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["exID"])) {
      $exIDErr = "";
    } else {
      $exID = test_input($_POST["exID"]);
    }

    if (empty($_POST["exName"])) {
      $exNameErr = "";
    } else {
      $exName = test_input($_POST["exName"]);
    }

    if (empty($_POST["exDescription"])) {
      $exDescriptionErr = "Null";
    } else {
      $exDescription = test_input($_POST["exDescription"]);
    }

    if (empty($_POST["exWebsite"])) {
      $exWebsiteErr = "Null";
    } else {
      $exWebsite = test_input($_POST["exWebsite"]);
    }
  }

  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data); //htmlspecialchars() replaces HTML characters like < and > with &lt; and &gt; which is used to defend hacker attack.
    return $data;
  }
  ?>
<br>
<h2 style="margin-top: 5%">Exhibitors Edit</h2>
<hr>
<p><span class="error"style="font-size:12px">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <input type="hidden" name="exID" value="<?php echo $exID;?>" />
  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Exhibitors Name:</label>
      <input type="text" name="exName" value="<?php echo $exName;?>" placeholder="Name" class="form-control" required>
      <span>if no exhibitors, please input 'No Exhibitors'</span>
      <br><br>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Exhibitors Description:</label>
      <input type="text" name="exDescription" value="<?php echo $exDescription;?>" placeholder="Description" class="form-control">
      <br><br>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Exhibitors Website:</label>
      <input type="text" name="exWebsite" value="<?php echo $exWebsite;?>" placeholder="Website" class="form-control">
      <br><br>
    </div>
  </div>

  <input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="Submit" />
  <div class="d-flex justify-content-center">
    <a href="exhibitors_list.php">Cancel</a>
  </div>
</form>

<?php
$fill = false;
if ($exName != "" and $exDescription != "" and $exWebsite != ""){
  $fill = true;
}

if ($fill == false){
  echo "";
}
else{
  $sql = "UPDATE EXHIBITORS SET Exhibitors_Name = '$exName', Exhibitors_Description = '$exDescription',
  Exhibitors_Website = '$exWebsite' WHERE Exhibitors_ID = '$exID'";

  if (mysqli_query($conn, $sql)) {
    echo "<script language=\"JavaScript\">alert(\"Successful!\");</script>";
    echo "<script language=\"JavaScript\">location.replace(\"exhibitors_list.php\");\r\n</script>";
  } else {
    echo "<script language=\"JavaScript\">alert(\"Registered Failed, Please check validation!\");</script>";
  }
}
?>
</div>
<?php
include('templates/footer.php');
?>
