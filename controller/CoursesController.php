<?php
// require 'database/database.php';
require 'model/CoursesModel.php';
require 'model/DepartmentModel.php';

// m = tên của hàm nằm trong file controller trong thư mục controller
$m = trim($_GET['m'] ?? 'index'); // ham mac dinh trong controller ten la index
$m = strtolower($m); //viết thường tất cả tên hàm

switch($m){
    case 'index';
        index();
    break;

    case 'add';
    Add();
    break;

    case 'handle-add';
    handleAdd();
    break;

    case 'delete';
    handleDelete();
    break;

    case 'edit';
    edit();
    break;

    case 'handle-edit';
    handleEdit();
    break;

    default:
        index();
    break;
}

function handleEdit(){
    if(isset($_POST['btnSave'])){

        $id = trim($_GET['id'] ?? null);
        $id = is_numeric($id) ? $id : 0;
        $info = getDetailDepartmentById($id);
        $name = trim($_POST['name'] ?? null);
        $name = strip_tags($name);

        $department_id = trim($_POST['department_id'] ?? null);
        $department_id = strip_tags($department_id);

        $status = trim($_POST['status'] ?? null);
        $status = $status === '0' || $status === '1' ? $status : 0;

        $_SESSION['error_update_course'] = [];
        if(empty($name)){
            $_SESSION['error_update_course']['name'] = 'Enter name of course, please';
        } else{
            $_SESSION['error_update_course']['name'] = null;
        }

        if(empty($department_id)){
            $_SESSION['error_update_course']['department_id'] = 'Enter name of department, please';
        } else{
            $_SESSION['error_update_course']['department_id'] = null;
        }
        $flagCheckingError = false;
        foreach($_SESSION['error_update_course'] as $error){
            if(!empty($error)){
                $flagCheckingError = true;
                break;
            }
        }
        if(!$flagCheckingError){
            // ko loi
            if(isset($_SESSION['error_update_course'])){
                unset($_SESSION['error_update_course']);
            }
            $slug = slug_string($name);
            $update = updateCourseById($name,$slug,$department_id,$status,$id);
            if($update){
                //update thanh cong
                header("Location:index.php?c=courses&state=success");

            } else {
                header("Location:index.php?c=courses&m=edit&id={$id}&state=error");
            }

        }else{
            //co loi - quay lai form
            header("Location:index.php?c=courses&m=edit&id={$id}&state=failure");
        }
    }
}
function edit()
{
//     // phai dang nhpa ms su dung duoc chuc nang nay
    if (!isLoginUser()) {
        header("Location:index.php");
        exit();
    }
    $id = trim($_GET['id'] ?? null);
    $id = is_numeric($id) ? $id : 0;
    $info = getDetailCourseById($id); //goi ham trong model
    $departments = getAllDataDepartments();
    if(!empty($info)){
        //co dl trong db
        //hien thi giao dien-thong tin chi tiet dl

        require 'view/courses/edit_view.php';
    } else{
        //khong co dl trong db
        //thong bao 1 giao dien loi

        require 'view/error_view.php';
    }
}

function handleDelete(){
    if(!isLoginUser()){
        header("Location:index.php");
        exit();
    }
    $id = trim($_GET['id'] ?? null);
    $id = is_numeric($id) ? $id : 0;
    $delete = deleteCourseId($id); //goi ten ham trong model
    if($delete){
        //xoa thanh cong
        header("Location:index.php?c=courses&state_del=success");
    } else{
 
        header("Location:index.php?c=courses&state_del=failure");
    }

}
function handleAdd(){
    
    if(isset($_POST['btnSave'])){
        $name = trim($_POST['name'] ?? null);
        $name = strip_tags($name);

        $department_id = trim($_POST['department_id'] ?? null);
        $department_id = strip_tags($department_id);

        $status = trim($_POST['status'] ?? null);
        $status = $status === '0' || $status === '1' ? $status : 0;

        //ktra thong tin
        $_SESSION['error_add_course'] = [];
        if(empty($name)){
            $_SESSION['error_add_course']['name'] = 'Enter name of course, please';
        } else{
            $_SESSION['error_add_course']['name'] = null;
        }
        
        if(empty($department_id)){
            $_SESSION['error_add_course']['department_id'] = 'Enter name of department, please';
        } else{
            $_SESSION['error_add_course']['department_id'] = null;
        }
      

        $flagCheckingError = false;
        foreach($_SESSION['error_add_course'] as $error){
            if(!empty($error)){
                $flagCheckingError = true;
                break;
            }
        }

        //check lai thong tin
        if(!$flagCheckingError){
            //tien hanh insert vao DB
            $slug = slug_string($name);
            $insert = insertCourse($name, $slug,$department_id,$status);
            if($status){
                header("Location:index.php?c=courses&state=success");
            } else{
                header("Location:index.php?c=courses&m=add&state=error");
            }

        } else {
            //thong bao loi cho nguoi dung biet
            header("Location:index.php?c=courses&m=add&state=fail");
        }
    }
}


function Add(){
    $departments = getAllDataDepartments();// goi tu department model
    require 'view/courses/add_view.php';
}
function index(){
if(!isLoginUser()){
    header("Location:index.php");
    exit;
}
$keyword = trim($_GET['search'] ?? null);
$keyword = strip_tags($keyword);

$departments = getAllDataDepartments();

$departmentNames = [];
foreach ($departments as $department) {
    $departmentNames[$department['id']] = $department['name'];
}
$page = trim($_GET['page'] ?? null);
$page = (is_numeric($page) && $page > 0) ? $page : 1;
$linkPage = createLink([
    'c' => 'courses',
    'm' => 'index',
    'page' => '{page}',
    'search' => $keyword
]);
$totalItems = getAllDataCourses($keyword);
$totalItems = count($totalItems);


$panigate = pagigate($linkPage,$totalItems,$page,$keyword, 10);
$start = $panigate['start'] ?? 0;
$htmlPage = $panigate['pagination'] ?? null;
$courses = getAllDataCoursesByPage($keyword,$start,10);
    require 'view/courses/index_view.php';
}