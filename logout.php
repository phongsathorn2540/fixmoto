<?php
include('template/header.php');

if(session_destroy()){
    Header("Location: index.php");
}
?>