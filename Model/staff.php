<?php

/**
 * Đối tượng Staff đại diện cho tài khoản của nhân viên
 * @package Model\
 * @author Datdat.itsn02
 * @param int    $staff_id : Mã số id của Staff
 * @param string $email    : Địa chỉ email và cũng là tên đăng nhập của Staff
 * @param string $password : Mật khẩu của Staff
 * @param string $name     : Tên riêng của Staff
 * @param string $image    : Hình đại diện của Staff
 * @param string $birthday : Ngày sinh của Staff
 * @param string $sex      : Giới tính của Staff
 * @param string $address  : Địa chỉ của Staff
 * @param string $phone    : Số điện thoại của Staff
 * @param string $role     : Vai trò của Staff
 * 
 * @method selectSingle    : Phương thức lấy thông tin 1 Staff dựa trên id của Staff
 * @method selectAll       : Phương thức lấy thông tin của tất cả Staff
 * @method insertSingle    : Phương thức thêm 1 tài khoản vào database
 * @method updateSingle    : Phương thức sửa thông tin 1 tài khoản trên database (Không bao gồm password)
 * @method updatePassword  : Phương thức sửa thông tin mật khẩu của Staff trên database dựa trên id của Staff
 * @method deleteSingle    : Phương thức xóa 1 Staff dựa trên id của Staff
 */
class Staff
{
    //==============================
    // THUỘC TÍNH
    //==============================

    private $staff_id = 0;
    private $email = null;
    private $password = null;
    private $name = null;
    private $image = null;
    private $birthday = null;
    private $sex = null;
    private $address = null;
    private $phone = null;
    private $role = null;

    //==============================
    // HÀM TẠO
    //==============================

    public function __construct()
    {
    }

    //==============================
    // PHƯƠNG THỨC
    //==============================

    
    /**
     * Phương thức lấy thông tin các nhân viên bằng tên hoặc email nhân viên
     * @param string $name : Tên hoặc email nhân viên
     * @return mixed       : Mảng nhân viên
     */
    function selectStaffByNameOrEmail($name)
    {
         // B1: Kết nối với database
         $db = new connect();
         // B2: Yêu cầu truy vấn
         $select = "SELECT * FROM `staffs` WHERE `name` LIKE '%$name%' OR `email` LIKE '%$name%'";
         // B3: Thực thi truy vấn
         $result = $db->getList($select);
         // B4: Trả về kết quả
         return $result;
    }

    /**
     * Phương thức lấy thông tin 1 Staff dựa trên id của Staff
     * @param int $staff_id    : Mã số id của Staff
     * @return mixed           : Mảng 1 Staff
     */
    function selectSingle($staff_id)
    {
        // B1: Kết nối được với database
        $db = new connect();
        // B2: Yêu cầu truy vấn
        $select = "select * from staffs where staff_id = $staff_id";
        // B3: Thực thi truy vấn
        $result = $db->getInstance($select);
        // B4: Trả về 1 Staff
        return $result;
    }

    /**
     * Phương thức lấy thông tin của tất cả Staff
     * @return mixed : Mảng nhiều Staff
     */
    function selectAll()
    {
        // B1: kết nối được với data base
        $db = new connect();
        // B2: Yêu cầu truy vấn
        $select = "select * from staffs";
        // B3: Thực thi truy vấn
        $result = $db->getList($select);
        // B4: Trả về mảng tất cả Staffs
        return $result;
    }

    /**
     * Phương thức kiểm tra đăng nhập của Staff
     * @param string $email    : Địa chỉ email và cũng là tên đăng nhập của Staff
     * @param string $password : Mật khẩu của Staff(đã được mã hóa md5)
     * @return mixed : Mảng 1 Staff
     */
    function checkLogin($email, $password)
    {
        // B1: kết nối được với data base
        $db = new connect();
        // B2: Yêu cầu truy vấn
        $select = "select * from staffs where email='$email' and password='$password'";
        // B3: Thực thi truy vấn
        $result = $db->getInstance($select);
        // B4: Trả về 1 Staff
        return $result;
    }

    /**
     * Phương thức kiểm tra 1 Staff có phải là admin hay không
     * @param int $staff_id : Mã số id của Staff
     * @param string $email : Địa chỉ email và cũng là tên đăng nhập của Staff
     * @param string $password : Mật khẩu của Staff(đã được mã hóa md5)
     * @return mixed : Mảng chứa Role của 1 Staff
     */
    function checkRole($staff_id, $email, $password)
    {
        // B1: Kết nối được với data base
        $db = new connect();
        // B2: Yêu cầu truy vấn
        $select = "select role from staffs where staff_id='$staff_id' and email='$email' and password='$password'";
        // B4: Thực thi truy vấn
        $result = $db->getInstance($select);
        // B4: Trả về Role của 1 Staff
        return $result;
    }

    /**
     * Phương thức thêm 1 tài khoản vào database
     * @param string $email    : Địa chỉ email và cũng là tên đăng nhập của Staff
     * @param string $password : Mật khẩu của Staff
     * @param string $name     : Tên riêng của Staff
     * @param string $image    : Hình đại diện của Staff
     * @param string $birthday : Ngày sinh của Staff
     * @param string $sex      : Giới tính của Staff
     * @param string $address  : Địa chỉ của Staff
     * @param string $phone    : Số điện thoại của Staff
     * @param string $role     : Vai trò của Staff
     * @return void
     */
    public function insertSingle(
        $email, 
        $password, 
        $name, 
        $image, 
        $birthday, 
        $sex, 
        $address, 
        $phone, 
        $role)
    {
        // B1: Kết nối database
        $db = new connect();
        // B2: Yêu cầu insert vào database
        $query = "INSERT INTO 
        `Staffs`(
            `staff_id`, 
            `email`, 
            `password`, 
            `name`,
            `image`,
            `birthday`,
            `sex`,
            `address`, 
            `phone`,
            `role`) 
        VALUES (
            Null,
            :email,
            :password,
            :name,
            :image,
            :birthday,
            :sex,
            :address,
            :phone,
            :role)
        ";
        // B3: Thực thi truy vấn
        $stm = $db->execP($query);
        $stm->bindParam(':email', $email);
        $stm->bindParam(':password', $password);
        $stm->bindParam(':name', $name);
        $stm->bindParam(':image', $image);
        $stm->bindParam(':birthday', $birthday);
        $stm->bindParam(':sex', $sex);
        $stm->bindParam(':address', $address);
        $stm->bindParam(':phone', $phone);
        $stm->bindParam(':role', $role);
        $stm->execute();
    }
    /**
     * Phương thức sửa thông tin 1 tài khoản trên database (Không bao gồm password)
     * @param int    $staff_id : Mã số Id của Staff
     * @param string $email    : Địa chỉ email và cũng là tên đăng nhập của Staff
     * @param string $name     : Tên riêng của Staff
     * @param string $birthday : Ngày sinh của Staff
     * @param string $sex      : Giới tính của Staff
     * @param string $address  : Địa chỉ của Staff
     * @param string $phone    : Số điện thoại của Staff
     * @param string $role     : Vai trò của Staff
     * @return void
     */
    public function updateSingle(
        $staff_id, 
        $email, 
        $name, 
        $birthday, 
        $sex, 
        $address, 
        $phone, 
        $role)
    {
        // B1: Kết nối database
        $db = new connect();
        // B2: Yêu cầu truy vấn
        $query = "UPDATE `Staffs` 
        SET 
        `email`=:email,
        `name`=:name,
        `birthday`=:birthday,
        `sex`=:sex,
        `address`=:address,
        `phone`=:phone, 
        `role`=:role
        WHERE `staff_id`= $staff_id
        ";
        // B3: Thực thi truy vấn
        $stm = $db->execP($query);
        $stm->bindParam(':email', $email);
        $stm->bindParam(':name', $name);
        $stm->bindParam(':birthday', $birthday);
        $stm->bindParam(':sex', $sex);
        $stm->bindParam(':address', $address);
        $stm->bindParam(':phone', $phone);
        $stm->bindParam(':role', $role);
        $stm->execute();
    }

    /**
     * Phương thức sửa thông tin mật khẩu của Staff trên database dựa trên id của Staff
     * @param int $staff_id : Mã số Id của Staff
     * @param string $password : Mật khẩu của Staff (Đã được mã hóa md5)
     * @return void
     */
    public function updatePassword($staff_id, $password)
    {
        // B1: kết nối database
        $db = new connect();
        // B2: Yêu cầu truy vấn
        $query = "UPDATE `staffs` 
        SET `password`=:password
        WHERE `staff_id`= $staff_id
        ";
        // B3: Thực thi truy vấn
        $stm = $db->execP($query);
        $stm->bindParam(':password', $password);
        $stm->execute();
    }

    /**
     * Phương thức đổi hình ảnh của 1 role dựa trên id role
     * @param int    $id              : Mã số Id của staff
     * @param string $image           : Tên file hình của staff
     * @return void
     */
    public function updateImage($id,$image)
    {
        // B1: Kết nối database
        $db=new connect();
        // B2: yêu cầu truy vấn
        $query="UPDATE `staffs` 
        SET `image`=:image 
        WHERE `staff_id`= $id
        ";
        // B3: Thực thi truy vấn
        $stm=$db->execP($query);
        $stm->bindParam(':image',$image);
        $stm->execute();
    }

    /**
     * Phương thức xóa 1 Staff dựa trên id của Staff
     * @param int $staff_id : Mã số Id của Staff
     * @return void
     */
    public function deleteSingle($staff_id)
    {
        // B1: Kết nối database
        $db = new connect();
        // B2: Yêu cầu truy vấn
        $query = "DELETE FROM `staffs` WHERE `staff_id` = $staff_id";
        // B3: Thực thi truy vấn
        $db->exec($query);
    }
}
