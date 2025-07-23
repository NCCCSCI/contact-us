<?php

session_start();

if (empty($_SESSION['count'])){
    $_SESSION['count'] = 0;
}
$_SESSION['count']++;

include 'config.php';

if(isset($_POST['name']))  { $name=$_POST['name']; }

if(isset($_POST['email']))  { $email=$_POST['email']; }

if(isset($_POST['message']))  { $message=$_POST['message']; }

if(isset($_POST['subject']))  { $subject=$_POST['subject']; }

if(isset($_POST['g-recaptcha-response']))  { $captcha=$_POST['g-recaptcha-response'];  }

if (!$captcha) {
          echo '<h2>Please check the the captcha form.</h2>';
              exit;
           }


$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);


$args = [
	'name' => ['filter' => FILTER_VALIDATE_REGEXP, 'options' => [ 'regexp' => '/^[\pL\pP\pZ]{3,50}$/u']],
	'email' => ['filter' => FILTER_VALIDATE_EMAIL, 'options' => [ FILTER_FLAG_EMAIL_UNICODE ]],
	'message' => ['filter'=> FILTER_VALIDATE_REGEXP, 'options' => [ 'regexp' => '/^[^<>]{10,500}$/' ]],
        'subject' =>  ['filter' => FILTER_VALIDATE_REGEXP, 'options' => [ 'regexp' => '/^[^<>]{5,50}$/' ]],
];


$results = filter_input_array(INPUT_POST,$args);

if (empty($results) || in_array(false,$results,true)){
	header("Location: /contact.html");
exit;
}


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
include 'config.php';

$stmt = $mysqli->prepare("INSERT INTO contact_info (name, email, subject, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $results['name'],$results['email'],$results['subject'],$results['message']);

$stmt->execute();

$stmt->close();
$mysqli->close();

header("Location: /thanks.html")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

</head>
<body>

 <p>Count: <?= $_SESSION['count'] ?></p>

</body>
</html>



