<?php
// session
session_start();
// nhung file database vao day
require_once("database.php");

function checkLogin($username, $password)
{
    // kiem tra dang nhap
    // tai khoan nhap co ton tai trong database ko?
    $db = connection(); // goi bien ket noi toi database
    // viet cau lenh sql truy van
    $sql = "SELECT * FROM `nguoi_dung` WHERE `username` = :account AND `password` = :pass LIMIT 1 ";
    // :account va :pass chinh la khai bao 1 bien truyen vao cau lenh sql
    // :account va :pass la 2 bien dai dien cho 2 tham so $username, $password

    // thuc thi tien hanh kiem tra cau lenh sql
    $stmt = $db->prepare($sql);
    $data = []; // du lieu cua cau lenh sql se dc gan vao day
    if($stmt){
        // thuc thi cau lenh khong co loi cu phap
        // kiem tra tham so truyen vao cau lenh sql
        $stmt->bindParam(":account", $username, PDO::PARAM_STR);
        $stmt->bindParam(":pass", $password, PDO::PARAM_STR);
        // chay cau lenh
        if($stmt->execute()){
            // kiem tra cau lenh select sql co du lieu tra ve ko ?
            if($stmt->rowCount() > 0){
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
            }
        }
    }
    disconnection($db);
    return $data;
}

function handle()
{
    if(isset($_POST['username'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if(!empty($username) && !empty($password)){
            // co nhap du lieu
            $infoUser = checkLogin($username, $password);
            if(!empty($infoUser)){
                // dang nhap thanh cong
                // luu thong tin nguoi dung vao session
                $_SESSION['username'] = $infoUser['username'];
                $_SESSION['email']    = $infoUser['email'];
                $_SESSION['role_id']  = $infoUser['role_id'];

                header("Location:dashboard.php");
            } else {
                // dang nhap khong thanh cong
                header("Location:login.php?state=error");
            }
        } else {
            // khong nhap du lieu
            header("Location:login.php?state=fail");
        }
    }
}
handle();