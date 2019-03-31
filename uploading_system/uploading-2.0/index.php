<!DOCTYPE html>
<html>
<head>
  <title>Welcome Upload System</title>
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
         <div class="card-body">
           <form method="post" action="check.php">
             <div class="container text-center">
               <div>
                 <label><b>Organizer:</b></label>
                 <input type="text" placeholder="Enter Organizer" name="Username" required>
               </div>
               <div>
                 <label><b>Password:</b></label>
                 <input type="password" placeholder="Enter Password" name="Password" required>
               </div>
               <br>
               <!--    <button type="submit">Login</button>  -->
               <div>
                 <input type="submit" class="btn btn-primary" value="Login">
               </div>
             </div>
           </form>
         </div>
       </div>
     </div>
   </article>
   <?php
   include('templates/footer.php');
   ?>
