<?php 
    echo '
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="home.php">ระบบร้านซ่อมมอเตอร์ไซ</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="home.php">หน้าแรก</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="addFIx.php">บันทึกรายการซ่อม</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="fixList.php">รายการซ่อม</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="partList.php">รายการอะไหร่</a>
        </li>
      </ul>
      <div class="my-2 my-lg-0">
      <a href="logout.php" <button class="btn btn-danger my-2 my-sm-0"> ออกจากระบบ </button> </a>
      </div>
    </div>
  </nav>
    ';
?>