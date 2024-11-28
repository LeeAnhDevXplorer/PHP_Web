<?php
include("connect.php");

$search = "";
if (isset($_POST['search'])) {
  $search = $_POST['search'];
}

// Sử dụng prepared statement để bảo vệ khỏi SQL Injection
$sql = "SELECT * from sinhvien as sv join khoavien as k on sv.MaKhoaVien = k.MaKhoaVien WHERE sv.HoTen LIKE ?";
$stmt = $connec->prepare($sql);
$search_param = "%$search%";
$stmt->bind_param("s", $search_param);
$stmt->execute();
$result = $stmt->get_result();

if (isset($_GET['MaSv'])) {
  $MaSv = $_GET['MaSv'];

  // Câu lệnh SQL để xóa sinh viên
  $sql_delete = "DELETE FROM sinhvien WHERE MaSv = $MaSv";
  $result = $connec->query($sql_delete);
  if ($result) {
    header("Location: index.php?message=Xóa thành công");
    exit();
  } else {
    echo "Lỗi: ";
  }
}

// // Kiểm tra nếu người dùng nhấn "Sửa"
// if (isset($_GET['MaSv'])) {
//   $editingMaSv = $_GET['MaSv'];

//   // Lấy thông tin của sinh viên để chỉnh sửa
//   $sql_edit = "SELECT * FROM sinh_vien WHERE MaSv = ?";
//   $stmt_edit = $connec->prepare($sql_edit);
//   $stmt_edit->bind_param("i", $editingMaSv);
//   $stmt_edit->execute();
//   $edit_result = $stmt_edit->get_result();

//   if ($edit_result->num_rows > 0) {
//     $row = $edit_result->fetch_assoc();
//     $editingLopBC = $row['LopBC'];
//     $editingHoTen = $row['HoTen'];
//     $editingNgaySinh = $row['NgaySinh'];
//     $editingDiaChi = $row['DiaChi'];
//     $editingMaKhoa = $row['MaKhoa'];
//   }
// }

// // Kiểm tra nếu form cập nhật được gửi
// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['MaSv'])) {
//   $MaSv = $_POST['MaSv'];
//   $LopBC = $_POST['LopBC'];
//   $HoTen = $_POST['HoTen'];
//   $NgaySinh = $_POST['NgaySinh'];
//   $DiaChi = $_POST['DiaChi'];
//   $MaKhoa = $_POST['MaKhoa'];

//   // Kiểm tra dữ liệu nhập vào
//   if (empty($MaSv) || empty($LopBC) || empty($HoTen) || empty($NgaySinh) || empty($DiaChi) || empty($MaKhoa)) {
//     echo "Tất cả các trường đều phải được điền.";
//   } else {
//     // Câu lệnh SQL để cập nhật dữ liệu
//     $sql_update = "UPDATE sinh_vien SET LopBC=?, HoTen=?, NgaySinh=?, DiaChi=?, MaKhoa=? WHERE MaSv=?";

//     $stmt_update = $connec->prepare($sql_update);
//     $stmt_update->bind_param("sssisi", $LopBC, $HoTen, $NgaySinh, $DiaChi, $MaKhoa, $MaSv);


//     if ($stmt_update->execute()) {
//       header("Location: index.php");
//       exit();
//     } else {
//       echo "Lỗi: " . $stmt_update->error;
//     }
//   }
// }

// // Lấy danh sách khoa để hiển thị trong dropdown
// $sql_khoa = "SELECT * FROM khoa_dao_tao";
// $stmt_khoa = $connec->prepare($sql_khoa);
// $stmt_khoa->execute();
// $khoa_result = $stmt_khoa->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Danh sách Sinh Viên</title>
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
      max-width: 600px;
      margin: 20px auto;
      background: white;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: #f4f4f4;
    }

    .link {
      padding: 10px;
      margin-bottom: 10px;
      background: #4CAF50;
      color: white;
      text-align: center;
      border-radius: 5px;
      cursor: pointer;
    }

    .link a {
      color: white;
      text-decoration: none;
    }

    .search-container {
      margin-bottom: 20px;
    }

    .search-input {
      padding: 10px;
      width: calc(100% - 100px);
    }

    .search-button {
      padding: 10px;
    }

    /* Styles for the edit form inside the table */
    .edit-form {
      display: flex;
      flex-direction: column;
    }

    .edit-form input,
    .edit-form select {
      padding: 5px;
      margin-bottom: 10px;
    }

    .edit-form button {
      background-color: #4CAF50;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .edit-form button:hover {
      background-color: #45a049;
    }
  </style>
</head>

<body>
  <h1>Danh sách Sinh Viên</h1>

  <!-- Form tìm kiếm -->
  <div class="search-container">
    <form method="POST" action="">
      <input type="text" name="search" placeholder="Tìm kiếm theo tên sinh viên" value="<?php echo htmlspecialchars($search); ?>" class="search-input">
      <button type="submit" class="search-button">Tìm kiếm</button>
    </form>
  </div>

  <div class="link">
    <a href="Add_SV.php" style="color:white;">Thêm Sinh Viên</a>
  </div>

  <table>
    <thead>
      <tr>
        <th>Mã SV</th>
        <th>Lớp</th>
        <th>Họ Tên</th>
        <th>Ngày Sinh</th>
        <th>Tên Khoa</th>
        <th>Hành Động</th>
      </tr>
    </thead>
    <php>
      <?php if ($result->num_rows > 0) : ?>
        <?php while ($row = $result->fetch_assoc()) : ?>
          <tr>
            <td><?= $row["MaSv"] ?></td>
            <td><?= $row["Lop"] ?></td>
            <td><?= $row["HoTen"] ?></td>
            <td><?= $row["NgaySinh"] ?></td>
            <td><?= $row["TenKhoaVien"] ?></td>
            <td><a href="">Sửa</a>
              <a href="index.php?MaSv=<?= $row["MaSv"] ?>">Xóa</a>
            </td>
          </tr>
        <?php endwhile ?>
      <?php endif ?>
    </php>
  </table>
</body>

</html>