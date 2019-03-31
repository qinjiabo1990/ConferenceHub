<!DOCTYPE HTML>
<html>
<head>
  <title>create an organizer account</title>
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
  $adName = $adPassword = $adEmail = "";
  $adNameErr = $adPasswordErr = $adEmailErr = "";
  $valide = 1;
  $valid = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["adName"])) {
      $adNameErr = "Userame is required";
    } else {
      $adName = test_input($_POST["adName"]);
    }

    if (empty($_POST["adPassword"])) {
      $adPasswordErr = "Password is required";
    } else {
      $adPassword = test_input($_POST["adPassword"]);
    }

    if (empty($_POST["adEmail"])) {
      $adEmailErr = "Email is required";
    } else {
      $adEmail = test_input($_POST["adEmail"]);
      // check if e-mail address is well-formed
      if (!filter_var($adEmail, FILTER_VALIDATE_EMAIL)) {
        $adEmailErr = "Invalid email format";
        $valide = 0;
      }
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
<h2 style="margin-top: 5%">Create an organizer account</h2>
<hr>
<p><span class="error"style="font-size:12px">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Organizer Name:</label>
      <input type="text" name="adName" value="<?php echo $adName;?>" placeholder="Name" class="form-control" required />
      <span class="error">* <?php echo $adNameErr;?></span>
      <br><br>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Password:</label>
      <input type="password" name="adPassword" placeholder="Password" class="form-control" required />
      <span class="error">* <?php echo $adPasswordErr;?></span>
      <br><br>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 mb-0">
      <label>Email:</label>
      <input type="text" name="adEmail" value="<?php echo $adEmail;?>" placeholder="Email" class="form-control" required />
      <span class="error">* <?php echo $adEmailErr;?></span>
      <br><br>
    </div>
  </div>

  <input class="btn btn-primary btn-lg btn-block" type="submit" name="submit" value="Submit" />
  <div class="d-flex justify-content-center">
    <a href="admin_list.php">Cancel</a>
  </div>
</form>

<?php
if ($valide == 1){
  $valid = true;
}

$fill = false;
if ($adName != "" and $adPassword != "" and $adEmail != ""){
  $fill = true;
}

if ($valid == false or $fill == false){
  echo "";
}
else{
  include('addUser.php');
  $sql = "INSERT INTO ADMIN" . "(Admin_Name, Admin_Password, Admin_Email)"
  . "VALUES" . "('$adName','$adPassword','$adEmail')";

  if (mysqli_query($conn, $sql)) {
    echo "<script language=\"JavaScript\">alert(\"Successful!\");</script>";
    echo "<script language=\"JavaScript\">location.replace(\"admin_list.php\");\r\n</script>";
  } else {
    echo "<script language=\"JavaScript\">alert(\"Registered Failed, Please check validation!\");</script>";
  }
}
?>
</div>
<?php
include('templates/footer.php');
?>
