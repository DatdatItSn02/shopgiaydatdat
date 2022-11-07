<div class="mb-3">
    <form id="searchId" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 mw-100 navbar-search">
        <div class="row">
            <div class="input-group">
                <input id="searchInput" type="text" class="form-control border-1 small" placeholder="Search products by name..." aria-label="Search" aria-describedby="basic-addon2" name="txtsearch">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" disabled>
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
            <div class="input-group">
                <select id="selectCategory" class="form-select form-control border-1 small" style="display:inline-block; min-width:200px;" name="txtcategory">
                    <option value="all">Tất cả</option>
                    <?php
                        $category = new Category();
                        $allCategory = $category->selectAll();
                        while($option = $allCategory->fetch()):
                    ?>
                    <option value="<?php echo $option['id'] ?>"><?php echo $option['name'] ?></option>
                    <?php
                        endwhile;
                    ?>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button" id="categoryBtn">
                        <i class="fa fa-filter"></i> Lọc
                    </button>
                </div>
            </div>
        </div>

    </form>
    <div style="float: right;">
        <a href="/Admin/index.php?action=dashboard&act=importxmlproduct" class="btn btn-success">Import XML</a>
        <a href="/Admin/index.php?action=dashboard&act=addproduct" class="btn btn-success">Thêm Sản phẩm</a>
    </div>
</div>
<div class="w-100" id="data">
    <table id="datatablesSimple" class="table text-center">
        <thead class="table-dark">
            <th>Id</th>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Discount</th>
            <th>Category</th>
            <th>Color</th>
            <th>Size</th>
            <th>Description</th>
            <th>Quantity</th>
            <th></th>
            <th></th>
        </thead>
        <?php
        $product  = new Product();
        $results  = $product->selectAll();
        while ($set = $results->fetch()) :
        ?>
            <tbody>
                <td><?php echo $set['id'] ?></td>
                <td><img src="../../assets/img/products/<?php echo $set['image'] ?>" width="50" alt=""></td>
                <td><?php echo $set['name'] ?></td>
                <td><?php echo number_format($set['price']); ?><sup>₫</sup></td>
                <td><?php echo $set['discountPercent'] * 100 ?>%</td>
                <td><?php
                    $setCategory = $category->selectName($set['category_id'])['name'];
                    echo $setCategory; ?></td>
                <td><?php echo $set['color'] ?></td>
                <td><?php echo $set['size'] ?></td>
                <td><?php echo substr($set['description'], 0, 30) . '...' ?></td>
                <td><?php echo $set['quantity'] ?></td>
                <td><a href="/Admin/index.php?action=dashboard&act=editproduct&id=<?php echo $set['id'] ?>" class="btn btn-warning">Sửa</a></td>
                <td><a href="/Admin/index.php?action=dashboard&act=deleteproduct&id=<?php echo $set['id'] ?>" onclick="return confirm('Bạn có chắc không ?')" class="btn btn-danger">Xóa</a></td>
            </tbody>
        <?php
        endwhile;
        ?>
    </table>
</div>
<script>
    $(document).ready(function() {
        $('#searchInput').on('input', function() {
            var form = document.querySelector('#searchId');
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "View/ajaxTemplate/productTable.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {
                    $('#data').html(data);
                }
            })
        });
        $('#categoryBtn').on('click', function() {
            var form = document.querySelector('#searchId');
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "View/ajaxTemplate/productTable.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function(data) {
                    $('#data').html(data);
                }
            })
        });
    });

</script>