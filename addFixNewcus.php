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

<h1>ลูกค้าไหม่</h1>

';
    if(isset($_GET['monumber'])){
      if($oBj->addnewCus($_GET['monumber'] , $_GET['f_name'] , $_GET['l_name']) == "อัพเดทเรียบร้อยแล้ว"){
        $customerID = $oBj->getLastcus();
        echo $oBj->addFixlist($customerID , $_GET['plate'] , $_GET['brand'] , $_GET['fix_detail']);
      };
    }
echo '
<form>
  <div class="form-group">
    <label for="exampleFormControlInput1">เบอร์โทร</label>
    <input type="number" name="monumber" class="form-control" id="exampleFormControlInput1" placeholder="xx-xxxx-xxxx" required>
  </div>
  <div class="form-group">
  <label for="exampleFormControlInput2">ชื่อ นามสกุล</label>
  <input type="text" name="f_name" class="form-control" id="exampleFormControlInput2" placeholder="ชื่อ" required>
  <input type="text" name="l_name" class="form-control" id="exampleFormControlInput2" placeholder="นามสกุล" required>
  </div>
  <div class="form-group">
  <label for="exampleFormControlInput3">ยี่ห้อรถ และ ป้ายทะเบียน</label>
  <input type="text" name="brand" class="form-control" id="exampleFormControlInput3" placeholder="ยี่ห้อ" required>
  <input type="text" name="plate" class="form-control" id="exampleFormControlInput3" placeholder="ป้ายทะเบียน" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">รายระเอียดการซ่อม</label>
    <textarea name="fix_detail" class="form-control" id="exampleFormControlTextarea1" rows="3" max="50" required></textarea>
  </div>
  <button class="btn btn-success my-2 my-sm-0">บันทึกข้อมูล</button> 
</form>
    


</div>
</main>
</body>
</html>

';