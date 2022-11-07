<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    set_include_path(get_include_path() . PATH_SEPARATOR . '../../../Model/');
    spl_autoload_extensions('.php'); // phần mở rộng
    spl_autoload_register();
?>
<table id="datatablesSimple" class="table">
        <thead class="table-dark" style="border-radius:5px;">
            <th>Id</th>
            <th>Avatar</th>
            <th>Email</th>
            <th>Name</th>
            <th>Sex</th>
            <th>Birthday</th>
            <th>Address</th>
            <th>Phone</th>
            <th></th>
            <th></th>
            <th></th>
        </thead>
        <?php
        $customer = new Customer();
        if(isset($_POST['txtsearch']))
        {
            $search = $_POST['txtsearch'];
            if($search == "")
            {
                $results  = $customer->selectAll();
            }
            else
            {
                $results = $customer->selectCustomerByNameOrEmail($search);
            }
        }
        while ($set = $results->fetch()) :
        ?>
            <tbody>
                <td><?php echo $set['customer_id'] ?></td>
                <td><img src="../../assets/img/customers/<?php echo $set['image']?>" width="50" alt=""></td>
                <td><?php echo $set['email'] ?></td>
                <td><?php echo $set['name'] ?></td>
                <td><?php echo $set['sex'] ?></td>
                <td><?php echo $set['birthday'] ?></td>
                <td><?php echo $set['address'] ?></td>
                <td><?php echo $set['phone'] ?></td>
                <td><a href="/Admin/index.php?action=dashboard&act=editcustomer&id=<?php echo $set['customer_id'] ?>" class="btn btn-warning">Sửa</a></td>
                <td><a href="/Admin/index.php?action=dashboard&act=deletecustomer&id=<?php echo $set['customer_id'] ?>" onclick="return confirm('Bạn có chắc không ?')" class="btn btn-danger">Xóa</a></td>
            </tbody>
        <?php
        endwhile;
        ?>
</table>