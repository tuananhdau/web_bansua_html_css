<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
};

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity')") or die('query failed');
      $message[] = 'product added to cart!';
   }

};

if(isset($_POST['update_cart'])){
   $update_quantity = $_POST['cart_quantity'];
   $update_id = $_POST['cart_id'];
   mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id = '$update_id'") or die('query failed');
   $message[] = 'cart quantity updated successfully!';
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'") or die('query failed');
   header('location:index.php');
}
  
if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   header('location:index.php');
}

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Milk</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
<?php
if(isset($message)){
   foreach($message as $message){
      echo '<div class="message" onclick="this.remove();">'.$message.'</div>';
   }
}
?>

    <header>
        <div class="header">
            <div class="logo">
                <a href="index.html"> <img src="./img/Screenshot_2025-03-17_193826-removebg-preview.png" alt="Logo"></a>
            </div>

            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" placeholder="Tìm kiếm món ăn...">
                <button class="filter-btn">
                    <i class="fas fa-filter"></i> Lọc
                </button>
            </div>

            <div class="user-cart">
              <i class="fas fa-user"></i>
              <div class="user-profile">

<?php
   $select_user = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($select_user) > 0){
      $fetch_user = mysqli_fetch_assoc($select_user);
   };
?>

<p> username : <span><?php echo $fetch_user['name']; ?></span> </p>
<p> email : <span><?php echo $fetch_user['email']; ?></span> </p>
<div class="flex">
   <a href="index.php?logout=<?php echo $user_id; ?>" onclick="return confirm('are your sure you want to logout?');" class="delete-btn">logout</a>
</div>
</div>

                <div class="cart">
                    <i class="fas fa-shopping-basket"></i>
                    <span>Giỏ hàng</span>
                    <div class="count">0</div>
                </div>
            </div>
        </div>

        <nav class="menu">
                <a href="index.html">Trang Chủ</a>
                <a href="./html/vinamilk.html">Vinamilk</a>
                <a href="./html/nutifood.html">Nutifood</a>
                <a href="./html/truemilk.html">TH True Milk</a>
                <a href="#">Dutch Lady</a>
                <a href="#">Nestlé</a>
                <a href="#">Liên Hệ</a>
        </nav>
    </header>
    <div class="banner">
        <video autoplay loop muted playsinline>
            <source src="./img/canva-EOeq7D2wVa0.mp4" type="video/mp4">
          </video>
    </div>
  <!-- Features -->
  <div class="features">
      <div class="feature-box">
          <i class="fas fa-truck"></i>
          <h3>GIAO HÀNG NHANH</h3>
          <p>Cho tất cả đơn hàng</p>
      </div>
      <div class="feature-box">
          <i class="fas fa-shield-heart"></i>
          <h3>SẢN PHẨM AN TOÀN</h3>
          <p>Cam kết chất lượng</p>
      </div>
      <div class="feature-box">
          <i class="fas fa-headphones"></i>
          <h3>HỖ TRỢ 24/7</h3>
          <p>Tất cả ngày trong tuần</p>
      </div>
      <div class="feature-box">
          <i class="fas fa-dollar-sign"></i>
          <h3>HOÀN LẠI TIỀN</h3>
          <p>Nếu không hài lòng</p>
      </div>
  </div>
  <section class="menu-section">
     <h2><span>SẢN PHẨM BÁN CHẠY🔥</span></h2>
    <div class="menu-grid">

        <!-- Các món ăn -->
        <!-- Món 1 -->
        <div class="menu-item">
            <img src="https://d8um25gjecm9v.cloudfront.net/store-front-cms/ST_Tiettrung_GF_Caodam_Itbeo_250_01_1193232520.png" alt="NGreen Farm Cao đạm ít béo">
            <h3>NGreen Farm Cao đạm ít béo</h3>
            <p class="price">25.000<span>đ</span></p>
            <button><i class="fas fa-cart-plus"></i> ĐẶT MÓN</button>
        </div>

        <!-- Món 2 -->
        <div class="menu-item">
            <img src="https://d8um25gjecm9v.cloudfront.net/store-front-cms/SDD_GC_Cf_Latte_300_01_7200a87cd1.png" alt="Vinamilk Cafe Latte">
            <h3>Vinamilk Cafe Latte</h3>
            <p class="price">78.000 <span>đ</span></p>
            <button><i class="fas fa-cart-plus"></i> ĐẶT MÓN</button>
        </div>

        <!-- Món 3 -->
        <div class="menu-item">
            <img src="https://product.hstatic.net/200000821091/product/6_2ba3e793fb5740de8492e44ccad206a1_master.png" alt="NutiMilk 100% Sữa New Zealand Bò ăn cỏ tự nhiên Có đường 180ml">
            <h3>NutiMilk 100% Sữa New Zealand Bò ăn cỏ tự nhiên</h3>
            <p class="price">180.000 <span>đ</span></p>
            <button><i class="fas fa-cart-plus"></i> ĐẶT MÓN</button>
        </div>

        <!-- Món 4 -->
        <div class="menu-item">
            <img src="https://d8um25gjecm9v.cloudfront.net/store-front-cms/ST_Tiet_trung_GF_Organic_1_L_1_f1241a6129.png" alt="Sữa tươi tiệt trùng">
            <h3>Sữa tươi tiệt trùng</h3>
            <p class="price">55.000 <span>đ</span></p>
            <button><i class="fas fa-cart-plus"></i> ĐẶT MÓN</button>
        </div>

        <!-- Thêm các món khác tùy ý -->
         <div class="menu-item">
            <img src="https://cdn.shopify.com/s/files/1/0761/8769/7443/files/FM100_ID_110_3.png?v=1735730822" alt="">
            <h3>Sữa tươi tiệt trùng (Khong duong)</h3>
            <p class="price">33.000 <span>đ</span></p>
            <button><i class="fas fa-cart-plus"></i>Đặt Món</button>
         </div>
    </div>
</section>
<footer>
    <div class="footer-container">
        <div class="footer-section about">
            <img src="./img/Screenshot_2025-03-17_193826-removebg-preview.png" alt="Milk Borcelle Logo" class="logo">
            <p>Milk Borcelle là thương hiệu được thành lập vào năm 2025 với tiêu chí đặt chất lượng sản phẩm lên hàng đầu.</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
            </div>
        </div>
        
        <div class="footer-section links">
            <h3>LIÊN KẾT</h3>
            <ul>
                <li><a href="#">Page</a></li>
                <li><a href="#">Thực đơn</a></li>
                <li><a href="#">Điều khoản</a></li>
                <li><a href="#">Liên hệ</a></li>
            </ul>
        </div>

        <div class="footer-section products">
            <h3>SẢN PHẨM</h3>
            <ul>
                <li><a href="#">Vinamilk</a></li>
                <li><a href="#">Nutifood</a></li>
                <li><a href="#">True Milk</a></li>
                <li><a href="#">Dutch Lady</a></li>
                <li><a href="#">Nestle</a></li>
            </ul>
        </div>

        <div class="footer-section contact">
            <h3>LIÊN HỆ</h3>
            <p><i class="fas fa-map-marker-alt"></i> Hải Châu, Đà Nẵng</p>
            <p><i class="fas fa-phone"></i> 088.9257.264 - 0566.3424.79</p>
            <p><i class="fas fa-envelope"></i> abc@domain.com</p>
            <p><i class="fas fa-envelope"></i> infoabc@domain.com</p>
        </div>
    </div>
    <div class="footer-top-subbox">
        <div class="footer-top-subs">
            <h2 class="footer-top-subs-title">Đăng ký nhận tin</h2>
            <p class="footer-top-subs-text">Nhận thông tin mới nhất từ chúng tôi</p>
        </div>
        <form class="form-ground">
            <input type="email" class="form-ground-input" placeholder="Nhập email của bạn">
            <button class="form-ground-btn">
                <span>ĐĂNG KÝ</span>
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>
    </div>

    <div class="footer-bottom">
        <p>Copyright 2025 MILK BORCELLE. All Rights Reserved</p>
    </div>
</footer>



</body>

</html>