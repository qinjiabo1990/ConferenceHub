<!DOCTYPE HTML>
<html>
<head>
  <title>Sponsers</title>
  <style>
  .error {color: #FF0000;}
  </style>
  <?php
  include('templates/header.php');
  include('templates/nav.php');
  $Admin_ID = $_SESSION['User_ID'];
  ?>
<div class="container">
  <?php
  $spName = $spDescription = $spWebsite = "";
  $spNameErr = $spDescriptionErr = $spWebsiteErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["spName"])) {
      $spNameErr = "";
    } else {
      $spName = test_input($_POST["spName"]);
    }

    if (empty($_POST["spDescription"])) {
      $spDescriptionErr = "";
    } else {
      $spDescription = test_input($_POST["spDescription"]);
    }

    if (empty($_POST["spWebsite"])) {
      $spWebsiteErr = "";
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
<h2 style="margin-top: 5%">Create a sponsor</h2>
<hr>
<p><span class="error"style="font-size:12px">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Sponsors Name:</label>
      <input type="text" name="spName" value="<?php echo $spName;?>" placeholder="Name" class="form-control">
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
    <a href="exhibitors_list.php">Cancel</a>
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
  $sql = "INSERT INTO SPONSORS" . "(Con_ID, Sponsors_Name, Sponsors_Description, Sponsors_Website)"
  . "VALUES" . "('$Admin_ID','$spName','$spDescription','$spWebsite')";

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
