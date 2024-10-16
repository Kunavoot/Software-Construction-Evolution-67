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
    <title>การจัดการข้อมูลสินค้า (Product Management)</title>
</head>

<body>
    <?php include('menuAdmin.php'); ?>

    <div class="main">
        <div class="topic">
            <b>
                <p>จัดการข้อมูลสินค้า</p>
            </b>
            <button onclick="insertClick();" type="button" class="btn btn-success btn-sm p-0 px-3 my-2 mx-3">เพิ่มสินค้าใหม่</button>
        </div>
        <div class="work mx-3">
            <table class="table">
                <thead>
                    <tr>
                        <th>รหัสสินค้า</th>
                        <th>ชื่อสินค้า</th>
                        <th>ประเภทสินค้า</th>
                        <th>ราคาต่อหน่วย</th>
                        <th>จำนวนในคลัง</th>
                        <th>ดำเนินการ</th>
                    </tr>
                </thead>
                <?php
                $data = $db_handle->Textquery("SELECT * FROM ALLPRODUCT");
                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                ?>
                        <tr>
                            <td><?php echo $data[$key]['Product_id']; ?></td>
                            <td class="name"><?php echo $data[$key]['Product_name']; ?></td>
                            <td><?php echo $data[$key]['New_type']; ?></td>
                            <td><?php echo $data[$key]['Product_price']; ?></td>
                            <td><?php echo $data[$key]['Product_count']; ?></td>
                            <td>
                                <button type="button" id="edit[<?php echo $key; ?>]" class="btn btn-warning btn-sm px-3" onclick="editClick(<?php echo $key; ?>);"
                                    pid="<?php echo $data[$key]['Product_id']; ?>"
                                    name="<?php echo $data[$key]['Product_name']; ?>"
                                    ptype="<?php echo $data[$key]['Product_type']; ?>"
                                    cost="<?php echo $data[$key]['Product_cost']; ?>"
                                    price="<?php echo $data[$key]['Product_price']; ?>"
                                    count="<?php echo $data[$key]['Product_count']; ?>"
                                    unit="<?php echo $data[$key]['Product_unit']; ?>"
                                    low="<?php echo $data[$key]['Product_low']; ?>"
                                    high="<?php echo $data[$key]['Product_high']; ?>"
                                    detail="<?php echo $data[$key]['Product_detail']; ?>"
                                    img="<?php echo $data[$key]['Product_picture']; ?>">แก้ไข</button>
                                <button class="btn btn-danger btn-sm" onclick="return confirm('กรุณายืนยันการลบข้อมูล ? ** ห้ามลบข้อมูลเดิม! **')">
                                    <a href="productProcess.php?st=D&pid=<?php echo $data[$key]['Product_id']; ?>">ลบข้อมูล</a></button>
                                <!-- <button type="button" class="btn btn-danger btn-sm px-3">ลบ</button> -->
                            </td>
                        </tr>
                <?php }
                } else {
                    echo "<script type='text/javascript'>";
                    echo "alert('ไม่พบสินค้าในปัจจุบัน...');";
                    echo "</script>";
                }
                ?>
            </table>
        </div>
    </div>

    <!-- -- พื้นที่ Model -- -->
    <div id="info1" class="info_product">
        <form action="productProcess.php" method="post" enctype="multipart/form-data">
            <div class="info_detail">
                <h4 id="topicname">เพิ่มข้อมูลสินค้าใหม่</h4>
                <div class="infoLeft">
                    <input type="text" id="st" name="st" hidden>
                    <div class="row">
                        <div class="col-3"><label>รหัสสินค้า</label></div>
                        <div class="col-4"><input type="text" id="pid" name="pid" maxlength="3"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>ชื่อสินค้า</label></div>
                        <div class="col-8"><input type="text" id="name" name="name" maxlength="100"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>ประเภทสินค้า</label></div>
                        <div class="col-8"><input type="text" id="type" name="type" maxlength="2"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>ราคาต้นทุน</label></div>
                        <div class="col-4"><input type="text" id="cost" name="cost"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>ราคาขาย</label></div>
                        <div class="col-4"><input type="text" id="price" name="price"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>จำนวนในคลัง</label></div>
                        <div class="col-4"><input type="text" id="count" name="count"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>หน่วยนับ</label></div>
                        <div class="col-4"><input type="text" id="unit" name="unit" maxlength="20"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>จำนวนต่ำสุด</label></div>
                        <div class="col-4"><input type="text" id="low" name="low"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>จำนวนสูงสุด</label></div>
                        <div class="col-4"><input type="text" id="high" name="high"></div>
                    </div>
                    <div class="row">
                        <div class="col-3"><label>รายละเอียด</label></div>
                        <div class="col-8"><textarea id="detail" name="detail" cols="20" rows="5" width="100" maxlength="200"></textarea></div>
                    </div>
                </div>

                <div class="infoRight">
                    <b>
                        <p>รูปสินค้า</p>
                    </b>
                    <img id="myImg"> <br>
                    <input type="file" name="productImg" id="productImg" accept="image/jpg"></input> <br>
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
            document.getElementById("topicname").innerText = "เพิ่มข้อมูลสินค้าใหม่"
            document.getElementById("st").value = "A";
            document.getElementById("pid").value = "";
            document.getElementById("name").value = "";
            document.getElementById("type").value = "";
            document.getElementById("cost").value = "";
            document.getElementById("price").value = "";
            document.getElementById("count").value = "";
            document.getElementById("unit").value = "";
            document.getElementById("low").value = "";
            document.getElementById("high").value = "";
            document.getElementById("detail").value = "";
            document.getElementById("myImg").src = "img/wait3.png";
            document.getElementById("pid").removeAttribute("readonly");
            document.getElementById("productImg").setAttribute("required", true);
        }

        function editClick(k) {
            var data = document.getElementById("edit[" + k + "]");
            document.getElementById("info1").style.display = "flex";
            document.getElementById("topicname").innerText = "แก้ไขข้อมูลสินค้า";
            document.getElementById("st").value = "V";
            document.getElementById("pid").value = data.getAttribute("pid");
            document.getElementById("name").value = data.getAttribute("name");
            document.getElementById("type").value = data.getAttribute("ptype");
            document.getElementById("cost").value = data.getAttribute("cost");
            document.getElementById("price").value = data.getAttribute("price");
            document.getElementById("count").value = data.getAttribute("count");
            document.getElementById("unit").value = data.getAttribute("unit");
            document.getElementById("low").value = data.getAttribute("low");
            document.getElementById("high").value = data.getAttribute("high");
            document.getElementById("detail").value = data.getAttribute("detail");
            document.getElementById("myImg").src = data.getAttribute("img");
            document.getElementById("pid").setAttribute("readonly", true);
            document.getElementById("productImg").removeAttribute("required");
        }

        function cancelClick() {
            document.getElementById("info1").style.display = "none";
        }
    </script>
</body>

</html>