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
    case 'delete':
        handleDelete();
        break;
    case 'edit':
        edit();
        break;
    case 'handle-edit':
        handleEdit();
        break;
}

function handleEdit(){
    if(isset($_POST['extra_id'])){
        // thuc su bam cap nhat du lieu
        $id   = $_GET['id'] ?? null;
        $id   = is_numeric($id) ? $id : 0;
        $code = $_POST['extra_id'];
        $name = $_POST['name'];
        $leader   = $_POST['leader'];
        $openDate = $_POST['open_date'];
        $status   = $_POST['status'];

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
        if($status !== '1' && $status !== '0'){
            $errors['status'] = 'Vui long chon trang thai';
        }

        if(empty($errors)){
            // khong co loi tu phia nguoi dung
            if(!empty($_SESSION['error_faculty'])){
                unset($_SESSION['error_faculty']);
            }
            $dataUpdate = [];
            $dataUpdate['code'] = $code;
            $dataUpdate['name'] = $name;
            $dataUpdate['leader'] = $leader;
            $dataUpdate['open_date'] = $openDate;
            $dataUpdate['status'] = $status;
            $update = updateFacultyById($dataUpdate, $id);
            if($update){
                // thanh cong
                header("Location:faculty.php?state=success");
            } else {
                // ko thanh cong
                header("Location:faculty.php?m=edit&id={$id}&state=fail");
            }
        } else {
            // co loi tu phia nguoi dung
            $_SESSION['error_faculty'] = $errors;
            header("Location:faculty.php?m=edit&id={$id}");
        }

    }
}

function edit(){
    $id = $_GET['id'] ?? null;
    $id = is_numeric($id) ? $id : 0;
    $info = getDetailFacultyById($id);

    if($id <= 0 || empty($info)){
        require("views/error_view.php");
    } else {

        require("views/faculty_edit_view.php");
    }
}

function handleDelete(){
    if(isset($_POST['btnDel'])){
        $id = $_POST['id'] ?? 0;
        $id = is_numeric($id) && $id > 0 ? $id : 0;
        $del = deleteFaculty($id);
        if($del){
            header("Location:faculty.php?state=success");
        } else {
            header("Location:faculty.php?state=fail");
        }
    }
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
                header("Location:faculty.php?state=success");
            } else {
                // khong thanh cong
                header("Location:faculty.php?m=add&state=fail");
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
    $faculties = getListFaculty();
    require("views/faculty_view.php");
}