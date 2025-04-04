<?php
include 'config.php';
session_start();

if(isset($_POST['submit'])){
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$pass'") or die('Query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
      header('Location: index.php');
      exit();
   } else {
      $message = 'Email hoặc mật khẩu không chính xác!';
   }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

<?php if(isset($message)): ?>
    <div class="message" onclick="this.remove();"><?= $message; ?></div>
<?php endif; ?>

<div class="container">
    <div class="form-contain">
        <img src="./img/Screenshot_2025-03-17_193826-removebg-preview.png" alt="Logo">
        <h2><b>Đăng Nhập Tài Khoản</b></h2><br>
        <div class="form">
            <form action="" method="post">
                <p>Email</p>
                <input name="email" type="email" required placeholder="VD: email@domain.com">
                <p>Mật Khẩu</p>
                <input name="password" type="password" required placeholder="Nhập Mật Khẩu">
                <br>
                <button type="submit" name="submit">Đăng Nhập</button>
                <p class="dn">Bạn chưa có tài khoản? <a href="register.php">Đăng Ký</a></p>
                <div class="form-login">
                    <button><p>Login Facebook <i class="fa-brands fa-facebook"></i></p></button>
                    <button><p>Login Google <i class="fa-brands fa-google"></i></p></button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
