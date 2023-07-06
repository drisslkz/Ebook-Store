<?php

$dsn = "mysql:host=localhost;dbname=shop_db";
$username = "root";
$password = "123456";

try {
   $conn = new PDO($dsn, $username, $password);
   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
   die("Connection failed: " . $e->getMessage());
}

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_POST['send'])) {

   $name = $_POST['name'];
   $email = $_POST['email'];
   $number = $_POST['number'];
   $msg = $_POST['message'];

   $select_message = $conn->prepare("SELECT * FROM `message` WHERE name = :name AND email = :email AND number = :number AND message = :msg");
   $select_message->execute(array(
      'name' => $name,
      'email' => $email,
      'number' => $number,
      'msg' => $msg
   ));

   if ($select_message->rowCount() > 0) {
      $message[] = 'message sent already!';
   } else {
      $insert_message = $conn->prepare("INSERT INTO `message`(user_id, name, email, number, message) VALUES(:user_id, :name, :email, :number, :msg)");
      $insert_message->execute(array(
         'user_id' => $user_id,
         'name' => $name,
         'email' => $email,
         'number' => $number,
         'msg' => $msg
      ));
      $message[] = 'message sent successfully!';
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>

   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3>contact us</h3>
   <p> <a href="home.php">home</a> / contact </p>
</div>

<section class="contact">

   <form action="" method="post">
      <h3>say something!</h3>
      <input type="text" name="name" required placeholder="enter your name" class="box">
      <input type="email" name="email" required placeholder="enter your email" class="box">
      <input type="number" name="number" required placeholder="enter your number" class="box">
      <textarea name="message" class="box" placeholder="enter your message" id="" cols="30" rows="10"></textarea>
      <input type="submit" style="color:black;" value="send message" name="send" class="btn">
   </form>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
