<?php
session_start();

if (empty($_SESSION['count'])){
    $_SESSION['count'] = 0;
}
$_SESSION['count']++;
$_SESSION['csrf'] = md5(time());

if($_SESSION['count'] > 5){
    header("Location: /");
}
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
  <link rel="stylesheet" href="css/style1.css" type="text/css">
  <title>Contact Us</title>
  <link rel="icon" type="image/x-icon" href="/css/images/phone2.png">
</head>
<body>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="container">
  <h1>Contact Us</h1>

  <form action="contact.php" method="post">
    <br>
    <a href="/" >Home</a>

    <a href="next.php?csrf=<?= $_SESSION['csrf'] ?>">Go</a>
    <!-- 'real-world' -->
    <input type="hidden" name="_csrf" value="<?= $_SESSION['csrf'] ?>">
    <!-- easy to read -->
    <input type="text" name="csrf"  value="<?= $_SESSION['csrf'] ?>">

    <label	 for="name">Name</label>
    <input type="text" id="name" name="name" placeholder="e.g. John Smith" required><br>

    <label for="email">Email</label>
    <input type="email" id="email" name="email" placeholder="e.g johnsmith@gmail.com" required><br>

    <label for="subject">Subject</label>
    <input type="text" id="subject" name="subject" placeholder="Who is John?" required><br>

    <label for="message">Message</label>
    <textarea id="message" name="message" rows="5" cols="50" placeholder="John is a silly goose." ></textarea><br>

    <div class="g-recaptcha" data-sitekey="6Lfmc4orAAAAAOT6i--MDAg8D2eLSlIYXDxo7Dd5"></div>

    <input type="submit"  value="Submit">

    <p>Count: <?= $_SESSION['count'] ?></p>
    <p>CSRF: <?= $_SESSION['csrf'] ?></p>

  </form>

</div>

</body>

</html>
