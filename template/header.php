<?php
    session_start();
    if ($_SESSION['status'] != 'login'){ 
      header("Location: index.php");
    }else{
      
    }
    echo "
    <!doctype html>
    <html lang='th'>
      <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <link href='//getbootstrap.com/docs/4.4/dist/css/bootstrap.min.css' rel='stylesheet' id='bootstrap-css'>
        <title>ระบบซ่อมรถ</title>
        
    ";