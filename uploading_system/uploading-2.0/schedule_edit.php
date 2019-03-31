<!DOCTYPE HTML>
<html>
<head>
  <title>Schedule</title>
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
  $schID = $schTitle = $schDescription = $schLocation = $schStart = $schEnd = "";
  $schIDErr = $schTitleErr = $schDescriptionErr = $schLocationErr = $schStartErr = $schEndErr = "";

  $sql_ask="SELECT * FROM SCHEDULE WHERE Schedule_ID = '$sch_ID'";
  $result_ask = mysqli_query($conn, $sql_ask);

    if (mysqli_num_rows($result_ask) > 0) {
        // output data
        $row = mysqli_fetch_assoc($result_ask);
        $schID = $row["Schedule_ID"];
        //$schTitle = $row["Schedule_Title"];
        $schDescription = $row["Schedule_Description"];
        $schLocation = $row["Schedule_Location"];
        $schStart = $row["Schedule_StartTime"];
        $schEnd = $row["Schedule_EndTime"];
      }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["schID"])) {
      $schTitleErr = "";
    } else {
      $schID = test_input($_POST["schID"]);
    }

    if (empty($_POST["schTitle"])) {
      $schTitleErr = "Schedule title is required";
    } else {
      $schTitle = test_input($_POST["schTitle"]);
    }

    if (empty($_POST["schDescription"])) {
      $schDescriptionErr = "Description is required";
    } else {
      $schDescription = test_input($_POST["schDescription"]);
    }

    if (empty($_POST["schLocation"])) {
      $schLocationErr = "Location is required";
    } else {
      $schLocation = test_input($_POST["schLocation"]);
    }

    if (empty($_POST["schStart"])) {
      $schStartErr = "Start time is required";
    } else {
      $schStart = test_input($_POST["schStart"]);
    }

    if (empty($_POST["schEnd"])) {
      $schEndErr = "End time is required";
    } else {
      $schEnd = test_input($_POST["schEnd"]);
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
<h2 style="margin-top: 5%">Edit Schedule</h2>
<hr>
<p><span class="error"style="font-size:12px">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <input type="hidden" name="schID" value="<?php echo $schID;?>" placeholder="Title" class="form-control"/>

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Schedule Title:</label>
      <input type="text" name="schTitle" value="<?php echo $schTitle;?>" placeholder="Title" class="form-control" required />
      <span class="error">*</span>
      <br><br>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Schedule Description:</label>
      <input type="text" name="schDescription" value="<?php echo $schDescription;?>" placeholder="Description" class="form-control" required />
      <span class="error">*</span>
      <br><br>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Schedule Venue:</label>
      <input type="text" name="schLocation" value="<?php echo $schLocation;?>" placeholder="Location" class="form-control" required />
      <span class="error">*</span>
      <br><br>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Start Time:</label>
      <input type="text" name="schStart" value="<?php echo $schStart;?>" placeholder="Start time" class="form-control" required />
      <span class="error">*</span>
      <br><br>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>End Time:</label>
      <input type="text" name="schEnd" value="<?php echo $schEnd;?>" placeholder="End Time" class="form-control" required />
      <span class="error">*</span>
      <br><br>
    </div>
  </div>

  <input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="Submit" />
  <div class="d-flex justify-content-center">
    <a href="schedule_list.php">Cancel</a>
  </div>
</form>

<?php
$fill = false;
if ($schTitle != "" and $schDescription != "" and $schLocation != "" and $schStart != ""
and $schEnd != ""){
  $fill = true;
}

if ($fill == false){
  echo "";
}
else{
  $sql = "UPDATE SCHEDULE SET Schedule_Title = '$schTitle', Schedule_Description = '$schDescription',
  Schedule_Location = '$schLocation', Schedule_StartTime = '$schStart', Schedule_EndTime = '$schEnd'
  WHERE Schedule_ID = '$schID'";

  if (mysqli_query($conn, $sql)) {
    echo "<script language=\"JavaScript\">alert(\"Successful!\");</script>";
    echo "<script language=\"JavaScript\">location.replace(\"schedule_list.php\");\r\n</script>";
  } else {
    echo "<script language=\"JavaScript\">alert(\"Registered Failed, Please check validation!\");</script>";
  }
}
?>
</div>
<?php
include('templates/footer.php');
?>
