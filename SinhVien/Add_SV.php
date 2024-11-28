<?php
include("connect.php");

// Biến để lưu thông báo
$message = "";

// Kiểm tra nếu form đã được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $LopBC = $_POST['LopBC'];
    $HoTen = $_POST['HoTen'];
    $NgaySinh = $_POST['NgaySinh'];
    $DiaChi = $_POST['DiaChi'];
    $MaKhoa = $_POST['MaKhoa'];

    // Câu lệnh SQL để thêm sinh viên
    $sql_insert = "INSERT INTO sinh_vien (LopBC, HoTen, NgaySinh, DiaChi, MaKhoa) VALUES ('$LopBC', '$HoTen', '$NgaySinh', '$DiaChi', '$MaKhoa')";
    $result = $connec->query($sql_insert);
    if ($result) {
        $message = "Thêm sinh viên thành công!";
        // Có thể chuyển hướng về trang danh sách sinh viên sau khi thêm
        header("Location: index.php");
        exit();
    } else {
        $message = "Lỗi: ";
    }
}

// Lấy danh sách khoa để hiển thị trong dropdown
$sql_khoa = "SELECT * FROM khoa_dao_tao";
$result1 = $connec->query($sql_khoa);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sinh Viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .form-container {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #45a049;
        }

        .message {
            text-align: center;
            color: green;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h1>Thêm Sinh Viên</h1>
        <?php if ($message) : ?>
            <div class="message"><?php echo $message; ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="HoTen">Họ và tên</label>
                <input type="text" name="HoTen" required>
            </div>
            <div class="form-group">
                <label for="LopBC">Lớp</label>
                <input type="text" name="LopBC" required>
            </div>
            <div class="form-group">
                <label for="NgaySinh">Ngày sinh</label>
                <input type="date" name="NgaySinh" required>
            </div>
            <div class="form-group">
                <label for="DiaChi">Địa chỉ</label>
                <input type="text" name="DiaChi" required>
            </div>
            <div class="form-group">
                <label for="MaKhoa">Khoa</label>
                <select name="MaKhoa" required>
                    <option value="">Chọn khoa</option>
                    <?php while ($row = $result1->fetch_assoc()) : ?>
                        <option value="<?php echo $row['MaKhoa']; ?>"> <?= $row['TenKhoa'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <button type="submit">Thêm</button>
            </div>
        </form>
    </div>

</body>

</html>