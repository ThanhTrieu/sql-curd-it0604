<?php
session_start();
if(empty($_SESSION['username'])){
    header("Location:login.php");
    exit();
}

// su dung cac lenh sql 
require "faculty_model.php";

$method = $_GET['m'] ?? 'index';
switch($method){
    case 'index':
        index();
        break;
    case 'add':
        add();
        break;
    case 'handle-add':
        handleAdd();
        break;
}

function handleAdd() {
    if(isset($_POST['extra_id'])){
        $code = $_POST['extra_id'];
        $name = $_POST['name'];
        $leader = $_POST['leader'];
        $openDate = $_POST['open_date'];
        $status = $_POST['status'];

        // kiem tra du lieu
        $errors = [];
        if(empty($code)){
            $errors['code'] = 'Vui long nhap ma khoa';
        }
        if(empty($name)){
            $errors['name'] = 'Vui long nhap ten khoa';
        }
        if(empty($leader)){
            $errors['leader'] = 'Vui long nhap ten truong khoa';
        }
        if(empty($openDate)){
            $errors['open_date'] = 'Vui long chon ngay thanh lap khoa';
        }

        if(empty($errors)){
            if(!empty($_SESSION['error_faculty'])){
                unset($_SESSION['error_faculty']);
            }
            // xu ly insert data vao database
            $dataInsert = [];
            $dataInsert['code'] = $code;
            $dataInsert['name'] = $name;
            $dataInsert['leader'] = $leader;
            $dataInsert['open_date'] = $openDate;
            $dataInsert['status'] = $status;
            $insert = insertFaculty($dataInsert);
            if($insert){
                header("Location:faculty.php");
            } else {
                // khong thanh cong
                header("Location:faculty.php?m=add&state=error");
            }
        } else {
            $_SESSION['error_faculty'] = $errors;
            header("Location:faculty.php?m=add");
        }
    }
}
function add()  {
    require("views/faculty_add_view.php");
}
function index(){
    require("views/faculty_view.php");
}