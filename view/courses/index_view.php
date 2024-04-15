<?php
if (!defined('ROOT_PATH')) {
    die('Can not access');
}
$titlePage = "BTEC_COURSES";
$state = trim($_GET['state'] ?? null);
?>
<?php require 'view/partials/header_view.php'; ?>

<div class="page-header">
    <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white me-2">
            <i class="mdi mdi-home"></i>
        </span> Courses
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
        <a class="btn btn-primary btn-lg" href="index.php?c=courses&m=add">Add new Courses</a>

        <div class="row mt-3">
            <div class="col-sm-12 col-md-6">
                <input type="text" id="keyword" value="<?= htmlentities($keyword); ?>" />
                <button id="btnSearchCourse" class="btn btn-primary btn-sm">Search</button>
                <a class="btn btn-info btn-sm"href="index.php?c=courses">Back to list</a>
            </div>
        </div> 
        <?php if ($state === 'success') : ?>
            <div class="my-3 text-success text-center">Action Successfully!</div>
        <?php endif; ?>
        <table class="table table-bordered table-striped my-3">
        <thead class="table-primary">
                <th>ID</th>
                <th>Name</th>
                <th>Department</th>
                <th>Status</th>
                <th colspan="2" class="text-center" width="10%">Action</th></th>
            </thead>
            <tbody>
            <?php foreach ($courses ?? [] as $key => $item) : ?>
                <tr>
                    <td><?= $item['id']; ?></td>
                    <td><?= $item['name']; ?></td>
                    <td><?= isset($departmentNames[$item['department_id']]) ? $departmentNames[$item['department_id']] : 'Unknown'; ?></td>
                    
                    <td><?= $item['status'] == 1 ? 'Active' : 'Deactive'; ?></td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="index.php?c=courses&m=edit&id=<?=$item['id']; ?>"> Edit</a>
                    </td>
                    <td>
                        <a class="btn btn-danger btn-sm" href="index.php?c=courses&m=delete&id=<?=$item['id']; ?>"> Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $htmlPage; ?>
        
    </div>
</div>

<?php require 'view/partials/footer_view.php'; ?>

<!-- <script>
    let btnSearch =document.getElementById('btnSearchCourse');
    btnSearch.addEventListener('click',function(){
        let txtkeyword =document.getElementById('keyword');
        let keyword =txtkeyword.value.trim();
        if(keyword != ''){
            window.location.href = "index.php?c=courses&search="+keyword;
         }else{
            alert('Enter keyword,pls')
        }
    });
</script> -->
<!-- <script>
    let btnSearch = document.getElementById('btnSearchCourse');
    btnSearch.addEventListener('click', function() {
        let txtKeyword = document.getElementById('keyword');
        let keyword = txtKeyword.value.trim();
        if (keyword != '') {
            let currentPage = <?php echo isset($_GET['page']) ? $_GET['page'] : 1; ?>; // Lấy số trang hiện tại từ URL
            window.location.href = "<?php echo $linkPage; ?>&search=" + keyword + "&page=" + currentPage;
        } else {
            alert('Enter keyword, pls');
        }
    });
</script> -->
<script>
    let btnSearch = document.getElementById('btnSearchCourse');
    btnSearch.addEventListener('click', function() {
        let txtKeyword = document.getElementById('keyword');
        let keyword = txtKeyword.value.trim();
        if (keyword != '') {
            let itemsPerPage = 2; // Số lượng sản phẩm mỗi trang
            let totalItems = <?php echo $totalItems; ?>; // Tổng số mục
            let totalPages = Math.ceil(totalItems / itemsPerPage); // Tính toán tổng số trang
            let pagigate  = []; // Trang mặc định
            window.location.href = "<?php echo $linkPage; ?>&search=" + keyword + "&page=" + pagigate;
        } else {
            alert('Enter keyword, pls');
        }
    });
</script>
