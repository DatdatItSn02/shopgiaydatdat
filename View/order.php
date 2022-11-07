<div class="row mt-5 mb-5">
    <div class="col-lg-1"></div>
    <div class="col-lg-7">
        <h3 class="text-center"><b>ĐƠN HÀNG CỦA BẠN</b></h3>
        <table class="table table-striped text-center" style="font-size: 1.4rem;">
            <thead class="table-dark" >
                <th>STT</th>
                <th>Hình</th>
                <th>Tên</th>
                <th>Danh mục</th>
                <th>Màu</th>
                <th>Size</th>
                <th style="min-width: 100px;">Đơn giá</th>
                <th style="min-width: 100px;">Số lượng</th>
                <th>Thành Tiền</th>
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
                <td><b><?php echo $item['quantity'] ?></b></td>
                <td><b><?php echo number_format($item['price']*$item['quantity']) ?> ₫</b></td>
            </tr>
            <?php
                endforeach;
                if(!isset($_GET['voucher'])){
                    $_SESSION['total'] = $total;
                }
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
                <td><b>TỔNG TIỀN : <?php echo number_format($total) ?> ₫</b></td>
                <td></td>
            </tr>
        </tbody>
        </table>
    </div>
    <div class="col-lg-3">
        <h3 class="text-center"><b>THÔNG TIN</b></h3>
        <?php
            
            if(isset($_SESSION['customerId']))
            {
                $id = $_SESSION['customerId'];
                $customerModel = new Customer();
                $customer = $customerModel->selectSingle($id);
            }
        ?>
        <form action="/index.php?action=order&act=order_action" method="post">
            <input type="hidden" name="txtcustomerid" value="<?php echo $customer['customer_id'] ?>">
            <input type="hidden" name="txtcustomername" value="<?php echo $customer['name'] ?>">
            <input type="hidden" name="txtcustomeremail" value="<?php echo $customer['email'] ?>">
            <input type="hidden" name="txtcustomeraddress" value="<?php echo $customer['address'] ?>">
            <input type="hidden" name="txtcustomerphone" value="<?php echo $customer['phone'] ?>">
            <input type="hidden" name="txttotal" value="<?php echo $_SESSION['total']; ?>">
            <input type="hidden" name="txtpaymentinfo" value="">
            <input type="hidden" name="txtsecurity" value="">
            <?php
                if(isset($_GET['voucher']))
                echo '<input type="hidden" name="txtvoucher" value="'.$_GET['voucher'].'">';
            ?>
            <div class="card p-5" style="font-size:1.4rem; width:100%; position:relative;">
                <h4 class="card-title" style="color: var(--header-text-color);">Giao tới :</h4>
                <a href="" class="m-3" style="position: absolute; top:0;right:0;">Thay đổi</a>
                <p class="card-text"><b><?php echo $customer['name'] ?> &nbsp; &nbsp; &nbsp;<?php echo $customer['phone'] ?></b></p>
                <p class="card-text ">Địa chỉ: <?php echo $customer['address'] ?></p>
            </div>
            <div class="card p-5 mt-3" style="font-size:1.4rem; width:100%; position:relative;">
                    <h4 class="card-title" style="color: var(--header-text-color);">Ghi chú cho cửa hàng :</h4>
                    <textarea class="form-control"  name="txtmessage" id="message" cols="5" rows="2"> </textarea>
            </div>
            <div class="card p-5 mt-3" style="font-size:1.4rem; width:100%; position:relative;">
                    <h4 class="card-title" style="color: var(--header-text-color);">Chọn phương thức thanh toán :</h4>
                    <select class="form-select mt-3" name="txtpayment">
                        <option value="Ship COD">Ship COD</option>
                    </select>
                    
            </div>
            <div class="card p-5 mt-3" style="font-size:1.4rem; width:100%; position:relative;">
                    <h4 class="card-title" style="color: var(--header-text-color);">Voucher :</h4>
                    <div class="input-group mb-3">
                        <?php
                            if(isset($_GET['voucher'])):
                        ?>
                        <input name="txtvoucher" value="<?php echo $_GET['voucher']; ?>" id="voucher" type="text" class="form-control" placeholder="Enter voucher code">
                        <?php
                            else:
                        ?>
                        <input name="txtvoucher" id="voucher" type="text" class="form-control" placeholder="Enter voucher code">
                        <?php
                            endif;
                        ?>
                        <button class="btn btn-success" name="btnVoucher" type="submit">Apply</button>
                    </div>
            </div>
            <div class="card p-5 mt-3" style="font-size:1.4rem; width:100%; position:relative;">
                <div style="display:flex; justify-content:space-between; flex-wrap:wrap;">
                <div class="w-100" style="display:flex; justify-content:space-between;">
                    <h5 class="card-title" style="color: var(--header-text-color);">Tạm tính :</h5>
                    <span class="card-text text-secondary" style="font-size: 1.5rem;"><?php echo number_format($total) ?> ₫</span>
                </div>
                <?php
                    if(isset($_GET['voucher'])):
                ?>
                <div class="w-100" style="display:flex; justify-content:space-between;">
                    <span class="card-text text-secondary" style="font-size: 1.5rem;"><?php echo $_GET['voucher'] ?></span>
                    <span class="card-text text-secondary" style="font-size: 1.5rem;">- <?php echo number_format($total - $_SESSION['total']) ?> ₫</span>
                </div>
                <?php
                    endif;
                ?>
                <div class="w-100" style="display:flex; justify-content:space-between;">
                    <h4 class="card-title" style="color: var(--header-text-color);">Tổng tiền :</h4>
                    <span class="card-text text-danger" style="font-size: 2.4rem;"><?php echo number_format($_SESSION['total']) ?> ₫</span>
                </div>
                </div>
            </div>
            <?php if(
                isset($_SESSION['customerId'])       && 
                isset($_SESSION['customerName'])     &&
                isset($_SESSION['customerEmail'])    &&
                isset($_SESSION['customerPassword']) &&
                isset($_SESSION['customerPhone'])    &&
                isset($_SESSION['customerAddress']) 
                ) :
                    if($_SESSION['customerPhone'] != null && $_SESSION['customerAddress'] != null) :
            ?>
                        <button type="submit" class="btn btn-danger btn-lg w-100"><h3>Mua Hàng (<?php echo $i ?>)</h3></button>
            <?php
                    else:
            ?>
                <button type="submit" class="btn btn-disable btn-lg w-100" disabled><h3>Mua Hàng (<?php echo $i ?>)</h3></button>
            <?php
                    endif;
                else:
            ?>
                <button type="submit" class="btn btn-disable btn-lg w-100" disabled><h3>Mua Hàng (<?php echo $i ?>)</h3></button>
            <?php
                endif;
            ?>
        </form>
    </div>
    <div class="col-lg-1"></div>
</div>