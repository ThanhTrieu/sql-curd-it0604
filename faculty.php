<?php
session_start();
if(empty($_SESSION['username'])){
    header("Location:login.php");
    exit();
}

$method = $_GET['m'] ?? 'index';
switch($method){
    case 'index':
        index();
    break;
    case 'add':
        add();
    break;
}
function add()  {
    require("views/faculty_add_view.php");
}
function index(){
    require("views/faculty_view.php");
}