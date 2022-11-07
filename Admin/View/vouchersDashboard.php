<div style="float: right;" class="mb-3">
    <a href="/Admin/index.php?action=dashboard&act=addvoucher" class="btn btn-success" >Thêm Vouchers</a>
</div>
<div class="w-100" style="overflow-x: auto; white-space:nowrap;">
    <table id="datatablesSimple" class="table text-center">
        <thead class="table-dark" >
            <th>Id</th>
            <th>Name</th>
            <th>Code</th>
            <th>Type</th>
            <th>Value</th>
            <th>Quantity</th>
            <th>Start</th>
            <th>End</th>
            <th>Include Category</th>
            <th>Exclude Category</th>
            <th>Include Products</th>
            <th>Exclude Products</th>
            <th>Include Customers</th>
            <th>Exclude Customers</th>
            <th></th>
            <th></th>
            <th></th>
            
        </thead>
        <tbody>
        <?php
            $voucher=new Voucher();
            $voucherType = new VoucherType();
            $results=$voucher->selectAll();
            while($set=$results->fetch()):
                $type = $voucherType->selectSingle($set['type_id'])['name'];

        ?>
            <tr>
            <td><?php echo $set['id'] ?></td>
            <td><?php echo $set['name'] ?></td>
            <td><?php echo $set['code'] ?></td>
            <td><?php echo $type ?></td>
            <td><?php echo $set['value'] ?></td>
            <td><?php echo $set['quantity'] ?></td>
            <td><?php echo $set['voucher_start'] ?></td>
            <td><?php echo $set['voucher_end'] ?></td>
            <td><?php echo $set['include_category'] ?></td>
            <td><?php echo $set['exclude_category'] ?></td>
            <td><?php echo $set['include_product'] ?></td>
            <td><?php echo $set['exclude_product'] ?></td>
            <td><?php echo $set['include_customer'] ?></td>
            <td><?php echo $set['exclude_customer'] ?></td>
            <td><a href="/Admin/index.php?action=dashboard&act=editvoucher&id=<?php echo $set['id'] ?>" class="btn btn-warning">Sửa</a></td>
            <td><a href="/Admin/index.php?action=dashboard&act=deletevoucher&id=<?php echo $set['id'] ?>" onclick="return confirm('Bạn có chắc không ?')" class="btn btn-danger">Xóa</a></td>
            </tr>
        <?php
            endwhile;
        ?>
        </tbody>
    </table>
</div>