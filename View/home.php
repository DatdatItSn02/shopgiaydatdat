    <!-- Carousel -->
    <div id="carousel" class="carousel slide w-100" data-bs-ride="carousel">

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/img/banner-shoe.webp" alt="slide-1" class="d-block w-100 myCarousel__img">
            </div>
            <div class="carousel-item">
                <img src="assets/img/banner-shoe.webp" alt="slide-2" class="d-block w-100 myCarousel__img">
            </div>
            <div class="carousel-item">
                <img src="assets/img/banner-shoe.webp" alt="slide-3" class="d-block w-100 myCarousel__img">
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
        <div class="myCarousel-caption">
            <div class="myCarousel-caption__textbox">
                <p class="myCarousel-caption__heading">Tiệm giày cũ mà bạn ưa thích nhất</p>
                <p class="myCarousel-caption__title">VINTAGEKICKS</p>
            </div>
            <a class="myCarousel-caption__btn" href="#">Xem thêm <i class="fa-solid fa-angle-right"></i></a>
        </div>
    </div>

    <div class="grid">
        <div class="home-session">
            <div class="home-session__title">
                <h3>Sản phẩm Mới nhất</h3>
            </div>
            <div class="row w-100">
                <div class="col-lg-2"></div>
                <div class="row col-lg-8">
                    <?php
                        $product=new Product();
                        $results=$product->selectListProductsNew();
                        while($set=$results->fetch()):
                    ?>
                    <div class="col-lg-4">
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
                                    <button class="card__button btn btn-outline-success btn-lg" >Thêm vào giỏ hàng</button>
                                    <button class="card__eyebutton btn btn-outline-success btn-lg" type="button"><i class="fa-solid fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                        endwhile;
                    ?>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
        <!-- <div class="home-session" id="Leu">
            <div class="home-session__title">
                <h3>Các sản phẩm lều trại</h3>
            </div>
            <div class="home-session__category">
                <button (click)="setPipeLeuTraiCategory('AllLeu')" [class.card__button--selected]="pipeLeuTraiCategory === 'AllLeu'" class="card__button btn btn-outline-success btn-lg">Tất cả</button>
                <button (click)="setPipeLeuTraiCategory('Lều 2 người')" [class.card__button--selected]="pipeLeuTraiCategory === 'Lều 2 người'" class="card__button btn btn-outline-success btn-lg">Lều 2 người</button>
                <button (click)="setPipeLeuTraiCategory('Lều 4 người')" [class.card__button--selected]="pipeLeuTraiCategory === 'Lều 4 người'" class="card__button btn btn-outline-success btn-lg">Lều 4 người</button>
                <button (click)="setPipeLeuTraiCategory('Lều 6 người')" [class.card__button--selected]="pipeLeuTraiCategory === 'Lều 6 người'" class="card__button btn btn-outline-success btn-lg">Lều 6 người</button>
                <button (click)="setPipeLeuTraiCategory('Lều 12 người')" [class.card__button--selected]="pipeLeuTraiCategory === 'Lều 12 người'" class="card__button btn btn-outline-success btn-lg">Lều 12 người</button>
            </div>
            <div class="row w-100">
                <div class="col-lg-2"></div>
                <div class="row col-lg-8">
                    <div class="col-lg-4" *ngFor="let item of products | arrayFilter: pipeLeuTraiCategory" (change)="setPipeLeuTraiCategory(pipeLeuTraiCategory)">
                        <div class="home-session__card card">
                            <img [src]="'assets/img/products/'+ item.image" [alt]="item.name" class="card__img w-100">
                            <div class="card__body card-body">
                                <div class="card__title">
                                    <h4>{{item.name}}</h4>
                                </div>
                                <div class="card__price">
                                    <p>{{item.price | number }} <sup>₫</sup>/ngày</p>
                                </div>
                                <div class="card__footer">
                                    <button class="card__button btn btn-outline-success btn-lg" (click)="addCart(item)">Thêm vào giỏ hàng</button>
                                    <button class="card__eyebutton btn btn-outline-success btn-lg" type="button" data-bs-toggle="modal" [attr.data-bs-target]="'#m'+item.id"><i class="fa-solid fa-eye"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div> -->
    </div>