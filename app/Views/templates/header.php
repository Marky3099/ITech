
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script src="https://kit.fontawesome.com/0df98348d7.js" crossorigin="anonymous"></script>

<!-- custom css file link  -->
<link rel="stylesheet" href="<?= base_url('assets/css/homestyle.css')?>">

<header class="header">

    <a href="<?= base_url('#Home')?>" class="logo" > <img src="<?= base_url('assets/image/logo.png')?>"></a>
        

    <nav class="navbar">
        <a href="#home">home</a>
        <a href="#about">about</a>
        <a href="#services">services</a>
        <a href="#aircon">aircon</a>
        <a href="#contacts">contacts</a>
    
    </nav>

    <div class="icons">
        <a href="<?= base_url('/user-type')?>"><span class="fas fa-user" id="user-btn"></span></a>
        <span class="fas fa-bars" id="menu-btn"></span>
    </div>


</header>
<script src="assets/js/script.js"></script>