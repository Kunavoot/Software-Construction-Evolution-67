<?php session_start(); ?>
<!DOCTYPE html>
<?php
require_once('script/Myscript.php');
$db_handle = new myDBControl();

if (isset($_SESSION["flag"])) {
    $Uid   = $_SESSION['id'];
    $Uname = $_SESSION['fname'];
} else {
    echo "<script type='text/javascript'>";
    echo "alert('กรุณา Login! ก่อนเลือกซื้อสินค้า');";
    echo "window.location = 'login.php';";
    echo "</script>";
}

// รับค่าตัวแปรสินค้าที่เลือก
if (isset($_GET['invid'])) {
    $invid  = $_GET['invid'];
    $DataInv   = $db_handle->Textquery("SELECT * FROM INVOICE_ALL WHERE Inv_no = '$invid'");
}
$DataInvD = $db_handle->Textquery("SELECT * FROM INVOICE_DETAIL_ALL WHERE Inv_no = '$invid'");
?>

<html lang="en">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/myStyle.css">
    <link rel="stylesheet" href="css/invoice.css">
    <title>Invoice Printing</title>
</head>

<body>
    <!-- แสดงพื้นที่ทำงาน-->
    <!-- <div class="section0"> -->
    <div class="invoice">
        <div class="invHead">
            <img src="img/logo.png">บริษัท SE-Store จำกัด<br>
        </div>
        <p>(ตัวอย่าง-ล่าสุด) เอกสารนี้เป็นหลักฐานการสั่งซื้อสินค้าจากลูกค้า</p>
        <h5>ใบคำสั่งซื้อสินค้า (Invoice)</h5>
        <div class="invDetail">
            <div class="Dleft">
                <p><b>From : รหัสสมาชิก </b><?php echo $DataInv[0]['Cust_id']; ?><b>คุณ </b><?php echo $DataInv[0]['Cust_name']; ?></p>
                <p><b>ที่อยู่ </b><?php echo $DataInv[0]['Cust_address']; ?><b>เบอร์โทรศัพท์ </b><?php echo $DataInv[0]['Cust_tel']; ?></p>
            </div>
            <div class="Dright">
                <p><b>ใบสั่งซื้อเลขที่ : </b><?php echo $invid; ?></p>
                <p><b>ใบสั่งซื้อวันที่ : </b><?php echo $DataInv[0]['Inv_date']; ?></p>
            </div>
        </div>

        <table class='invTable'>
            <tr>
                <th>รหัสสินค้า</th>
                <th>สินค้า</th>
                <th>ราคา/หน่วย</th>
                <th>จำนวน</th>
                <th>จำนวนเงิน</th>
            </tr>
            <?php $total = 0;
            foreach ($DataInvD as $key => $value) {
            //for ($x = 0; $x <= 10; $x++) { ?>
                <tr>
                    <td><?php echo $DataInvD[$key]['Product_id']; ?></td>
                    <td><?php echo $DataInvD[$key]['Product_name']; ?></td>
                    <td><?php echo number_format($DataInvD[$key]['Product_price'], 2); ?></td>
                    <td><?php echo $DataInvD[$key]['Product_num']; ?></td>
                    <td><?php echo number_format($DataInvD[$key]['Tmoney'], 2); ?></td>
                </tr>
            <?php $total = $total + $DataInvD[$key]['Tmoney'];
            } ?>
        </table>
        <div class="invFooter">
            <div class="Fleft">
                <p>ชำระแบบ</p><input type="text" value="พร้อมเพย์">
                <p>ขนส่งโดย</p><input type="text" value="Standard Express co.th">
            </div>
            <div class="Fright">
                <p>รวมเป็นเงินทั้งสิ้น </p>
                <input type="text" value="<?php echo number_format($total, 2); ?>">
                <p>ส่วนลด </p>
                <input type="text" value="<?php echo number_format($total - ($total * 0.9), 2); ?>">
                <p>คิดภาษีมูลค่าเพิ่ม </p>
                <input type="text" value="<?php echo number_format($total * 0.7, 2); ?>">
                <h5> รวมเงินที่ต้องชำระ </h5>
                <label><?php echo number_format($total * 1.6, 2); ?></label>
            </div>
        </div>
    </div>
    <!-- </div> -->

    <script>
        window.addEventListener(" load", window.print());
        window.onafterprint = function() {
            window.location = 'saleReport.php';
        }
    </script>

</body>

</html>