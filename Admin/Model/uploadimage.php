<?php
function uploadImage($dir)
{
  // B1: Thư mục chứa hình:
  // $target_dir = "../assets/img/products/";
  $target_dir = $dir;

  // B2: lấy tên file lưu trên server để đưa vào thư mục chứa img
  $target_file = $target_dir . basename($_FILES["txtimage"]["name"]);

  // B3: lấy phần mở rộng của hình ra và đổi về dạng chữ in hoa hoặc thường
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  
  // B4: kiểm tra khi người dùng nhấn nút submit thì hình có được upload lên server hay không ?

  // đặt cờ để đánh dấu có hình
  $uploadimage = 1;
  // if (isset($_POST['submit'])) {
  //   $check = getimagesize($_FILES["txtimage"]["tmp_name"]);
  //   if ($check != false) {
  //     $uploadimage = 1;
  //   } else {
  //     echo "Hình này ko có";
  //     $uploadimage = 0;
  //   }
  // }

  // // kiểm tra file này có tồn tại hay chưa
  // if (file_exists($target_file)) {
  //   $uploadimage = 0;
  // }

  // // kiểm tra kích thước hình vượt quá 500KB hay không?
  // if ($_FILES["txtimage"]["size"] > 500000) {
  //   echo "Hình vượt dung lượng";
  //   $uploadimage = 0;
  // }

  // kiểm tra hình up lên có phìa là jpg, png, gif, jpeg
  // if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
  //   echo " Hình ko đúng định dạng";
  //   $uploadimage = 0;
  // }
  
  // B5: tiến hành upload
  if ($uploadimage == 0) {
  } else { // $uploadimage=1 là ko có bất kỳ lỗi gì
    if (move_uploaded_file($_FILES["txtimage"]["tmp_name"], $target_file)) {
    } else {
    }
  }
}