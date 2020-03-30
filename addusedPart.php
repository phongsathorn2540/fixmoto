<?php 
    include('class.php');
    $oBj = new Main;
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
    <div class="starter-template">
    <form method="get">
    <table>
    <tr>
     <td> รหัสอะไหล่ </td>
     <td> <input type="text" name="partnumber" required> </td>
    </tr>  
    <tr>
        <td> <input type="text" name="fix_id" value="'.$_GET['fix_id'].'" hidden> </td>
        <td>
        <button type="submit" class="btn btn-success">เพิ่ม</button>
    </table>
    </form>
    ';
    if(isset($_GET['partnumber'])){
        $partnumber = $_GET['partnumber'];
        $fix_id = $_GET['fix_id'];
        if(count($oBj->checkPartuse($partnumber)) == 1 ){
            echo "อะไหล่ถูกใช้แล้ว";
        }else if(count($oBj->checkPartuse($partnumber)) > 1 ){
            echo $oBj->addFixuse($partnumber , $fix_id);
            echo $oBj->setStatuspart($partnumber);
            echo $oBj->updateStockfixuser($partnumber);
            echo $oBj->changeStatusFix($fix_id , 2);
        }else {
            echo "มีปัญหา";
        }
        //echo $oBj->addFixuse($_GET['partnumber'] , $_GET['fix_id']);
    }
?>