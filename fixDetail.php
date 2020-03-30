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
$buyid = 0;
if(isset($_GET['fix_id'])){
    $fix_id = $_GET['fix_id'];
    echo '
<main role="main" class="container">

<div class="starter-template">



<div class="starter-template">

<h1>รายการซ่อม</h1>
<center>
<table width="800px">
    <tr>
        <td>หมายเลขงานซ่อม</td>
        <td>หมายเลขลูกค้า</td>
        <td>ยี่ห้อรถ</td>
        <td>ป้ายทะเบียน</td>
        <td>รายระเอียด</td>
        <td>สถานะ</td>
    </tr>
';

$datafix = $oBj->showFixlistbyid($fix_id);
$fixDetail = $oBj->usePart($fix_id);
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
        
    </tr>
    </table>
    
    ";

    
};
}else{
    echo "<h1> เกิดข้อผิดพลาดกรุณาลองไหม่";
}
echo "
<br>
    <hr>
    <h1>อะไหล่ที่ใช้</h1>
    <br>
    <table width='800px'>
      <tr>
        <td>
          หมายเลขอะไหล่
        </td>
        <td>
          อะไหล่
        </td>
      </tr>

";


if(count($fixDetail) == 1){
  echo "<h1>ยังไม่ได้อัพเดทรายการใช้อะไหล่";
}else{
  for($i = 1 ; count($fixDetail) > $i ; $i++){
    echo "
    <tr>
      <td>
        ".$fixDetail[$i]['part_number'] ."
      </td>
      <td>
        ".$fixDetail[$i]['part_desc'] ."
      </td>
    </tr>
    ";
  }
}
echo "    
</table>
</center>
<br>";
if($oBj->checkStatusFix($fix_id) != 'ซ่อมเรียบร้อย'){
  echo "<a href='addusedPart.php?fix_id=".$fix_id."'> <button type='button' class='btn btn-primary'>เพิ่มอะไหล่ที่ใช้</button></a>";
}
if($oBj->checkStatusFix($fix_id) == 'กำลังซ่อม'){
  echo "
  <a href='changeFixStatus.php?fix_id=".$fix_id."&fix_status=3'><button type='button' class='btn btn-primary'>ซ่อมเรียบร้อยแล้วคลิกที่นี่</button></a>
  ";
}else if($oBj->checkStatusFix($fix_id) == 'รอชำระ'){
  echo "
  <a href='changeFixStatus.php?fix_id=".$fix_id."&fix_status=4'><button type='button' class='btn btn-primary'>ชำระเงินและรับรถเรียบร้อยคลิกที่นี่</button></a>
  ";
}
echo'
</main>
</body>
</html>

';


