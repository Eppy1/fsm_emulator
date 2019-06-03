<?php
    $email_md5 = '';
    $connect=mysqli_connect('localhost', 'root', '', 'fsm');
    $query=mysqli_query($connect,"SELECT * FROM `users` WHERE email='{$_POST['email']}'");
    if(mysqli_num_rows($query) > 0) $email_md5=$query->fetch_assoc()['md5_email'];

    
$headers = 'From: webmaster@example.com' . "\r\n" .
'Reply-To: webmaster@example.com' . "\r\n" .
'X-Mailer: PHP/' . phpversion();

    mail($_POST['email'],"Password restoration","Go here: <a href="."\"http://127.0.0.1:1365/restore.php?md5=\"".$email_md5."\">link</a>", $headers);
    echo "Email has sent. Check It";
?>