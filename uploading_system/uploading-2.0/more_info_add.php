<!DOCTYPE HTML>
<html>
<head>
  <title>More Information</title>
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
  $infoLocation = $infoAddress = $infoLatitude = $infoLongitude = $infoWIFI = $infoOhter = "";
  $infoLocationErr = $infoAddressErr = $infoLatitudeErr = $infoLongitudeErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["infoLocation"])) {
      $infoLocationErr = "Location is required";
    } else {
      $infoLocation = test_input($_POST["infoLocation"]);
    }

    if (empty($_POST["infoAddress"])) {
      $infoAddressErr = "Address is required";
    } else {
      $infoAddress = test_input($_POST["infoAddress"]);
    }

    if (empty($_POST["infoLatitude"])) {
      $infoLatitudeErr = "Latitude is required";
    } else {
      $infoLatitude = test_input($_POST["infoLatitude"]);
    }

    if (empty($_POST["infoLongitude"])) {
      $infoLongitudeErr = "Abstract is required";
    } else {
      $infoLongitude = test_input($_POST["infoLongitude"]);
    }

    if (empty($_POST["infoWIFI"])) {
      $infoWIFI = "No information";
    } else {
      $infoWIFI = test_input($_POST["infoWIFI"]);
    }

    if (empty($_POST["infoOhter"])) {
      $infoOhter = "No information";
    } else {
      $infoOhter = test_input($_POST["infoOhter"]);
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
<h2 style="margin-top: 5%">More Information</h2>
<hr>
<p><span class="error"style="font-size:12px">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Conference Venue:</label>
      <input type="text" name="infoLocation" value="<?php echo $infoLocation;?>" placeholder="Location" class="form-control">
      <span class="error">* <?php echo $infoLocationErr;?></span>
      <br><br>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Conference Address:</label>
      <input type="text" name="infoAddress" value="<?php echo $infoAddress;?>" placeholder="Address" class="form-control" />
      <span class="error">* <?php echo $infoAddressErr;?></span>
      <br><br>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Conference Latitude: (N+/S- 00.000000)</label>
      <input type="text" name="infoLatitude" value="<?php echo $infoLatitude;?>" placeholder="Latitude" class="form-control">
      <span class="error">* <?php echo $infoLatitudeErr;?></span>
      <br><br>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Conference Longitude: (E+/W- 00.000000)</label>
      <input type="text" name="infoLongitude" value="<?php echo $infoLongitude;?>" placeholder="Longitude" class="form-control">
      <span class="error">* <?php echo $infoLongitudeErr;?></span>
      <br><br>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Conference WIFI:</label>
      <input type="text" name="infoWIFI" value="<?php echo $infoWIFI;?>" placeholder="WIFI" class="form-control">
      <br><br>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Conference Other Information: </label>
      <input type="text" name="infoOhter" value="<?php echo $infoOhter;?>" placeholder="Ohter" class="form-control">
      <br><br>
    </div>
  </div>
  <input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="Submit" />
  <div class="d-flex justify-content-center">
    <a href="more_info_list.php">Cancel</a>
  </div>
</form>

<?php
$fill = false;
if ($infoLocation != "" and $infoAddress != "" and $infoLatitude != "" and $infoLongitude != ""
and $infoWIFI != "" and $infoOhter != ""){
  $fill = true;
}

if ($fill == false){
  echo "";
}
else{
  $sql = "INSERT INTO OTHER_INFO" . "(Con_ID, Info_Location, Info_Address, Info_Latitude, Info_Longitude, Info_LatitudeDelta, Info_LongitudeDelta, Info_WIFI, Info_Other)"
  . "VALUES" . "('$Admin_ID', '$infoLocation','$infoAddress','$infoLatitude','$infoLongitude','0.1','0.1','$infoWIFI','$infoOhter')";

  if (mysqli_query($conn, $sql)) {
    echo "<script language=\"JavaScript\">alert(\"Successful!\");</script>";
    echo "<script language=\"JavaScript\">location.replace(\"more_info_list.php\");\r\n</script>";
  } else {
    echo "<script language=\"JavaScript\">alert(\"Registered Failed, Please check validation!\");</script>";
  }
}
?>
</div>
<?php
include('templates/footer.php');
?>
