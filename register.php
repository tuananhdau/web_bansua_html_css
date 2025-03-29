<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist!';
   }else{
      mysqli_query($conn, "INSERT INTO `user_form`(name, email, password) VALUES('$name', '$email', '$pass')") or die('query failed');
      $message[] = 'registered successfully!';
      header('location:login.php');
   }

}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>
   

    <div class="container">
        <div class="form-contain">
            <img src="./img/Screenshot_2025-03-17_193826-removebg-preview.png" alt="">
            <h2><b>Đăng Kí Tài Khoản</b></h2><br>
            <div class="form">
                <form action="" method="post">
                    <p>Tên đầy đủ</p>
                    <input id="name" name="name" type="text" required placeholder="VD: Tuan Anh">
                    <p>Email</p>
                    <input id="email" name="email" type="email" required placeholder="VD: email@domain.com">
                    <p>Mật khẩu</p>
                    <input class="password" name="password" type="password" required placeholder="Nhập mật khẩu">
                    <p>Nhập lại mật khẩu</p>
                    <input class="password" name="cpassword" type="password" required placeholder="Nhập lại mật khẩu">
                    <br>
                    <button type="submit" name="submit">Đăng Ký</button>
                    <p class="dk">Bạn đã có tài khoản? <a href="login.php">Đăng Nhập</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
