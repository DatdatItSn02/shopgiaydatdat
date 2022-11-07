<div class="row">
    <div class="col-lg-2"></div>
    <div class="col-lg-8 text-center" style="font-size: 1.6rem;">
        <h1>Hóa đơn của bạn</h1>
        <div class="card-body">
        <table id="datatablesSimple" class="table table-striped text-center">
            <thead class="table-dark">
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Total</th>
                <th>Payment</th>
                <th>Message</th>
                <th>Updated At</th>
                <th></th>
            </thead>
            <?php
                if(isset($_SESSION['customerId'])){
                    $customerId = $_SESSION['customerId'];
                };
                $order=new Order();
                $results=$order->selectAllOrderCustomer($customerId);
                while($set=$results->fetch()):
            ?>
            <tbody>
                <tr>
                <td><?php echo $set['id'] ?></td>
                <td><?php echo $set['customer_name'] ?></td>
                <td><?php echo $set['customer_email'] ?></td>
                <td><?php echo $set['customer_address'] ?></td>
                <td><?php echo $set['customer_phone'] ?></td>
                <td><?php echo number_format($set['total']);?><sup>₫</sup></td>
                <td><?php echo $set['payment']?></td>
                <td><?php echo $set['message'] ?></td>
                <td><?php echo $set['updated_at'] ?></td>
                <td><button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myOrderDetail<?php echo $set['id'];?>">View</button></td>
                </tr>
                <?php
                endwhile;
                ?>
            </tbody>
        </table>
        <?php
            $order=new Order();
            $results=$order->selectAllOrderCustomer($customerId);
            while($set=$results->fetch()):
        ?>

            <!-- The Modal -->
            <div class="modal fade" id="myOrderDetail<?php echo $set['id']; ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Chi tiết hóa đơn mã <?php echo $set['id'];?></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <table class="table table-striped text-center">
                                <thead class="table-dark">
                                    <th></th>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Data</th>
                                </thead>
                                <tbody>
                                <?php
                                        $product = new Product();
                                        $orderDetail = new OrderDetail();
                                        $results2 = $orderDetail->selectAllById($set['id']);
                                        $tong = 0;
                                        while($set2 = $results2->fetch()):
                                            // $tong = $tong + ($set2['total'])
                                            $set3 = $product->selectSingle($set2['product_id']);
                                            $image = $set3['image'];
                                    ?>
                                    <tr>
                                        <td><img src="../../assets/img/products/<?php echo $image?>" width="50" alt=""></td>
                                        <td><?php echo $set3['name']?></td>
                                        <td><?php echo $set2['quantity'] ?></td>
                                        <td><?php echo number_format($set2['total']*$set2['quantity']);?><sup>₫</sup></td>
                                        <td><?php echo $set2['data'] ?></td>
                                    </tr>
                                    <?php
                                        endwhile;
                                    ?>
                                    <!-- <tr>
                                        <div class="w-100" style="display:flex; justify-content:space-between;">
                                            <h4 class="card-title" style="color: var(--header-text-color);">Tổng tiền :</h4>
                                            <span class="card-text text-danger" style="font-size: 2.4rem;"><?php echo number_format($_SESSION['total']) ?> ₫</span>
                                        </div>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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