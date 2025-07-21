<?php
ini_set('display_errors', 1);
$link = mysqli_connect("localhost","anthony", "Ares1234!", "contact");

if (mysqli_connect_errno()){
printf("Connect failed: %s\n", mysqli_connect_error());
exit();
}
$contacts = [];
$stmt = mysqli_stmt_init($link);

if (mysqli_stmt_prepare($stmt, "SELECT * FROM contact_info")) {


    mysqli_stmt_bind_result($stmt, $id, $name, $email, $subject, $message);

    mysqli_stmt_execute($stmt);


    while (mysqli_stmt_fetch($stmt)) {
   	 $contacts[] = ['id' =>$id, 'name'=> $name, 'email'=> $email, 'subject'=> $subject, 'message'=> $message];
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Data</title>
    <link rel="stylesheet" href="/css/contactdata.css" type="text/css">
</head>
<body>

  <table>
    <thead>
    <tr>

      <th>ID</th>
      <th>Name</th>
      <th>Email</th>
      <th>Subject</th>
      <th>Message</th>

    </tr>
    </thead>

    <tbody>
    <?php foreach ($contacts as $row): ?>
      <tr>
        <td><?= htmlentities ($row['id']) ?></td>
        <td><?= htmlentities ($row['name']) ?></td>
        <td><?= '<a href="mailto:' . htmlentities($row['email']) . '">' . htmlentities($row['email']) . '</a>' ?></td>
        <td><?= htmlentities ($row['subject']) ?></td>
        <td><?= htmlentities ($row['message']) ?></td>
      </tr>
    <?php endforeach ?>
    </tbody>

  </table>
</body>
</html>