<div class="container">
    <div class="row">
        <div class="col-lg-3">
        </div>
        <div class="col-lg-8">
            <div class="row">
                <?php
                $blog = new Blog();
                $results = $blog->selectAll();
                while ($set = $results->fetch()) :
                ?>
                    <div class="col-lg-4">
                            <input type="hidden" name="txtid" value="<?php echo $set['id'] ?>">
                            <input type="hidden" name="quantity" value="1">
                            <div class="home-session__card card" style="min-height: 500px;">
                                <img src="<?php echo 'assets/img/blogs/' . $set['thumbnail'] ?>" style="min-height: 250px;" class="card__img w-100">
                                <div class="card__body card-body">
                                    <div class="card__title"  style="min-height: 80px;">
                                        <h4><?php echo substr($set['title'],0,200) ?></h4>
                                    </div>
                                    <div class="card__text">
                                        <p><?php echo substr($set['summary'],0,200).'...' ?></p>
                                    </div>
                                    <div class="card__footer">
                                        <a href="/index.php?action=blogs&act=blogDetail&id=<?php echo $set['id'] ?>" class="card__button btn btn-outline-success w-100 btn-lg">Xem bài viết</a>
                                        <!-- <a href="/index.php?action=products&act=productDetail&id=" class="card__eyebutton btn btn-outline-success btn-lg" type="button"><i class="fa-solid fa-eye"></i></a> -->
                                    </div>
                                </div>
                            </div>
                    </div>
                <?php
                endwhile;
                ?>
            </div>
        </div>
        <div class="col-lg-1"></div>
    </div>
</div>