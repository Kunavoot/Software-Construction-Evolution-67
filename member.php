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
    <title>การจัดการข้อมูลสมาชิก (Member Management)</title>
</head>

<body>
    <?php include('menuAdmin.php'); ?>

    <div class="main">
        <div class="topic">
            <b>
                <p>จัดการข้อมูลสมาชิก</p>
            </b>
            <button onclick="insertClick();" type="button" class="btn btn-success btn-sm p-0 px-3 my-2 mx-3">เพิ่มสมาชิกใหม่</button>
        </div>
        <div class="work mx-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>รหัสสมาชิก</th>
                        <th>ชื่อ - นามสกุล</th>
                        <th>วันเดือนปีเกิด</th>
                        <th>เบอร์โทรศัพท์</th>
                        <th>ดำเนินการ</th>
                    </tr>
                </thead>
                <?php
                $data = $db_handle->Textquery("SELECT * FROM MEMBER");
                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                ?>
                        <tr>
                            <td><?php echo $data[$key]['Cust_id']; ?></td>
                            <td class="name"><?php echo $data[$key]['New_name']; ?></td>
                            <td><?php echo $data[$key]['Cust_birth']; ?></td>
                            <td><?php echo $data[$key]['Cust_tel']; ?></td>
                            <td>
                                <button type="button" id="edit[<?php echo $key; ?>]" class="btn btn-warning btn-sm px-3" onclick="editClick(<?php echo $key; ?>);"
                                    cid="<?php echo $data[$key]['Cust_id']; ?>"
                                    pname="<?php echo $data[$key]['Cust_prename']; ?>"
                                    fname="<?php echo $data[$key]['Cust_firstname']; ?>"
                                    lname="<?php echo $data[$key]['Cust_lastname']; ?>"
                                    level="<?php echo $data[$key]['Cust_level']; ?>"
                                    address="<?php echo $data[$key]['Cust_address']; ?>"
                                    bdate="<?php echo $data[$key]['Cust_birth']; ?>"
                                    tel="<?php echo $data[$key]['Cust_tel']; ?>"
                                    un="<?php echo $data[$key]['Cust_UN']; ?>"
                                    pw="<?php echo $data[$key]['Cust_PW']; ?>"
                                    img="<?php echo $data[$key]['Cust_picture']; ?>">แก้ไข</button>
                                <button class="btn btn-danger btn-sm" onclick="return confirm('กรุณายืนยันการลบข้อมูล ? ** ห้ามลบข้อมูลเดิม! **')">
                                    <a href="memberProcess.php?st=D&cid=<?php echo $data[$key]['Cust_id']; ?>">ลบข้อมูล</a></button>
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
    <div id="info1" class="info_member">
        <form action="memberProcess.php" method="post" enctype="multipart/form-data">
            <div class="info_detail">
                <h4 id="topicname">เพิ่มข้อมูลสมาชิกใหม่</h4>
                <div class="infoLeft">
                    <input type="text" id="st" name="st" hidden>
                    <div class="row">
                        <div class="col-3"><label>รหัสสมาชิก</label></div>
                        <div class="col-4"><input type="text" id="cid" name="cid" maxlength="5"></div>
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
                        <div class="col-3"><label>ระดับสมาชิก</label></div>
                        <div class="col-8"><input type="text" width="50" id="level" name="level" maxlength="3"></div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-3"><label>ที่อยู่</label></div>
                        <div class="col-8"><textarea name="address" id="address" cols="20" rows="5" width="100" maxlength="200"></textarea></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>วันเดือนปีเกิด</label></div>
                        <div class="col-4"><input type="text" id="bdate" name="bdate" maxlength="10"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>เบอร์โทรศัพท์</label></div>
                        <div class="col-4"><input type="text" id="tel" name="tel" maxlength="20"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>ชื่อเข้าใช้ระบบ</label></div>
                        <div class="col-4"><input type="text" id="un" name="un" maxlength="5"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>รหัสผ่าน</label></div>
                        <div class="col-4"><input type="text" id="pw" name="pw" maxlength="6"></div>
                    </div>
                </div>

                <div class="infoRight">
                    <b>
                        <p>รูปสมาชิก</p>
                    </b>
                    <img id="myImg"> <br>
                    <input type="file" name="memberImg" id="memberImg" accept="image/jpeg"></input> <br>
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
            document.getElementById("topicname").innerText = "เพิ่มข้อมูลสมาชิกใหม่"
            document.getElementById("st").value = "A";
            document.getElementById("cid").value = "";
            document.getElementById("pname").value = "";
            document.getElementById("fname").value = "";
            document.getElementById("lname").value = "";
            document.getElementById("level").value = "";
            document.getElementById("address").value = "";
            document.getElementById("bdate").value = "";
            document.getElementById("tel").value = "";
            document.getElementById("un").value = "";
            document.getElementById("pw").value = "";
            document.getElementById("myImg").src = "img/unknown.jpg";
            document.getElementById("cid").removeAttribute("readonly");
            document.getElementById("un").removeAttribute("readonly");
            document.getElementById("pw").removeAttribute("readonly");
            document.getElementById("memberImg").setAttribute("required", true);
        }

        function editClick(k) {
            var data = document.getElementById("edit[" + k + "]");
            document.getElementById("info1").style.display = "flex";
            document.getElementById("topicname").innerText = "แก้ไขข้อมูลสมาชิก";
            document.getElementById("st").value = "V";
            document.getElementById("cid").value = data.getAttribute("cid");
            document.getElementById("pname").value = data.getAttribute("pname");
            document.getElementById("fname").value = data.getAttribute("fname");
            document.getElementById("lname").value = data.getAttribute("lname");
            document.getElementById("level").value = data.getAttribute("level");
            document.getElementById("address").value = data.getAttribute("address");
            document.getElementById("bdate").value = data.getAttribute("bdate");
            document.getElementById("tel").value = data.getAttribute("tel");
            document.getElementById("un").value = data.getAttribute("un");
            document.getElementById("pw").value = data.getAttribute("pw");
            document.getElementById("myImg").src = data.getAttribute("img");
            document.getElementById("cid").setAttribute("readonly", true);
            document.getElementById("un").setAttribute("readonly", true);
            document.getElementById("pw").setAttribute("readonly", true);
            document.getElementById("memberImg").removeAttribute("required");

            //สำหรับตรวจสอบรูป
            var img = new Image();
            img.src = data.getAttribute("img");
            img.onload = () => {
                document.getElementById("myImg").src = data.getAttribute("img");
            };
            img.onerror = () => {
                document.getElementById("myImg").src = 'img/wait1.png';
            }
        }

        function cancelClick() {
            document.getElementById("info1").style.display = "none";
        }

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