<?php
session_start();

require_once('script/Myscript.php');
$db_handle = new myDBControl();

$un = $_POST['Uname'];
$pw = $_POST['Passwd'];

$data = $db_handle->Textquery("SELECT * FROM LOGIN_DATA
    WHERE Username = '$un' AND Password = '$pw'");

// echo "SELECT * FROM LOGIN_DATA
//     WHERE Username = '$un' AND Password = '$pw'";
if (empty($data)) {
    echo "<script type='text/javascript'>";
    echo "alert('คุณไม่มีสิทธิเข้าระบบ!!!!');";
    echo "window.location = 'login.php';";
    echo "</script>";
} else {
    $flag = $data[0]['Flag'];
    $name = $data[0]['Firstname'].' '.$data[0]['Lastname'];
    $pos = $data[0]['Level'];
    // echo $flag."<br>".$name;
    $_SESSION["id"]     = $data[0]['ID'];   //รหัสบุคคล
    $_SESSION["fname"]  = $name;            //ชื่อผู้เข้าระบบ
    if ($flag == '1') {
        $_SESSION["flag"]   = '1';            //สิทธิ์ผู้เข้าใช้ระบบ
        echo "<script type='text/javascript'>";
        //echo "alert('สวัสดีคุณลูกค้า ชื่อ ".$name."');";
        echo "window.location = 'profile.php';";
        echo "</script>";
    } else {
        if ($pos == 'P00') {
            $_SESSION["flag"]   = '3';            //สิทธิ์ผู้เข้าใช้ระบบ
            echo "<script type='text/javascript'>";
            //echo "alert('สวัสดีคุณผู้บริหาร ชื่อ ".$name."');";
            echo "window.location = 'saleReport.php';";
            echo "</script>";
        } else {
            $_SESSION["flag"]   = '2';            //สิทธิ์ผู้เข้าใช้ระบบ
            echo "<script type='text/javascript'>";
            // echo "alert('สวัสดีคุณเจ้าหน้าที่ ชื่อ ".$name."');";
            echo "window.location = 'member.php';";
            echo "</script>";
        }
    }
}
?>
