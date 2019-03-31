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

  <?php
  $sql = "SELECT * FROM OTHER_INFO WHERE Con_ID = '$Admin_ID'";

  $result = mysqli_query($conn, $sql);
  echo "<div style='margin-top:5%; margin-left:10px'>";
  echo "<h2>More Information</h2>";
  echo "<hr />";
  if (mysqli_num_rows($result) > 0) {
    echo '<table>
    <tr>
      <th>Venue</th>
      <th>Address</th>
      <th>Latitude</th>
      <th>Longitude</th>
      <th>WIFI</th>
      <th>Other Information</th>
      <th>Operation</th>
    </tr>';
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        echo '

          <tr>
            <td>'. $row["Info_Location"]. '</td>
            <td>'. $row["Info_Address"]. '</td>
            <td>'. $row["Info_Latitude"]. '</td>
            <td>'. $row["Info_Longitude"]. '</td>
            <td>'. $row["Info_WIFI"]. '</td>
            <td>'. $row["Info_Other"]. '</td>
            <td>
            <a href="more_info_edit.php"><input type="button" value="Edit" name="Add User"></a>
            </td>
          </tr>
        </table>
        <br>
        ';
      }
  } else {
      echo '0 results
      <br>
      <a href="more_info_add.php"><input type="button" value="Add" name="Add User"></a><br>';
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
