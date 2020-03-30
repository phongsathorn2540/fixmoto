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
    <h1> รับสินค้า </h1>
    <hr>
";
if($buyid != 0){
    echo "
    <form method='get'>
    <input type='text' value='".$buyid."' name='buyid' hidden>
    
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
                    <td>จำนวนที่สัง</td>
                    <td style='text-align: right;'>จำนวนที่ได้</td>
                </tr>
    ";
    for($i = 0 ; count($data) > $i ; $i++){
    echo "
        <tr>
        <td>" . $data[$i]['part_id'] ."</td>
        <td>" . $data[$i]['part_desc'] ."</td>
        <td>" . $data[$i]['order_amount'] ."</td>
        <td> 
        ";
        if($oBj->checkRecv($buyid) == 1){
            echo "รับสินค้าแล้ว";
        }else{
            echo "<input type='number' name='amount".$i."' min='0'  required>";
        };
        echo "
        </td>
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
                        <input type='text' value='".$buyid."' name='formpost' hidden>
                        ";
                        if($oBj->checkRecv($buyid) == 1){
                        }else{
                            echo "<input type='submit' value='รับสินค้า'>";
                        }
                        echo "
                        </form>
    ";
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
if(isset($_GET['formpost'])){
    for($is = 0 ; count($data) > $is ; $is++){
        $part_id = $data[$is]['part_id'];
        $order_amout = $_GET['amount'.$is];
        echo $oBj->getProduct($part_id , $order_amout);
    }
echo $oBj->updateDateRecv($buyid);
};

?>