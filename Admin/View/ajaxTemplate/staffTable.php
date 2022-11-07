<?php
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    set_include_path(get_include_path() . PATH_SEPARATOR . '../../../Model/');
    spl_autoload_extensions('.php'); // phần mở rộng
    spl_autoload_register();
?>
<table id="datatablesSimple" class="table">
        <thead class="table-dark">
            <th>Id</th>
            <th>Avatar</th>
            <th>Email</th>
            <th>Name</th>
            <th>Sex</th>
            <th>Birthday</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Role</th>
            <th></th>
            <th></th>
        </thead>
        <?php
        $staff = new Staff();
        if(isset($_POST['txtsearch']))
        {
            $search = $_POST['txtsearch'];
            if($search == "")
            {
                $results  = $staff->selectAll();
            }
            else
            {
                $results = $staff->selectStaffByNameOrEmail($search);
            }
        }
        while ($set = $results->fetch()) :
        ?>
            <tbody>
                <td><?php echo $set['staff_id'] ?></td>
                <td><img src="../../assets/img/staffs/<?php echo $set['image'] ?>" width="50" alt=""></td>
                <td><?php echo $set['email'] ?></td>
                <td><?php echo $set['name'] ?></td>
                <td><?php echo $set['sex'] ?></td>
                <td><?php echo $set['birthday'] ?></td>
                <td><?php echo $set['address'] ?></td>
                <td><?php echo $set['phone'] ?></td>
                <td><?php echo $set['role'] ?></td>
                <td><a href="/Admin/index.php?action=dashboard&act=editstaff&id=<?php echo $set['staff_id'] ?>" class="btn btn-warning">Sửa</a></td>
                <td><a href="/Admin/index.php?action=dashboard&act=deletestaff&id=<?php echo $set['staff_id'] ?>" onclick="return confirm('Bạn có chắc không ?')" class="btn btn-danger">Xóa</a></td>
            </tbody>
        <?php
        endwhile;
        ?>
</table>