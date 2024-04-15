
<?php
// require "database/database.php";

function updateCourseById($name, $slug, $department_id, $status, $id)
    {
        $checkUpdate = false;
        $db = connectionDb();
        $updateTime = date("Y-m-d H:i:s");
        $sql = "UPDATE `courses` SET `name` = :nameCourse,
         `slug` = :slug, `department_id` = :departmentid,
         `status` = :statusDepartment,
          `updated_at` = :updated_at WHERE `id` = :id AND `deleted_at` IS NULL";
        $stmt   = $db->prepare($sql);
        if ($stmt) {
            $stmt->bindParam(':nameCourse', $name, PDO::PARAM_STR);
            $stmt->bindParam(':slug', $slug, PDO::PARAM_STR);
            $stmt->bindParam(':departmentid', $department_id, PDO::PARAM_STR);
            $stmt->bindParam(':statusDepartment', $status, PDO::PARAM_INT); //int
            $stmt->bindParam(':updated_at', $updateTime, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); //int
            if ($stmt->execute()) {
                $checkUpdate = true;
            }
        }
        disconnectDb($db);
        return $checkUpdate;
    }
function getDetailCourseById($id = 0){
    $sql ="SELECT * FROM `courses` WHERE `id` = :id AND `deleted_at` IS NULL";
    $db = connectionDB();
    $data = [];
    $stmt = $db->prepare($sql);
    if($stmt){
        $stmt->bindParam('id', $id, PDO::PARAM_INT);
        if($stmt->execute()){
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
    disconnectDB($db);
    return $data;
}
function deleteCourseId($id = 0){
    $sql = "UPDATE `course` SET `deleted_at` = :deleted_at WHERE `id` = :id ";
    $db = connectionDB();
    $checkDelete = false;
    $deleteTime = date("y-m-d H:i:s");
    $stmt = $db->prepare($sql);
    if($stmt){
        $stmt->bindParam('deleted_at', $deleteTime, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        if($stmt->execute()){
            $checkDelete = true;

        }
    }
    disconnectDB($db);
    return $checkDelete;
}

function getAllDataCourses($keyword = null){
    $db = connectionDB();
    $key = "%{$keyword}%";
    $sql = "SELECT * from `courses` WHERE (`name` LIKE :nameCourse OR `department_id` LIKE :departmentid) AND `deleted_at` IS NULL";
   // $sql = "SELECT * FROM `course` WHERE (`name` LIKE :nameCourse OR `department_id` IN (SELECT id FROM `department` WHERE `name` LIKE :departmentName)) AND `deleted_at` IS NULL";
    $stmt = $db->prepare($sql);
    $data = [];
    if($stmt){
        $stmt->bindParam(':nameCourse', $key,PDO::PARAM_STR);
        $stmt->bindParam(':departmentid', $key,PDO::PARAM_STR);
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }
    disconnectDB($db);
    return $data;
}
function getAllDataCoursesByPage($keyword = null,$start = 0, $limit =10){ //$start = 0, $limit =2
    $key  = "%{$keyword}%";
   // $sql = "SELECT * from `course` WHERE (`name` LIKE :nameCourse OR `department_id` LIKE :departmentid) AND `deleted_at`IS NULL LIMIT :startData, :limitData";
   $sql = "SELECT * FROM `courses` WHERE (`name` LIKE :keyword OR `department_id` IN (SELECT id FROM `departments` WHERE `name` LIKE :keyword)) AND `deleted_at` IS NULL LIMIT :startData, :limitData";
   $db = connectionDB();
    $stmt = $db->prepare($sql);
    $data = [];
    if($stmt){
        // $stmt->bindParam(':nameCourse', $key, PDO::PARAM_STR);
        // $stmt->bindParam(':departmentid', $key,PDO::PARAM_STR);
        $stmt->bindParam(':keyword', $key, PDO::PARAM_STR);
        $stmt->bindParam(':startData', $start, PDO::PARAM_INT);
        $stmt->bindParam(':limitData', $limit, PDO::PARAM_INT);  
        if($stmt->execute()){
            if($stmt->rowCount() > 0){
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }
    disconnectDB($db);
    return $data;
}

function insertCourse($name,$slug, $department_id,$status){
    //viet cau lenh sql insert vao bang department
    $currenDate = date('Y-m-d H:i:s');
    $sqlInsert = "INSERT INTO `courses` (`name`, `slug`, `department_id`,`status`, `created_at`) 
    VALUES (:nameDepartment, :slug, :departmentid,:statusDepartment,:createdAt)";
    $checkInsert = false;
    $db = connectionDB();
    $stmt = $db->prepare($sqlInsert);
    
    if($stmt){
        $stmt->bindParam(':nameDepartment', $name,PDO::PARAM_STR);
        $stmt->bindParam(':slug', $slug,PDO::PARAM_STR);
        $stmt->bindParam(':departmentid', $department_id,PDO::PARAM_STR);
        $stmt->bindParam(':statusDepartment', $status,PDO::PARAM_STR);
        $stmt->bindParam(':createdAt', $currenDate,PDO::PARAM_STR);
        if($stmt->execute()){
            $checkInsert = true;
        }
    }
    disconnectDB($db);
    //tra ve true, insert thanh cong va  nguoc lai
    return $checkInsert;
}