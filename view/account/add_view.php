<?php
if (!defined('ROOT_PATH')) {
    die('Can not access');
}
$titlePage = "Btec - Create Account";
$errorAdd = $_SESSION['error_add_account'] ?? null;
?>
<?php require 'view/partials/header_view.php'; ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Create Account
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
        <a class="btn btn-primary btn-lg" href="index.php?c=account">Back to Lists</a>
        <div class="card card-primary mt-3">
            <div class="card-header bg-primary">
                <h5 class="card-title text-white">Add New account</h5>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="post" action="index.php?c=account&m=handle-add">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="">Username</label>
                                <input class="form-control" type="text" name="username" />
                                <?php if(!empty($errorAdd['username'])): ?>
                                    <span class="text-danger"><?= $errorAdd['username']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div>
                            <label for="">Role</label>
                                <select class="form-control" name="role_id">
                                    <option value="">-- Choose --</option>
                                    <?php foreach($role as $item): ?>
                                        <option value="<?=$item['id']?>"><?= $item['name'] ?></option>
                                    <?php endforeach; ?>                                  
                                </select>
                                <?php if(!empty($errorAdd['role_id'])): ?>
                                <span class="text-danger"><?= $errorAdd['role_id']; ?></span>
                                <?php endif; ?> 
                            </div>
                            <div class="form-group mb-3">
                                <label>User</label>
                                <select class="form-control" name="user_id">
                                    <option value="">-- Choose --</option>
                                    <?php foreach($user as $item): ?>
                                        <option value="<?=$item['id']?>"><?= $item['full_name'] ?></option>
                                    <?php endforeach; ?>                                  
                                </select>
                                <?php if(!empty($errorAdd['user_id'])): ?>
                                <span class="text-danger"><?= $errorAdd['user_id']; ?></span>
                                <?php endif; ?> 
                            </div>
                        </div>
                       
                        <div class="col-sm-12 col-md-6">
                            
                            <div class="form-group mb-3">
                            <label for="">Password</label>
                                <input type="text" name="password" id="" class="form-control">
                                <?php if(!empty($errorAdd['password'])): ?>
                                    <span class="text-danger"><?= $errorAdd['password']; ?></span>
                                <?php endif; ?>
                                <br>
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="1"> Active</option>
                                    <option value="0"> Deactive</option>
                                </select>
                            </div>
                           
                            <button class ="btn btn-primary btn-lg btnA" type="submit" name ="btnSave">Save</button>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?php require 'view/partials/footer_view.php'; ?>