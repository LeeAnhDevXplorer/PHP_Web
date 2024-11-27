
# Tạo Cơ Sở Dữ Liệu QLSV

## 1. Tạo cơ sở dữ liệu và bảng

Đầu tiên, chúng ta tạo cơ sở dữ liệu `QLSV` và các bảng `khoavien` và `sinhvien` như sau:

```sql
-- Tạo cơ sở dữ liệu QLSV
CREATE DATABASE IF NOT EXISTS QLSV;

-- Sử dụng cơ sở dữ liệu QLSV
USE QLSV;

-- Tạo bảng khoavien
CREATE TABLE IF NOT EXISTS khoavien (
    MaKhoaVien INT AUTO_INCREMENT PRIMARY KEY,
    TenKhoaVien VARCHAR(30),
    Phone VARCHAR(10),
    Email VARCHAR(30)
);

-- Tạo bảng sinhvien
CREATE TABLE IF NOT EXISTS sinhvien (
    MaSv INT AUTO_INCREMENT PRIMARY KEY,
    MaKhoaVien INT,
    Lop VARCHAR(10),
    HoTen VARCHAR(30),
    NgaySinh VARCHAR(30),
    FOREIGN KEY (MaKhoaVien) REFERENCES khoavien(MaKhoaVien)
);
```

## 2. Thêm dữ liệu mẫu vào bảng

Sau khi tạo cơ sở dữ liệu và bảng, bạn có thể thêm dữ liệu mẫu cho các khoa và sinh viên như sau:

```sql
-- Thêm dữ liệu vào bảng khoavien
INSERT INTO khoavien (TenKhoaVien, Phone, Email) VALUES
('CNTT', '0123456789', 'cntt@university.edu'),
('Sư phạm Toán', '0123456790', 'sptoan@university.edu'),
('Luật', '0123456791', 'luat@university.edu'),
('Kinh tế', '0123456792', 'kinhte@university.edu'),
('Ngoại ngữ', '0123456793', 'ngoaingu@university.edu');

-- Thêm dữ liệu vào bảng sinhvien
INSERT INTO sinhvien (MaKhoaVien, Lop, HoTen, NgaySinh) VALUES
(1, 'CT1', 'Nguyễn Văn A', '2001-01-01'),
(1, 'CT2', 'Trần Thị B', '2001-02-02'),
(1, 'CT3', 'Lê Văn C', '2001-03-03'),
(2, 'SP1', 'Phạm Minh D', '2001-04-04'),
(2, 'SP2', 'Hoàng Thị E', '2001-05-05'),
(3, 'LU1', 'Vũ Minh F', '2001-06-06'),
(3, 'LU2', 'Nguyễn Thị G', '2001-07-07'),
(4, 'KT1', 'Lý Văn H', '2001-08-08'),
(4, 'KT2', 'Đặng Thị I', '2001-09-09'),
(5, 'NN1', 'Bùi Minh K', '2001-10-10');
```

## Giải thích

- **Cơ sở dữ liệu `QLSV`** chứa hai bảng: `khoavien` và `sinhvien`.
- **Bảng `khoavien`** lưu trữ thông tin về các khoa viện như CNTT, Sư phạm Toán, Luật, Kinh tế, Ngoại ngữ.
- **Bảng `sinhvien`** lưu trữ thông tin về sinh viên thuộc các khoa viện với các trường như `MaSv`, `MaKhoaVien` (khóa ngoại), `Lop`, `HoTen`, và `NgaySinh`.
