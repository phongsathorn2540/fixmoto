<?php 
    include('class.php');
    include('template/header.php');
    include('template/menu.php');
    $oBj = new Main;
    $data = $oBj->showSupplier();
    if(isset($_GET["supplier"])){
        $supplier = $_GET["supplier"];
        $name = $_GET["name"];
        $cost = $_GET["cost"];
        $price = $_GET["price"];
        echo $oBj->addProduct($supplier , $name , $cost , $price);
    };
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
    echo '
    <main role="main" class="container">
    <div class="starter-template">';
    include('template/menuPart.php');
    echo "
        <h1> เพิ่ม Product </h1>
        <br>
        <form method='get'>
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
    echo "          </select>
                </td>
            <tr>
                <td>
                    ชื่อสินค้า
                </td>
                <td>
                    <input type='text' name='name' placeholder='ชื่อสินค้า' required>
                </td>
            </tr>
                    
            <tr>
            <td>
                ราคาซื้อ
            </td>
            <td>
                <input type='text' name='cost' placeholder='ราคาซื้อ' required>
            </td>
        </tr>
        <tr>
        <td>
            ราคาขาย
        </td>
        <td>
            <input type='text' name='price' placeholder='ราคาขาย' required>
        </td>
    </tr>
    </table>
    <button type='submit' value='submit'>เพิ่ม</button>
    </form>
    ";
?>