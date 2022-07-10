<?php

session_start();
$servername = "localhost";
$dbusername = "root";
$dbname = "shop_db";
$password = "";
$connect = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $password);
$sql = "SELECT * FROM products";
$connect->exec("SET NAMES utf8");
$query = $connect->prepare($sql);
$query->execute();

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <title>main</title>
</head>

<body>



    <header class="main">
        <div class="container">
            <nav class="navbar navbar-expand pt-5">
                <ul class="navbar-nav d-flex justify-content-around w-100">
                    <li class="nav-item"><a href="index.php" class="nav-link">صفحه اصلی</a></li>
                    <li class="nav-item"><a href="sign.php" class="nav-link">عضویت در سایت</a></li>
                    <?php
                    if (isset($_SESSION["stateLogin"]) && $_SESSION["stateLogin"] === true) {
                    ?>
                        <li class="nav-item"><a href="logout.php" class="nav-link">خروج از سایت</a></li>
                    <?php
                    } else {
                    ?>
                        <li class="nav-item"><a href="login.php" class="nav-link">ورود به سایت</a></li>
                    <?php
                    }
                    ?>
                    <li class="nav-item"><a href="#" class="nav-link">درباره ما</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">تماس با ما</a></li>
                    <?php
                    if (isset($_SESSION["stateLogin"]) && $_SESSION["stateLogin"] === true && $_SESSION["user-type"] === "admin") {
                    ?>
                        <li class="nav-item"><a href="admin.php" class="nav-link">مدیریت فروشگاه</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
            <div class="header-titles text-center d-flex justify-content-center mt-3 ml-5">
                <i class="fas fa-store text-warning shop-icon"></i>
                <div class="main-title">
                    <h1 class="pt-5 font-weight-bold" style="font-size: 60px;"> وبسایت ایرانیان شاپ</h1>
                    <h1 class="pt-5 text-warning">خوش آمدید </h1>
                    <h1 class="pt-5">از سایت ما دیدن کنید</h1>
                    <button class="mt-5 btn btn-outline-warning"><a href="#product" class="">دیدن محصولات</a></button>
                </div>


            </div>
        </div>
    </header>


    <div class="production py-5">
        <div class="container">
            <div class="row">
                <div class="col-6 text-center">
                    <div class="pro-titles">
                        <h1 class="py-3">درباره وبسایت</h1>
                        <p class="text-justify">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد.
                            در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان
                            مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.
                        </p>
                        <button class="btn btn-outline-warning">اطلاعات بیشتر</button>
                    </div>
                </div>
                <div class="col-6 py-3"><img src="img/gallery-img-1.jpeg" class="pro-img img-fluid"></div>
            </div>
        </div>
    </div>




    <div class="banner" id="product" class="py-2">
        <h1 class="text-center py-4 mr-5 text-warning">محصولات</h1>
        <div class="row no-gutters">
            <?php
            $counter = 0;
            while ($result = $query->fetch()) {
                ++$counter;
            ?>
                <div class="col-4 cardd">
                    <div class="overlay d-flex flex-column justify-content-center align-items-center">
                        <h2><?php echo ($result["pro_name"]) ?></h2><br>
                        <h6><?php echo "قیمت محصول : " . $result["pro_price"] . " ریال" ?></h6>
                        <h6><?php echo "تعداد موجودی : " . $result["pro_qty"]; ?></h6>
                        <h6><?php echo "توضیحات  : " . substr($result["pro_detail"], 0, 80); ?></h6><br>
                        <h6><b><a href="shop.php?id=<?php echo $result['pro_code'] ?>" class="btn btn-outline-warning" style="text-decoration: none;color:#fff;">توضیحات تکمیلی و خرید</a></b></h3>
                    </div>
                    <img src="images/products/<?php echo $result["pro_image"] ?>" class="img" style="width: 450px;height:250px;">
                </div>
            <?php
                if ($counter % 3 == 0) {
                    echo "</div><div class='row no-gutters'>";
                }
            }
            if ($counter % 3 != 0) {
                echo "</div>";
            }
            ?>
        </div>





        <footer class="footer my-5">
            <div class="social-media w-100 d-flex justify-content-around">
                <a href=""><i class="fab fa-instagram"></i></a>
                <a href=""><i class="fab fa-facebook"></i></a>
                <a href=""><i class="fab fa-telegram"></i></a>
                <a href=""><i class="fab fa-youtube"></i></a>
            </div>
        </footer>

        <script src="js/all.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/jquery-3.3.1.min.js"></script>

</body>

</html>