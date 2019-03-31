<!DOCTYPE HTML>
<html>
<head>
  <title>Conference Organizer List</title>
  <style>
  .error {color: #FF0000;}
  </style>
  <?php
  include('templates/header.php');
  ?>
  <nav class="nav justify-content-end bg-dark fixed-top" style="height: 3rem;">
    <li class="nav-item">
      <?php
        include 'templates/account.php';
        if (isset($_SESSION['Username'])){
          echo '<a class="nav-link text-light" href="admin_list.php">' . $_SESSION['Username'] . '</a>';
        }
        else {
          echo '<p class="nav-link text-light">Hello</p>';
        }
      ?>
    </li>
  </nav>
  <?php
  $sql = "SELECT * FROM ADMIN ";
  $result = mysqli_query($conn, $sql);
  echo "<div style='margin-top:5%; margin-left:10px'>";
  echo "<h2>Administration</h2>";?>
  <ul class="nav nav-tabs">
    <li class="nav-item"><a class="nav-link active" href="admin_list.php">Conference Organizer List</a></li>
    <li class="nav-item"><a class="nav-link" href="admin_conference.php">Conference List</a></li>
  </ul>
  <br>
  <div>
    <a href="addAdmin.php"><input type="button" value="Add a conference organizer" name="Add User"></a></button>
  </div>
  <?php
  echo "<hr />";
  if (mysqli_num_rows($result) > 0) {
    echo '<table>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Operation</th>
    </tr>';
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        $sch_ID = $row["Admin_ID"];
          echo '
            <tr>
              <td>'. $row["Admin_ID"]. '</td>
              <td>'. $row["Admin_Name"]. '</td>
              <td>'. $row["Admin_Email"]. '</td>
              <td>
              <form method="post" action="admin_list_delete.php">
              <input type="hidden" value='. $sch_ID .' placeholder="Title" name="ID">
              <input type="submit" name="submit" value="delete" />
              </form>
              </td>
            </tr>';
          }
            echo '
          </table>
          <br>
        ';
  } else {
      echo "No users";
  }
  echo "</div>";
  ?>
  <hr />
  <div class="text-center">
    <a href="templates/logout.php"><input type="button" value="Log Out" name="Log out"></a></button>
  </div>

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
