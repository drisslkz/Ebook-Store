<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
   exit;
}
include 'header.php';
?>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
<div>
    <style>
        .container{
            height: 100vh;
            text-transform: capitalize;
            font-size: xx-large;
        }
    </style>
    <link rel="stylesheet" href="style.css">
    <div class="container flex justify-center items-center">
        <p class="text-center">Sorry But I'm Still Working on this page</p>
    </div>

</div>

<?php
include 'footer.php';
?>