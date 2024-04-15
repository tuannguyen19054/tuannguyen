<?php
require_once 'database/database.php';


function updateAccountById($username, $password, $role_id, $user_id, $status, $id)
{
    $checkUpdate = false;
    $db = connectionDb();
    $sql = "UPDATE accounts SET username = :username, password = :password, role_id = :role_id, user_id = :user_id, status = :status, updated_at = NOW() WHERE id = :id";
    $stmt = $db->prepare($sql);
    if ($stmt) {
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if ($stmt->execute()) {
            $checkUpdate = true;
        }
    }
    return $checkUpdate;
}

function getDetailAccountById($id=0){
    $sql = "SELECT * FROM `accounts` WHERE `id` = :id AND `deleted_at` IS NULL";
    $db = connectionDb();
    $data=[];
    $stmt = $db->prepare($sql);
    if($stmt){
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if($stmt->execute()){
            $data = $stmt->fetch(PDO::FETCH_ASSOC); 
        }
    }
    disconnectDb($db);
    return $data;
}
function deleteAccountById($id = 0){
    $sql = "UPDATE `accounts` SET `deleted_at` = :deleted_at WHERE `id` = :id";
    $db = connectionDb();
    $checkDelete = false;
    $deleteTime = date("Y-m-d H:i:s");
    $stmt = $db->prepare($sql);
    if($stmt){
        $stmt->bindParam(':deleted_at', $deleteTime, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if($stmt->execute()){
            $checkDelete = true;
        }
    }
    disconnectDb($db);
    return $checkDelete;
}

function getAllDataAccount($keyword=null){
    $db   = connectionDb();
    $key  = "%{$keyword}%";
    $sql  = "SELECT * FROM `accounts` WHERE (`username` LIKE :nameDepartment) AND `deleted_at` IS NULL";
    $stmt = $db->prepare($sql);
    $data = [];
    if($stmt){
        $stmt->bindParam(':nameDepartment', $key, PDO::PARAM_STR);
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }
    disconnectDb($db);
    return $data;

}

function addNewAccount($username, $password, $role_id, $user_id, $status) {
    $sql = "INSERT INTO accounts (username, password, role_id, user_id, status) 
            VALUES (:username, :password, :role_id, :user_id, :status)";
    $conn = connectionDb();
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role_id', $role_id);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':status', $status);
    if ($stmt->execute()) {
        return true; 
    } else {
        return false; 
    }
}
function getAllDataAccountByPage($keyword = null, $start = 0, $limit = 4) {
    $key = "%{$keyword}%";
    $sql = "SELECT * FROM `accounts` WHERE (`username` LIKE :username) AND deleted_at IS NULL LIMIT :startData, :limitData";
    $db = connectionDb();
    $stmt = $db->prepare($sql);
    $data = [];
    if ($stmt) {
        $stmt->bindParam(':username', $key, PDO::PARAM_STR);
        $stmt->bindParam(':startData', $start, PDO::PARAM_INT);
        $stmt->bindParam(':limitData', $limit, PDO::PARAM_INT);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }
    disconnectDb($db);
    return $data;
}