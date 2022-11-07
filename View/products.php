<div class="container">
    <div class="row">
        <div class="col-lg-3">
        </div>
        <div class="col-lg-8">
            <div class="row">
                <?php
                    $product = new Product();
                    $results = $product->selectAll();
                    while($set = $results->fetch()):
                ?>
                    <div class="col-lg-4">
                        <form action="/index.php?action=cart&act=addcart" method="POST">
                            <input type="hidden" name="txtid" value="<?php echo $set['id'] ?>">
                            <input type="hidden" name="quantity" value="1">
                        <div class="home-session__card card">
                            <img src="<?php echo 'assets/img/products/'.$set['image']?>" class="card__img w-100">
                            <div class="card__body card-body">
                                <div class="card__title">
                                    <h4><?php echo $set['name'] ?></h4>
                                </div>
                                <div class="card__price">
                                    <p><?php echo number_format($set['price']);?><sup>₫</sup></p>
                                </div>
                                <div class="card__footer">
                                    <button type="submit" class="card__button btn btn-outline-success btn-lg" >Thêm vào giỏ hàng</button>
                                    <a href="/index.php?action=products&act=productDetail&id=<?php echo $set['id'] ?>" class="card__eyebutton btn btn-outline-success btn-lg" type="button"><i class="fa-solid fa-eye"></i></a>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                <?php
                    endwhile;
                ?>
            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>
</div>