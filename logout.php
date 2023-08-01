<?php
session_start();

function logout(){
    if(isset($_POST['btnLogout'])){
        session_destroy(); // huy tat ca session
        header("Location:login.php");
        exit();
    }
}
logout();