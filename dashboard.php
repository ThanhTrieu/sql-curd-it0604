<?php
session_start();
if(empty($_SESSION['username'])){
    header("Location:login.php");
    exit();
}

function index(){
    require("views/index_view.php");
}
index();