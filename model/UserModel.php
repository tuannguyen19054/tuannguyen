<?php
require_once 'database/database.php';


function deleteUserById($id) {
    $sql = "UPDATE users SET deleted_at = NOW() WHERE id = :id";
    $db = connectionDb();
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $success = $stmt->execute();
    disconnectDb($db);
    return $success;
}

function updateUserById($extra_code, $role_id, $full_name, $email, $phone, $avatar, $address, $birthday, $gender, $status, $id)
{
    // Biến kiểm tra việc cập nhật
    $checkUpdate = false;
    
    // Kết nối đến cơ sở dữ liệu
    $db = connectionDb();
    
    // Câu lệnh SQL để cập nhật thông tin của người dùng
    $sql = "UPDATE `users` 
            SET `extra_code` = :extra_code,
                `role_id` = :role_id,
                `full_name` = :full_name,
                `email` = :email,
                `phone` = :phone,
                `avatar` = :avatar,
                `address` = :address,
                `birthday` = :birthday,
                `gender` = :gender,
                `status` = :status,
                `updated_at` = :updated_at
            WHERE `id` = :id";
    
    // Thời gian cập nhật
    $updateTime = date('Y-m-d H:i:s');
    
    // Chuẩn bị và thực thi câu lệnh SQL
    $stmt = $db->prepare($sql);
    
    if ($stmt) {
        $stmt->bindParam(':extra_code', $extra_code, PDO::PARAM_STR);
        $stmt->bindParam(':role_id', $role_id, PDO::PARAM_INT);
        $stmt->bindParam(':full_name', $full_name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':avatar', $avatar, PDO::PARAM_STR);
        $stmt->bindParam(':address', $address, PDO::PARAM_STR);
        $stmt->bindParam(':birthday', $birthday, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $gender, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT);
        $stmt->bindParam(':updated_at', $updateTime, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $checkUpdate = true;
        }
    }
    
    // Ngắt kết nối đến cơ sở dữ liệu
    disconnectDb($db);
    
    // Trả về kết quả việc cập nhật
    return $checkUpdate;
}

function getDetailUserById($id=0){
    $sql = "SELECT * FROM `users` WHERE `id` = :id AND `deleted_at` IS NULL";
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

function deleteUsersById($id = 0)
{
    // Câu lệnh SQL để cập nhật trường `deleted_at` của bảng users thành thời gian hiện tại
$sql = "UPDATE `users` SET `deleted_at` = :deleted_at WHERE `id` = :id";
    
    // Kết nối đến cơ sở dữ liệu
    $db = connectionDb();
    // Biến kiểm tra việc xóa
    $checkDelete = false;
    
    // Thời gian xóa
    $deleteTime = date("Y-m-d H:i:s");
    
    // Chuẩn bị và thực thi câu lệnh SQL
    $stmt = $db->prepare($sql);
    
    if ($stmt) {
        $stmt->bindParam(':deleted_at', $deleteTime, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $checkDelete = true;
        }
    }
    
    // Ngắt kết nối đến cơ sở dữ liệu
    disconnectDb($db);
    
    // Trả về kết quả việc xóa
    return $checkDelete;
}

function getDataRole(){
    $db = connectionDb();
    $sql = "SELECT * FROM `roles` WHERE `deleted_at` IS NULL ";
    $stmt = $db->prepare($sql);
    $data =[];
    if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
    }
    disconnectDb($db);
    return $data;
}
function getDataUser(){
    $db = connectionDb();
    $sql = "SELECT * FROM `users` WHERE `deleted_at` IS NULL ";
    $stmt = $db->prepare($sql);
    $data =[];
    if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
    }
    disconnectDb($db);
    return $data;
}

function getAllDataUsers($keyword = null)
{
    // Chuẩn bị từ khoá tìm kiếm
    $key = "%{$keyword}%";
    
    // Câu lệnh SQL để truy vấn dữ liệu từ bảng users với điều kiện tìm kiếm theo tên, email, extra_code và address và giới hạn số lượng bản ghi trả về
    $sql = "SELECT * FROM `users` WHERE (`full_name` LIKE :fullName OR `email` LIKE :email OR `extra_code` LIKE :extraCode OR `address` LIKE :address) AND `deleted_at` IS NULL";
    
    // Kết nối đến cơ sở dữ liệu
    $db = connectionDb();
    
    // Chuẩn bị và thực thi câu lệnh SQL
    $stmt = $db->prepare($sql);
    
    // Mảng chứa dữ liệu người dùng
    $data = [];
    
    if ($stmt) {
        $stmt->bindParam(':fullName', $key, PDO::PARAM_STR);
        $stmt->bindParam(':email', $key, PDO::PARAM_STR);
        $stmt->bindParam(':extraCode', $key, PDO::PARAM_STR);
        $stmt->bindParam(':address', $key, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            // Kiểm tra xem có dữ liệu trả về hay không
            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }
    
    // Ngắt kết nối đến cơ sở dữ liệu
    disconnectDb($db);
    
    // Trả về dữ liệu người dùng
    return $data;
}

function getAllDataUsersByPage($keyword = null, $start = 0, $limit = 4)
{
    // Chuẩn bị từ khoá tìm kiếm
    $key = "%{$keyword}%";
// Câu lệnh SQL để truy vấn dữ liệu từ bảng users với điều kiện tìm kiếm theo tên hoặc email và giới hạn số lượng bản ghi trả về
    $sql = "SELECT * FROM `users` WHERE (`full_name` LIKE :fullName OR `email` LIKE :email OR `extra_code` LIKE :extraCode OR `address` LIKE :address) AND `deleted_at` IS NULL  LIMIT :startData, :limitData";
    
    // Kết nối đến cơ sở dữ liệu
    $db = connectionDb();
    
    // Chuẩn bị và thực thi câu lệnh SQL
    $stmt = $db->prepare($sql);
    
    // Mảng chứa dữ liệu người dùng
    $data = [];
    
    if ($stmt) {
        $stmt->bindParam(':fullName', $key, PDO::PARAM_STR);
        $stmt->bindParam(':email', $key, PDO::PARAM_STR);
        $stmt->bindParam(':startData', $start, PDO::PARAM_INT);
        $stmt->bindParam(':limitData', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':extraCode', $key, PDO::PARAM_STR);
        $stmt->bindParam(':address', $key, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            // Kiểm tra xem có dữ liệu trả về hay không
            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }
    
    // Ngắt kết nối đến cơ sở dữ liệu
    disconnectDb($db);
    
    // Trả về dữ liệu người dùng
    return $data;
}
function insertUser($extra_code, $role_id, $full_name, $email, $phone, $avatar, $address, $birthday, $gender, $status)
{
    // Chuẩn bị câu lệnh SQL để chèn dữ liệu vào bảng users
    $sqlInsert = "INSERT INTO `users`(`extra_code`, `role_id`, `full_name`, `email`, `phone`, `avatar`, `address`, `birthday`, `gender`, `status`) 
                  VALUES(:extra_codeUser, :role_idUser, :full_nameUser, :emailUser, :phoneUser, :avatarUser, :addressUser, :birthdayUser, :gender, :status)";
    
    // Biến kiểm tra việc chèn dữ liệu
    $checkInsert = false;
    
    // Kết nối đến cơ sở dữ liệu
    $db = connectionDb();
    
    // Chuẩn bị và thực thi câu lệnh SQL
    $stmt = $db->prepare($sqlInsert);
    
    if ($stmt) {
        $stmt->bindParam(':extra_codeUser', $extra_code, PDO::PARAM_STR);
        $stmt->bindParam(':role_idUser', $role_id, PDO::PARAM_INT);
        $stmt->bindParam(':full_nameUser', $full_name, PDO::PARAM_STR);
        $stmt->bindParam(':emailUser', $email, PDO::PARAM_STR);
        $stmt->bindParam(':phoneUser', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':avatarUser', $avatar, PDO::PARAM_STR);
        $stmt->bindParam(':addressUser', $address, PDO::PARAM_STR);
        $stmt->bindParam(':birthdayUser', $birthday, PDO::PARAM_STR);
        $stmt->bindParam(':gender', $gender, PDO::PARAM_INT);
        $stmt->bindParam(':status', $status, PDO::PARAM_INT); 
        // Thực thi câu lệnh SQL và kiểm tra kết quả
        if ($stmt->execute()) {
            $checkInsert = true;
        }
}
    
    return $checkInsert;
}