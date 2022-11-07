<div class="mb-3">
    <div style="float: right;">
        <a href="/Admin/index.php?action=dashboard&act=addblogcategory" class="btn btn-success">Tạo danh mục</a>
    </div>
</div>
<div class="w-100" id="data">
    <table id="datatablesSimple" class="table text-center">
        <thead class="table-dark">
            <th>Id</th>
            <th>Name</th>
            <th>Slug</th>
            <th></th>
            <th></th>
        </thead>
        <?php
        $blogCategory  = new BlogCategory();
        $results  = $blogCategory->selectAll();
        while ($set = $results->fetch()) :
        ?>
            <tbody>
                <td><?php echo $set['id'] ?></td>
                <td><?php echo $set['name'] ?></td>
                <td><?php echo $set['slug'] ?></td>
                <td><a href="/Admin/index.php?action=dashboard&act=editblogcategory&id=<?php echo $set['id'] ?>" class="btn btn-warning">Sửa</a></td>
                <td><a href="/Admin/index.php?action=dashboard&act=deleteblogcategory&id=<?php echo $set['id'] ?>" onclick="return confirm('Bạn có chắc không ?')" class="btn btn-danger">Xóa</a></td>
            </tbody>
        <?php
        endwhile;
        ?>
    </table>
</div>