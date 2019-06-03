<?php
    if(isset($_POST["register"]) || true){
        $connect=mysqli_connect('localhost', 'root', '', 'fsm');
        $login=mysqli_real_escape_string($connect,$_POST['login']);
        $email=mysqli_real_escape_string($connect,$_POST['email']);
        $pword=mysqli_real_escape_string($connect,$_POST['pword']);
        $query=mysqli_query($connect,"SELECT * FROM `users` WHERE login='{$login}'");
        $numr=mysqli_num_rows($query);

        if($numr==0) {

            $md5login = md5($login . $pword);
            $md5email = md5($email . $pword);

            $token = md5($login . round(microtime(true) * 1000));
            
            $n = random_int(0, 6);

            $sql_q = "INSERT INTO `users` (login, email, md5_email, md5_login, token, icon) VALUES ('{$login}','{$email}', '{$md5email}', '{$md5login}', '{$token}', '{$n}')";
            $res=mysqli_query($connect,$sql_q);
            if($res){
                setcookie("fsmemutoken", $token, time()+604800*50);

                header("Location: index.php");
                die();
            }
            else {
                echo "Не удалось добавить информацию";
            }
        }
        else {
            echo "This username is already in use. Try another one!";
        }
    }
?>