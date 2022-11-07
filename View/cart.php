<?php
  if(!isset($_SESSION['cart'])||count($_SESSION['cart'])==0):
    echo '<script> alert("Giỏ hàng của bạn chưa có món hàng nào");</script>';
    echo '<meta http-equiv="refresh" content="0;url=../index.php?action=products"/>';
?>
<?php
  else:
?>
<div class="container text-center">
    <h1>Giỏ hàng của bạn</h1>
    <div id="data">
        <table class="table table-striped" style="font-size: 1.8rem;">
        <thead class="table-dark">
            <th>STT</th>
            <th>Hình</th>
            <th>Tên</th>
            <th>Danh mục</th>
            <th>Màu</th>
            <th>Size</th>
            <th>Đơn giá</th>
            <th>Số lượng</th>
            <th>Thành Tiền</th>
            <th></th>
        </thead>
        <tbody>
            <?php
                $categoryModal = new Category();
                $i = 0;
                $total = 0;
                foreach($_SESSION['cart'] as $key=>$item):
                $i++;
                $total += $item['quantity']*($item['price']*(1-$item['discount']));
                $category = $categoryModal->selectName($item['category'])['name'];
            ?>
            <tr class="">
                <td><?php echo $i ?></td>
                <td><img src="<?php echo 'assets/img/products/'.$item['image']?>" width="50"></td>
                <td style="max-width: 200px;"><?php echo $item['name'] ?></td>
                <td><?php echo $category ?></td>
                <td><?php echo $item['color'] ?></td>
                <td><?php echo $item['size'] ?></td>
                <?php 
                if($item['discount'] > 0) : 
                ?>
                    <td><sup><del><?php echo number_format($item['price']) ?> ₫</del></sup> <b><?php echo number_format($item['price']*(1-$item['discount']))?>₫</b></td>
                <?php
                else :
                ?>
                    <td><b><?php echo number_format($item['price'])?> ₫</b></td>
                <?php 
                    endif;
                ?>
                <td><a href="./index.php?action=cart&act=decreaseQuantity&id=<?php echo $item['productId'] ?>" class="btn btn-secondary">-</a> <b><?php echo $item['quantity'] ?></b> <a href="./index.php?action=cart&act=increaseQuantity&id=<?php echo $item['productId'] ?>" class="btn btn-secondary">+</a></td>
                <td><b><?php echo number_format($item['price']*$item['quantity']) ?> ₫</b></td>
                <td><a href="./index.php?action=cart&act=deleteItem&id=<?php echo $item['productId'] ?>" class="btn btn-danger">Xóa</a></td>
            </tr>
            <?php
                endforeach;
            ?>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><h3><b>TỔNG TIỀN : <?php echo number_format($total) ?> ₫</b></h3></td>
                <td><a href="/index.php?action=cart&act=order" class="btn btn-success btn-lg">THANH TOÁN</a></td>
            </tr>
        </tbody>
    </table>
    </div>
    
</div>
<?php
    endif;
?>