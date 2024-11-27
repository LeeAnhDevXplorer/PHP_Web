<?php
include("connect.php");

// Kiểm tra xem có mã sinh viên trong URL không 
if (isset($_GET['MaSv'])) {
    $MaSv = $_GET['MaSv'];

    // Câu lệnh SQL để xóa sinh viên
    $sql_delete = "DELETE FROM sinh_vien WHERE MaSv = ?";
    $stmt_delete = $connec->prepare($sql_delete);
    $stmt_delete->bind_param("i", $MaSv);

    if ($stmt_delete->execute()) {
        header("Location: index.php?message=Xóa thành công");
        exit();
    } else {
        echo "Lỗi: " . $stmt_delete->error;
    }
} else {
    echo "Mã sinh viên không hợp lệ.";
}
?>
