<?php
require_once('script/Myscript.php');
$db_handle = new myDBControl();

$st = $_REQUEST["st"];
if ($st == 'A') {
    $eid        = $_POST["eid"];
    $pname      = $_POST["pname"];
    $fname      = $_POST["fname"];
    $lname      = $_POST["lname"];
    $position   = $_POST["position"];
    $idcard     = $_POST["idcard"];
    $ssNum      = $_POST["ssNum"];
    $bank       = $_POST["bank"];
    $salary     = $_POST["salary"];
    $un         = $_POST["un"];
    $pw         = $_POST["pw"];
    $img        = "img/Employee/" . $eid . ".jpg";

    // echo  'name=' . $_FILES['memberImg']['name'] . "<br>";
    // echo  'temp_name=' . $_FILES['memberImg']['temp_name'] . "<br>";
    // echo  'size=' . $_FILES['memberImg']['size'] . "<br>";
    // echo  'error=' . $_FILES['memberImg']['error'] . "<br>";

    //สร้างแหล่งที่จะ upload file เข้าไปเก็บ
    if (isset($_FILES['EmployeeImg'])) {
        //คัดลอกไฟล์ไปเก็บที่เว็บเซริ์ฟเวอร์ => Host
        move_uploaded_file($_FILES['EmployeeImg']['tmp_name'], $img);
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('ไม่พบ Image file " . $_FILES['EmployeeImg']['name'] . "');";
        echo "</script>";
    }

    $tcheck     = "SELECT * FROM EMPLOYEE WHERE (Emp_id = '$eid' AND Emp_UN = '$un' AND Emp_PW = '$pw')";
    $check      = $db_handle->Textquery($tcheck);

    if (empty($check)) {
        $tquery     = "INSERT INTO EMPLOYEE VALUE('$un', '$pw', '$eid', '$pname', '$fname', '$lname', '$position', '$idcard', '$ssNum', '$bank', '$salary', '$img')";
        $insData    = $db_handle->Execquery($tquery);
        echo "<script type='text/javascript'>";
        echo "alert('เจ้าหน้าที่รหัส " . $eid . " ได้ถูกบันทึกข้อมูลแล้ว');";
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
    $eid        = $_POST["eid"];
    $pname      = $_POST["pname"];
    $fname      = $_POST["fname"];
    $lname      = $_POST["lname"];
    $position   = $_POST["position"];
    $idcard     = $_POST["idcard"];
    $ssNum      = $_POST["ssNum"];
    $bank       = $_POST["bank"];
    $salary     = $_POST["salary"];
    $un         = $_POST["un"];
    $pw         = $_POST["pw"];
    $img        = "img/Employee/" . $eid . ".jpg";

    $tquery     = "UPDATE EMPLOYEE SET
                        Emp_prename = '$pname',
                        Emp_firstname = '$fname',
                        Emp_lastname = '$lname',
                        Emp_pos_id = '$position',
                        Emp_code1 = '$idcard',
                        Emp_code2 = '$ssNum',
                        Emp_bank = '$bank',
                        Emp_salary = '$salary'
                    WHERE (Emp_id = '$eid')";
    $UpData    = $db_handle->Execquery($tquery);

    unlink($img);
    move_uploaded_file($_FILES['memberImg']['tmp_name'], $img);

    echo "<script type='text/javascript'>";
    echo "alert('สมาชิกรหัส " . $eid . " ได้ถูกปรับปรุงข้อมูลแล้ว');";
    echo "window.location = 'employee.php';";
    echo "</script>";
}

if ($st == 'D') {
    $eid        = $_GET["eid"];
    $img = "img/Member/" . $eid . ".jpg";

    if (substr($eid, 0, 2) != 'E00') {
        unlink($img); //ลบไฟล์เดิมก่อน    
    }

    $tquery = "DELETE FROM EMPLOYEE WHERE (Emp_id = '$eid') AND (Emp_id NOT LIKE 'E00%')";
    $delData    = $db_handle->Execquery($tquery);
    echo "<script type='text/javascript'>";
    echo "alert('เจ้าหน้าที่รหัส " . $eid . " ได้ถูกลบข้อมูลแล้ว');";
    echo "window.location = 'employee.php';";
    echo "</script>";
}
