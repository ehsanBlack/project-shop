<?php
session_start();
if (isset($_SESSION["stateLogin"]) && $_SESSION["stateLogin"] === true) {
    exit("<script>location.replace('index.php')</script>");
}

if (
    isset($_POST["username"]) && !empty($_POST["username"])
    && isset($_POST["realname"]) && !empty($_POST["realname"])
    && isset($_POST["password"]) && !empty($_POST["password"])
    && isset($_POST["repassword"]) && !empty($_POST["repassword"])
    && isset($_POST["email"]) && !empty($_POST["email"])
) {
    $username = $_POST["username"];
    $realname = $_POST["realname"];
    $password = strval($_POST["password"]);
    $email = $_POST["email"];
    if ($_POST["password"] != $_POST["repassword"]) {
        exit("<script>alert('کلمه عبور با تکرار آن مطابقت ندارد');</script>");
    }

    $servername="localhost";
    $dbusername="root";
    $dbname="shop_db";
    $Password ="";

    $connect = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $Password);
    $sql = "INSERT INTO users (realName,userName,password,email,type) VALUES ('$realname','$username','$password','$email',0)";
    $connect->exec("SET NAMES utf8");
    $connect->exec($sql);
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<script>alert('ثبت نام با موفقیت انجام شد');</script>";
    echo "<script>location.replace('index.php')</script>";
} else
if (
    isset($_POST["username"]) && empty($_POST["username"])
    && isset($_POST["password"]) && empty($_POST["password"])
) {
    echo "<script>alert('برخی از فیلد ها خالی است');</script>";
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


    <title>sign</title>
</head>

<body class="login">


    <div class="box">
        <form action="" method="POST" class="form form-sign">

            <h5 class="my-3 text-warning">فرم ثبت نام</h5>
            <div class="form-group"><input type="text" class="form-control " name="realname" id="realname" placeholder="نام واقعی"></div><br>
            <div class="form-group"><input type="text" class="form-control " name="username" id="username" placeholder="نام کاربری"></div><br>
            <div class="form-group"><input type="password" class="form-control " name="password" id="password" placeholder="رمز عبور"></div><br>
            <div class="form-group"><input type="password" class="form-control " name="repassword" id="repassword" placeholder="تکرار رمز عبور"></div><br>
            <div class="form-group"><input type="email" class="form-control " name="email" id="email" placeholder="ایمیل"></div><br>
            <div class="form-group">
                <input type="submit" value="ثبت" class="btn btn-success ml-3">
                <input type="reset" value="جدید" class="btn btn-warning">
            </div>
        </form>
    </div>


    <script src="js/all.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>