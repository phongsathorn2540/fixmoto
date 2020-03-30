<?php 
    include('class.php');
    $oBj = new Main;
    $listPoActivate = $oBj->listPoActivate();
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
    <h1> รับสินค้าเข้าคลัง </h1>
    <hr>
    รายการใบสั่งซื้อที่อนุมัติแล้ว
    <table border='0' width='500'>
                
                
    <tr>
        <td>รหัส</td>
        <td>ชื่อลูกค้า </td>
        <td>วันที่ออก </td>
        <td>มูลค่า</td>
        <td></td>
    </tr>
";
    for($i = 0 ; $i < count($listPoActivate) ; $i++){
    $buy_ids = $listPoActivate[$i]['buy_id'];
    echo "
    <tr>
        <td> <a href='listPoDetail.php?buyid=". $buy_ids ."'> ". $buy_ids ." </a> </td>
        <td> ". $listPoActivate[$i]['supplier_desc'] ." </td>
        <td> ". $listPoActivate[$i]['buy_date'] ." </td>
        <td> ". $oBj->costPo($buy_ids) ." </td>
        <td>             
                

    ";
    if($oBj->checkRecv($buy_ids) == 1){
        echo "รับสินค้าแล้ว";
    }else{
        echo "<a href='getPartDetail.php?buyid=".$buy_ids."'><button type='button'>รับสินค้า</button></a>";
    };
    echo "
        </td>
    </tr>
    ";
    };
    echo "
    </table>
    ";

?>