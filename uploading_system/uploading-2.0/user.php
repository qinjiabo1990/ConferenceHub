<!DOCTYPE html>
<html>
  <head>
    <title>Account Information</title>
    <link rel="stylesheet" type="text/css" href="css/user.css">
    <?php
    include('templates/header.php');
    include('templates/nav.php');
    $Admin_ID = $_SESSION['User_ID'];
    ?>
    <br>
<h1 style='margin-top:30px;text-align:center'>
    <?php
    echo " Hi ". $_SESSION['Username']. " !";
    ?>
    </h1>
    <br />
    <div style="text-align:center">
    <p>Please maintain your conference <a href="main_page.php">here</a></p>
    </div>
    <br />
    <hr />
    <div class="text-center">
      <a href="templates/logout.php"><input type="button" value="Log Out" name="Log out"></a></button>
    </div>

    <?php
    include('templates/footer.php');
    ?>
