 

<?php
$servername = "localhost:3309";  // Tên máy chủ, mặc định là localhost
$username = "root";         // Tên người dùng MySQL
$password = "";             // Mật khẩu MySQL, nếu có
$dbname = "quanlyhoc_db";  // Tên cơ sở dữ liệu bạn muốn kết nối

// Tạo kết nối
$connec = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($connec->connect_error) {
  die("Kết nối thất bại: " . $connec->connect_error);
}
echo "Kết nối thành công";

?>
