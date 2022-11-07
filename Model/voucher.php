<?php
/**
 * Đối tượng Voucher đại diện cho phiếu giảm giá của cửa hàng.
 * @param int $id : Mã số của voucher
 * @param string $name : Tên của voucher
 * @param string $code : Mã nhập của voucher
 * @param string $type : Loại giảm giá của voucher
 * @param float $value : Giá trị của voucher (phụ thuộc vào type của voucher)
 * @param int $quantity : Số lượng sử dụng còn lại của voucher
 * @param int $voucherStart : Ngày bắt đầu áp dụng của voucher
 * @param int $voucherEnd : Ngày hết hạn của voucher
 * @param int $includeCategory : Các danh mục được áp dụng của voucher
 * @param int $excludeCategory : Các danh mục được áp dụng của voucher
 * @param int $includeProduct  : Các sản phẩm được áp dụng của voucher
 * @param int $excludeProduct  : Các sản phẩm được áp dụng của voucher
 * @param int $includeCustomer : Các khách hàng được áp dụng của voucher
 * @param int $excludeCustomer : Các khách hàng được áp dụng của voucher
 */
class Voucher
{
    //==============================
    // THUỘC TÍNH
    //==============================

    var $id = 0;
    var $name = null; 
    var $code = null; 
    var $type = null; 
    var $value = 0;
    var $quantity = 0;
    var $voucherStart = null;
    var $voucherEnd = null;
    var $includeCategory = null; 
    var $excludeCategory = null; 
    var $includeProduct = null; 
    var $excludeProduct = null; 
    var $includeCustomer = null; 
    var $excludeCustomer = null; 

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
     * Phương thức lấy thông tin 1 voucher dựa trên code voucher
     * @param string $code : Mã nhập của voucher
     * @return mixed     : Mảng 1 voucher
     */
    function selectVoucherInput($code)
    {
        // B1: kết nối được với database
        $db = new connect();
        // B2: Yêu cầu truy vấn
        $select = "select * from voucher where code = '$code'";
        // B3: Thực thi truy vấn
        $result = $db->getInstance($select);
        // B4 Trả về kết quả
        return $result;
    }

    /**
     * Phương thức lấy thông tin 1 voucher dựa trên id voucher
     * @param  int   $id : Mã số Id của voucher
     * @return mixed     : Mảng 1 voucher
     */
    function selectSingle($id)
    {
        // B1: kết nối được với database
        $db = new connect();
        // B2: Yêu cầu truy vấn
        $select = "select * from voucher where id = $id";
        // B3: Thực thi truy vấn
        $result = $db->getInstance($select);
        // B4 Trả về kết quả
        return $result;
    }

    /**
     * Phương thức yêu cầu lấy tất cả phiếu giảm giá
     * @return mixed : Mảng tất cả phiếu giảm giá
     */
    function selectAll()
    {
        // B1: kết nối được với database
        $db = new connect();
        // B2: yêu cầu truy vấn
        $select = "select * from voucher";
        // B3: Thực thi truy vấn
        $result = $db->getList($select);
        // B4: trả về kết quả
        return $result;
    }

        /**
     * Phương thức thêm 1 product vào database
     * @param string $name            : Tên của product
     * @param string $price           : Đơn giá của product
     * @param string $discountPercent : Phần trăm giảm giá của product (từ 0 -> 1)
     * @param string $image           : Tên file hình của product
     * @param string $category_id     : Mã loại của product
     * @param string $color           : Màu của product
     * @param string $size            : Kích cỡ của product
     * @param string $description     : Mô tả của product
     * @param string $quantity        : Số lượng tồn kho của product
     * @return void
     */
    public function insertSingle($name,$code,$typeId,$value,$quantity,$voucherStart,$voucherEnd,$includeCategory,$excludeCategory,$includeProduct,$excludeProduct,$includeCustomer,$excludeCustomer)
    {
        $db=new connect();
        // b2 yêu cầu insert vào database
        $query="INSERT INTO `voucher`(
            `id`, 
            `name`, 
            `code`, 
            `type_id`, 
            `value`, 
            `quantity`, 
            `voucher_start`, 
            `voucher_end`, 
            `include_category`, 
            `exclude_category`, 
            `include_product`, 
            `exclude_product`, 
            `include_customer`, 
            `exclude_customer`)
             VALUES (
            Null,
            :name,
            :code,
            :typeId,
            :value,
            :quantity,
            :voucherStart,
            :voucherEnd,
            :includeCategory,
            :excludeCategory,
            :includeProduct,
            :excludeProduct,
            :includeCustomer,
            :excludeCustomer)
        ";
        $stm=$db->execP($query);
        $stm->bindParam(':name',$name);
        $stm->bindParam(':code',$code);
        $stm->bindParam(':typeId',$typeId);
        $stm->bindParam(':value',$value);
        $stm->bindParam(':quantity',$quantity);
        $stm->bindParam(':voucherStart',$voucherStart);
        $stm->bindParam(':voucherEnd',$voucherEnd);
        $stm->bindParam(':includeCategory',$includeCategory);
        $stm->bindParam(':excludeCategory',$excludeCategory);
        $stm->bindParam(':includeProduct',$includeProduct);
        $stm->bindParam(':excludeProduct',$excludeProduct);
        $stm->bindParam(':includeCustomer',$includeCustomer);
        $stm->bindParam(':excludeCustomer',$excludeCustomer);
        $stm->execute();
    }
    /**
     * Phương thức sửa 1 sản phẩm (không bao gồm hình ảnh)
     * @param int $id : Mã số của voucher
     * @param string $name : Tên của voucher
     * @param string $code : Mã nhập của voucher
     * @param string $type : Loại giảm giá của voucher
     * @param float $value : Giá trị của voucher (phụ thuộc vào type của voucher)
     * @param int $quantity : Số lượng sử dụng còn lại của voucher
     * @param int $voucherStart : Ngày bắt đầu áp dụng của voucher
     * @param int $voucherEnd : Ngày hết hạn của voucher
     * @param int $includeCategory : Các danh mục được áp dụng của voucher
     * @param int $excludeCategory : Các danh mục được áp dụng của voucher
     * @param int $includeProduct  : Các sản phẩm được áp dụng của voucher
     * @param int $excludeProduct  : Các sản phẩm được áp dụng của voucher
     * @param int $includeCustomer : Các khách hàng được áp dụng của voucher
     * @param int $excludeCustomer : Các khách hàng được áp dụng của voucher
     * @return void
     */
    public function updateSingle($id,$name,$code,$typeId,$value,$quantity,$voucherStart,$voucherEnd,$includeCategory,$excludeCategory,$includeProduct,$excludeProduct,$includeCustomer,$excludeCustomer)
    {
        // B1: Kết nối database
        $db=new connect();
        // B2: yêu cầu truy vấn
        $query="UPDATE `voucher` SET 
        `name`=:name,
        `code`=:code,
        `type_id`=:typeId,
        `value`=:value,
        `quantity`=:quantity,
        `voucher_start`=:voucherStart,
        `voucher_end`=:voucherEnd,
        `include_category`=:includeCategory,
        `exclude_category`=:excludeCategory,
        `include_product`=:includeProduct,
        `exclude_product`=:excludeProduct,
        `include_customer`=:includeCustomer,
        `exclude_customer`=:excludeCustomer
        WHERE `id`=:id
        ";
        // B3: Thực thi truy vấn
        
        $stm=$db->execP($query);
        $stm->bindParam(':id',$id);
        $stm->bindParam(':name',$name);
        $stm->bindParam(':code',$code);
        $stm->bindParam(':typeId',$typeId);
        $stm->bindParam(':value',$value);
        $stm->bindParam(':quantity',$quantity);
        $stm->bindParam(':voucherStart',$voucherStart);
        $stm->bindParam(':voucherEnd',$voucherEnd);
        $stm->bindParam(':includeCategory',$includeCategory);
        $stm->bindParam(':excludeCategory',$excludeCategory);
        $stm->bindParam(':includeProduct',$includeProduct);
        $stm->bindParam(':excludeProduct',$excludeProduct);
        $stm->bindParam(':includeCustomer',$includeCustomer);
        $stm->bindParam(':excludeCustomer',$excludeCustomer);
        $stm->execute();
    }

    /**
     * Phương thức xóa 1 voucher dựa trên id
     * @param int    $id              : Mã số Id của voucher
     * @return void
     */
    public function deleteSingle($id)
    {
        // B1: Kết nối database
        $db=new connect();
        // b2 yêu cầu truy vấn
        $query="DELETE FROM `voucher` WHERE `id` = $id";
        $db->exec($query);
    }
    /**
     * Phương thức giảm số lượng tồn kho của 1 voucher dựa trên id
     * @param int $id       : Mã số Id của voucher
     * @param int $quantity : Số lượng cần giảm
     */
    public function decreaseQuantity($id, $quantity)
    {
        // B1: Kết nối database
        $db=new connect();
        // B2: Yêu cầu truy vấn
        $query= "UPDATE `voucher` SET `quantity`= quantity - :quantity WHERE `id`= :id ";
        // B3: Thực thi truy vấn
        $stm=$db->execP($query);
        $stm->bindParam(':id',$id);
        $stm->bindParam(':quantity',$quantity);
        $stm->execute();
    }
}
?>