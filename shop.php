<?php
$servername="localhost";
$dbusername="root";
$dbname="shop_db";
$password ="";

$connect = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $password);

$connect->exec("SET NAMES utf8");

if (isset($_GET["id"])) {
    $code = 0;
    $code = $_GET["id"];
    $sql = "SELECT * FROM products WHERE pro_code='$code'";
    $query = $connect->prepare($sql);
    $query->execute();
}
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


    <header class="pro_detail">
        <div class="banner" id="product" class="py-2">
            <div class="row no-gutters" style="text-align:center; display: flex;justify-content: center;align-items: center;height: 100vh;">
                <?php
                if ($result = $query->fetch()) {
                ?>
                    <div class="col-4 w-100 d-flex flex-column align-items-center">
                        <h2><?php echo ($result["pro_name"]) ?></h2><br>
                        <img src="images/products/<?php echo $result["pro_image"] ?>" class="" style="width:600px;height:350px;opacity:0.7">
                        <div class="d-flex flex-column justify-content-center align-items-center mt-4">
                            <h6><?php echo "قیمت محصول : " . $result["pro_price"] . " ریال" ?></h6>
                            <h6><?php echo "تعداد موجودی : " . $result["pro_qty"]; ?></h6>
                            <h6><?php echo "توضیحات  : " . $result["pro_detail"]; ?></h6><br>
                            <h6><b><a href="order.php?id=<?php echo $result['pro_code'] ?>" class="btn btn-outline-warning" style="text-decoration: none;color:#fff;">سفارش و خرید</a></b></h3>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

            <script src="js/all.js"></script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/bootstrap.bundle.min.js"></script>
            <script src="js/jquery-3.3.1.min.js"></script>

</body>

</html>