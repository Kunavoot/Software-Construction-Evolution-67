<?php
session_start();

if (isset($_SESSION['flag'])) {
    if ($_SESSION['flag'] == '2') {
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('คุณไม่ใช่เจ้าหน้าที่ !!!');";
        echo "window.location = 'login.php";
        echo "</script>";
    }
} else {
    echo "<script type='text/javascript'>";
    echo "alert('คุณไม่มีสิทธิ์เข้าทำงาน !!!');";
    echo "window.location = 'login.php";
    echo "</script>";
}
?>