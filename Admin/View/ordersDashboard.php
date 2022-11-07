<div class="mb-3">
    <form
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 mw-100 navbar-search" id="selectType">
        <div class="input-group">
                <select class="form-select form-control border-1 small" style="display:inline-block; min-width:200px;" name="txtstatus">
                    <option value="All">Tất cả</option>
                    <option value="Đặt hàng">Đặt hàng</option>
                    <option value="Duyệt đơn">Duyệt đơn</option>
                    <option value="Đang giao hàng">Đang giao hàng</option>
                    <option value="Hoàn thành">Hoàn thành</option>
                    <option value="Hủy đơn">Hủy đơn</option>
                </select>
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" id="statusbtn">
                    <i class="fa fa-filter"></i> Lọc
                </button>
            </div>
        </div>
    </form>
    <!-- <form id="searchId" style="float:right;"
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 mw-100 navbar-search">
        <div class="input-group">
            <input id="searchInput" type="text" class="form-control bg-light border-1 small" placeholder="Search order by id..."
                aria-label="Search" aria-describedby="basic-addon2" name="txtsearch">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form> -->
</div>
<div class="w-100" id="data">
    <table id="datatablesSimple" class="table table-striped text-center">
        <thead class="table-dark">
            <th></th>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Total</th>
            <th>Payment</th>
            <th>Message</th>
            <th style="min-width: 250px;">Status</th>
            <th></th>
        </thead>
        <?php
        $order = new Order();
        $results = $order->selectAllDesc();
        while ($set = $results->fetch()) :
        ?>
            <tbody>
                <tr class="">
                    <td><?php
                        switch ($set['status']) {
                            case 'Đặt hàng':
                                echo '<i class="fa fa-bell" style="color: #f6c23e; font-size:2rem;"></i>';
                                break;
                            case 'Duyệt đơn':
                                echo '<i class="fa fa-clipboard-list" style="color: #36b9cc; font-size:2rem;"></i>';
                                break;
                            case 'Đang giao hàng';
                                echo '<i class="fa fa-shipping-fast" style="color: #212529; font-size:2rem;"></i>';
                                break;
                            case 'Hoàn thành':
                                echo '<i class="fa fa-check-square" style="color: #1cc88a; font-size:2rem;"></i>';
                                break;
                            case 'Hủy đơn':
                                echo '<i class="fa fa-trash-alt" style="color: #858796; font-size:2rem;"></i>';
                                break;
                            default:
                                echo '<i class="fa fa-bell" style="color: #f6c23e; font-size:2rem;"></i>';
                                break;
                        }
                        ?></td>
                    <td><?php echo $set['id'] ?></td>
                    <td><?php echo $set['customer_name'] ?></td>
                    <td><?php echo $set['customer_email'] ?></td>
                    <td><?php echo $set['customer_address'] ?></td>
                    <td><?php echo $set['customer_phone'] ?></td>
                    <td><?php echo number_format($set['total']); ?><sup>₫</sup></td>
                    <td><?php echo $set['payment'] ?></td>
                    <td><?php echo $set['message'] ?></td>
                    <td>
                        <form action="/Admin/index.php?action=dashboard&act=updateorderstatus" style="display:flexbox; flex-wrap:nowrap;" method="post">
                            <input type="hidden" name="txtid" value="<?php echo $set['id'] ?>">
                            <div class="input-group">
                                <select class="form-select form-control bg-light border-0 small" style="display:inline-block; width:60%" name="txtstatus">
                                    <option value="Đặt hàng" <?php if ($set['status'] == 'Đặt hàng') {
                                                                    echo 'selected';
                                                                } ?>>Đặt hàng</option>
                                    <option value="Duyệt đơn" <?php if ($set['status'] == 'Duyệt đơn') {
                                                                    echo 'selected';
                                                                } ?>>Duyệt đơn</option>
                                    <option value="Đang giao hàng" <?php if ($set['status'] == 'Đang giao hàng') {
                                                                        echo 'selected';
                                                                    } ?>>Đang giao hàng</option>
                                    <option value="Hoàn thành" <?php if ($set['status'] == 'Hoàn thành') {
                                                                    echo 'selected';
                                                                } ?>>Hoàn thành</option>
                                    <option value="Hủy đơn" <?php if ($set['status'] == 'Hủy đơn') {
                                                                echo 'selected';
                                                            } ?>>Hủy đơn</option>
                                </select>
                                <div class="input-group-append">
                                    <button class="btn btn-success" type="submit">Lưu</button>
                                </div>                                
                            </div>
                        </form>
                    </td>
                    <td><button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#myOrderDetail<?php echo $set['id']; ?>">View</button></td>
                </tr>
            <?php
        endwhile;
            ?>
            </tbody>
    </table>
    <?php
    $order = new Order();
    $results = $order->selectAllDesc();
    while ($set = $results->fetch()) :
    ?>
        <!-- The Modal -->
        <div class="modal fade" id="myOrderDetail<?php echo $set['id']; ?>">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Chi tiết hóa đơn mã <?php echo $set['id']; ?></h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <table class="table table-striped text-center">
                            <thead class="table-dark">
                                <th>Id</th>
                                <th>Order Id</th>
                                <th>Product Id</th>
                                <th>Image</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Data</th>
                            </thead>
                            <tbody>
                                <?php
                                $product = new Product();
                                $orderDetail = new OrderDetail();
                                $results2 = $orderDetail->selectAllById($set['id']);
                                while ($set2 = $results2->fetch()) :
                                    $image = $product->selectImage($set2['product_id'])['image'];
                                ?>
                                    <tr>
                                        <td><?php echo $set2['id'] ?></td>
                                        <td><?php echo $set2['order_id'] ?></td>
                                        <td><?php echo $set2['product_id'] ?></td>
                                        <td><img src="../../assets/img/products/<?php echo $image ?>" width="50" alt=""></td>
                                        <td><?php echo $set2['quantity'] ?></td>
                                        <td><?php echo number_format($set2['total']); ?><sup>₫</sup></td>
                                        <td><?php echo $set2['data'] ?></td>
                                    </tr>
                                <?php
                                endwhile;
                                ?>
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
<script>
    $(document).ready(function() {
        $('#statusbtn').on('click', function() {
            var form = document.querySelector('#selectType');
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "View/ajaxTemplate/orderTable.php",
                data:data,
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