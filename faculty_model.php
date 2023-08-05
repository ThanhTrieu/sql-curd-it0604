<?php
require "database.php";

function deleteFaculty($id = 0){
    $db = connection();
    $checkDelete = false;
    $sql = "DELETE FROM `khoa` WHERE `id` = :id ";
    $stmt = $db->prepare($sql);
    if($stmt){
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        if($stmt->execute()){
            $checkDelete = true;
        }
    }
    disconnection($db);
    return $checkDelete;
}
function getListFaculty(){
    // lay all du lieu tu database
    $data = [];
    $db = connection();
    $sql = "SELECT * FROM `khoa` GROUP BY `id` DESC";
    $stmt = $db->prepare($sql);
    if($stmt){
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }
    disconnection($db);
    return $data;
}
function insertFaculty($dataInsert = []){
    $code = $dataInsert['code'];
    $name = $dataInsert['name'];
    $leader = $dataInsert['leader'];
    $openDate = $dataInsert['open_date'];
    $status = $dataInsert['status'];
    $createdTime = date("Y-m-d H:i:s");

    $db = connection();
    $sql = "INSERT INTO `khoa`(`extra_id`, `name`, `leader`, `open_date`, `status`, `created_at`) VALUES(:code, :nameFaculty, :leader, :openDate, :statusFaculty, :createTime)";
    $stmt = $db->prepare($sql);
    $checkInsert = false;
    if($stmt){
        $stmt->bindParam(":code", $code, PDO::PARAM_STR);
        $stmt->bindParam(":nameFaculty", $name, PDO::PARAM_STR);
        $stmt->bindParam(":leader", $leader, PDO::PARAM_STR);
        $stmt->bindParam(":openDate", $openDate, PDO::PARAM_STR);
        $stmt->bindParam(":statusFaculty", $status, PDO::PARAM_INT);
        $stmt->bindParam(":createTime", $createdTime, PDO::PARAM_STR);
        if($stmt->execute()){
            $checkInsert = true;
        }
    }
    disconnection($db); // ngat ket noi
    return $checkInsert;
    // ham nay tra ve true insert thanh cong
}