<?php
include"koneksi.php";
?>



<!DOCTYPE html>
<html>
<head>
    <title>Halaman Login</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body id="login-page">
    <div id="inputan">
        <form action="" method="post">
            <input type="text" name="user" placeholder="username" class="log" />
            <input type="password" name="pass" placeholder="Password" class="log" />
            <input type="submit" name="login" value="Login" class="ig" />
        </form>
        <?php
            if(isset($_POST['login'])){
                $user = $_POST['user'];
                $pass = md5($_POST['pass']);
                $cek = mysqli_num_rows(mysqli_query($conn, "select * from tb_login where username='$user' and password='$pass'"));
                if($cek > 0){
                    $_SESSION['userweb'] = $user;
                    header("location:home.php");
                }else{
                    ?>
                    <script type="text/javascript">alert("Username Password Salah");</script>
                    <?php
                }
            }
        ?>
    </div>
</body>
</html>