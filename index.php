<?php
require_once "./db.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shopping Cart Book</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Feather Icon -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- Google Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap"
      rel="stylesheet" />
    <!-- Menambah favicon -->
    <link rel="icon" href="/images/iconbook.png" />
    <!-- Menambahkan icon dari Feather Icon -->
  </head>
  <body>
    <!-- Navbar Start -->
    <nav class="navbar">
      <!-- Membuat logo pojok kiri atas -->
      <a href="#" class="navbar-logo"
        >pustaka<span class="color-logo">Rindu</span></a
      >
      <!-- Membuat menu -->
      <div class="navbar-menu">
        <a href="#home" class="navbar-menu-item">Home</a>
        <a href="#products" class="navbar-menu-item">Products</a>
        <a href="#" class="navbar-menu-item">About</a>
        <a href="#" class="navbar-menu-item">Contact</a>
      </div>
      <!-- Membuat navbar untuk tombol pencarian dan shopping caart -->
      <div class="navbar-extra">
        <a href="#" id="search" class="navbar-item"
          ><i data-feather="search"></i
        ></a>
        <a href="#" id="shopping-cart-button" class="navbar-item"
          ><i data-feather="shopping-cart"></i>
        </a>
        <a href="#" id="menu-bar" class="navbar-item"
          ><i data-feather="menu"></i
        ></a>
        <!-- Membuat tombol menu bar untuk media query -->
      </div>

      <!-- Shopping Cart -->

      <div class="shopping-cart">
        <!-- <div class="cart-item">
          <img src="/images/book_1.jpg" alt="Atomic Habits" />
          <div class="detail-item">
            <h3>Atomic Habits</h3>
            <div class="item-price">IDR 75000</div>
          </div>
          <i data-feather="trash-2" class="delete-item"></i>
        </div> -->
      </div>

      <!-- Shopping Cart End -->
    </nav>
    <!-- Navbar End -->

    <!-- Hero Section Start-->
    <section class="hero" id="home">
      <main class="content">
        <h1 class="hero-title">pustaka<span>Rindu</span></h1>
        <p>Diam bukan berarti tidak memperhatikanmu,</p>
        <p>Halo Kami Pustaka Rindu yang siap menerangi duniamu.</p>
        <a href="#products" class="btn">Shop Now</a>
      </main>
    </section>
    <!-- Hero Section End-->

    <!-- Product Section -->
    <section id="products" class="products">
      <h2><span>Product</span> Kami</h2>
      <div class="row">
        <?php
          $query = mysqli_query($conn, "SELECT * FROM products ORDER BY id DESC");
          while($row = mysqli_fetch_array($query)) {
        ?>
        <div class="product-card">
          <div class="product-icons">
            <a href="/<?=$row['id']?>"><i data-feather="shopping-cart"></i></a>
          </div>
          <div class="product-image">
            <img src="<?=$row['img']?>" alt="Atomic Habits" width="400px" />
          </div>
          <div class="product-content">
            <h3><?=$row['name']?></h3>
            <div class="product-stars">
              <i data-feather="star"></i>
              <i data-feather="star"></i>
              <i data-feather="star"></i>
              <i data-feather="star"></i>
              <i data-feather="star"></i>
            </div>
            <div class="product-price"><span>Rp<?=number_format($row['price'])?></span></div>
          </div>
        </div>
        <?php } ?>
      </div>
    </section>

    <!-- Product Section End -->

    <!-- Modal Box Detail Item -->
    <!-- Membuat item ketika diklik akan muncul diskripsi -->
    <!-- Untuk membuat transparan background ketika buka modal -->
    <!-- <div class="modal-item" id="modal-item">
      <div class="modal-container">
        <a href="#" class="close-icon"><i data-feather="x"></i></a>
        <div class="modal-content">
          <img src="images/atomic.jpg" alt="Atomic Habits" />
          <h3>Atomic Habits</h3>
          <p>
            Atomic Habits adalah buku yang membahas tentang bagaimana kebiasaan
            kecil dapat membawa perubahan besar dalam hidup kita. Buku ini
            ditulis oleh James Clear dan merupakan buku best seller di New York
            Times.
          </p>

          <div class="product-stars">
            <i data-feather="star"></i>
            <i data-feather="star"></i>
            <i data-feather="star"></i>
            <i data-feather="star"></i>
            <i data-feather="star"></i>
          </div>
          <div class="product-price">IDR 75000</div>
          <a href="#"
            ><i data-feather="shopping-cart"></i><span>Add to Cart</span></a
          >
        </div>
      </div>
    </div> -->
    <!-- Modal Box Detail Item End -->

    <script src="script.js"></script>
  </body>
</html>
