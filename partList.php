<?php 
    include('class.php');
    $oBj = new Main;
    $data = $oBj->showProduct();
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
    <br>
    <center>
    <table width='800px;'>
    <tr>
        <td>
            รหัส
        </td>
        <td>
            ชื่อสินค้า
        </td>
        <td>
            ราคาซื้อ
        </td>
        <td>
            ราคาขาย
        </td>
        <td>
            จำนวนคงเหลือ
        </td>
    </tr>         
    " ;
    for($i = 1 ; $i < count($data) ; $i++){
        echo "
        <tr>
            <td>
                " .$data[$i]['part_id']. "
            </td>
            <td>
                " .$data[$i]['part_desc']. "
            </td>
            <td>
                " .$data[$i]['part_cost']. "
            </td>
            <td>
                " .$data[$i]['part_price']. "
            </td>
            <td>
                " .$data[$i]['part_total']. "
            </td>
        </tr>         
        " ;
    }
    echo "</table>";
 //   echo "<pre>";
   // print_r($data);
    //  echo "</pre>";
?>