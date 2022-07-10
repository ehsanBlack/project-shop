<?php
session_start();
if (
    isset($_POST["username"]) && !empty($_POST["username"])
    && isset($_POST["password"]) && !empty($_POST["password"])
) {
    $servername="localhost";
    $dbusername="root";
    $dbname="shop_db";
    $password ="";

    $connect = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $password);
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE userName='$username' AND password='$password'";
    $query = $connect->prepare($sql);
    $query->execute();
    $results = $query->fetch();
    // var_dump($results);
    // exit;
    if ($results) {
        $_SESSION["stateLogin"] = true;
        $_SESSION["realName"] = $results["realName"];
        if ($results["type"] == 0) {
            $_SESSION["user-type"] = "public";
        } else {
            $_SESSION["user-type"] = "admin";
            // echo  "<script>location.replace('admin.php');</script>";
        }
        echo "<script>alert('خوش آمدید');</script>";
        echo "<script>location.replace('index.php')</script>";
    } else {
        echo "<script>alert('کاربری یافت نشد');</script>";
    }
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
    <title>login</title>
</head>

<body class="login">

    <div class="box">
        <form class="form form-login" method="POST">
        <h5 class="text-warning">فرم ورود  </h5><br>
            <div class="form-group"><input type="text" name="username" id="username" placeholder="نام کاربری" class="form-control"></div><br>
            <div class="form-group"><input type="password" name="password" id="password" placeholder="رمز عبور" class="form-control"></div><br>
            <div class="form-group text-center">
                <input type="submit" value="ورود" class="btn btn-success ml-3">
                <input type="reset" value="جدید" class="btn btn-warning">
            </div>
        </form>
    </div>


    <script src="js/all.js"></script>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>



</body>

</html>