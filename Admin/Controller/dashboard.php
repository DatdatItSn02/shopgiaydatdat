<?php
$action = "dashboard";
if (isset($_GET['act'])) {
    $action = $_GET['act'];
}
switch ($action) {

        //====================================================================
        //                        ĐIỀU HƯỚNG DASHBOARD
        //====================================================================

        // Điều hướng tới trang customersDashboard.php
    case 'dashboard':
        include './View/dashboard.php';
        break;
        // Điều hướng tới trang customersDashboard.php
    case 'customers':
        include './View/customersDashboard.php';
        break;

        // Điều hướng tới trang staffsDashboard.php
    case 'staffs':
        // Kiểm tra vai trò trước khi thêm nhân viên
        if (isset($_SESSION['staffId']) && isset($_SESSION['staffEmail']) && isset($_SESSION['staffPassword'])) {
            $checkId       = $_SESSION['staffId'];
            $checkEmail    = $_SESSION['staffEmail'];
            $checkPassword = $_SESSION['staffPassword'];
            // Sử dụng phương thức checkRole để kiểm tra vai trò
            $staff = new Staff();
            $checkRole = $staff->checkRole($checkId, $checkEmail, $checkPassword)['role'];
            // Kiểm tra vai trò
            if ($checkRole == "Boss") {
                // Điều hướng tới trang staffsDashboard.php
                include './View/staffsDashboard.php';
            } else {
                // Thông báo
                echo '<script>alert("Bạn không có quyền vào trang quản lý nhân viên")</script>';
                // Điều hướng tới trang Dashboard
                echo '<meta http-equiv="refresh" content="0;url=../Admin/"/>';
            }
        };
        break;

        // Điều hướng tới trang productsDashboard.php
    case 'products':
        include './View/productsDashboard.php';
        break;
        // Điều hướng tới trang ordersDashboard.php
    case 'orders':
        include './View/ordersDashboard.php';
        break;
        // Điều hướng tới trang vouchersDashboard.php
    case 'vouchers':
        include './View/vouchersDashboard.php';
        break;
        // Điều hướng tới trang blogsDashboard.php
    case 'blogs':
        include './View/blogsDashboard.php';
        break;
        // Điều hướng tới trang blogCategoryDashboard.php
    case 'blogcategory':
        include './View/blogCategoryDashboard.php';
        break;
        

        //====================================================================
        //                                BLOG
        //====================================================================

        // Điều hướng tới trang productForm.php
    case 'addblog':
        include 'View/blogForm.php';
        break;

    case 'addblog_action':
        // Kiểm tra request method
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //Khai báo biến để lấy giá trị nhận về
            $authorId   = $_SESSION['staffId'];
            $title      = $_POST['txttitle'];
            $categoryId = $_POST['txtcategory'];
            $summary    = $_POST['txtsummary'];
            $tag        = $_POST['txttag'];
            $ispublish  = $_POST['txtispublish'];
            $content    = $_POST['txtcontent'];
            $viewNumber = $_POST['txtviewnumber'];
            $thumbnail  = $_FILES['txtimage']['name'];

            $blog = new Blog();
            $blog->insertSingle($title,$categoryId,$thumbnail,$summary,$content,$ispublish,$viewNumber,$tag,$authorId);
            if ($blog) {
                // Lưu hình
                uploadImage('../assets/img/blogs/');
                // Điều hướng tới trang blogsDashboard.php
                echo '<meta http-equiv="refresh" content="0;url=../Admin/index.php?action=dashboard&act=blogs"/>';
            }
        }
        break;
    case 'editblog':
        include 'View/blogForm.php';
        break;
    case 'editblog_action':
        // Kiểm tra request method
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id         = $_POST['txtid'];
            $authorId   = $_SESSION['staffId'];
            $title      = $_POST['txttitle'];
            $categoryId = $_POST['txtcategory'];
            $summary    = $_POST['txtsummary'];
            $tag        = $_POST['txttag'];
            $ispublish  = $_POST['txtispublish'];
            $content    = $_POST['txtcontent'];
            $viewNumber = $_POST['txtviewnumber'];
            $flag = false;
            if(isset($_FILES['txtimage']['name']))
            {
                $image = $_FILES['txtimage']['name'];
                $flag = true;
            }
            else 
            {
                $image = $_POST['txtimageold'];
            }
            // if($_FILES['txtimage']['name']=="")
            // {
            //     $image = $_POST['txtimageold'];
            // }
            // else
            // {
            //     $image = $_FILES['txtimage']['name'];
            // }
            // sử dụng phương thức Updateblog để sửa tài khoản trên database
            $blog = new Blog();
            $blog->updateSingle($id,$title,$categoryId,$image,$summary,$content,$ispublish,$viewNumber,$tag,$authorId);
            // Điều hướng về trang BlogsDashboard.php 
            if ($blog) {
                // Lưu hình
                if($flag){
                    uploadImage('../assets/img/blogs/');
                }
                // Điều hướng tới trang blogsDashboard.php
                echo '<meta http-equiv="refresh" content="0;url=../Admin/index.php?action=dashboard&act=blogs"/>';
            }
        }
        break;
    // Thực hiện xóa 1 blog
    case 'deleteblog':
        $id = $_GET['id'];
        //Sử dụng phương thức deleteSingle để xóa 1 blog 
        $blog = new blog();
        $blog->deleteSingle($id);
        // Điều hướng tới trang blogsDashboard.php
        include 'View/blogsDashboard.php';
        break;
        //====================================================================
        //                           BLOG CATEGORY
        //====================================================================

        // Điều hướng tới trang productForm.php
    case 'addblogcategory':
        include 'View/blogCategoryForm.php';
        break;
    
    case 'addblogcategory_action':
        // Kiểm tra request method
        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            //Khai báo biến để lấy giá trị nhận về
            $name = $_POST['txtname'];
            $blogCategory = new BlogCategory();
            $blogCategory->insertSingle($name);
            echo '<meta http-equiv="refresh" content="0;url=../Admin/index.php?action=dashboard&act=blogcategory"/>';
        }
        break;

    case 'editblogcategory':
        include 'View/blogCategoryForm.php';
        break;
        
        // Thực thi update blogcategory
    case 'editblogcategory_action':
        // Kiểm tra request method
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['txtid'];
            $name = $_POST['txtname'];
            // sử dụng phương thức Updateblogcategory để sửa tài khoản trên database
            $blogCategory = new BlogCategory();
            $blogCategory->updateSingle($id, $name);
            // Điều hướng về trang blogcategorysDashboard.php 
            echo '<meta http-equiv="refresh" content="0;url=../Admin/index.php?action=dashboard&act=blogcategory"/>';
        }
        break;
    
    // Thực thi xóa 1 blogcategory
    case 'deleteblogcategory':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Sử dụng hàm deleteSingle để xóa 1 tài khoản
            $blogCategory = new BlogCategory();
            $blogCategory->deleteSingle($id);
        }
        // Điều hướng tới trang blogcategorysDashboard.php
        echo '<meta http-equiv="refresh" content="0;url=../Admin/index.php?action=dashboard&act=blogcategory"/>';
        break;

        //====================================================================
        //                              CUSTOMER
        //====================================================================

        // Điều hướng tới trang customerForm.php
    case 'addcustomer':
        include 'View/customerForm.php';
        break;

        // Thực thi thêm customer
    case 'addcustomer_action':
        // Kiểm tra request method
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // khai báo các biến để lấy giá trị nhận về
            $email    = $_POST['txtemail'];
            $password = $_POST['txtpassword'];
            $name     = $_POST['txtname'];
            $sex      = $_POST['txtsex'];
            $birthday = $_POST['txtbirthday'];
            $image    = $_FILES['txtimage']['name'];
            $address  = $_POST['txtaddress'];
            $phone    = $_POST['txtphone'];
            // Mã hóa password
            $cypt = md5($password);
            // Sử dụng phương thức insertSingle để thêm tài khoản vào database
            $customer = new Customer();
            $customer->insertSingle($email, $cypt, $name, $sex, $birthday, $image, $address, $phone);
            if ($customer) {
                // Lưu hình
                uploadImage('../assets/img/customers/');
                // Điều hướng tới trang customersDashboard.php
                echo '<meta http-equiv="refresh" content="0;url=../Admin/index.php?action=dashboard&act=customers"/>';
            }
        }
        break;

        // Điều hướng tới trang customerForm.php
    case 'editcustomer':
        include 'View/customerForm.php';
        break;

        // Thực thi update customer
    case 'editcustomer_action':
        // Kiểm tra request method
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['txtid'];
            $email = $_POST['txtemail'];
            $name = $_POST['txtname'];
            $image = $_POST['txtimage'];
            $sex = $_POST['txtsex'];
            $birthday = $_POST['txtbirthday'];
            $address = $_POST['txtaddress'];
            $phone = $_POST['txtphone'];
            // sử dụng phương thức Updatecustomer để sửa tài khoản trên database
            $customer = new Customer();
            $customer->updateSingle($id, $email, $name, $sex, $birthday, $image, $address, $phone);

            // Điều hướng về trang customersDashboard.php 
            echo '<meta http-equiv="refresh" content="0;url=../Admin/index.php?action=dashboard&act=customers"/>';
        }
        break;

        // Điều hướng tới trang customerEditPassword.php
    case 'editcustomerpassword':
        include 'View/customerEditPassword.php';
        break;

        // Thực thi sửa mật khẩu customer
    case 'editcustomerpassword_action':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // khai báo các biến để lấy giá trị nhận về
            $id = $_POST['txtid'];
            $password = $_POST['txtpassword'];
            // mã hóa password
            $cypt = md5($password);
            // sử dụng phương thức updatePassword để sửa mật khẩu customer trên database
            $customer = new customer();
            $customer->updatePassword($id, $cypt);
            // Điều hướng tới trang customersDashboard.php
            echo '<meta http-equiv="refresh" content="0;url=../Admin/index.php?action=dashboard&act=customers"/>';
        }
        break;

        // Thực thi xóa 1 customer
    case 'deletecustomer':
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            // Sử dụng hàm deleteSingle để xóa 1 tài khoản
            $customer = new Customer();
            $customer->deleteSingle($id);
        }
        // Điều hướng tới trang customersDashboard.php
        include 'View/customersDashboard.php';
        break;

        // Điều hướng tới trang customerEditImage.php
    case 'editcustomerimage':
        include 'View/customerEditImage.php';
        break;

        // Thực thi thay đổi ảnh cho 1 sản phẩm
    case 'editcustomerimage_action':
        //Kiểm tra request method
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // khai báo các biến để lấy giá trị nhận về
            $id = $_POST['txtid'];
            $image = $_FILES['txtimage']['name'];

            // sử dụng phương thức updateImage để sửa hình ảnh của sản phẩm vào database
            $customer = new Customer();
            $customer->updateImage($id, $image);
            if ($customer) {
                // Lưu hình
                uploadImage('../assets/img/customers/');
                // Điều hướng tới trang customersDashboard.php
                include 'View/customersDashboard.php';
            }
        }
        break;

        //====================================================================
        //                              PRODUCTS
        //====================================================================

        // Điều hướng tới trang productForm.php
    case 'addproduct':
        include 'View/productForm.php';
        break;

        // Thực thi thêm 1 sản phẩm
    case 'addproduct_action':
        // Kiểm tra request method
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // khai báo các biến để lấy giá trị nhận về
            $name = $_POST['txtname'];
            $price = $_POST['txtprice'];
            $discountpercent = $_POST['txtdiscountpercent'];
            $image = $_FILES['txtimage']['name'];
            $category = $_POST['txtcategory'];
            $color = $_POST['txtcolor'];
            $size = $_POST['txtsize'];
            $description = $_POST['txtdescription'];
            $quantity = $_POST['txtquantity'];

            // sử dụng phương thức insertSingle để thêm tài khoản vào database
            $product = new Product();
            $product->insertSingle($name, $price, $discountpercent, $image, $category, $color, $size, $description, $quantity);
            if ($product) {
                // Lưu hình
                uploadImage('../assets/img/products/');
                // Điều hướng tới trang productsDashboard.php
                echo '<meta http-equiv="refresh" content="0;url=../Admin/index.php?action=dashboard&act=products"/>';
            }
        }
        break;

        // Điều hướng tới trang productForm.php
    case 'editproduct':
        include "View/productForm.php";
        break;

        // Thực thi sửa thông tin 1 sản phẩm
    case 'editproduct_action':
        // Kiểm tra request method
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // khai báo các biến để lấy giá trị nhận về
            $id = $_POST['txtid'];
            $name = $_POST['txtname'];
            $price = $_POST['txtprice'];
            $discountpercent = $_POST['txtdiscountpercent'];
            $category = $_POST['txtcategory'];
            $color = $_POST['txtcolor'];
            $size = $_POST['txtsize'];
            $description = $_POST['txtdescription'];
            $quantity = $_POST['txtquantity'];

            // sử dụng phương thức updateSingle để sửa tài khoản vào database
            $product = new Product();
            $product->updateSingle($id, $name, $price, $discountpercent, $category, $color, $size, $description, $quantity);
            if ($product) {
                // Điều hướng tới trang productsDashboard.php
                echo '<meta http-equiv="refresh" content="0;url=../Admin/index.php?action=dashboard&act=products"/>';
            }
        }
        break;

        // Điều hướng tới trang productEditImage.php
    case 'editproductimage':
        include 'View/productEditImage.php';
        break;

        // Thực thi thay đổi ảnh cho 1 sản phẩm
    case 'editproductimage_action':
        //Kiểm tra reques tmethod
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // khai báo các biến để lấy giá trị nhận về
            $id = $_POST['txtid'];
            $image = $_FILES['txtimage']['name'];

            // sử dụng phương thức updateImage để sửa hình ảnh của sản phẩm vào database
            $product = new Product();
            $product->updateImage($id, $image);
            if ($product) {
                // Lưu hình
                uploadImage('../assets/img/products/');
                // Điều hướng tới trang productsDashboard.php
                include 'View/productsDashboard.php';
            }
        }
        break;

        // Thực hiện xóa 1 sản phẩm
    case 'deleteproduct':
        $id = $_GET['id'];
        //Sử dụng phương thức deleteSingle để xóa 1 sản phẩm 
        $product = new Product();
        $product->deleteSingle($id);
        // Điều hướng tới trang productsDashboard.php
        include 'View/productsDashboard.php';
        break;

        //Điều hướng tới trang import xml
    case 'importxmlproduct':
        include 'View/productImportXml.php';
        break;
        // Thực hiện import file xml vào database
        // case 'importxmlproduct_action':
        //     if(isset($_POST['btnSubmit'])) :
        //         $inputFileName = $_FILES['file']['tmp_name'];
        //         echo $inputFileName;
        //         try {
        //             $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
        //             $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        //             $objPHPExcel = $objReader->load($inputFileName);
        //         } catch(Exception $e) {
        //             die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
        //         }
        //         //  Get worksheet dimensions
        //         $sheet = $objPHPExcel->getSheet(0); 
        //         $highestRow = $sheet->getHighestRow(); 
        //         $highestColumn = $sheet->getHighestColumn();
        //         echo $sheet;
        //         echo $highestRow;
        //         echo $highestColumn;
        //         // for($row = 1; $row <= $highestRow; $row++){ 
        //         //     //  Read a row of data into an array
        //         //     $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
        //         //                                     NULL,
        //         //                                     TRUE,
        //         //                                     FALSE);
        //         //     //  Insert row data array into your database of choice here

        //         // }
        //     endif;
        // break;

        //====================================================================
        //                               STAFFS
        //====================================================================    

        // Điều hướng tới trang staffForm.php
    case 'addstaff':
        include 'View/staffForm.php';
        break;

        // Thực thi thêm staff
    case 'addstaff_action':
        // Kiểm tra vai trò trước khi thêm nhân viên
        if (isset($_SESSION['staffId']) && isset($_SESSION['staffEmail']) && isset($_SESSION['staffPassword'])) {
            $checkId       = $_SESSION['staffId'];
            $checkEmail    = $_SESSION['staffEmail'];
            $checkPassword = $_SESSION['staffPassword'];
            // Sử dụng phương thức checkRole để kiểm tra vai trò
            $staff = new Staff();
            $checkRole = $staff->checkRole($checkId, $checkEmail, $checkPassword)['role'];
            // Kiểm tra vai trò
            if ($checkRole == "Boss") {
                // Kiểm tra request method
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // khai báo các biến để lấy giá trị nhận về
                    $email = $_POST['txtemail'];
                    $password = $_POST['txtpassword'];
                    $name = $_POST['txtname'];
                    $sex = $_POST['txtsex'];
                    $birthday = $_POST['txtbirthday'];
                    $image = $_FILES['txtimage']['name'];
                    $address = $_POST['txtaddress'];
                    $phone = $_POST['txtphone'];
                    $role = $_POST['txtrole'];
                    // Mã hóa password
                    $cypt = md5($password);
                    // Sử dụng phương thức insertSingle để thêm tài khoản vào database
                    $staff->insertSingle($email, $cypt, $name, $image, $birthday, $sex, $address, $phone, $role);
                    if ($staff) {
                        // Lưu hình
                        uploadImage('../assets/img/staffs/');
                        // Điều hướng tới trang staffsDashboard.php
                        echo '<meta http-equiv="refresh" content="0;url=../Admin/index.php?action=dashboard&act=staffs"/>';
                    }
                }
            } else {
                // Thông báo
                echo 'Bạn không có quyền thêm tài khoản';
                // Điều hướng tới trang Dashboard
                echo '<meta http-equiv="refresh" content="0;url=../Admin/"/>';
            }
        }
        break;

        // Điều hướng tới trang staffForm.php
    case 'editstaff':
        include 'View/staffForm.php';
        break;

        // Thực thi update staff
    case 'editstaff_action':
        // Kiểm tra vai trò trước khi thêm nhân viên
        if (isset($_SESSION['staffId']) && isset($_SESSION['staffEmail']) && isset($_SESSION['staffPassword'])) {
            $checkId       = $_SESSION['staffId'];
            $checkEmail    = $_SESSION['staffEmail'];
            $checkPassword = $_SESSION['staffPassword'];
            // Sử dụng phương thức checkRole để kiểm tra vai trò
            $staff = new Staff();
            $checkRole = $staff->checkRole($checkId, $checkEmail, $checkPassword)['role'];
            // Kiểm tra vai trò
            if ($checkRole == "Boss") {
                // Kiểm tra request method
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $id       = $_POST['txtid'];
                    $email    = $_POST['txtemail'];
                    $name     = $_POST['txtname'];
                    $sex      = $_POST['txtsex'];
                    $birthday = $_POST['txtbirthday'];
                    $address  = $_POST['txtaddress'];
                    $phone    = $_POST['txtphone'];
                    $role     = $_POST['txtrole'];
                    // sử dụng phương thức Updatestaff để sửa tài khoản trên database
                    $staff = new staff();
                    $staff->updateSingle($id, $email, $name, $birthday, $sex, $address, $phone, $role);

                    // Điều hướng về trang staffsDashboard.php 
                    echo '<meta http-equiv="refresh" content="0;url=../Admin/index.php?action=dashboard&act=staffs"/>';
                }
            }
        }
        break;

        // Điều hướng tới trang staffEditPassword.php
    case 'editstaffpassword':
        include 'View/staffEditPassword.php';
        break;

        // Thực thi sửa mật khẩu staff
    case 'editstaffpassword_action':
        // Kiểm tra vai trò trước khi thêm nhân viên
        if (isset($_SESSION['staffId']) && isset($_SESSION['staffEmail']) && isset($_SESSION['staffPassword'])) {
            $checkId       = $_SESSION['staffId'];
            $checkEmail    = $_SESSION['staffEmail'];
            $checkPassword = $_SESSION['staffPassword'];
            // Sử dụng phương thức checkRole để kiểm tra vai trò
            $staff = new Staff();
            $checkRole = $staff->checkRole($checkId, $checkEmail, $checkPassword)['role'];
            // Kiểm tra vai trò
            if ($checkRole == "Boss") {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // khai báo các biến để lấy giá trị nhận về
                    $id = $_POST['txtid'];
                    $password = $_POST['txtpassword'];
                    // mã hóa password
                    $cypt = md5($password);
                    // sử dụng phương thức updatePassword để sửa mật khẩu staff trên database
                    $staff = new staff();
                    $staff->updatePassword($id, $cypt);
                    // Điều hướng tới trang staffsDashboard.php
                    echo '<meta http-equiv="refresh" content="0;url=../Admin/index.php?action=dashboard&act=staffs"/>';
                }
            }
        }
        break;

        // Thực thi xóa 1 staff
    case 'deletestaff':
        // Kiểm tra vai trò trước khi thêm nhân viên
        if (isset($_SESSION['staffId']) && isset($_SESSION['staffEmail']) && isset($_SESSION['staffPassword'])) {
            $checkId       = $_SESSION['staffId'];
            $checkEmail    = $_SESSION['staffEmail'];
            $checkPassword = $_SESSION['staffPassword'];
            // Sử dụng phương thức checkRole để kiểm tra vai trò
            $staff = new Staff();
            $checkRole = $staff->checkRole($checkId, $checkEmail, $checkPassword)['role'];
            // Kiểm tra vai trò
            if ($checkRole == "Boss") {
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    // Sử dụng hàm deleteSingle để xóa 1 tài khoản
                    $staff = new staff();
                    $staff->deleteSingle($id);
                }
                // Điều hướng tới trang staffsDashboard.php
                echo '<meta http-equiv="refresh" content="0;url=../Admin/index.php?action=dashboard&act=staffs"/>';
            }
        }
        break;

        // Điều hướng tới trang staffEditImage.php
    case 'editstaffimage':
        include 'View/staffEditImage.php';
        break;

        // Thực thi thay đổi ảnh cho 1 sản phẩm
    case 'editstaffimage_action':
        // Kiểm tra vai trò trước khi thêm nhân viên
        if (isset($_SESSION['staffId']) && isset($_SESSION['staffEmail']) && isset($_SESSION['staffPassword'])) {
            $checkId       = $_SESSION['staffId'];
            $checkEmail    = $_SESSION['staffEmail'];
            $checkPassword = $_SESSION['staffPassword'];
            // Sử dụng phương thức checkRole để kiểm tra vai trò
            $staff = new Staff();
            $checkRole = $staff->checkRole($checkId, $checkEmail, $checkPassword)['role'];
            // Kiểm tra vai trò
            if ($checkRole == "Boss") {
                //Kiểm tra reques tmethod
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // khai báo các biến để lấy giá trị nhận về
                    $id = $_POST['txtid'];
                    $image = $_FILES['txtimage']['name'];

                    // sử dụng phương thức updateImage để sửa hình ảnh của sản phẩm vào database
                    $staff = new staff();
                    $staff->updateImage($id, $image);
                    if ($staff) {
                        // Lưu hình
                        uploadImage('../assets/img/staffs/');
                        // Điều hướng tới trang staffsDashboard.php
                        include 'View/staffsDashboard.php';
                    }
                }
            }
        }
        break;

        //====================================================================
        //                               VOUCHERS
        //====================================================================  

        // Điều hướng tới trang voucherForm.php
    case 'addvoucher':
        include 'View/voucherForm.php';
        break;

        // Thực thi thêm 1 sản phẩm
    case 'addvoucher_action':
        // Kiểm tra request method
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // khai báo các biến để lấy giá trị nhận về
            $name = $_POST['txtname'];
            $code = $_POST['txtcode'];
            $typeId = $_POST['txttypeid'];
            $value = $_POST['txtvalue'];
            $quantity = $_POST['txtquantity'];
            $voucherStart = $_POST['txtstart'];
            $voucherEnd = $_POST['txtend'];

            if (isset($_POST['txtincludecategory'])) {
                $tmpIncludeCategory = $_POST['txtincludecategory'];
                if ($_POST['txtincludecategory'] != "All") {
                    $includeCategory = implode(':', $tmpIncludeCategory);
                } else {
                    $includeCategory = "All";
                }
            } else $includeCategory = "";
            if (isset($_POST['txtexcludecategory'])) {
                $tmpExcludeCategory = $_POST['txtexcludecategory'];
                if ($_POST['txtexcludecategory'] != "All") {
                    $excludeCategory = implode(':', $tmpExcludeCategory);
                } else {
                    $excludeCategory = "All";
                }
            } else $excludeCategory = "";

            if (isset($_POST['txtincludeproduct'])) {
                $tmpIncludeproduct = $_POST['txtincludeproduct'];
                if ($_POST['txtincludeproduct'] != "All") {
                    $includeProduct = implode(':', $tmpIncludeproduct);
                } else {
                    $includeProduct = "All";
                }
            } else $includeProduct = "";
            if (isset($_POST['txtexcludeproduct'])) {
                $tmpExcludeproduct = $_POST['txtexcludeproduct'];
                if ($_POST['txtexcludeproduct'] != "All") {
                    $excludeProduct = implode(':', $tmpExcludeproduct);
                } else {
                    $excludeProduct = "All";
                }
            } else $excludeProduct = "";

            if (isset($_POST['txtincludecustomer'])) {
                $tmpIncludecustomer = $_POST['txtincludecustomer'];
                if ($_POST['txtincludecustomer'] != "All") {
                    $includeCustomer = implode(':', $tmpIncludecustomer);
                } else {
                    $includeCustomer = "All";
                }
            } else $includeCustomer = "";
            if (isset($_POST['txtexcludecustomer'])) {
                $tmpExcludecustomer = $_POST['txtexcludecustomer'];
                if ($_POST['txtexcludecustomer'] != "All") {
                    $excludeCustomer = implode(':', $tmpExcludecustomer);
                } else {
                    $excludeCustomer = "All";
                }
            } else $excludeCustomer = "";

            // sử dụng phương thức insertSingle để thêm tài khoản vào database
            $voucher = new Voucher();
            $voucher->insertSingle($name, $code, $typeId, $value, $quantity, $voucherStart, $voucherEnd, $includeCategory, $excludeCategory, $includeProduct, $excludeProduct, $includeCustomer, $excludeCustomer);
            echo '<meta http-equiv="refresh" content="0;url=../Admin/index.php?action=dashboard&act=vouchers"/>';
        }
        break;

        // Điều hướng tới trang voucherForm.php
    case 'editvoucher':
        include 'View/voucherForm.php';
        break;

        // Thực thi thêm 1 sản phẩm
    case 'editvoucher_action':
        // Kiểm tra request method
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // khai báo các biến để lấy giá trị nhận về
            $id = $_POST['txtid'];
            $name = $_POST['txtname'];
            $code = $_POST['txtcode'];
            $typeId = $_POST['txttypeid'];
            $value = $_POST['txtvalue'];
            $quantity = $_POST['txtquantity'];
            $voucherStart = $_POST['txtstart'];
            $voucherEnd = $_POST['txtend'];

            if (isset($_POST['txtincludecategory'])) {
                $tmpIncludeCategory = $_POST['txtincludecategory'];
                if ($_POST['txtincludecategory'] != "All") {
                    $includeCategory = implode(':', $tmpIncludeCategory);
                } else {
                    $includeCategory = "All";
                }
            } else $includeCategory = "";
            if (isset($_POST['txtexcludecategory'])) {
                $tmpExcludeCategory = $_POST['txtexcludecategory'];
                if ($_POST['txtexcludecategory'] != "All") {
                    $excludeCategory = implode(':', $tmpExcludeCategory);
                } else {
                    $excludeCategory = "All";
                }
            } else $excludeCategory = "";

            if (isset($_POST['txtincludeproduct'])) {
                $tmpIncludeproduct = $_POST['txtincludeproduct'];
                if ($_POST['txtincludeproduct'] != "All") {
                    $includeProduct = implode(':', $tmpIncludeproduct);
                } else {
                    $includeProduct = "All";
                }
            } else $includeProduct = "";
            if (isset($_POST['txtexcludeproduct'])) {
                $tmpExcludeproduct = $_POST['txtexcludeproduct'];
                if ($_POST['txtexcludeproduct'] != "All") {
                    $excludeProduct = implode(':', $tmpExcludeproduct);
                } else {
                    $excludeProduct = "All";
                }
            } else $excludeProduct = "";

            if (isset($_POST['txtincludecustomer'])) {
                $tmpIncludecustomer = $_POST['txtincludecustomer'];
                if ($_POST['txtincludecustomer'] != "All") {
                    $includeCustomer = implode(':', $tmpIncludecustomer);
                } else {
                    $includeCustomer = "All";
                }
            } else $includeCustomer = "";
            if (isset($_POST['txtexcludecustomer'])) {
                $tmpExcludecustomer = $_POST['txtexcludecustomer'];
                if ($_POST['txtexcludecustomer'] != "All") {
                    $excludeCustomer = implode(':', $tmpExcludecustomer);
                } else {
                    $excludeCustomer = "All";
                }
            } else $excludeCustomer = "";

            // sử dụng phương thức insertSingle để thêm tài khoản vào database
            $voucher = new Voucher();
            $voucher->updateSingle($id, $name, $code, $typeId, $value, $quantity, $voucherStart, $voucherEnd, $includeCategory, $excludeCategory, $includeProduct, $excludeProduct, $includeCustomer, $excludeCustomer);

            echo '<meta http-equiv="refresh" content="0;url=../Admin/index.php?action=dashboard&act=vouchers"/>';
        }
        break;

        // Thực hiện xóa 1 voucher
    case 'deletevoucher':
        $id = $_GET['id'];
        //Sử dụng phương thức deleteSingle để xóa 1 voucher 
        $voucher = new Voucher();
        $voucher->deleteSingle($id);
        // Điều hướng tới trang vouchersDashboard.php
        include 'View/vouchersDashboard.php';
        break;
        //====================================================================
        //                              ORDERS
        //====================================================================

    case 'updateorderstatus':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['txtid'];
            $status = $_POST['txtstatus'];
            $order = new Order();
            $order->updateStatus($id, $status);
            // Điều hướng tới trang ordersDashboard.php
            include 'View/ordersDashboard.php';
        }
        break;
}
