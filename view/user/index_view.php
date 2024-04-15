<?php
if (!defined('ROOT_PATH')) {
    die('Can not access');
}
$state = trim($_GET['state']??null);
$states = trim($_GET['state_del']??null);
$titlePage = "Btec - Courses";

?>
<?php require 'view/partials/header_view.php'; ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> User
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
        <a class="btn btn-primary btn-lg" href="index.php?c=user&m=add">Add User</a>
        <div class="row mt-3">
            <div class="col-sm-12 col-md-6">
                <input type="text" id="keyword" value="<?= htmlentities($keyword); ?>" />
                <button id="btnSearchUser" class="btn btn-primary btn-sm">Search</button>
                <a class="btn btn-info btn-sm" href="index.php?c=user">Back to lists</a>
            </div>
        </div>
        <?php if($state==='success'): ?>
        <div class="my-3 text-success text-center">
            Action Successfully!
        </div>
        <?php endif; ?>

        <?php if($states==='success'): ?>
        <div class="my-3 text-success text-center text-danger">
            Delete Successfully!
        </div>
        <?php endif; ?>

        <div style="overflow-x: auto;">
        <table class="table table-bordered table-striped my-3">
            <thead class="table-primary">
                <th>ID</th>
                <th>Extra Code</th>
                <th>Role</th>
                <th>Full Name</th>
                <th>Avatar</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Birthday</th>
                <th>Status</th>
                <th>Gender</th>
                <th class="text-center" colspan="2" width="10%">Action</th>
            </thead>
            <tbody>
                <?php foreach($users as $key => $item):?>
                <tr>
                    <td><?= $item['id']; ?></td>
                    <td><?= $item['extra_code']; ?></td>
                    <td><?= $roleName[$item['role_id']];?></td>
                    <td><?= $item['full_name']; ?></td>
                    <td width="10%">
                            <img
                                style="width: 100%; height: 100%;"
                                class="img-fluid"
                                alt="<?= $item['avatar'] ?>"
                                src="public/uploads/images/<?= $item['avatar']; ?>"
                            />
                        </td>
                    <td><?= $item['email']; ?></td>
                    <td><?= $item['phone']; ?></td>
                    <td><?= $item['address']; ?></td>
                    <td><?= $item['birthday']; ?></td>
                    <td><?= $item['status'] == 1 ? 'Active' : 'Deactive'; ?></td>
                    <td><?= $item['gender'] == 1 ? 'Male' : 'Female'; ?></td>
                    <td>
                        <a href="index.php?c=user&m=edit&id=<?= $item['id']; ?>"
                            class="btn btn-primary btn-sm">Edit</a>
                    </td>
                    <td>
                        <a href="index.php?c=user&m=delete&id=<?= $item['id']; ?>" class="btn btn-danger
                             btn-sm">Delete</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        </div>
           <!-- phan trang du lieu -->
           <?= $htmlPage; ?>
  

    </div>
</div>

<?php require 'view/partials/footer_view.php'; ?>
<script>
let btnSearch = document.getElementById('btnSearchUser');
btnSearch.addEventListener('click', function() {
    let txtKeyword = document.getElementById('keyword');
    let keyword = txtKeyword.value.trim();
    if (keyword != '') {
        window.location.href = "index.php?c=user&search=" + keyword;
    } else {
        alert('Enter keyword, please');
    }
});
</script>