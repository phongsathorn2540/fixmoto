<?php
    include('class.php');
    $oBj = new Main;   
    include('template/header.php');
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
include('template/menu.php');

echo '
<main role="main" class="container">

<div class="starter-template">



<div class="starter-template">

<h1>รายการซ่อม</h1>
<table>
    <tr>
        <td>หมายเลขงานซ่อม</td>
        <td>หมายเลขลูกค้า</td>
        <td>ยี่ห้อรถ</td>
        <td>ป้ายทะเบียน</td>
        <td>รายระเอียด</td>
        <td>สถานะ</td>
    </tr>
';
$datafix = $oBj->showFixlist();
for($i = 0; count($datafix) > $i ; $i++){
    $statusbyFixid = $oBj->getStatusbyfixid($datafix[$i]['fix_id']);
    echo "
    <tr>
        <td> ".$datafix[$i]['fix_id']." </td>
        <td> ".$datafix[$i]['customer_id']." </td>
        <td> ".$datafix[$i]['brand']." </td>
        <td> ".$datafix[$i]['plate']." </td>
        <td> ".$datafix[$i]['fix_detail']." </td>
        <td> ".$statusbyFixid[0]['fix_detail']." </td>
        <td>  <a href='fixDetail.php?fix_id=".$datafix[$i]['fix_id']."'>
    ";
    if($oBj->checkStatusFix($datafix[$i]['fix_id']) != 'ซ่อมเรียบร้อย'){
      echo "
      <button class='btn-small btn-danger my-2 my-sm-0'> อัพเดทงานซ่อม </button> </a></td>
        
      </tr>
      ";
    }
};

echo'
</main>
</body>
</html>

';


