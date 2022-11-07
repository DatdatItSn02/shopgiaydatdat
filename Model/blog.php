<?php
/**
 * Đối tượng blog đại diện cho sản phẩm của cửa hàng gồm 10 thuộc tính và 7 phương thức
 * @package Model\
 * @author Datdat.itsn02
 */
class Blog
{
    //==============================
    // THUỘC TÍNH
    //==============================

    private $id = 0;
    private $blog_category_id = 0;
    private $title = null;
    private $slug = null;
    private $thumbnail = null;
    private $summary = null;
    private $content = null;
    private $view_number = 0;
    private $tag = null;
    private $author_id = 0;


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
     * Phương thức lấy thông tin 1 sản phẩm dựa trên id sản phẩm
     * @param  int   $id : Mã số Id của blog
     * @return mixed     : Mảng 1 sản phẩm
     */
    function selectSingle($id)
    {
        // B1: kết nối được với database
        $db = new connect();
        // B2: Yêu cầu truy vấn
        $select = "select * from blogs where id = $id";
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
        $select = "select * from blogs";
        // B3: Thực thi truy vấn
        $result = $db->getList($select);
        // B4: trả về kết quả
        return $result;
    }
    /**
     * Phương thức yêu cầu lấy tất cả sản phẩm từ mới nhất tới cũ nhất
     * @return mixed : Mảng tất cả sản phẩm
     */
    function selectAllDesc()
    {
        // B1: kết nối được với database
        $db = new connect();
        // B2: yêu cầu truy vấn
        $select = "SELECT * FROM `blogs` GROUP BY id DESC";
        // B3: Thực thi truy vấn
        $result = $db->getList($select);
        // B4: trả về kết quả
        return $result;
    }

    /**
     * Phương thức thêm 1 blog vào database
     * @param string $title           : Tiêu đề của blog
     * @param string $categoryId      : Mã danh mục của blog
     * @param string $thumbnail       : Tên file hình thumbnail của blog
     * @param string $summary         : Tóm tắt của blog
     * @param string $content         : Nội dung của blog
     * @param string $is_publish      : Trạng thái của blog
     * @param string $viewNumber      : Số lượt xem của blog
     * @param string $tag             : Các tags của blog
     * @param string $authorId        : Mã tác giả của blog
     * @return void
     */
    public function insertSingle($title,$categoryId,$thumbnail,$summary,$content,$is_publish,$viewNumber,$tag,$authorId)
    {
        $db=new connect();
        // b2 yêu cầu insert vào database
        $query="INSERT INTO `blogs`(`id`,
         `blog_category_id`,
         `title`,
         `slug`,
         `thumbnail`,
         `summary`,
         `content`,
         `is_publish`,
         `view_number`,
         `tag`,
         `author_id`) VALUES (
         Null,
         :categoryId,
         :title,
         :slug,
         :thumbnail,
         :summary,
         :content,
         :is_publish,
         :viewNumber,
         :tag,
         :authorId
         )";
        $stm=$db->execP($query);
        
        $tmpSlug = fnVnStrFilter($title);
        $slug = str_replace(' ', '-', $tmpSlug);

        $stm->bindParam(':title',$title);
        $stm->bindParam(':categoryId',$categoryId);
        $stm->bindParam(':slug',$slug);
        $stm->bindParam(':thumbnail',$thumbnail);
        $stm->bindParam(':summary',$summary);
        $stm->bindParam(':content',$content);
        $stm->bindParam(':is_publish',$is_publish);
        $stm->bindParam(':viewNumber',$viewNumber);
        $stm->bindParam(':tag',$tag);
        $stm->bindParam(':authorId',$authorId);

        $stm->execute();

    }

    /**
     * Phương thức sửa 1 blog
     * @param int    $id              : Mã của blog
     * @param string $title           : Tiêu đề của blog
     * @param string $categoryId      : Mã danh mục của blog
     * @param string $thumbnail       : Tên file hình thumbnail của blog
     * @param string $summary         : Tóm tắt của blog
     * @param string $content         : Nội dung của blog
     * @param string $is_publish      : Trạng thái của blog
     * @param string $viewNumber      : Số lượt xem của blog
     * @param string $tag             : Các tags của blog
     * @param string $authorId        : Mã tác giả của blog
     * @return void
     */
    public function updateSingle($id,$title,$categoryId,$thumbnail,$summary,$content,$is_publish,$viewNumber,$tag,$authorId)
    {
        $db=new connect();
        // b2 yêu cầu insert vào database
        $query="UPDATE `blogs` SET 
         `blog_category_id`=:categoryId,
         `title`=:title,
         `slug`=:slug,
         `thumbnail`=:thumbnail,
         `summary`=:summary,
         `content`=:content,
         `is_publish`=:is_publish,
         `view_number`=:viewNumber,
         `tag`=:tag,
         `author_id`=:authorId WHERE `id` = :id";
        $stm=$db->execP($query);
        
        $tmpSlug = fnVnStrFilter($title);
        $slug = str_replace(' ', '-', $tmpSlug);

        $stm->bindParam(':id',$id);
        $stm->bindParam(':title',$title);
        $stm->bindParam(':categoryId',$categoryId);
        $stm->bindParam(':slug',$slug);
        $stm->bindParam(':thumbnail',$thumbnail);
        $stm->bindParam(':summary',$summary);
        $stm->bindParam(':content',$content);
        $stm->bindParam(':is_publish',$is_publish);
        $stm->bindParam(':viewNumber',$viewNumber);
        $stm->bindParam(':tag',$tag);
        $stm->bindParam(':authorId',$authorId);

        $stm->execute();
    }

    /**
     * Phương thức xóa 1 blog dựa trên id
     * @param int    $id              : Mã số Id của blog
     * @return void
     */
    public function deleteSingle($id)
    {
        // B1: Kết nối database
        $db=new connect();
        // b2 yêu cầu truy vấn
        $query="DELETE FROM `blogs` WHERE `id` = $id";
        $db->exec($query);
    }

    /**
     * Phương thức giảm số lượng tồn kho của 1 sản phẩm dựa trên id
     * @param int $id       : Mã số Id của blog
     * @param int $quantity : Số lượng cần giảm
     */
    public function decreaseQuantity($id, $quantity)
    {
        // B1: Kết nối database
        $db=new connect();
        // B2: Yêu cầu truy vấn
        $query= "UPDATE `blogs` SET `quantity`= quantity - :quantity WHERE `id`= :id ";
        // B3: Thực thi truy vấn
        $stm=$db->execP($query);
        $stm->bindParam(':id',$id);
        $stm->bindParam(':quantity',$quantity);
        $stm->execute();
    }
}
