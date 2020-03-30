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
$fix_id = $_GET['fix_id'];
$fix_status = $_GET['fix_status'];
echo '
<main role="main" class="container">
<div class="starter-template">
<div class="starter-template">
';

echo $oBj->changeStatusFix($fix_id , $fix_status);

echo "
<a href='fixDetail.php?fix_id=".$fix_id."'>คลิกที่นี่เพื่อกลับไปยังหน้าที่แล้ว</a>
";

