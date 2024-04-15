<?php
if (!defined('ROOT_PATH')) {
    die('Can not access');
}
$titlePage = "Btec - Update Account";
$errorUpdate  = $_SESSION['error_update_account'] ?? null;
?>
<?php require 'view/partials/header_view.php'; ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Update Account
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
        <a class="btn btn-primary" href="index.php?c=account&m=index"> List Account</a>
        <div class="card mt-3">
            <div class="card-header bg-primary">
                <h5 class="card-title text-white"> Update Account</h5>
            </div>
            <div class="card-body">
                <form enctype="multipart/form-data" method="post"
                    action="index.php?c=account&m=handle-edit&id=<?= $info['id']; ?>">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="">Username</label>
                                <input class="form-control" type="text" name="username" value="<?= $info['username']; ?>" />
                                <?php if(!empty($errorUpdate['username'])): ?>
                                    <span class="text-danger"><?= $errorUpdate['username']; ?></span>
                                <?php endif; ?>

                                <div class="form-group mb-3">
                                    <label>Role</label>
                                    <select class="form-control" name="role_id">
                                        <?php foreach ($role as $dept) { ?>
                                        <option value="<?php echo $dept['id']; ?>"
                                            <?php if ($dept['id'] == $info['role_id']) echo 'selected'; ?>>
                                            <?php echo $dept['name']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                    <?php if(!empty($errorAdd['role_id'])): ?>
                                <span class="text-danger"><?= $errorAdd['role_id']; ?></span>
                                <?php endif; ?>
                                </div>

                                <div class="form-group mb-3">
                                    <label>User</label>
                                    <select class="form-control" name="user_id">
                                        <?php foreach ($user as $dept) { ?>
                                        <option value="<?php echo $dept['id']; ?>"
                                            <?php if ($dept['id'] == $info['user_id']) echo 'selected'; ?>>
                                            <?php echo $dept['full_name']; ?>
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group mb-3">
                            <label for="">Password</label>
                                <input class="form-control" type="text" name="password" value="<?= $info['password']; ?>" />
                                <?php if(!empty($errorAdd['password'])): ?>
                                    <span class="text-danger"><?= $errorUpdate['password']; ?></span>
                                <?php endif; ?>

                                <label>Status</label>
                                <select class="form-control" name="status">
                                    <option value="1" <?= $info['status'] == 1 ? 'selected' : null; ?>> Active</option>
                                    <option value="0" <?= $info['status'] == 0 ? 'selected' : null; ?>> Deactive
                                    </option>
                                </select>
                            </div>

                            <button class="btn btn-primary" type="submit" name="btnSave">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require 'view/partials/footer_view.php'; ?>