<?php
session_start();

if (empty($_SESSION['count'])){
    $_SESSION['count'] = 0;
}
$_SESSION['count']++;
$_SESSION['csrf'] = md5(time());

if($_SESSION['count'] > 5){
    error_log("Too many attempts", 0);
    header("Location: /");
}
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
  <link rel="stylesheet" href="css/style1.css" type="text/css">
  <title>Contact Us</title>
  <link rel="icon" type="image/x-icon" href="/css/images/phone2.png">
  <script src="js/ping.js" defer></script>
</head>
<body>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="container">
  <h1>Contact Us</h1>

  <form action="contact.php" method="post">
    <br>
    <a href="/" class="link1" >Home</a>

    <!-- 'real-world' -->
    <input type="hidden" name="_csrf" value="<?= $_SESSION['csrf'] ?>">

    <label for="name">Name</label>
    <input type="text" id="name" name="name" pattern="^(?!.*[<>])([a-zA-Z]{1,15}\s[a-zA-Z]{1,15})$" placeholder="e.g. John Smith" required title="Please enter your full name (First Last)."><br>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="e.g johnsmith@gmail.com" required title="Please enter a valid email address."><br>

    <label for="subject">Subject</label>
    <input type="text" id="subject" name="subject" pattern="(?=.*[a-zA-Z]{2,15}\s[a-zA-Z]{2,15})(?!.*[<>])^[\s\S]*$" placeholder="Who is John?" required title="Please enter a proper subject."><br>

    <label for="message">Message</label>
    <textarea id="message" name="message" rows="5" cols="50" placeholder="John is a silly goose." required title="Please enter your message." ></textarea><br>

    <div class="g-recaptcha" data-sitekey="6Lfmc4orAAAAAOT6i--MDAg8D2eLSlIYXDxo7Dd5"></div>

    <input type="submit"  value="Submit">

     <a href="session-end.php" class="link2" >reset</a>

  </form>

</div>

</body>

</html>
