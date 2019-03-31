<!DOCTYPE HTML>
<html>
<head>
  <title>Conference Information</title>
  <style>
  .error {color: #FF0000;}
  </style>
  <?php
  include('templates/header.php');
  include('templates/nav.php');
  $Admin_ID = $_SESSION['User_ID'];
  $Admin_PA = $_SESSION['Password'];
  $Admin_US = $_SESSION['Username'];
  $Admin_EM = $_SESSION['Email'];
  ?>
<div class="container">
  <?php
  $conName = $conDate = $conAddress = $conAbstract = $conImage = $conDescription = "";
  $conNameErr = $conDateErr = $conAddressErr = $conAbstractErr = $conImageErr = $conDescriptionErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["conName"])) {
      $conNameErr = "Conference name is required";
    } else {
      $conName = test_input($_POST["conName"]);
    }

    if (empty($_POST["conDate"])) {
      $conDateErr = "Date is required";
    } else {
      $conDate = test_input($_POST["conDate"]);
    }

    if (empty($_POST["conAddress"])) {
      $conAddressErr = "Address is required";
    } else {
      $conAddress = test_input($_POST["conAddress"]);
    }

    if (empty($_POST["conAbstract"])) {
      $conAbstractErr = "Abstract is required";
    } else {
      $conAbstract = test_input($_POST["conAbstract"]);
    }

    if (empty($_POST["conDescription"])) {
      $conDescriptionErr = "Description is required";
    } else {
      $conDescription = test_input($_POST["conDescription"]);
    }

    if (empty($_POST["conImage"])) {
      $conImage = "https://imgur.com/eJWjlBx.png";
    } else {
      $conImage = test_input($_POST["conImage"]);
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
<h2 style="margin-top: 5%">Create a conference</h2>
<hr>
<p><span class="error"style="font-size:12px">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Conference Name:</label>
      <input type="text" name="conName" value="<?php echo $conName;?>" placeholder="Name" class="form-control" required />
      <span class="error">* <?php echo $conNameErr;?></span>
      <br><br>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Conference Date: (DD-DD/MM/YYYY)</label>
      <input type="text" name="conDate" value="<?php echo $conDate;?>" placeholder="Date" class="form-control" required />
      <span class="error">* <?php echo $conDateErr;?></span>
      <br><br>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Conference Location:</label>
      <input type="text" name="conAddress" value="<?php echo $conAddress;?>" placeholder="Location" class="form-control" required />
      <span class="error">* <?php echo $conAddressErr;?></span>
      <br><br>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Conference Abstract:</label>
      <input type="text" name="conAbstract" value="<?php echo $conAbstract;?>" placeholder="Abstract" class="form-control" required />
      <span class="error">* <?php echo $conAbstractErr;?></span>
      <br><br>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Conference Description:</label>
      <input type="text" name="conDescription" value="<?php echo $conDescription;?>" placeholder="Description" class="form-control" required />
      <span class="error">* <?php echo $conDescriptionErr;?></span>
      <br><br>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Conference Image: (Please insert the image URL)</label>
      <input type="text" name="conImage" value="<?php echo $conImage;?>" placeholder="Image" class="form-control">
      <p>Example: https://xxxx/xxxx.png</p>
      <p>Defult will show 'No photo available'</p>
      <br><br>
    </div>
  </div>

  <input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="Submit" />
  <div class="d-flex justify-content-center">
    <a href="conference_info_list.php">Cancel</a>
  </div>
</form>

<?php
$fill = false;
if ($conName != "" and $conDate != "" and $conAddress != "" and $conAbstract != ""
and $conDescription != "" and $conImage != ""){
  $fill = true;
}

if ($fill == false){
  echo "";
}
else{
  $sql = "INSERT INTO CONFERENCE_INFO" . "(Con_ID, Con_Name, Con_Date, Con_Address, Con_Abstract, Con_Image, Con_Description, Admin_ID)"
  . "VALUES" . "('$Admin_ID','$conName','$conDate','$conAddress','$conAbstract','$conImage','$conDescription','$Admin_ID')";
  if (mysqli_query($conn, $sql)) {
    include('templates/add_user.php');
    include('templates/add_feedback.php');
    include('templates/add_attendance.php');
    echo "<script language=\"JavaScript\">alert(\"Successful!\");</script>";
    echo "<script language=\"JavaScript\">location.replace(\"conference_info_list.php\");\r\n</script>";
  } else {
    echo "<script language=\"JavaScript\">alert(\"Registered Failed, Please check validation!\");</script>";
  }
}
?>
</div>
<?php

include('templates/footer.php');
?>
