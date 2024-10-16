<!DOCTYPE html>
<?php
session_start();
require_once('script/Myscript.php');
$db_handle = new myDBControl();

if (isset($_SESSION["flag"])) {
    if ($_SESSION["flag"] == '1') {
        $id    = $_SESSION["id"];
        $fname  = $_SESSION["fname"];
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('คุณไม่ได้เป็นสมาชิก !!!!');";
        echo "window.location = 'login.php';";
        echo "</script>";
    }
} else {
    echo "<script type='text/javascript'>";
    echo "alert('คุณไม่มีสิทธิ์เข้าใช้งาน !!!!');";
    echo "window.location = 'login.php';";
    echo "</script>";
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>การจัดการข้อมูลส่วนตัว (my Profile Management) </title>
    <link rel="stylesheet" href="css/myStyle.css">
    <link rel="stylesheet" href="css/memberStyle.css">
</head>

<body>
    <div class="adminHeader">
        <div class="headLeft">
            <div class="logo">
                <img src="img/logo.png">
            </div>
            <div class="title">
                <h4>SE-Store System</h4>
                <p>: ส่วนงานสมาชิก</p>
            </div>
        </div>
        <div class="headRight">
            <p>สวัสดี คุณสมาชิก <b><?php echo $fname; ?></b></p>
            <ul class="menubar">
                <li><b><a href="profile.php">ข้อมูลส่วนตัว</a></b></li>
                <li>|</li>
                <li><b><a href="cart.php">ตะกร้าสินค้า</a></b></li>
                <li>|</li>
                <li><b><a href="login.php">ออกจากระบบ</a></b></li>
            </ul>
        </div>
    </div>

    <?php $data = $db_handle->Textquery("SELECT * FROM MEMBER WHERE Cust_id = '$id'"); ?>

    <div class="main">
        <form action="profileProcess.php" method="post" enctype="multipart/form-data">
            <div class="info_detail">
                <h4>ข้อมูลส่วนตัว</h4>
                <div class="infoLeft">
                    <div class="row">
                        <div class="col-3"><label>รหัสสมาชิก</label></div>
                        <div class="col-4"><input type="text" name="cid" maxlength="5" value="<?php echo $data[0]['Cust_id']; ?>" readonly></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>คำนำหน้าชื่อ</label></div>
                        <div class="col-8"><input type="text" name="pname" maxlength="50" value="<?php echo $data[0]['Cust_prename']; ?>"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>ชื่อ-นามสกุล</label></div>
                        <div class="col-4"><input type="text" name="fname" maxlength="50" value="<?php echo $data[0]['Cust_firstname']; ?>"></div>
                        <div class="col-4"><input type="text" name="lname" maxlength="50" value="<?php echo $data[0]['Cust_lastname']; ?>"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>ระดับสมาชิก</label></div>
                        <div class="col-8"><input type="text" name="level" maxlength="3" value="<?php echo $data[0]['Cust_level']; ?>"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>ที่อยู่</label></div>
                        <div class="col-8"><textarea rows="5" name="address" maxlength="200"><?php echo $data[0]['Cust_address']; ?></textarea></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>วันเดือนปีเกิด</label></div>
                        <div class="col-4"><input type="text" name="bdate" maxlength="10" value="<?php echo $data[0]['Cust_birth']; ?>"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>เบอร์โทรศัพท์</label></div>
                        <div class="col-4"><input type="text" name="tel" maxlength="10" value="<?php echo $data[0]['Cust_tel']; ?>"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>User Name</label></div>
                        <div class="col-4"><input type="text" name="un" maxlength="5" value="<?php echo $data[0]['Cust_UN']; ?>" readonly></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>Password</label></div>
                        <div class="col-4"><input type="text" name="pw" maxlength="6" value="<?php echo $data[0]['Cust_PW']; ?>" readonly></div>
                    </div>


                </div>
                <div class="infoRight">
                    <p>รูปสมาชิก</p>
                    <p><img src="<?php
                                    if (isset($data[0]['Cust_picture'])) {
                                        echo $data[0]['Cust_picture'];
                                    } else {
                                        echo "Img/wait1.png";
                                    }
                                    ?>" id="myImg"></p>
                    <p><input type="file" id="memberImg" name="memberImg" Class="btImg" accept="image/jpg" onchange="imgSelected(this);"></input> </p>
                    <button class="btn btn-pink" type="submit">ปรับปรุงข้อมูลส่วนตัว</button>
                </div>

            </div>
        </form>
    </div>
    <script>
        function imgSelected(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById("myImg").src = e.target.result;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>