<?php
require_once('script/Myscript.php');
$db_handle = new myDBControl();

$st = $_REQUEST["st"];
if ($st == 'A') {
    $cid        = $_POST["cid"];
    $pname      = $_POST["pname"];
    $fname      = $_POST["fname"];
    $lname      = $_POST["lname"];
    $level      = $_POST["level"];
    $address    = $_POST["address"];
    $bdate      = $_POST["bdate"];
    $tel        = $_POST["tel"];
    $un         = $_POST["un"];
    $pw         = $_POST["pw"];
    $img        = "img/Member/" . $cid . ".jpg";

    // echo  'name=' . $_FILES['memberImg']['name'] . "<br>";
    // echo  'temp_name=' . $_FILES['memberImg']['temp_name'] . "<br>";
    // echo  'size=' . $_FILES['memberImg']['size'] . "<br>";
    // echo  'error=' . $_FILES['memberImg']['error'] . "<br>";

    //สร้างแหล่งที่จะ upload file เข้าไปเก็บ
    if (isset($_FILES['memberImg'])) {
        //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์ => Host
        move_uploaded_file($_FILES['memberImg']['tmp_name'], $img);
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('ไม่พบ Image file " . $_FILES['memberImg']['name'] . "');";
        echo "</script>";
    }

    $tcheck     = "SELECT * FROM CUSTOMER WHERE (Cust_id = '$cid' AND Cust_UN = '$un' AND Cust_PW = '$pw')";
    $check      = $db_handle->Textquery($tcheck);

    if (empty($check)) {
        $tquery     = "INSERT INTO CUSTOMER VALUE('$un', '$pw', '$cid', '$pname', '$fname', '$lname', '$level', '$bdate', '$address', '$tel', '$img')";
        $insData    = $db_handle->Execquery($tquery);
        echo "<script type='text/javascript'>";
        echo "alert('สมาชิกรหัส " . $cid . " ได้ถูกบันทึกข้อมูลแล้ว');";
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
    $cid        = $_POST["cid"];
    $pname      = $_POST["pname"];
    $fname      = $_POST["fname"];
    $lname      = $_POST["lname"];
    $level      = $_POST["level"];
    $address    = $_POST["address"];
    $bdate      = $_POST["bdate"];
    $tel        = $_POST["tel"];
    $un         = $_POST["un"];
    $pw         = $_POST["pw"];
    $img        = "img/Member/" . $cid . ".jpg";

    $tquery     = "UPDATE CUSTOMER SET
                        Cust_prename = '$pname',
                        Cust_firstname = '$fname',
                        Cust_lastname = '$lname',
                        Cust_level = '$level',
                        Cust_birth = '$bdate',
                        Cust_address = '$address',
                        Cust_tel = '$tel'
                    WHERE (Cust_id = '$cid')";
    $UpData    = $db_handle->Execquery($tquery);

    unlink($img);
    move_uploaded_file($_FILES['memberImg']['tmp_name'], $img);

    echo "<script type='text/javascript'>";
    echo "alert('สมาชิกรหัส " . $cid . " ได้ถูกปรับปรุงข้อมูลแล้ว');";
    echo "window.location = 'member.php';";
    echo "</script>";
}

if ($st == 'D') {
    $cid        = $_GET["cid"];
    $img = "img/Member/" . $cid . ".jpg";

    if (substr($cid, 0, 2) != 'C00') {
        unlink($img); //ลบไฟล์เดิมก่อน    
    }

    $tquery = "DELETE FROM CUSTOMER WHERE (Cust_id = '$cid') AND (Cust_id NOT LIKE 'C00%')";
    $delData    = $db_handle->Execquery($tquery);
    echo "<script type='text/javascript'>";
    echo "alert('สมาชิกรหัส " . $cid . " ได้ถูกลบข้อมูลแล้ว');";
    echo "window.location = 'member.php';";
    echo "</script>";
}
