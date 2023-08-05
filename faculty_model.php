<?php
require "database.php";
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