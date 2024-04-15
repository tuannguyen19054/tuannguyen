<?php
if (!defined('ROOT_PATH')) {
    die('Can not access');
}
$state = trim($_GET['state']??null);
$states = trim($_GET['state_del']??null);
$titlePage = "Btec - Account";

?>
<?php require 'view/partials/header_view.php'; ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Account
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
        <a class="btn btn-primary btn-lg" href="index.php?c=account&m=add">Add Account</a>
        <div class="row mt-3">
            <div class="col-sm-12 col-md-6">
                <input type="text" id="keyword" value="<?= htmlentities($keyword); ?>" />
                <button id="btnSearchAccount" class="btn btn-primary btn-sm">Search</button>
                <a class="btn btn-info btn-sm" href="index.php?c=account">Back to lists</a>
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


        <table class="table table-bordered table-striped my-3">
            <thead class="table-primary">
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Role</th>
                <th>User</th>
                <th>Status</th>
                
                <th class="text-center" colspan="2" width="10%">Action</th>
            </thead>
            <tbody>
                <?php foreach($accounts as $key => $item):?>
                <tr>
                    <td><?= $item['id']; ?></td>
                    <td><?= $item['username']; ?></td>
                    <td><?= $item['password']; ?></td>
                    <td><?= $roleName[$item['role_id']];?></td>
                    <td><?= $UserName[$item['user_id']];?></td>
                  
                    <td><?= $item['status'] == 1 ? 'Active' : 'Deactive'; ?></td> 
                    <td>
                        <a href="index.php?c=account&m=edit&id=<?= $item['id']; ?>"
                            class="btn btn-primary btn-sm">Edit</a>
                    </td>
                    <td>
                        <a href="index.php?c=account&m=delete&id=<?= $item['id']; ?>" class="btn btn-danger
                             btn-sm">Delete</a>
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
</table>
         <!-- phan trang du lieu -->
         <?= $htmlPage; ?>

    </div>
</div>

<?php require 'view/partials/footer_view.php'; ?>
<script>
let btnSearch = document.getElementById('btnSearchAccount');
btnSearch.addEventListener('click', function() {
    let txtKeyword = document.getElementById('keyword');
    let keyword = txtKeyword.value.trim();
    if (keyword != '') {
        window.location.href = "index.php?c=account&search=" + keyword;
    } else {
        alert('Enter keyword, please');
    }
});
</script>