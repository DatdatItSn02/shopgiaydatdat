<div class="row">
    <div class="col-lg-2"></div>
    <?php
        if($_GET['id']) {
            $id = $_GET['id'];
        }
        $product = new Product();
        $result = $product->selectSingle($id);
    ?>
    <div class="col-lg-5">
        <img src="assets/img/products/<?php echo $result['image']?>"  width="100%" alt="">
    </div>
    <div class="col-lg-3" style="font-size: 1.8rem;">
        <form action="/index.php?action=cart&act=addcart" method="post">
            <input type="hidden" name="txtid" value="<?php echo $result['id'] ?>">
        <h1 style="color: var(--header-text-color);"><?php echo $result['name'] ?></h1>
        <hr>
        <?php
            if($result['quantity'] > 0) :
                if($result['discountPercent'] > 0) :
        ?>
            <p><del><?php echo number_format($result['price']) ?> ₫</del></p> <br>
            <p><b><?php echo number_format($result['price']*(1-$result['discountPercent'])) ?> ₫</b></p>
        <?php
                else:
        ?>
            <p style="font-size: 2.4rem;"><b><?php echo number_format($result['price']) ?> ₫</b></p>
            
            <?php
                endif;
            ?>
            <p style="color: #7a9c59; font-size:1.4rem;"><b><?php echo $result['quantity'] ?> in stock</b></p>
        <?php
            else:
            echo '<p class="text-danger" style=" font-size: 2.4rem; "><b>Hết hàng</b></p>';
            endif;
        ?>
        <hr style="width : 30%;">
        <label for="quantity"><b>Số lượng :</b></label>
        <input class="text-center m-3" autofocus type="number" min="1" max="<?php echo $result['quantity'] ?>" value="1" name="quantity" id="quantity"><br>
        <button type="submit" class="btn btn-dark p-3 mt-5"><b style="font-size: 1.8rem; ">Add to cart</b></button>
        </form>
    </div>
    <div class="col-lg-2"></div>
</div>