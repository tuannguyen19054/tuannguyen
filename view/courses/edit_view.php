<?php
if (!defined('ROOT_PATH')) {
    die('Can not access');
}

$titlePage = "BTEC_Creat Course";
$errorUpdate = $_SESSION['error_update_course'] ?? null;

?>
<?php require 'view/partials/header_view.php'; ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Update courses
    </h3>
    <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">
                <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
            </li>
        </ul>
    </nav>
</div>
<div class="row">
    <div class="col-sm-12 col-md-12">
        <a class="btn btn-primary" href="index.php?c=courses&m=index"> List Courses</a>
        <div class="card mt-3">
            <div class="card-header bg-primary">
                <h5 class="card-title text-white">Update Course</h5>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="post" action="index.php?c=courses&m=handle-edit&id=<?= $info['id']; ?>">
                <div class="row">
                    <div class= "col-sm-12 col-md-6">
                        <div class="form-group mb-3">
                            <label>Name</label>
                            <input class="form-control" type="text" name="name" value="<?= $info['name']; ?>" />
                            <?php if(!empty($errorUpdate['name'])): ?>
                                    <span class="text-danger"><?= $errorUpdate['name']; ?></span>
                                <?php endif; ?>
                        </div>

                        <!-- <select class="form-control" name="department_id">
                                <option value="">--Choose</option> -->
                                <!-- <?php foreach($departments as $item): ?> -->
                                    <!-- <option value="<?= $item['id'] ?>">
                                        <?= $item['name']; ?>
                                    </option> -->
                                <!-- <?php endforeach ?> -->
                            <!-- </select> -->

                            <div class="form-group mb-3">
                                <label>Department</label>
                                <select class="form-control" name="department_id">
                                    <option value="">--Choose--</option>
                                    <?php foreach($departments as $item):?>
                                        <option value="<?= $item['id']; ?>"<?= ($item['id'] == $info['department_id']) ? 'selected' : ''; ?> >
                                            <?= $item['name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                    
                                </select>
                                <?php if(!empty($errorUpdate['department_id'])): ?>
                                    <span class="text-danger"><?= $errorUpdate['department_id']; ?></span>
                                <?php endif; ?>
                            </div>

                    </div>  
                        <div class= "col-sm-12 col-md-6">
                            <div class="form-group mb-3">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="1" 
                                    <?= $info['status'] == 1 ? 'selected' : null; ?>
                                    > Active</option>
                                    <option value="0" 
                                    <?= $info['status'] == 0 ? 'selected' : null; ?>
                                    > Deactive</option>
                                </select>
                            </div>
                            
                            <button class="btn btn-primary btn-lg" type="submit" name="btnSave">Save</button>
                        </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

<?php require 'view/partials/footer_view.php'; ?>