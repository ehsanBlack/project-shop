<?php
session_start();

if (!(isset($_SESSION["stateLogin"]) && $_SESSION["stateLogin"] === true && $_SESSION["user-type"] === "admin")) {
    echo "<script>location.replace('index.php');</script>";
}
if (
    isset($_POST["code"]) && !empty($_POST["code"])
    && isset($_POST["name"]) && !empty($_POST["name"])
    && isset($_POST["qty"]) && !empty($_POST["qty"])
    && isset($_POST["price"]) && !empty($_POST["price"])
    && isset($_POST["description"]) && !empty($_POST["description"])
) {
    $code = $_POST["code"];
    $name = $_POST["name"];
    $qty = $_POST["qty"];
    $price = $_POST["price"];
    $image = basename($_FILES["pro_image"]["name"]);
    // var_dump($image);
    // exit;
    $description = $_POST["description"];

    $servername="localhost";
    $dbusername="root";
    $dbname="shop_db";
    $password ="";

    $connect = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $password);

    $pathimage = "images/products/";
    $pathimagecompelet = $pathimage . basename($_FILES["pro_image"]["name"]);

    $uploadOk = 1;
    $pathinfo = pathinfo($pathimagecompelet, PATHINFO_EXTENSION);

    $imagesize = getimagesize($_FILES["pro_image"]["tmp_name"]);
    // var_dump($imagesize);
    // exit;
    if ($imagesize !== false) {
        echo "<script>alert('پرونده انتخابی شما " . $imagesize["mime"] . "است')</script>";
        $uploadOk = 1;
    } else {
        echo "<script>alert('پرونده انتخابی شما از نوع عکس نمی باشد')</script>";
        $uploadOk = 0;
    }

    if ($_FILES["pro_image"]["size"] > 3000000) {
        echo "<script>alert('فایل ورودی شما از 3 مگابایت بیشتر است')</script>";
        $uploadOk = 0;
    }

    if ($pathinfo != "jpg" && $pathinfo != "jpeg" && $pathinfo != "png" && $pathinfo != "gif") {
        echo "<script>alert('فقط پسوند های gif,png,jpg,jpeg مجاز هستند')</script>";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "<script>alert(پرونده انتخاب شده به سرویس دهنده ارسال نشد) </script><br>";
    } else {
        if (move_uploaded_file($_FILES["pro_image"]["tmp_name"], $pathimagecompelet)) {
            echo "<script>alert('پرونده" . $_FILES["pro_image"]["name"] . "با موفقیت ارسال شد')</script>";
        } else {
            echo "<script>alert('خطا در ارسال فایل به سرویس دهنده')</script>";
        }
    }


    if ($uploadOk == 1) {
        $sql = "INSERT INTO products(pro_code,pro_name,pro_qty,pro_price,pro_image,pro_detail)VALUES
        ('$code',n'$name','$qty','$price','$image',n'$description')";
        $query = $connect->prepare($sql);
        if ($query->execute() === true) {
            echo "<script>alert('کالا با موقفیت به سرویس دهنده ارسال شد')</script>";
            echo "<script>location.replace('index.php #product');</script>";
        } else {
            echo "<script>alert('خطا در ثبت مشخصات کالا')</script>";
        }
    } else {
        echo "<script>alert('خطا در ثبت مشخصات کالا')</script>";
    }
} else
if (
    isset($_POST["code"]) && empty($_POST["code"])
    || isset($_POST["name"]) && empty($_POST["name"])
    || isset($_POST["qty"]) && empty($_POST["qty"])
    || isset($_POST["price"]) && empty($_POST["price"])
    || isset($_POST["description"]) && empty($_POST["description"])
) {
    echo "<script>alert('برخی از فیلد ها خالی می باشد')</script>";
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

    <title>admin</title>
</head>

<body class="login">

<div class="box">
        <form class="form form-admin pt-3" method="POST" enctype="multipart/form-data">
            <div class="form-group"> <input type="text" placeholder="کد کالا" class="form-control " name="code"></div><br>
            <div class="form-group"> <input type="text" placeholder="نام کالا" class="form-control " name="name"></div><br>
            <div class="form-group"> <input type="text" placeholder="موجودی کالا" class="form-control" name="qty"></div><br>
            <div class="form-group"> <input type="text" placeholder="قیمت کالا" class="form-control " name="price"></div><br>
            <div class="form-group"> <input type="file" class="offset-2" name="pro_image"></div><br>
            <div class="form-group"> <input type="text" placeholder="توضیحات تکمیلی کالا" class="form-control " name="description"></div><br>
            <div class="form-group">
                <input type="submit" class="btn btn-success ml-3" name="login" value="افزودن کالا">
                <input type="reset" class="btn btn-warning" value="جدید">
            </div>
        </form>
    </div>



    <script src="js/all.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>

