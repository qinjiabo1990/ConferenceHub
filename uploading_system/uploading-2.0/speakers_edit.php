<!DOCTYPE HTML>
<html>
<head>
  <title>Speakers</title>
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
  $speaID = $speaName = $speaDescription = $speaCompany = $speaEmail = "";
  $speaIDErr = $speaNameErr = $speaDescriptionErr = $speaCompanyErr = $speaEmailErr = "";

  $sql_ask="SELECT * FROM SPEAKERS WHERE Speakers_ID = '$sch_ID'";
  $result_ask = mysqli_query($conn, $sql_ask);

    if (mysqli_num_rows($result_ask) > 0) {
        // output data
        $row = mysqli_fetch_assoc($result_ask);
        $speaID = $row["Speakers_ID"];
        //$speaName = $row["Speakers_Name"];
        $speaDescription = $row["Speakers_Description"];
        $speaCompany = $row["Speakers_Company"];
        $speaEmail = $row["Speakers_Email"];
      }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["speaID"])) {
      $speaIDErr = "";
    } else {
      $speaID = test_input($_POST["speaID"]);
    }

    if (empty($_POST["speaName"])) {
      $speaNameErr = "Speaker's name is required";
    } else {
      $speaName = test_input($_POST["speaName"]);
    }

    if (empty($_POST["speaDescription"])) {
      $speaDescriptionErr = "Speaker's description is required. Type 'Null' if empty";
    } else {
      $speaDescription = test_input($_POST["speaDescription"]);
    }

    if (empty($_POST["speaCompany"])) {
      $speaCompanyErr = "Speaker's company is required. Type 'Null' if empty";
    } else {
      $speaCompany = test_input($_POST["speaCompany"]);
    }

    if (empty($_POST["speaEmail"])) {
      $speaEmailErr = "Speaker's email is required. Type 'Null' if empty";
    } else {
      $speaEmail = test_input($_POST["speaEmail"]);
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
<h2 style="margin-top: 5%">Edit Speaker</h2>
<hr>
<p><span class="error"style="font-size:12px">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <input type="hidden" name="speaID" value="<?php echo $speaID;?>" placeholder="Name" class="form-control" />
  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Speaker Name:</label>
      <input type="text" name="speaName" value="<?php echo $speaName;?>" placeholder="Name" class="form-control" required />
      <span class="error">*</span>
      <br><br>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Speaker Description:</label>
      <input type="text" name="speaDescription" value="<?php echo $speaDescription;?>" placeholder="Description" class="form-control">
      <span class="error">*</span>
      <br><br>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Speaker Company:</label>
      <input type="text" name="speaCompany" value="<?php echo $speaCompany;?>" placeholder="Company" class="form-control">
      <span class="error">*</span>
      <br><br>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Speaker Email:</label>
      <input type="text" name="speaEmail" value="<?php echo $speaEmail;?>" placeholder="Email" class="form-control">
      <span class="error">*</span>
      <br><br>
    </div>
  </div>

  <input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="Submit" />
  <div class="d-flex justify-content-center">
    <a href="speakers_list.php">Cancel</a>
  </div>
</form>

<?php
$fill = false;
if ($speaName != "" and $speaDescription != "" and $speaCompany != "" and $speaEmail != ""){
  $fill = true;
}

if ($fill == false){
  echo "";
}
else{

  $sql = "UPDATE SPEAKERS SET Speakers_Name = '$speaName', Speakers_Description = '$speaDescription',
  Speakers_Company = '$speaCompany', Speakers_Email = '$speaEmail' WHERE Speakers_ID = '$speaID'";

  if (mysqli_query($conn, $sql)) {
    echo "<script language=\"JavaScript\">alert(\"Successful!\");</script>";
    echo "<script language=\"JavaScript\">location.replace(\"speakers_list.php\");\r\n</script>";
  } else {
    echo "<script language=\"JavaScript\">alert(\"Registered Failed, Please check validation!\");</script>";
  }
}
?>
</div>
<?php
include('templates/footer.php');
?>
