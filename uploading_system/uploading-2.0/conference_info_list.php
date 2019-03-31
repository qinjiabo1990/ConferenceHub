<!DOCTYPE HTML>
<html>
<head>
  <title>Confernece Information</title>
  <style>
  .error {color: #FF0000;}
  </style>
  <?php
  include('templates/header.php');
  include('templates/nav.php');
  $Admin_ID = $_SESSION['User_ID'];
  ?>

  <?php
  $sql = "SELECT * FROM CONFERENCE_INFO WHERE CONFERENCE_INFO.Con_ID = '$Admin_ID'";
  $result = mysqli_query($conn, $sql);
  echo "<div style='margin-top:5%; margin-left:10px'>";
  echo "<h2>Conference Information</h2>";
  echo "<hr />";
  if (mysqli_num_rows($result) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        echo '
        <table>
        <tr>
          <th>Conference Name</th>
          <th>Date</th>
          <th>Location</th>
          <th>Abstract</th>
          <th>Description</th>
          <th>Operation</th>
        </tr>
          <tr>
            <td>'. $row["Con_Name"]. '</td>
            <td>'. $row["Con_Date"]. '</td>
            <td>'. $row["Con_Address"]. '</td>
            <td>'. $row["Con_Abstract"]. '</td>
            <td>'. $row["Con_Description"]. '</td>
            <td>
            <a href="conference_info_edit.php"><input type="button" value="Edit" name="Add User"></a>
            </td>
          </tr>
        </table>
        <br>
        ';
      }
  } else {
      echo '0 results
      <br>
      <a href="conference_info_add.php"><input type="button" value="Add" name="Add User"></a><br>';
  }
  echo '<br><a href="main_page.php"><input type="button" value="Go Back" name="Add User"></a>';
  echo "</div>";
  ?>

  <?php
  include('templates/footer.php');
  ?>
<style>
table {
   font-family: arial, sans-serif;
   border-collapse: collapse;
   width: 100%;
}

td, th {
   border: 1px solid #000000;
   text-align: left;
   padding: 8px;
}

tr:nth-child(even) {
   background-color: #dddddd;
}
</style>
