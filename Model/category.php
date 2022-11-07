<?php
/**
 * Đối tượng Category đại diện cho danh mục của sản phẩm.
 * @param int    $id   : Mã số của Category
 * @param string $name : Tên của Category
 */
class Category
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
     * Phương thức yêu cầu lấy tên 1 danh mục sản phẩm
     * @return mixed : Mảng tên 1 danh mục sản phẩm
     */
    function selectName($id)
    {
        // B1: kết nối được với database
        $db = new connect();
        // B2: yêu cầu truy vấn
        $select = "select name from category where id = $id";
        // B3: Thực thi truy vấn
        $result = $db->getInstance($select);
        // B4: trả về kết quả
        return $result;
    }
    /**
     * Phương thức yêu cầu lấy tất cả danh mục sản phẩm
     * @return mixed : Mảng tất cả danh mục sản phẩm
     */
    function selectAll()
    {
        // B1: kết nối được với database
        $db = new connect();
        // B2: yêu cầu truy vấn
        $select = "select * from category";
        // B3: Thực thi truy vấn
        $result = $db->getList($select);
        // B4: trả về kết quả
        return $result;
    }

}
?>