<?php
    class OrderDetail
    {
        //==============================
        // THUỘC TÍNH
        //==============================

        var $id         = 0;
        var $orderId   = 0;
        var $productId = 0;
        var $quantity = 0;
        var $total = 0;
        var $data = Null;
        //==============================
        // HÀM TẠO
        //==============================

        public function __construct()
        {
        }
            
        //==============================
        // PHƯƠNG THỨC
        //==============================
        
        function selectAllById($orderId) {
            // B1: kết nối được với database
            $db = new connect();
            // B2: yêu cầu truy vấn
            $select = "select * from orderdetail where order_id = $orderId";
            // B3: Thực thi truy vấn
            $result = $db->getList($select);
            // B4: trả về kết quả
            return $result;
        }

        function insertSingle(
        $orderId,
        $productId,
        $quantity,
        $total,
        $data)
        {
            // B1: Kết nối database
            $db=new connect();
            // B2: yêu cầu insert vào database
            $query="INSERT INTO
             `orderdetail`(
                `id`, 
                `order_id`, 
                `product_id`, 
                `quantity`, 
                `total`, 
                `data`)     
            VALUES (
                Null,
                :orderId,
                :productId,
                :quantity,
                :total,
                :data)
                ";
            $stm=$db->execP($query);
            $stm->bindParam(':orderId',$orderId);
            $stm->bindParam(':productId',$productId);
            $stm->bindParam(':quantity',$quantity);
            $stm->bindParam(':total',$total);
            $stm->bindParam(':data',$data);
            $stm->execute();
        }

        function deleteSingle($id) {
            // B1: Kết nối database
            $db = new connect();
            // B2: Yêu cầu truy vấn
            $query = "DELETE FROM `orderdetail` WHERE `order_id` = $id";
            // B3: Thực thi truy vấn
            $db->exec($query);
        }
}
?>