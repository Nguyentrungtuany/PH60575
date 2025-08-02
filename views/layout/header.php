
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Anime | Template</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <!-- Css Styles -->
    <link rel="stylesheet" href="./commons/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="./commons/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="./commons/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="./commons/css/plyr.css" type="text/css">
    <link rel="stylesheet" href="./commons/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="./commons/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="./commons/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="./commons/css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="header__logo">
                        <a href="?act=index">
                            <img src="./commons/img/logo.png" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="header__nav">
                        <nav class="header__menu mobile-menu">
                            <ul>
                                <li class="active"><a href="?act=index">Homepage</a></li>
                                <li><a href="?act=categories">Categories <span class="arrow_carrot-down"></span></a>
                                    <ul class="dropdown">
                                        <li><a href="?act=categories">Categories</a></li>
                                        <li><a href="?act=anime-details">Anime Details</a></li>
                                        <li><a href="?act=anime-watching">Anime Watching</a></li>
                                        <li><a href="?act=blog-details">Blog Details</a></li>
                                        <li><a href="?act=signup">Sign Up</a></li>
                                        <li><a href="?act=login">Login</a></li>
                                    </ul>
                                </li>
                                <li><a href="?act=blog">Our Blog</a></li>
                                <li><a href="#">Contacts</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="header__right d-flex align-items-center">
                        <form class="d-flex align-items-center" method="GET" action="index.php">
                            <input type="hidden" name="act" value="anime-search">
                            <input type="search" name="keyword" placeholder="Nhập tên phim bạn muốn tìm..." 
                                style="padding: 6px 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;"
                                value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
                            <button type="submit" style="border: none; background: none; margin-left: 5px;">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                            <?php if (isset($_SESSION['user'])): ?>
                            <div class="dropdown">
                                <button class="btn btn-dark dropdown-toggle d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="<?php echo $_SESSION['user']['avata']; ?>"  width="50" class="me-2">
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li class="dropdown-item text-muted"><i class="bi bi-file-earmark-person"></i> Xin chào, <strong><?php echo htmlspecialchars($_SESSION['user']['username']); ?></strong></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-dark " href="?act=profile"><i class="bi bi-pencil"></i> Cập nhật thông tin</a></li>
                                    <li><a class="dropdown-item text-dark" href="?act=logout"><i class="bi bi-door-open"></i> Đăng xuất</a></li>
                                </ul>
                            </div>
                        <?php else: ?>
                             <a href="?act=login" style="margin-left: 15px;"><span class="icon_profile"></span></a>
                        <?php endif; ?>

                        </form>

                        <!-- <a href="?act=login" style="margin-left: 15px;"><span class="icon_profile"></span></a> -->
                    </div>
                </div>

            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <!-- Header End -->