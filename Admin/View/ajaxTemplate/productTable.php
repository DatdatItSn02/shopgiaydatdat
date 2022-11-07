<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    set_include_path(get_include_path() . PATH_SEPARATOR . '../../../Model/');
    spl_autoload_extensions('.php'); // phần mở rộng
    spl_autoload_register();
?>
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
        // if(isset($_POST['txtsearch'])) {
        //     $search = $_POST['txtsearch'];
        //     if($search == "")
        //     {
        //         $results  = $product->selectAll();
        //     }
        //     else
        //     {
        //         $results = $product->selectProductByName($search);
        //     }
        // } elseif(isset($_POST['txtcategory']))
        // {
        //     $category = $_POST['txtcategory'];
        //     if($category == "")
        //     {
        //         $results  = $product->selectAll();            
        //     }
        //     else
        //     {
        //         $results = $product->selectProductByCategory($category);
        //     }
        // }
        if(isset($_POST['txtsearch'])) {
            $search = $_POST['txtsearch']; 
        }
        else {
            $search = "";
        }
        if(isset($_POST['txtcategory'])) {
            $category = $_POST['txtcategory']; 
        }
        else {
            $category = 0;
        }
        $results = $product->selectProductByNameAndCategory($search,$category);
        while ($set = $results->fetch()) :
        ?>
            <tbody>
                <td><?php echo $set['id'] ?></td>
                <td><img src="../../assets/img/products/<?php echo $set['image'] ?>" width="50" alt=""></td>
                <td><?php echo $set['name'] ?></td>
                <td><?php echo number_format($set['price']); ?><sup>₫</sup></td>
                <td><?php echo $set['discountPercent'] * 100 ?>%</td>
                <td><?php
                    $category = new Category();
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