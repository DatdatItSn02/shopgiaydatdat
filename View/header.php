<header class="header">
    <!-- Header Logo Image -->
    <div class="header__logo">
            <img src="assets/img/logo.jpg" alt="" style="padding-top: 30px;">
    </div>
    <!-- Header Navbar -->
    <nav class="header__navbar">
        <ul class="header__navbar-list">
            <li class="header__navbar-item">
                <a href="/index.php?action=home" class="header__navbar-item-link">
                    <img src="assets/img/nav1.png" alt="" class="header__navbar-item-img">
                    <span>Trang chủ</span>
                </a>
                <!-- <div class="header__navbar-item-submenu">
                    <ul class="header__navbar-item-submenu-list">
                        <li class="header__navbar-item-submenu-item">
                            <a href="#">
                                Lều 2 Người
                            </a>
                        </li>
                        <li class="header__navbar-item-submenu-item">
                            <a href="#">
                                Lều 4 Người
                            </a>
                        </li>
                        <li class="header__navbar-item-submenu-item">
                            <a href="#">
                                Lều 6 Người
                            </a>
                        </li>
                        <li class="header__navbar-item-submenu-item">
                            <a href="#">
                                Lều 12 Người
                            </a>
                        </li>
                    </ul>
                </div> -->
            </li>
            <li class="header__navbar-item">
                <a href="/index.php?action=products" class="header__navbar-item-link">
                    <img src="assets/img/nav2.png" alt="" class="header__navbar-item-img">
                    <span>Sản phẩm</span>
                </a>
            </li>
            <li class="header__navbar-item">
                <a href="/index.php?action=blogs" class="header__navbar-item-link">
                    <img src="assets/img/newpaper.png" alt="" class="header__navbar-item-img">
                    <span>Blog</span>
                </a>
            </li>
        </ul>
    </nav>
    <!-- Header Button -->
    <div class="header__button">
        <a type="button" href="./index.php?action=cart" class="menu-button" style="text-decoration:none;"><i class="fa-solid fa-basket-shopping"></i></a>
        <button type="button" class="menu-button" data-bs-toggle="modal" data-bs-target="#mySearch"><i class="fa-solid fa-search"></i></button>
    </div>
    <?php
    // kiểm tra đăng nhập
    if (
        isset($_SESSION['customerId']) && 
        isset($_SESSION['customerName']) || 
        isset($_SESSION['staffId']) && 
        isset($_SESSION['staffName'])) :

        if(isset($_SESSION['staffId']))
            $name = $_SESSION['staffName'];
        else
            $name = $_SESSION['customerName'];
    ?>
        <div class="header__login">
            <div class="header-login__item">
                <button type="button" style="border: none; background-color:white">
                    <a href="index.php?action=order&act=orderhistory"><i class="fa-solid fa-list"></i>Lịch sử đơn hàng</a>
                </button>
            </div>
            <?php 
                if(isset($_SESSION['staffId'])) :
            ?>
            <div class="header-login__item">
                <a href="/Admin"><i class="fa-solid fa-user-shield"></i>Go to Admin</a>
            </div>
            <?php
                endif;
            ?>
            <div class="header-login__item">
                <a href="#"><i class="fa-solid fa-user"></i><?php echo $name ?></a>
            </div>
            <div class="header-login__item">
                <a href="index.php?action=login&act=logout"><i class="fa-solid fa-user-xmark"></i>Đăng Xuất</a>
            </div>
        </div>
    <?php
    else :
    ?>
        <div class="header__login">
            <div class="header-login__item">
                <a href="index.php?action=login"><i class="fa-solid fa-user"></i>Đăng nhập</a>
            </div>
            <div class="header-login__item">
                <a href="index.php?action=register"><i class="fa-solid fa-user-plus"></i>Đăng kí</a>
            </div>
        </div>
    <?php
    endif;
    ?>
</header>