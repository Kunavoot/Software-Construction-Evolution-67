<?php
require_once('script/Myscript.php');
$db_handle = new myDBControl();

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

// unlink($img);
move_uploaded_file($_FILES['memberImg']['tmp_name'], $img);

echo "<script type='text/javascript'>";
echo "alert('สมาชิกรหัส " . $cid . " ได้ถูกปรับปรุงข้อมูลแล้ว');";
echo "window.location = 'profile.php';";
echo "</script>";
