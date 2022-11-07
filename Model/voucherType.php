<?php
/**
 * Đối tượng Voucher đại diện cho phiếu giảm giá của cửa hàng.
 * @param int $id      : Mã số của voucherType
 * @param string $name : Tên của voucherType
 */
class VoucherType
{
    //==============================
    // THUỘC TÍNH
    //==============================

    var $id = 0;
    var $name = null; 

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
     * Phương thức lấy thông tin 1 voucherType dựa trên id voucherType
     * @param  int   $id : Mã số Id của voucherType
     * @return mixed     : Mảng 1 voucherType
     */
    function selectSingle($id)
    {
        // B1: kết nối được với database
        $db = new connect();
        // B2: Yêu cầu truy vấn
        $select = "select * from voucherType where id = $id";
        // B3: Thực thi truy vấn
        $result = $db->getInstance($select);
        // B4 Trả về kết quả
        return $result;
    }

    /**
     * Phương thức yêu cầu lấy tất cả loại phiếu giảm giá
     * @return mixed : Mảng tất cả loại phiếu giảm giá
     */
    function selectAll()
    {
        // B1: kết nối được với database
        $db = new connect();
        // B2: yêu cầu truy vấn
        $select = "select * from vouchertype";
        // B3: Thực thi truy vấn
        $result = $db->getList($select);
        // B4: trả về kết quả
        return $result;
    }
}
?>