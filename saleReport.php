<!DOCTYPE html>
<?php
session_start();
require_once('script/Myscript.php');
$db_handle = new myDBControl();

if (isset($_SESSION["flag"])) {
    if ($_SESSION["flag"] == '3') {
        $id    = $_SESSION["id"];
        $fname  = $_SESSION["fname"];
    } else {
        echo "<script type='text/javascript'>";
        echo "alert('คุณไม่ได้เป็นผู้บริหาร !!!!');";
        echo "window.location = 'login.php';";
        echo "</script>";
    }
} else {
    echo "<script type='text/javascript'>";
    echo "alert('คุณไม่มีสิทธิ์เข้าดูรายงาน !!!!');";
    echo "window.location = 'login.php';";
    echo "</script>";
}
$date = '';
$tsearch = '';
if (isset($_GET['date']) && $_GET['date'] != '') {
    $date = $_GET['date'];
    $tsearch = "WHERE (Inv_date LIKE '%$date')";
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
    <title>รายงานการขายสินค้า (Sale Report) </title>
    <link rel="stylesheet" href="css/myStyle.css">
    <link rel="stylesheet" href="css/adminStyle.css">
    <link rel="stylesheet" href="css/masterStyle.css">
</head>

<body>
    <div class="adminHeader master">
        <div class="headLeft">
            <img src="img/logo.png">
            <div class="title">
                <h4>SE-Store System</h4>
                <p>: ส่วนงานผู้บริหาร</p>
            </div>
        </div>
        <div class="headRight">
            <p>สวัสดี, คุณผู้บริหาร : <b><?php echo $fname; ?></b></p>
            <ul class="menubar">
                <li><b><a href="saleReport.php">รายงานการขายสินค้า</a></b></li>
                <li> | </li>
                <li><b><a href="purchaseReport.php">รายงานการซื้อเข้าคลัง</a></b></li>
                <li> | </li>
                <li><b><a href="login.php">ออกจากระบบ</a></b></li>
            </ul>
        </div>
    </div>

    <div class="main">
        <div class="reportHead">
            <div class="company">
                <img src="img/logo.png"><label>บริษัท SE-Store จำกัด</label>
                <p>รายงานการขายสินค้า <?php if ($date != '') {
                                            echo ": ประจำเดือน " . $date;
                                        } ?></p>
            </div>
        </div>

        <div class="area">
            <table class="saleTable">
                <thead>
                    <tr>
                        <th>เลขที่ใบเสร็จ</th>
                        <th>วันที่ใบเสร็จ</th>
                        <th>ชื่อสมาชิก</th>
                        <th>จำนวนซื้อ</th>
                        <th>รวมเงิน</th>
                        <th>ส่วนลด</th>
                        <th>ภาษี</th>
                        <th>รวมสุทธิ</th>
                    </tr>
                </thead>
                <?php
                $total = 0;
                $flag = 0;
                $data = $db_handle->Textquery("SELECT * FROM INVOICE_ALL " . $tsearch . " ORDER BY RIGHT(Inv_date,4) DESC, SUBSTR(Inv_date,4,2) DESC, LEFT(Inv_date,2) DESC");
                if (!empty($data)) {
                    foreach ($data as $key => $value) { ?>
                        <tr>
                            <td><button class="btn btn-print px-3" onclick="invPrint(this);"><?php echo $data[$key]['Inv_no']; ?></button></td>
                            <td><?php echo $data[$key]['Inv_date']; ?></td>
                            <td><?php echo $data[$key]['Cust_name']; ?></td>
                            <td><?php echo $data[$key]['totalUnit']; ?></td>
                            <td><?php echo number_format($data[$key]['Amount'], 2); ?></td>
                            <td><?php echo number_format($data[$key]['Discount'], 2); ?></td>
                            <td><?php echo number_format($data[$key]['Tax'], 2); ?></td>
                            <td><?php echo number_format($data[$key]['totalMoney'], 2); ?></td>
                            </td>
                        </tr> 
                <?php
                        $total = $total + $data[$key]['totalMoney'];;
                    }
                } else {
                    $flag = 1;
                } ?>
            </table>
            <?php
            if ($flag == 1) { ?>

                <div class="notFound">
                    <p>ไม่พบข้อมูลรายการขายสินค้าในวันดังกล่าว !</p>
                </div>
            <?php } ?>
        </div>
        <div class="footer">
            <div class="search">
                เลือกเดือน/ปี
                <input type="text" name="date" id="date" placeholder="mm/yyyy">
                <button class="btn btn-search btn-sm px-3" onclick="dateClick();">ค้นหา</button>
            </div>
            <div class="sum">
                ยอดขายรวมทั้งสิ้น <input type="text" value="<?php echo number_format($total, 2); ?>" readonly> บาท
            </div>
        </div>
    </div>
    <script>
        function dateClick() {
            Tdate = document.getElementById('date').value;
            window.location = 'saleReport.php?date=' + Tdate;
        }

        function invPrint(e) {
            var invNo = e.innerText;
            alert('เตรียมพิมพ์ใบสั่งซื้อ/ใบเสร็จเลขที่ ' + invNo);
            window.location = 'invoice.php?invid=' + invNo;
        }
    </script>
</body>

</html>