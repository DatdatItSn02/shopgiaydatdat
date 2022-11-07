
<div class="mb-3">
    <form id="searchId" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 mw-100 navbar-search">
        <div class="input-group">
            <input id="searchInput" type="text" class="form-control border-1 small" placeholder="Search customers..." aria-label="Search" aria-describedby="basic-addon2" name="txtsearch">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" disabled>
                    <i class="fas fa-search fa-sm"></i>
                </button>
            </div>
        </div>
    </form>
    <div style="float: right;">
        <a href="/Admin/index.php?action=dashboard&act=addcustomer" class="btn btn-success" >Thêm Customeers</a>
    </div>
</div>
<div class="w-100" id="data">
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
        $results = $customer->selectAllDesc();
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
</div> 
<script>
    $(document).ready(function() {
        $('#searchInput').on('input', function() {
            var form = document.querySelector('#searchId');
            var data = new FormData(form);
            $.ajax({
                type: "POST",
                url: "View/ajaxTemplate/customerTable.php",
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

