<?php
   
   session_start();
   include('db.php');
   $user_check = $_SESSION['username'];
   
   $ses_sql = mysqli_query($connection,"SELECT user FROM user WHERE username = '$user_check' ");

   $row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);
   
   $login_session = $row['Name'];
   
   if(!isset($_SESSION['username'])){
      header("location:login.php");
      die();
   }
?>
