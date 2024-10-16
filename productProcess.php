<?php
require_once('script/Myscript.php');
$db_handle = new myDBControl();

$st = $_REQUEST["st"];
if ($st == 'A') {
    $pid        = $_POST["pid"];
    $name       = $_POST["name"];
    $type       = $_POST["type"];
    $cost       = $_POST["cost"];
    $price      = $_POST["price"];
    $count      = $_POST["count"];
    $unit       = $_POST["unit"];
    $low        = $_POST["low"];
    $high       = $_POST["high"];
    $detail     = $_POST["detail"];
    $img        = "img/Product/" . $pid . ".jpg";

    // echo  'name=' . $_FILES['memberImg']['name'] . "<br>";
    // echo  'temp_name=' . $_FILES['memberImg']['temp_name'] . "<br>";
    // echo  'size=' . $_FILES['memberImg']['size'] . "<br>";
    // echo  'error=' . $_FILES['memberImg']['error'] . "<br>";

    //สร้างแหล่งที่จะ upload file เข้าไปเก็บ
    if (isset($_FILES['ProductImg'])) {
        //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์ => Host
        move_uploaded_file($_FILES['ProductImg']['tmp_name'], $img);
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('ไม่พบ Image file " . $_FILES['ProductImg']['name'] . "');";
        echo "</script>";
    }

    $tcheck     = "SELECT * FROM PRODUCT WHERE (Product_id = '$pid')";
    $check      = $db_handle->Textquery($tcheck);

    if (empty($check)) {
        $tquery     = "INSERT INTO PRODUCT VALUE('$pid', '$name', '$type', '$unit', '$cost', '$price', '$count', '$low', '$high', '$img', '$detail', '0')";
        $insData    = $db_handle->Execquery($tquery);
        echo "<script type='text/javascript'>";
        echo "alert('สินค้ารหัส " . $pid . " ได้ถูกบันทึกข้อมูลแล้ว');";
        echo "window.history.back();";
        echo "</script>";
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('พบข้อมูลซ้ำซ้อน กรุณาตรวจสอบ');";
        echo "window.history.back();";
        echo "</script>";
    }
}

if ($st == 'V') {
    $pid        = $_POST["pid"];
    $name       = $_POST["name"];
    $type       = $_POST["type"];
    $cost       = $_POST["cost"];
    $price      = $_POST["price"];
    $count      = $_POST["count"];
    $unit       = $_POST["unit"];
    $low        = $_POST["low"];
    $high       = $_POST["high"];
    $detail     = $_POST["detail"];
    $img        = "img/Product/" . $pid . ".jpg";

    $tquery     = "UPDATE PRODUCT SET
                        Product_name = '$name',
                        Product_type = '$type',
                        Product_cost = '$cost',
                        Product_price = '$price',
                        Product_count = '$count',
                        Product_unit = '$unit',
                        Product_low = '$low',
                        Product_high = '$high',
                        Product_detail = '$detail'
                    WHERE (Product_id = '$pid')";
    $UpData    = $db_handle->Execquery($tquery);

    unlink($img);
    move_uploaded_file($_FILES['productImg']['tmp_name'], $img);

    echo "<script type='text/javascript'>";
    echo "alert('สินค้ารหัส " . $pid . " ได้ถูกปรับปรุงข้อมูลแล้ว');";
    echo "window.location = 'product.php';";
    echo "</script>";
}

if ($st == 'D') {
    $pid        = $_GET["pid"];
    $img = "img/Product/" . $pid . ".jpg";

    if (substr($pid, 0, 1) != 'S') {
        unlink($img); //ลบไฟล์เดิมก่อน    
    }

    $tquery = "DELETE FROM PRODUCT WHERE (Product_id = '$pid') AND (Product_id NOT LIKE 'S%')";
    $delData    = $db_handle->Execquery($tquery);
    echo "<script type='text/javascript'>";
    echo "alert('สินค้ารหัส " . $pid . " ได้ถูกลบข้อมูลแล้ว');";
    echo "window.location = 'product.php';";
    echo "</script>";
}
