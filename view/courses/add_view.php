<?php
if (!defined('ROOT_PATH')) {
    die('Can not access');
}
$titlePage = "BTEC_ Creat new COURSES";
$errorAdd = $_SESSION['error_add_course'] ?? null;
?>
<?php require 'view/partials/header_view.php'; ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Create a new Courses
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
        <a class="btn btn-primary btn-lg" href="index.php?c=courses">Back to list</a>
        <div class="card mt-3">
            <div class="card-header bg-primary">
                <h5 class="card-title text-white mb-0">Creat Course</h5>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="post" action="index.php?c=courses&m=handle-add">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group mb-3">
                                <label>Name</label>
                                <input type="text" class="form-control" name = "name" />
                                <?php if(!empty($errorAdd['name'])): ?>
                                    <span class="text-danger"><?= $errorAdd['name']; ?></span>
                                <?php endif; ?>
                                <div class="form-group mb-3">
                            <label>Department</label>
                            <select class="form-control" name="department_id">
                                <option value="">--Choose--</option>
                                <?php foreach($departments as $item): ?>
                                    <option value="<?= $item['id'] ?>">
                                        <?= $item['name']; ?>
                                    </option>
                                    <?php if(!empty($errorAdd['department'])): ?>
                                    <span class="text-danger"><?= $errorAdd['name']; ?></span>
                                <?php endif; ?>
                                <?php endforeach ?>
                            </select>
                            <?php if(!empty($errorAdd['department_id'])): ?>
                                    <span class="text-danger"><?= $errorAdd['department_id']; ?></span>
                                <?php endif; ?>
                    </div>
                        <div class= "col-sm-12 col-md-6">
                            <div class="form-group mb-3">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="1"> Active</option>
                                    <option value="0"> Deactive</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="btnSave">Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?php require 'view/partials/footer_view.php'; ?>