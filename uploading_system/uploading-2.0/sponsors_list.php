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

  $sql = "SELECT * FROM SPONSORS WHERE Con_ID = '$Admin_ID'";

  $result = mysqli_query($conn, $sql);
  echo "<div style='margin-top:5%; margin-left:10px'>";
  echo "<h2>Sponsors</h2>";
  echo "<hr />";

  if (mysqli_num_rows($result) > 0) {
      // output data of each row
      echo '<table>
      <tr>
        <th>Name</th>
        <th>Description</th>
        <th>Website</th>
        <th>Operation</th>
      </tr>';
      while($row = mysqli_fetch_assoc($result)) {
        $sch_ID = $row["Sponsors_ID"];
        echo '
          <tr>
            <td>'. $row["Sponsors_Name"]. '</td>
            <td>'. $row["Sponsors_Description"]. '</td>
            <td>'. $row["Sponsors_Website"]. '</td>
            <td>
            <form method="post" action="sponsors_edit.php">
            <input type="hidden" value='. $sch_ID .' placeholder="Title" name="ID">
            <input type="submit" name="submit" value="edit" />
            </form>
            <form method="post" action="sponsors_delete.php">
            <input type="hidden" value='. $sch_ID .' placeholder="Title" name="ID">
            <input type="submit" name="submit" value="delete" />
            </form>
            </td>
          </tr>';
        }
          echo '
        </table>
        <a href="sponsors_add.php"><input type="button" value="Add"></a>
        <br>
      ';
  } else {
      echo '0 results
      <br>
      <a href="sponsors_add.php"><input type="button" value="Add"></a><br>';
  }
  echo '<br><a href="main_page.php"><input type="button" value="Go Back" name="Add User"></a>';
  echo "</div>";

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
