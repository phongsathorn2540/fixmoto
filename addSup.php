<?php 
    if(isset($_POST["name"])){
        $name = $_POST["name"];
        include('class.php');
        $oBj = new Main;
        echo $oBj->addSupplier($name);
    };

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
    <h1> เพิ่ม supplier </h1>
    <br>
    <form action='addSup.php' method='post'>
    <table>
        <tr>
            <td>
                ชื่อ supplier 
            </td>
            <td>
                <input type='text' name='name' placeholder='ชื่อ supplier' required>
            </td>
        </tr>
        <tr>
            <td>
            </td>
            <td>
                <button type='submit' value='submit'>เพิ่ม</button>
            </td>
        </tr>
    </table>
    </form>
";
?>