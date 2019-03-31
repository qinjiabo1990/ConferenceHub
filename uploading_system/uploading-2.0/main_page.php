<!DOCTYPE html>
<html>
<head>
  <title>Task List</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php
  include('templates/header.php');
  include('templates/nav.php');
  ?>
  <br>
   <article style="padding-top: 50px;">
     <div class="row">
       <div class="col" style="width: 18rem;">
         <h3 class="text-center">ConferenceHub Upload System</h3>
         <hr/>
         <br/>
         <div class="d-flex justify-content-center">
         <table>
            <tr>
              <th>Features</th>
              <th>Operation</th>
            </tr>
            <tr>
              <td>Conference Information</td>
              <td><a href="conference_info_list.php">check</a></td>
            </tr>
            <tr>
              <td>More Information</td>
              <td><a href="more_info_list.php">check</a></td>
            </tr>
            <tr>
              <td>Schedule</td>
              <td><a href="schedule_list.php">check</a></td>
            </tr>
            <tr>
              <td>Speakers</td>
              <td><a href="speakers_list.php">check</a></td>
            </tr>
            <tr>
              <td>Sponsors</td>
              <td><a href="sponsors_list.php">check</a></td>
            </tr>
            <tr>
              <td>Exhibitors</td>
              <td><a href="exhibitors_list.php">check</a></td>
            </tr>
          </table>
        </div>
       </div>
     </div>
   </article>
 </br>
 <?php
 include('templates/footer.php');
 ?>
 <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 90%;
}

td, th {
    border: 2px solid #000000;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
