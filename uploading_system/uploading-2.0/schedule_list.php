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

  $sql = "SELECT * FROM SCHEDULE WHERE Con_ID = '$Admin_ID'";

  $result = mysqli_query($conn, $sql);
  echo "<div style='margin-top:5%; margin-left:10px'>";
  echo "<h2>Schedule</h2>";
  echo "<hr />";

  if (mysqli_num_rows($result) > 0) {
      // output data of each row
      echo '<table>
      <tr>
        <th>Title</th>
        <th>Description</th>
        <th>Venue</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Operation</th>
      </tr>';
      while($row = mysqli_fetch_assoc($result)) {
        $sch_ID = $row["Schedule_ID"];
        echo '
          <tr>
            <td>'. $row["Schedule_Title"]. '</td>
            <td>'. $row["Schedule_Description"]. '</td>
            <td>'. $row["Schedule_Location"]. '</td>
            <td>'. $row["Schedule_StartTime"]. '</td>
            <td>'. $row["Schedule_EndTime"]. '</td>
            <td>
            <form method="post" action="schedule_edit.php">
            <input type="hidden" value='. $sch_ID .' placeholder="Title" name="ID">
            <input type="submit" name="submit" value="edit" />
            </form>
            <form method="post" action="schedule_delete.php">
            <input type="hidden" value='. $sch_ID .' placeholder="Title" name="ID">
            <input type="submit" name="submit" value="delete" />
            </form>
            </td>
          </tr>';
        }
          echo '
        </table>
        <a href="schedule_add.php"><input type="button" value="Add"></a>
        <br>
      ';
  } else {
      echo '0 results
      <br>
      <a href="schedule_add.php"><input type="button" value="Add"></a><br>';
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
