<?php

include 'config.php';

if (isset($_POST['submit'])) {

   $name = $_POST['name'];
   $email = $_POST['email'];
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $stmt = $conn->prepare("SELECT * FROM `users` WHERE email = :email AND password = :pass");
   $stmt->bindParam(':email', $email);
   $stmt->bindParam(':pass', $pass);
   $stmt->execute();

   if ($stmt->rowCount() > 0) {
      $message[] = 'user already exists!';
   } else {
      if ($pass != $cpass) {
         $message[] = 'confirm password not matched!';
      } else {
         $insert_stmt = $conn->prepare("INSERT INTO `users`(name, email, password, user_type) VALUES(:name, :email, :pass, :user_type)");
         $insert_stmt->bindParam(':name', $name);
         $insert_stmt->bindParam(':email', $email);
         $insert_stmt->bindParam(':pass', $cpass);
         $insert_stmt->bindParam(':user_type', $user_type);
         $insert_stmt->execute();
         $message[] = 'registered successfully!';
         header('location:login.php');
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php
   if (isset($message)) {
      foreach ($message as $msg) {
         echo '
      <div class="message">
         <span>' . $msg . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
      }
   }
   ?>

   <div class="form-container">

      <form action="" method="post">
         <h3>register now</h3>
         <input type="text" name="name" placeholder="enter your name" required class="box">
         <input type="email" name="email" placeholder="enter your email" required class="box">
         <input type="password" name="password" placeholder="enter your password" required class="box">
         <input type="password" name="cpassword" placeholder="confirm your password" required class="box">
         <select name="user_type" class="box">
            <option value="user">user</option>
            <option value="admin">admin</option>
         </select>
         <input type="submit" name="submit" value="register now" class="btn">
         <p>already have an account? <a href="login.php">login now</a></p>
      </form>

   </div>

</body>

</html>
