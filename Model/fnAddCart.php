<?php
    /**
     * Hàm thêm sản phẩm vào giỏ hàng
     * @param int $productId : Mã sản phẩm
     * @param int $quantity  : Số lượng sản phẩm
     * @return void
     */
    function fnAddCart($productId,$quantity)
    {
        if(isset($_SESSION['cart'][$productId])){
            $product = new Product();
            $result = $product->selectSingle($productId);
            if($result['quantity'] >= $_SESSION['cart'][$productId]['quantity'] + $quantity){
                $_SESSION['cart'][$productId]['quantity'] += $quantity;
            }
            else echo '<script>alert("Cửa hàng không còn đủ sản phẩm này!")</script>';
        }
        else {
            //Lấy thông tin sản phẩm
            $product = new Product();
            $result = $product->selectSingle($productId);
            if($result['quantity'] > 0) {
                // Đặt biến lưu thông tin sản phẩm
                $name        = $result['name'];
                $price       = $result['price'];
                $discount    = $result['discountPercent'];
                $image       = $result['image'];
                $category    = $result['category_id'];
                $color       = $result['color'];
                $size        = $result['size'];
                $description = $result['description'];
                //Tính tổng tiền
                $total = ($price * (1-$discount))*$quantity;
                // Tạo đối tượng cho sản phẩm
                $item=array(
                    'productId'   => $productId,
                    'name'        => $name,
                    'price'       => $price,
                    'discount'    => $discount,
                    'image'       => $image,
                    'category'    => $category,
                    'color'       => $color,
                    'size'        => $size,
                    'description' => $description,
                    'quantity'    => $quantity,
                    'total'       => $total 
                );
                // Lưu đối tượng vào giỏ hàng
                $_SESSION['cart'][$productId] = $item;
            }
            else echo '<script>alert("Cửa hàng không còn đủ sản phẩm này!")</script>';
        }
    }
?>