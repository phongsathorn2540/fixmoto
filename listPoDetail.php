<?php 
    include('class.php');
    $oBj = new Main;
    $buyid = 0;
    if(isset($_GET['buyid'])){
        $buyid = $_GET['buyid'];
    };
    $data = $oBj->detailBill($buyid);
    include('template/header.php');
    include('template/menu.php');
    echo '
    <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>
  <!-- Custom styles for this template -->
  <link href="//getbootstrap.com/docs/4.4/examples/starter-template/starter-template.css" rel="stylesheet">
    </head>
    <body>

';
    echo '<main role="main" class="container">
    <div class="starter-template">';
    include('template/menuPart.php');
    echo "
    <br>
    <h1> รายการใบสั่งซื้อ </h1>
    <hr>
";
if($buyid != 0){
    echo "
    <table>
    <tr style='background-color:lightblue'>
        <td>
            ใบสั่งซื้อเลขที่ " . $buyid . " "  . $oBj->getStatusPo($buyid) . "
        </td>
        
    </tr>
    <tr>
        <td>
            <table width='100%'>
                <tr>
                    <td>
                        ผู้ขาย " . $oBj->getNameSupplier($buyid) . "
                    </td>
                    <td>
                        วันที่ออก " . $oBj->getDatebuy($buyid) . "
                    </td>
                    <td>
                        ยอดรวมสุทธิ " . $oBj->costPo($buyid) . " บาท
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width='100%'>
                <tr>
                    <td>รหัสสินค้า</td>
                    <td>ชื่อสินค้า</td>
                    <td>จำนวน</td>
                    <td style='text-align: right;'>ราคา</td>
                </tr>
    ";
    for($i = 0 ; count($data) > $i ; $i++){
    echo "
        <tr>
        <td>" . $data[$i]['part_id'] ."</td>
        <td>" . $data[$i]['part_desc'] ."</td>
        <td>" . $data[$i]['order_amount'] ."</td>
        <td style='text-align: right;'>" . $data[$i]['(order_amount * part_list.part_cost)'] ."</td>
        </tr>
    ";
    }
    echo "
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width='100%'>
                <tr>
                    <td style='text-align: right;'>
                        <b>ยอดรวมสุทธิ</b>
                        <br>
                        " . $oBj->costPo($buyid) . " บาท
                        <br>
    ";
    if($oBj->checkPay($buyid) == 0){
        echo "
            <form action='' method='POST'>
                <input type='text' name='idtoupdate' value='".$buyid."' hidden>
                <input type='submit' value='ชำระค่าบริการ'>
            </form>            
        ";
    }else if($oBj->getStatusPo($buyid) == "รออนุมัติ"){
        echo "
        ชำระค่าสินค้าแล้ว
        <form action='' method='POST'>
        <input type='text' name='activateBill' value='".$buyid."' hidden>
        <input type='submit' value='อนุมัติรายการ'>
        </form> 
        
        ";
    }else {
        echo "
        ชำระค่าสินค้าแล้ว <br>
        อนุมัติรายการแล้ว
        ";
    }
    if(isset($_POST['idtoupdate'])){
        echo $oBj->payBill($buyid);
    }
    if(isset($_POST['activateBill'])){
        echo $oBj->activateBill($buyid);
    }
    echo "
                        
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
";
}else{
    echo "fail";
}

?>