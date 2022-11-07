<?php

/**
 * Đối tượng Customer đại diện cho tài khoản của khách hàng gồm 6 thuộc tính và 6 phương thức
 * @package Model\
 * @author Datdat.itsn02
 * @param int    $customer_id : Mã số id của Customer
 * @param string $email       : Địa chỉ email và cũng là tên đăng nhập của Customer
 * @param string $password    : Mật khẩu của Customer
 * @param string $name        : Tên riêng của Customer
 * @param string $sex         : Giới tính của Customer
 * @param string $birthday    : Ngày sinh của Customer
 * @param string $image       : Hình đại diện của Customer
 * @param string $address     : Địa chỉ của Customer
 * @param string $phone       : Số điện thoại của Customer
 * 
 * @method selectSingle       : Phương thức lấy thông tin 1 Customer dựa trên id của Customer
 * @method selectAll          : Phương thức lấy thông tin của tất cả Customer
 * @method insertSingle       : Phương thức thêm 1 tài khoản vào database
 * @method updateSingle       : Phương thức sửa thông tin 1 tài khoản trên database (Không bao gồm password)
 * @method updatePassword     : Phương thức sửa thông tin mật khẩu của Customer trên database dựa trên id của Customer
 * @method deleteSingle       : Phương thức xóa 1 Customer dựa trên id của Customer
 */
class Customer
{
    //==============================
    // THUỘC TÍNH
    //==============================

    private $customer_id = 0;
    private $email = null;
    private $password = null;
    private $name = null;
    private $set = null;
    private $birthday = null;
    private $image = null;
    private $address = null;
    private $phone = null;

    function selectCustomerByEmail($email)
    {
         // B1: Kết nối với database
         $db = new connect();
         // B2: Yêu cầu truy vấn
         $select = "select * from `customers` where `email` = '$email'";
         // B3: Thực thi truy vấn
        //  echo $select;
        //  exit();
         $result = $db->getInstance($select);
         // B4: Trả về kết quả
         return $result;
    }

    /**
     * Phương thức lấy thông tin các khách hàng bằng tên hoặc email khách hàng
     * @param string $name : Tên hoặc email khách hàng
     * @return mixed       : Mảng khách hàng
     */
    function selectCustomerByNameOrEmail($name)
    {
         // B1: Kết nối với database
         $db = new connect();
         // B2: Yêu cầu truy vấn
         $select = "SELECT * FROM `customers` WHERE `name` LIKE '%$name%' OR `email` LIKE '%$name%'";
         // B3: Thực thi truy vấn
         $result = $db->getList($select);
         // B4: Trả về kết quả
         return $result;
    }

    /**
     * Phương thức lấy thông tin 1 Customer dựa trên id của Customer
     * @param int $customer_id : Mã số id của Customer
     * @return mixed           : Mảng 1 Customer
     */
    function selectSingle($customer_id)
    {
        // B1: Kết nối được với database
        $db = new connect();
        // B2: Yêu cầu truy vấn
        $select = "select * from customers where customer_id = $customer_id";
        // B3: Thực thi truy vấn
        $result = $db->getInstance($select);
        // B4: Trả về 1 Customer
        return $result;
    }

     /**
     * Phương thức lấy thông tin của tất cả Customer mới đến cũ
     * @return mixed : Mảng nhiều Customer
     */
    function selectAllDesc()
    {
        // B1: kết nối được với data base
        $db = new connect();
        // B2: Yêu cầu truy vấn
        $select = "select * from customers group by customer_id desc";
        // B3: Thực thi truy vấn
        $result = $db->getList($select);
        // B4: Trả về mảng tất cả Customers
        return $result;
    }

    /**
     * Phương thức lấy thông tin của tất cả Customer
     * @return mixed : Mảng nhiều Customer
     */
    function selectAll()
    {
        // B1: kết nối được với data base
        $db = new connect();
        // B2: Yêu cầu truy vấn
        $select = "select * from customers";
        // B3: Thực thi truy vấn
        $result = $db->getList($select);
        // B4: Trả về mảng tất cả Customers
        return $result;
    }

    /**
     * Phương thức kiểm tra đăng nhập của Customer
     * @param string $email    : Địa chỉ email và cũng là tên đăng nhập của Customer
     * @param string $password : Mật khẩu của Customer(đã được mã hóa md5)
     * @return mixed : Mảng 1 Customer
     */
    function checkLogin($email, $password)
    {
        // B1: kết nối được với data base
        $db = new connect();
        // B2: Yêu cầu truy vấn
        $select = "select * from customers where email='$email' and password='$password'";
        // B3: Thực thi truy vấn
        $result = $db->getInstance($select);
        // B4: Trả về 1 Customer
        return $result;
    }

    /**
     * Phương thức đăng ký tài khoản của khách hàng
     * @param string $email       : Địa chỉ email và cũng là tên đăng nhập của Customer
     * @param string $password    : Mật khẩu của Customer
     * @param string $name        : Tên riêng của Customer
     * @param string $address     : Địa chỉ của Customer
     * @param string $phone       : Số điện thoại của Customer
     * @return bool true = email đăng ký thành công, false = email đã tồn tại
     */
    function register($email,$password,$name,$address,$phone)
    {
        // B1: Kết nối database
        $db = new connect();
        // B2: Kiểm tra database có tồn tại email đã đăng ký hay chưa
        $query1 = "select * from customers where email = '$email'";
        $result1 = $db->getInstance($query1);
        if(!empty($result1)){
            return false;
        }

        // B3: Yêu cầu insert vào database
        $query = "INSERT INTO 
        `Customers`(
            `customer_id`, 
            `email`, 
            `password`, 
            `name`, 
            `address`, 
            `phone`) 
        VALUES (
            Null,
            :email,
            :password,
            :name,
            :address,
            :phone)
        ";
        // B3: Thực thi truy vấn
        $stm = $db->execP($query);
        $stm->bindParam(':email', $email);
        $stm->bindParam(':password', $password);
        $stm->bindParam(':name', $name);
        $stm->bindParam(':address', $address);
        $stm->bindParam(':phone', $phone);
        $stm->execute();

        return true;
    }

    /**
     * Phương thức thêm 1 tài khoản vào database
     * @param string $email       : Địa chỉ email và cũng là tên đăng nhập của Customer
     * @param string $password    : Mật khẩu của Customer
     * @param string $name        : Tên riêng của Customer
     * @param string $sex         : Giới tính của Customer
     * @param string $birthday    : Ngày sinh của Customer
     * @param string $image       : Hình đại diện của Customer
     * @param string $address     : Địa chỉ của Customer
     * @param string $phone       : Số điện thoại của Customer
     * @return void
     */
    public function insertSingle($email, $password, $name, $sex, $birthday, $image, $address, $phone)
    {
        // B1: Kết nối database
        $db = new connect();
        // B2: Yêu cầu insert vào database
        $query = "INSERT INTO 
        `Customers`(
            `customer_id`, 
            `email`, 
            `password`, 
            `name`, 
            `sex`,
            `birthday`,
            `image`,
            `address`, 
            `phone`) 
        VALUES (
            Null,
            :email,
            :password,
            :name,
            :sex,
            :birthday,
            :image,
            :address,
            :phone)
        ";
        // B3: Thực thi truy vấn
        $stm = $db->execP($query);
        $stm->bindParam(':email', $email);
        $stm->bindParam(':password', $password);
        $stm->bindParam(':name', $name);
        $stm->bindParam(':sex', $sex);
        $stm->bindParam(':birthday', $birthday);
        $stm->bindParam(':image', $image);
        $stm->bindParam(':address', $address);
        $stm->bindParam(':phone', $phone);
        $stm->execute();
    }
    /**
     * Phương thức sửa thông tin 1 tài khoản trên database (Không bao gồm password)
     * @param int    $customer_id : Mã số Id của Customer
     * @param string $email       : Địa chỉ email và cũng là tên đăng nhập của Customer
     * @param string $name        : Tên riêng của Customer
     * @param string $address     : Địa chỉ của Customer
     * @param string $phone       : Số điện thoại của Customer
     * @return void
     */
    public function updateSingle($customer_id, $email, $name, $sex, $birthday, $image, $address, $phone)
    {
        // B1: Kết nối database
        $db = new connect();
        // B2: Yêu cầu truy vấn
        $query = "UPDATE `Customers` 
        SET 
        `email`=:email,
        `name`=:name,
        `sex`=:sex,
        `birthday`=:birthday,
        `image`=:image,
        `address`=:address,
        `phone`=:phone 
        WHERE `customer_id`= $customer_id
        ";
        // B3: Thực thi truy vấn
        $stm = $db->execP($query);
        $stm->bindParam(':email', $email);
        $stm->bindParam(':name', $name);
        $stm->bindParam(':sex', $sex);
        $stm->bindParam(':birthday', $birthday);
        $stm->bindParam(':image', $image);
        $stm->bindParam(':address', $address);
        $stm->bindParam(':phone', $phone);
        $stm->execute();
    }

    /**
     * Phương thức sửa thông tin mật khẩu của Customer trên database dựa trên id của Customer
     * @param int $customer_id : Mã số Id của Customer
     * @param string $password : Mật khẩu của Customer (Đã được mã hóa md5)
     * @return void
     */
    public function updatePassword($customer_id, $password)
    {
        // B1: kết nối database
        $db = new connect();
        // B2: Yêu cầu truy vấn
        $query = "UPDATE `Customers` 
        SET `password`= :password
        WHERE `customer_id`= :customer_id
        ";
        // B3: Thực thi truy vấn
        $stm = $db->execP($query);
        $stm->bindParam(':password', $password);
        $stm->bindParam(':customer_id', $customer_id);
        $stm->execute();
    }

    /**
     * Phương thức đổi hình ảnh của 1 khách hàng dựa trên id khách hàng
     * @param int    $id              : Mã số Id của customer
     * @param string $image           : Tên file hình của customer
     * @return void
     */
    public function updateImage($id,$image)
    {
        // B1: Kết nối database
        $db=new connect();
        // B2: yêu cầu truy vấn
        $query="UPDATE `customers` 
        SET `image`=:image 
        WHERE `customer_id`= $id
        ";
        // B3: Thực thi truy vấn
        $stm=$db->execP($query);
        $stm->bindParam(':image',$image);
        $stm->execute();
    }

    /**
     * Phương thức xóa 1 Customer dựa trên id của Customer
     * @param int $customer_id : Mã số Id của Customer
     * @return void
     */
    public function deleteSingle($customer_id)
    {
        // B1: Kết nối database
        $db = new connect();
        // B2: Yêu cầu truy vấn
        $query = "DELETE FROM `customers` WHERE `customer_id` = $customer_id";
        // B3: Thực thi truy vấn
        $db->exec($query);
    }
}
