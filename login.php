<!DOCTYPE html>
<html lang="en">

<?php
require_once('script/Myscript.php');
$db_handle = new myDBControl();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>งานตรวจสอบสิทธิ์</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <!-- <h6>ส่วนที่ 1 : ธนากร</h6> -->
    <!-- <div class="section1">
        <div class="main">
            <img src="img/logo.png">
            <div class="title">
                SE-Store System
            </div>
        </div>
        <ul class="menubar">
            <li>
                <a href="index.php">หน้าหลัก</a>
            </li>
            <li> | </li>
            <li><a href="login.php">เข้าสู่ระบบ</a></li>
        </ul>
    </div> -->
    <div class="login">
        <div class="leftLogin">
            <p class="head">ยินดีต้อนรับ</p>
            <form action="loginProcess.php" method="post" enctype="multipart/form-data">
                <p class="input">
                    ชื่อเข้าใช้ระบบ/e-mail <br>
                    <input type="text" name="Uname" class="inputtext" value="C0001">
                </p>
                <p class="input">
                    รหัสผ่าน <br>
                    <input type="password" name="Passwd" class="inputtext" value="1234">
                </p>
                <p class="fgpass"><input type="checkbox" name="" id=""> ลืมรหัสผ่าน ?</p> 
                <button type="submit" class="loginbutton">Login</button> <br>
                <b><a href="">ต้องการสมัครสมาชิกใหม่, คลิก!</a></b>
            </form>
        </div>
        <div class="rightImage">
            <img src="img/loginpage.png">
        </div>
    </div>
</body>

</html>