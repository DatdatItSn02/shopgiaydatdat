<?php
/**
 * Đối tượng Product đại diện cho sản phẩm của cửa hàng gồm 10 thuộc tính và 7 phương thức
 * @package Model\
 * @author Datdat.itsn02
 * @property int    $id              : Mã số Id của product
 * @property string $name            : Tên của product
 * @property string $price           : Đơn giá của product
 * @property string $discountPercent : Phần trăm giảm giá của product (từ 0 -> 1)
 * @property string $image           : Tên file hình của product
 * @property string $category_id     : Mã loại của product
 * @property string $color           : Màu của product
 * @property string $size            : Kích cỡ của product
 * @property string $description     : Mô tả của product
 * @property string $quantity        : Số lượng tồn kho của product
 * @method selectListProductsNew     : Phương thức lấy thông tin 3 sản phẩm mới nhất
 * @method selectSingle              : Phương thức yêu cầu lấy 1 sản phẩm dựa trên id
 * @method selectAll                 : Phương thức yêu cầu lấy tất cả sản phẩm
 * @method insertSingle              : Phương thức thêm 1 product vào database
 * @method updateSingle              : Phương thức sửa 1 sản phẩm (không bao gồm hình ảnh)
 * @method updateImage               : Phương thức đổi hình ảnh của 1 sản phẩm dựa trên id sản phẩm
 * @method deleteSingle              : Phương thức xóa 1 product dựa trên id
 */
class Product
{
    //==============================
    // THUỘC TÍNH
    //==============================

    var $id = 0;
    var $name = null; 
    var $price = null;
    var $discountPercent = null;
    var $image = null;
    var $category_id = null;
    var $color = null;
    var $size = null;
    var $description = null;
    var $quantity = null;

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
     * Phương thức lấy thông tin các sản phẩm bằng danh mục sản phẩm
     * @param string $category : danh mục sản phẩm
     * @return mixed       : Mảng sản phẩm
     */
    function selectProductByCategory($category)
    {
         // B1: Kết nối với database
         $db = new connect();
         // B2: Yêu cầu truy vấn
         $select = "SELECT * FROM `products` WHERE `category_id` LIKE '%$category%'";
         // B3: Thực thi truy vấn
         $result = $db->getList($select);
         // B4: Trả về kết quả
         return $result;
    }
    /**
     * Phương thức lấy thông tin các sản phẩm bằng tên và danh mục sản phẩm
     * @param string $name     : Tên sản phẩm
     * @param string $category : Danh mục sản phẩm
     * @return mixed           : Mảng sản phẩm
     */
    function selectProductByNameAndCategory($name,$category)
    {
         // B1: Kết nối với database
         $db = new connect();
         // B2: Yêu cầu truy vấn
         if($category == 0)
         {
             $select = "SELECT * FROM `products` WHERE `name` LIKE '%$name%'";
         }
         else
         {
            $select = "SELECT * FROM `products` WHERE `name` LIKE '%$name%' AND `category_id` = $category";
         }
         // B3: Thực thi truy vấn
         $result = $db->getList($select);
         // B4: Trả về kết quả
         return $result;
    }
    /**
     * Phương thức lấy thông tin 3 sản phẩm mới nhất
     * @return mixed : Mảng 3 sản phẩm
     */
    function selectListProductsNew()
    {
        // B1: Kết nối với database
        $db = new connect();
        // B2: Yêu cầu truy vấn
        $select = "select * from products order by id desc limit 3";
        // B3: Thực thi truy vấn
        $result = $db->getList($select);
        // B4: Trả về kết quả
        return $result;
    }

    // phương thức yêu cầu lấy hình ảnh 1 sản phẩm dựa trên id
    /**
     * Phương thức lấy thông tin hình ảnh 1 sản phẩm dựa trên id sản phẩm
     * @param  int   $id : Mã số Id của product
     * @return mixed     : Mảng hình ảnh 1 sản phẩm
     */
    function selectImage($id)
    {
        // B1: kết nối được với database
        $db = new connect();
        // B2: Yêu cầu truy vấn
        $select = "select image from products where id = $id";
        // B3: Thực thi truy vấn
        $result = $db->getInstance($select);
        // B4 Trả về kết quả
        return $result;
    }

    /**
     * Phương thức lấy thông tin 1 sản phẩm dựa trên id sản phẩm
     * @param  int   $id : Mã số Id của product
     * @return mixed     : Mảng 1 sản phẩm
     */
    function selectSingle($id)
    {
        // B1: kết nối được với database
        $db = new connect();
        // B2: Yêu cầu truy vấn
        $select = "select * from products where id = $id";
        // B3: Thực thi truy vấn
        $result = $db->getInstance($select);
        // B4 Trả về kết quả
        return $result;
    }

    /**
     * Phương thức yêu cầu lấy tất cả sản phẩm
     * @return mixed : Mảng tất cả sản phẩm
     */
    function selectAll()
    {
        // B1: kết nối được với database
        $db = new connect();
        // B2: yêu cầu truy vấn
        $select = "select * from products";
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
    public function insertSingle($name,$price,$discountPercent,$image,$category_id,$color,$size,$description,$quantity)
    {
        $db=new connect();
        // b2 yêu cầu insert vào database
        $query="INSERT INTO `products`(
            `id`,     
            `name`, 
            `price`, 
            `discountPercent`, 
            `image`, 
            `category_id`, 
            `color`, 
            `size`, 
            `description`, 
            `quantity`) 
        VALUES (
            Null,
            :name,
            :price,
            :discountPercent,
            :image,
            :category_id,
            :color,
            :size,
            :description,
            :quantity)
        ";
        $stm=$db->execP($query);
        $stm->bindParam(':name',$name);
        $stm->bindParam(':price',$price);
        $stm->bindParam(':discountPercent',$discountPercent);
        $stm->bindParam(':image',$image);
        $stm->bindParam(':category_id',$category_id);
        $stm->bindParam(':color',$color);
        $stm->bindParam(':size',$size);
        $stm->bindParam(':description',$description);
        $stm->bindParam(':quantity',$quantity);
        $stm->execute();
    }

    /**
     * Phương thức sửa 1 sản phẩm (không bao gồm hình ảnh)
     * @param int    $id              : Mã số Id của product
     * @param string $name            : Tên của product
     * @param string $price           : Đơn giá của product
     * @param string $discountPercent : Phần trăm giảm giá của product (từ 0 -> 1)
     * @param string $category_id     : Mã loại của product
     * @param string $color           : Màu của product
     * @param string $size            : Kích cỡ của product
     * @param string $description     : Mô tả của product
     * @param string $quantity        : Số lượng tồn kho của product
     * @return void
     */
    public function updateSingle($id,$name,$price,$discountPercent,$category_id,$color,$size,$description,$quantity)
    {
        // B1: Kết nối database
        $db=new connect();
        // B2: yêu cầu truy vấn
        $query="UPDATE `products` 
        SET 
        `name`=:name,
        `price`=:price,
        `discountPercent`=:discountPercent,
        `category_id`=:category_id,
        `color`=:color,
        `size`=:size,
        `description`=:description,
        `quantity`=:quantity 
        WHERE 
        `id`= $id
        ";
        // B3: Thực thi truy vấn
        $stm=$db->execP($query);
        $stm->bindParam(':name',$name);
        $stm->bindParam(':price',$price);
        $stm->bindParam(':discountPercent',$discountPercent);
        $stm->bindParam(':category_id',$category_id);
        $stm->bindParam(':color',$color);
        $stm->bindParam(':size',$size);
        $stm->bindParam(':description',$description);
        $stm->bindParam(':quantity',$quantity);
        $stm->execute();
    }
    /**
     * Phương thức đổi hình ảnh của 1 sản phẩm dựa trên id sản phẩm
     * @param int    $id              : Mã số Id của product
     * @param string $image           : Tên file hình của product
     * @return void
     */
    public function updateImage($id,$image)
    {
        // B1: Kết nối database
        $db=new connect();
        // B2: yêu cầu truy vấn
        $query="UPDATE `products` 
        SET `image`=:image 
        WHERE `id`= $id
        ";
        // b3 Thực thi truy vấn
        $stm=$db->execP($query);
        $stm->bindParam(':image',$image);
        $stm->execute();
    }

    /**
     * Phương thức xóa 1 product dựa trên id
     * @param int    $id              : Mã số Id của product
     * @return void
     */
    public function deleteSingle($id)
    {
        // B1: Kết nối database
        $db=new connect();
        // b2 yêu cầu truy vấn
        $query="DELETE FROM `products` WHERE `id` = $id";
        $db->exec($query);
    }

    /**
     * Phương thức giảm số lượng tồn kho của 1 sản phẩm dựa trên id
     * @param int $id       : Mã số Id của product
     * @param int $quantity : Số lượng cần giảm
     */
    public function decreaseQuantity($id, $quantity)
    {
        // B1: Kết nối database
        $db=new connect();
        // B2: Yêu cầu truy vấn
        $query= "UPDATE `products` SET `quantity`= quantity - :quantity WHERE `id`= :id ";
        // B3: Thực thi truy vấn
        $stm=$db->execP($query);
        $stm->bindParam(':id',$id);
        $stm->bindParam(':quantity',$quantity);
        $stm->execute();
    }
}
