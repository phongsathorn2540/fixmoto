<?php   
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

echo  '
<main role="main" class="container">

<div class="starter-template">

<a href="addFix.php" <button class="btn btn-success my-2 my-sm-0"> เพิ่มงานซ่อม </button> </a>

</div>
</main>
</body>
</html>

';