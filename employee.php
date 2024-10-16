<!DOCTYPE html>

<?php
session_start();

require_once('script/Myscript.php');
$db_handle = new myDBControl();

include('check.php');

$id = $_SESSION['id'];
$fname = $_SESSION['fname'];
?>

<html lang="en">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <?php include('headAdmin.php'); ?>
    <title>การจัดการข้อมูลสมาชิก (Employee Management)</title>
</head>

<body>
    <?php include('menuAdmin.php'); ?>

    <div class="main">
        <div class="topic">
            <b>
                <p>จัดการข้อมูลเจ้าหน้าที่</p>
            </b>
            <button onclick="insertClick();" type="button" class="btn btn-success btn-sm p-0 px-3 my-2 mx-3">เพิ่มเจ้าหน้าที่ใหม่</button>
        </div>
        <div class="work mx-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>รหัสเจ้าหน้าที่</th>
                        <th>ชื่อ - นามสกุล</th>
                        <th>ตำแหน่งงาน</th>
                        <th>เงินเดือน</th>
                        <th>บัญชีธนาคาร</th>
                        <th>ดำเนินการ</th>
                    </tr>
                </thead>
                <?php
                $data = $db_handle->Textquery("SELECT * FROM ALL_EMPLOYEE");
                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                ?>
                        <tr>
                            <td><?php echo $data[$key]['Emp_id']; ?></td>
                            <td class="name"><?php echo $data[$key]['New_name']; ?></td>
                            <td><?php echo $data[$key]['Pos_name']; ?></td>
                            <td><?php echo $data[$key]['Emp_salary']; ?></td>
                            <td><?php echo $data[$key]['Emp_bank']; ?></td>
                            <td>
                                <button type="button" id="edit[<?php echo $key; ?>]" class="btn btn-warning btn-sm px-3" onclick="editClick(<?php echo $key; ?>);"
                                    eid="<?php echo $data[$key]['Emp_id']; ?>"
                                    pname="<?php echo $data[$key]['Emp_prename']; ?>"
                                    fname="<?php echo $data[$key]['Emp_firstname']; ?>"
                                    lname="<?php echo $data[$key]['Emp_lastname']; ?>"
                                    position="<?php echo $data[$key]['Emp_pos_id']; ?>"
                                    idcard="<?php echo $data[$key]['Emp_code1']; ?>"
                                    ssNum="<?php echo $data[$key]['Emp_code2']; ?>"
                                    bank="<?php echo $data[$key]['Emp_bank']; ?>"
                                    salary="<?php echo $data[$key]['Emp_salary']; ?>"
                                    un="<?php echo $data[$key]['Emp_UN']; ?>"
                                    pw="<?php echo $data[$key]['Emp_PW']; ?>"
                                    img="<?php echo $data[$key]['Emp_picture']; ?>">แก้ไข</button>
                                <button class="btn btn-danger btn-sm" onclick="return confirm('กรุณายืนยันการลบข้อมูล ? ** ห้ามลบข้อมูลเดิม! **')">
                                    <a href="employeeProcess.php?st=D&eid=<?php echo $data[$key]['Emp_id']; ?>">ลบข้อมูล</a></button>
                                <!-- <button type="button" class="btn btn-danger btn-sm px-3">ลบ</button> -->
                            </td>
                        </tr>
                <?php }
                } else {
                    echo "<script type='text/javascript'>";
                    echo "alert('ไม่พบสมาชิกในปัจจุบัน...');";
                    echo "</script>";
                }
                ?>
            </table>
        </div>
    </div>

    <!-- -- พื้นที่ Model -- -->
    <div id="info1" class="info_employee">
        <form action="employeeProcess.php" method="post" enctype="multipart/form-data">
            <div class="info_detail">
                <h4 id="topicname">เพิ่มข้อมูลเจ้าหน้าใหม่</h4>
                <div class="infoLeft">
                    <input type="text" id="st" name="st" hidden>
                    <div class="row">
                        <div class="col-3"><label>รหัสเจ้าหน้าที่</label></div>
                        <div class="col-4"><input type="text" id="eid" name="eid" maxlength="5"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>คำนำหน้าชื่อ</label></div>
                        <div class="col-8"><input type="text" id="pname" name="pname" maxlength="50"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>ชื่อ - นามสกุล</label></div>
                        <div class="col-4"><input type="text" id="fname" name="fname" maxlength="50"></div>
                        <div class="col-4"><input type="text" id="lname" name="lname" maxlength="50"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>ตำแหน่งงาน</label></div>
                        <div class="col-8"><input type="text" width="50" id="position" name="position" maxlength="3"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>เลขที่บัตร ปชช</label></div>
                        <div class="col-8"><input type="text" id="idcard" name="idcard" maxlength="15"></textarea></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>ประกันสังคม</label></div>
                        <div class="col-8"><input type="text" id="ssNum" name="ssNum" maxlength="15"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>บัญชีธนาคาร</label></div>
                        <div class="col-8"><input type="text" id="bank" name="bank" maxlength="50"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>เงินเดือน</label></div>
                        <div class="col-4"><input type="text" id="salary" name="salary" maxlength="8"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>User Name</label></div>
                        <div class="col-4"><input type="text" id="un" name="un" maxlength="5"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>Password</label></div>
                        <div class="col-4"><input type="text" id="pw" name="pw" maxlength="6"></div>
                    </div>
                </div>

                <div class="infoRight">
                    <b>
                        <p>รูปสมาชิก</p>
                    </b>
                    <img id="myImg"> <br>
                    <input type="file" name="employeeImg" id="employeeImg" accept="image/jpeg"></input> <br>
                    <div class="d-grid gap-2 d-md-block mx-auto">
                        <button type="submit" class="btn btn-primary btn-sm px-2 mx-2">บันทึกข้อมูล</button>
                        <button onclick="cancelClick();" type="reset" class="btn btn-danger btn-sm px-4 mx-2">ยกเลิก</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        function insertClick() {
            document.getElementById("info1").style.display = "flex";
            document.getElementById("topicname").innerText = "เพิ่มข้อมูลเจ้าหน้าที่ใหม่"
            document.getElementById("st").value = "A";
            document.getElementById("eid").value = "";
            document.getElementById("pname").value = "";
            document.getElementById("fname").value = "";
            document.getElementById("lname").value = "";
            document.getElementById("position").value = "";
            document.getElementById("idcard").value = "";
            document.getElementById("ssNum").value = "";
            document.getElementById("bank").value = "";
            document.getElementById("salary").value = "";
            document.getElementById("un").value = "";
            document.getElementById("pw").value = "";
            document.getElementById("myImg").src = "img/unknown.jpg";
            document.getElementById("eid").removeAttribute("readonly");
            document.getElementById("un").removeAttribute("readonly");
            document.getElementById("pw").removeAttribute("readonly");
            document.getElementById("employeeImg").setAttribute("required", true);
        }

        function editClick(k) {
            var data = document.getElementById("edit[" + k + "]");
            document.getElementById("info1").style.display = "flex";
            document.getElementById("topicname").innerText = "แก้ไขข้อมูลเจ้าหน้าที่";
            document.getElementById("st").value = "V";
            document.getElementById("eid").value = data.getAttribute("eid");
            document.getElementById("pname").value = data.getAttribute("pname");
            document.getElementById("fname").value = data.getAttribute("fname");
            document.getElementById("lname").value = data.getAttribute("lname");
            document.getElementById("position").value = data.getAttribute("position");
            document.getElementById("idcard").value = data.getAttribute("idcard");
            document.getElementById("ssNum").value = data.getAttribute("ssNum");
            document.getElementById("bank").value = data.getAttribute("bank");
            document.getElementById("salary").value = data.getAttribute("salary");
            document.getElementById("un").value = data.getAttribute("un");
            document.getElementById("pw").value = data.getAttribute("pw");
            document.getElementById("myImg").src = data.getAttribute("img");
            document.getElementById("eid").setAttribute("readonly", true);
            document.getElementById("un").setAttribute("readonly", true);
            document.getElementById("pw").setAttribute("readonly", true);
            document.getElementById("EmployeeImg").removeAttribute("required");
        }

        function cancelClick() {
            document.getElementById("info1").style.display = "none";
        }
    </script>
</body>

</html>