<!DOCTYPE HTML>
<html>
<head>
  <title>Sponsors</title>
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
  $spID = $spName = $spDescription = $spWebsite = "";
  $spIDErr = $spNameErr = $spDescriptionErr = $spWebsiteErr = "";

  $sql_ask="SELECT * FROM SPONSORS WHERE Sponsors_ID = '$sch_ID'";
  $result_ask = mysqli_query($conn, $sql_ask);

    if (mysqli_num_rows($result_ask) > 0) {
        // output data
        $row = mysqli_fetch_assoc($result_ask);
        $spID = $row["Sponsors_ID"];
        //$spName = $row["Sponsors_Name"];
        $spDescription = $row["Sponsors_Description"];
        $spWebsite = $row["Sponsors_Website"];
      }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["spID"])) {
      $spIDErr = "";
    } else {
      $spID = test_input($_POST["spID"]);
    }

    if (empty($_POST["spName"])) {
      $spNameErr = "";
    } else {
      $spName = test_input($_POST["spName"]);
    }

    if (empty($_POST["spDescription"])) {
      $spDescriptionErr = "Null";
    } else {
      $spDescription = test_input($_POST["spDescription"]);
    }

    if (empty($_POST["spWebsite"])) {
      $spWebsiteErr = "Null";
    } else {
      $spWebsite = test_input($_POST["spWebsite"]);
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
<h2 style="margin-top: 5%">Edit Sponsor</h2>
<hr>
<p><span class="error"style="font-size:12px">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <input type="hidden" name="spID" value="<?php echo $spID;?>" />

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Sponsors Name:</label>
      <input type="text" name="spName" value="<?php echo $spName;?>" placeholder="Name" class="form-control" required>
      <span>if no sponsors, please input 'No Sponsors'</span>
      <br><br>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Sponsors Description:</label>
      <input type="text" name="spDescription" value="<?php echo $spDescription;?>" placeholder="Description" class="form-control">
      <br><br>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Sponsors Website:</label>
      <input type="text" name="spWebsite" value="<?php echo $spWebsite;?>" placeholder="Website" class="form-control">
      <br><br>
    </div>
  </div>

  <input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="Submit" />
  <div class="d-flex justify-content-center">
    <a href="sponsors_list.php">Cancel</a>
  </div>
</form>

<?php
$fill = false;
if ($spName != "" and $spDescription != "" and $spWebsite != ""){
  $fill = true;
}

if ($fill == false){
  echo "";
}
else{

  $sql = "UPDATE SPONSORS SET Sponsors_Name = '$spName', Sponsors_Description = '$spDescription',
  Sponsors_Website = '$spWebsite' WHERE Sponsors_ID = '$spID'";

  if (mysqli_query($conn, $sql)) {
    echo "<script language=\"JavaScript\">alert(\"Successful!\");</script>";
    echo "<script language=\"JavaScript\">location.replace(\"sponsors_list.php\");\r\n</script>";
  } else {
    echo "<script language=\"JavaScript\">alert(\"Registered Failed, Please check validation!\");</script>";
  }
}
?>
</div>
<?php
include('templates/footer.php');
?>
