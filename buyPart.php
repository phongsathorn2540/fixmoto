<?php 
    include('class.php');
    $oBj = new Main;
    $data = $oBj->showSupplier();
    $sup_id = '';
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
    <h1> สั่งซื้อ Part </h1>
        <br>
        <form method='post'>
        <table>
            <tr>
                <td>
                    เลือก supplier   
                </td>
                <td>
                    <select name='supplier'>           
    ";
                    for($i = 0 ; $i < count($data) ; $i++){
                        echo "<option value='". $data[$i]['supplier_id'] ."'> ". $data[$i]['supplier_desc'] ." </option>";
                    }
    echo " </select> <button type='submit' value='submit'>เลือก</button> </form></td> </tr>";
    if(isset($_POST["supplier"])){
        $sup_id = $_POST["supplier"];
        $dataProductbyid = $oBj->showBuyproduct($sup_id);
        echo "
        <form method='get'>
            <tr>
                <td>
                    วันที่ออก
                </td>
                <td>
                    <input type='text' name='supplier' value='$sup_id' hidden>
                    <input type='date' name='dateofbill' required>
                </td>
            </tr>
            <tr>
            <td>
                วันที่จะชำระ
            </td>
            <td>
                <input type='date' name='dateofpay' required>
            </td>
        </tr>
            <tr>
                <td>
                    ชื่อสินค้า
                </td>
                <td>
                    จำนวน
                </td>
            </tr>
        ";
        for($i = 0 ; $i < count($dataProductbyid) ; $i++){
            echo "
                <tr>
                    <td>
                         " . $dataProductbyid[$i]['part_desc'] . "
                    </td>
                    <td>
                        <input type='number' name='amount".$i."' min='0' required>
                    </td>
                </tr>   
            ";
        }
        echo "
        </table>
        <button type='submit' value='submit'>สั่งซื้อ</button>
        </form>
        ";
    }
    if(isset($_GET['dateofbill'])){
        $sup_id = $_GET["supplier"];
        $dataProductbyid = $oBj->showBuyproduct($sup_id);
        $dateofbill = $_GET['dateofbill'];
        $dateofpay = $_GET['dateofpay'];
        echo $oBj->addBuy($sup_id, $dateofbill, $dateofpay);
        $buyid = $oBj->showBuyid(); //last buy id
        for($ii = 0 ; $ii < count($dataProductbyid) ; $ii++){
            $prod_id = $dataProductbyid[$ii]['part_id'];
            $order_amout = $_GET['amount'.$ii];
            echo $oBj->addBuydesc($buyid, $prod_id , $order_amout);
        }
    }
?>
