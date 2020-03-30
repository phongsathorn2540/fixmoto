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

<h1>ลูกค้าเดิม</h1>

';
if(isset($_GET['monumber'])){
    $monumber = $_GET['monumber'];
    $dataarr = $oBj->getDatacus($monumber);
    if(count($dataarr) == 1){
      echo "ไม่พบข้อมูล";
    }else{
      if(isset($_GET['customerID'])){
        echo $oBj->addFixlist($_GET['customerID'] , $_GET['plate'] , $_GET['brand'] , $_GET['fix_detail']);
    }
    echo "
        คุณ ".$dataarr[1]['f_name']. $dataarr[1]['l_name']." <br>
        เบอร์โทรติดต่อ ".$dataarr[1]['mobile_num']."
        <br>
        <h2> กรุณากรอก </h2>
    ";

    echo '
    <form metthod="GET">
    <div class="form-group">
    <label for="exampleFormControlInput3">ยี่ห้อรถ และ ป้ายทะเบียน</label>
    <input type="text" name="brand" class="form-control" id="exampleFormControlInput3" placeholder="ยี่ห้อ" required>
    <input type="text" name="plate" class="form-control" id="exampleFormControlInput3" placeholder="ป้ายทะเบียน" required>
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1">รายระเอียดการซ่อม</label>
        <textarea name="fix_detail" class="form-control" id="exampleFormControlTextarea1" rows="3" max="50" required></textarea>
    </div>
    <input type="text" name="monumber" value="'.$monumber.'" hidden>
    <input type="text" name="customerID" value="'.$dataarr[1]['customer_id'].'" hidden>
    <button class="btn btn-success my-2 my-sm-0">บันทึกข้อมูล</button> 
    ';
    }
}else {
    echo '
    <form metthod="POST">
      <div class="form-group">
        <label for="exampleFormControlInput1">เบอร์โทร</label>
        <input type="number" name="monumber" class="form-control" id="exampleFormControlInput1" placeholder="xx-xxxx-xxxx" required>
        <br>
        <button class="btn btn-success my-2 my-sm-0">ดึงข้อมูล</button> 
    </form>    
</main>
</body>
</html>
        ';
};
