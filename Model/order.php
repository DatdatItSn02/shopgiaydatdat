<?php
    // 
    class Order
    {
        //==============================
        // THUỘC TÍNH
        //==============================

        var $id         = 0;
        var $customerId = 0;
        var $customerName = Null;
        var $customerEmail = Null;
        var $customerPhone = Null;
        var $total = 0;
        var $voucherCode = Null;
        var $payment = Null;
        var $paymentInfo = Null;
        var $message = Null;
        var $security = Null;
        var $status = Null;

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
         * Phương thức yêu cầu lấy về các hóa đơn dựa trên status
         * @param string $status : Trạng thái của hóa đơn
         * @return mixed: Mảng hóa đơn
         */
        function selectOrderByStatus($status)
        {
            // B1: Kết nối với database
            $db = new connect();
            // B2: Yêu cầu truy vấn
            $select = "SELECT * FROM `orders` WHERE `status` = '$status'";
            // B3: Thực thi truy vấn
            $result = $db->getList($select);
            // B4: Trả về kết quả
            return $result; 
        }

        // phương thức yêu cầu lấy về id hóa đơn mới nhất
        /**
         * Phương thức lấy thông tin id hóa đơn mới nhất
         * @return mixed : Mảng id hóa đơn
         */
        function selectIdOrderNew()
        {
            // B1: Kết nối với database
            $db = new connect();
            // B2: Yêu cầu truy vấn
            $select = "select id from orders order by id desc limit 1";
            // B3: Thực thi truy vấn
            $result = $db->getInstance($select);
            // B4: Trả về kết quả
            return $result;
        }
        
        /**
         * Phương thức yêu cầu lấy tất cả hóa don của customer dựa vào customerId
         * @return mixed : Mảng tất cả hóa don của customer dựa vào customerId
         */
        function selectOrderId($customerId)
        {
            // B1: kết nối được với database
            $db = new connect();
            // B2: yêu cầu truy vấn
            $select = "select id from orders where customer_id = $customerId";
            // B3: Thực thi truy vấn
            $result = $db->getList($select);
            // B4: trả về kết quả
            return $result;
        }       

        /**
         * Phương thức yêu cầu lấy tất cả hóa don của customer dựa trên id customer
         * @return mixed : Mảng tất cả hóa don của customer dựa trên id customer
         */
        function selectAllOrderCustomer($customerId)
        {
            // B1: kết nối được với database
            $db = new connect();
            // B2: yêu cầu truy vấn
            $select = "select * from orders where customer_id = $customerId";
            // B3: Thực thi truy vấn
            $result = $db->getList($select);
            // B4: trả về kết quả
            return $result;
        }   

        /**
         * Phương thức yêu cầu lấy tất cả hóa don
         * @return mixed : Mảng tất cả hóa don
         */
        function selectAllDesc()
        {
            // B1: kết nối được với database
            $db = new connect();
            // B2: yêu cầu truy vấn
            $select = "select * from orders group by id desc";
            // B3: Thực thi truy vấn
            $result = $db->getList($select);
            // B4: trả về kết quả
            return $result;
        }        

        /**
         * Phương thức yêu cầu lấy tất cả hóa don
         * @return mixed : Mảng tất cả hóa don
         */
        function selectAll()
        {
            // B1: kết nối được với database
            $db = new connect();
            // B2: yêu cầu truy vấn
            $select = "select * from orders";
            // B3: Thực thi truy vấn
            $result = $db->getList($select);
            // B4: trả về kết quả
            return $result;
        }        

        /**
         * Phương thức thêm 1 hóa đơn chi tiết vào bảng orderDetail
         */
        function insertSingle(
        $customerId,
        $customerName,
        $customerEmail,
        $customerAddress,
        $customerPhone,
        $total,
        $voucherCode,
        $payment,
        $paymentInfo,
        $message,
        $security,
        $status)
        {
            // B1: Kết nối database
            $db=new connect();
            // B2: yêu cầu insert vào database
            $query="INSERT INTO
             `orders`(
                `id`, 
                `customer_id`, 
                `customer_name`, 
                `customer_email`, 
                `customer_address`, 
                `customer_phone`, 
                `total`, 
                `voucher_code`,
                `payment`, 
                `payment_info`, 
                `message`, 
                `security`,
                `status`) 
                VALUES (
                Null,
                :customerId,
                :customerName,
                :customerEmail,
                :customerAddress,
                :customerPhone,
                :total,
                :voucherCode,
                :payment,
                :paymentInfo,
                :message,
                :security,
                :status)
                ";

            $stm=$db->execP($query);
            $stm->bindParam(':customerId',$customerId);
            $stm->bindParam(':customerName',$customerName);
            $stm->bindParam(':customerEmail',$customerEmail);
            $stm->bindParam(':customerAddress',$customerAddress);
            $stm->bindParam(':customerPhone',$customerPhone);
            $stm->bindParam(':total',$total);
            $stm->bindParam(':voucherCode',$voucherCode);
            $stm->bindParam(':payment',$payment);
            $stm->bindParam(':paymentInfo',$paymentInfo);
            $stm->bindParam(':message',$message);
            $stm->bindParam(':security',$security);
            $stm->bindParam(':status',$status);
            $stm->execute();
        }

        function deleteSingle($id) {
            // B1: Kết nối database
            $db = new connect();
            // B2: Yêu cầu truy vấn
            $query = "DELETE FROM `orders` WHERE `id` = $id";
            // B3: Thực thi truy vấn
            $db->exec($query);
        }

        function updateStatus($id,$status){
            // B1: Kết nối database
            $db = new connect();
            // B2: Yêu cầu truy vấn
            $query = "UPDATE `orders` SET `status`= :status WHERE `id`= :id";
            // B3: Thực thi truy vấn
            $stm = $db->execP($query);
            $stm->bindParam(':id',$id);
            $stm->bindParam(':status',$status);
            $stm->execute();

        }
}
?>