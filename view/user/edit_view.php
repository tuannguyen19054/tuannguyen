<?php
if (!defined('ROOT_PATH')) {
    die('Can not access');
}
$titlePage = "Btec - Update User";
$errorUpdate  = $_SESSION['error_update_user'] ?? null;
?>
<?php require 'view/partials/header_view.php'; ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Update User
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
        <a class="btn btn-primary" href="index.php?c=User&m=index"> List Users</a>
        <div class="card mt-3">
            <div class="card-header bg-primary">
                <h5 class="card-title text-white"> Update User</h5>
            </div>
            <div class="card-body">
            <form enctype="multipart/form-data" method="post" action="index.php?c=user&m=handle-edit&id=<?= $info['id']; ?>">
                <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group mb-3">
                                <label for="">Extra Code</label>
                                <input class="form-control" type="text" name="extra_code" value="<?= $info['extra_code']; ?>" />
                                <?php if(!empty($errorUpdate['extra_code'])): ?>
                                    <span class="text-danger"><?= $errorUpdate['extra_code']; ?></span>
                                <?php endif; ?>
                            </div>
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

                            </div>
                            <div class="form-group mb-3">
                                <label for="">Full Name</label>
                                <input class="form-control" type="text" name="full_name" value="<?= $info['full_name']; ?>" />
                                <?php if(!empty($errorUpdate['full_name'])): ?>
                                    <span class="text-danger"><?= $errorUpdate['full_name']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Email</label>
                                <input type="email" name="email" id="" class="form-control" value="<?= $info['email']; ?>">
                                <?php if(!empty($errorUpdate['email'])): ?>
                                    <span class="text-danger"><?= $errorUpdate['email']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group mb-3">
                                <label> Avatar </label>
                                <input type="file" class="form-control" name="avatar" />
                                <?php if(!empty($errorUpdate['avatar'])): ?>
                                    <span class="text-danger"><?= $errorUpdate['avatar']; ?></span>
                                <?php endif; ?>
                                <br/>
                                <img
                                    width="50%"
                                    class="img-fluid"
                                    alt="<?= $info['avatar']; ?>"
                                    src="public/upload/images/<?= $info['avatar']; ?>"
                                />
                            </div>
                        </div>
                       
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group mb-3">
                            <label>Status</label>
                                <select class="form-control" name="status">
                                    <option
                                        value="1"
                                        <?= $info['status'] == 1 ? 'selected' : null; ?>
                                    > Active</option>
                                    <option
                                        value="0"
                                        <?= $info['status'] == 0 ? 'selected' : null; ?>
                                    > Deactive</option>
                                </select>
                            </div>
                            <div class="form-group mb-3 begin form-margin  " >
                                <label>Birthday</label>
                                <input 
                                    value="<?= $info['birthday']; ?>"
                                    type="date"
                                    class="form-control"
                                    name="birthday"
                                />
                                <?php if(!empty($errorAdd['birthday'])): ?>
                                <span class="text-danger"><?= $errorAdd['birthday']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group mb-3">
                                <label>Gender</label>
                                <select class="form-control" name="gender">
                                <option
                                        value="1"
                                <?= $info['gender'] == 1 ? 'selected' : null; ?>
                                    > Male</option>
                                    <option
                                        value="0"
                                        <?= $info['gender'] == 0 ? 'selected' : null; ?>
                                    > Female</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Phone</label>
                                <input class="form-control" type="phone" name="phone" value="<?= $info['phone']; ?>"pattern="[0-9]*" />
                                <?php if(!empty($errorUpdate['phone'])): ?>
                                    <span class="text-danger"><?= $errorUpdate['phone']; ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="form-group mb-3">
                                <label for="">Address</label>
                                <input type="text" name="address" id="" class="form-control" value="<?= $info['address']; ?>">
                                <?php if(!empty($errorUpdate['address'])): ?>
                                    <span class="text-danger"><?= $errorUpdate['address']; ?></span>
                                <?php endif; ?>
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