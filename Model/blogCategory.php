<?php
/**
 * Đối tượng BlogCategory đại diện cho danh mục của bài viết.
 * @param int    $id   : Mã số của BlogCategory
 * @param string $name : Tên của BlogCategory
 * @param string $slug : Tên của BlogCategory không dấu
 */
class BlogCategory
{
    //==============================
    // THUỘC TÍNH
    //==============================

    var $id = 0;
    var $name = null; 
    var $slug = null;

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
     * Phương thức yêu cầu lấy tên 1 danh mục bài viết
     * @return mixed : Mảng tên 1 danh mục bài viết
     */
    function selectName($id)
    {
        // B1: kết nối được với database
        $db = new connect();
        // B2: yêu cầu truy vấn
        $select = "select name from blog_category where id = $id";
        // B3: Thực thi truy vấn
        $result = $db->getInstance($select);
        // B4: trả về kết quả
        return $result;
    }
    
     /**
     * Phương thức yêu cầu lấy 1 danh mục bài viết
     * @return mixed : Mảng 1 danh mục bài viết
     */
    function selectSingle($id)
    {
        // B1: kết nối được với database
        $db = new connect();
        // B2: yêu cầu truy vấn
        $select = "select * from blog_category where id = $id";
        // B3: Thực thi truy vấn
        $result = $db->getInstance($select);
        // B4: trả về kết quả
        return $result;
    }

    /**
     * Phương thức yêu cầu lấy tất cả danh mục bài viết
     * @return mixed : Mảng tất cả danh mục bài viết
     */
    function selectAll()
    {
        // B1: kết nối được với database
        $db = new connect();
        // B2: yêu cầu truy vấn
        $select = "select * from blog_category";
        // B3: Thực thi truy vấn
        $result = $db->getList($select);
        // B4: trả về kết quả
        return $result;
    }

    function insertSingle($name)
    {
        // B1: kết nối được với database
        $db = new connect();
        // B2: yêu cầu truy vấn
        $query = "INSERT INTO `blog_category`(`name`, `slug`) VALUES (:name,:slug)";
        //Bỏ dấu tiếng việt
        $tmpSlug = fnVnStrFilter($name);
        //Đổi các ký tự khoảng trắng thành gạch nối
        $slug = str_replace(' ', '-', $tmpSlug);
        $stm = $db->execP($query);
        $stm->bindParam(':name', $name);
        $stm->bindParam(':slug', $slug);
        $stm->execute();
    }

    function updateSingle($id,$name)
    {
        // B1: kết nối được với database
        $db = new connect();
        // B2: yêu cầu truy vấn
        $query = "UPDATE `blog_category` SET `name`=:name,`slug`=:slug WHERE `id`=:id";
        //Bỏ dấu tiếng việt
        $tmpSlug = fnVnStrFilter($name);
        //Đổi các ký tự khoảng trắng thành gạch nối
        $slug = str_replace(' ', '-', $tmpSlug);
        $stm = $db->execP($query);
        $stm->bindParam(':id', $id);
        $stm->bindParam(':name', $name);
        $stm->bindParam(':slug', $slug);
        $stm->execute();
    }

    function deleteSingle($id)
    {
        // B1: kết nối được với database
        $db = new connect();
        // B2: yêu cầu truy vấn
        $query = "DELETE FROM `blog_category` WHERE `id`=:id";
        $stm = $db->execP($query);
        $stm->bindParam(':id', $id);
        $stm->execute();
    }
}
