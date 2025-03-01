<?php
$host = '127.0.0.1';
$dbname = 'web_tracuu';  // Thay bằng tên cơ sở dữ liệu của bạn
$username = 'root';  // Tên người dùng MySQL (thường là root)
$password = '';  // Mật khẩu của tài khoản MySQL (nếu không có mật khẩu, để trống)

// Kết nối tới cơ sở dữ liệu
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Kết nối thành công!";
} catch (PDOException $e) {
    echo "Kết nối thất bại: " . $e->getMessage();
    die();
}
?>
