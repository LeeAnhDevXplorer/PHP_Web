<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = htmlspecialchars($_POST['username']);
  setcookie("username", $username, time() + 3600, "/");
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #e9ecef;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .welcome-container {
      background-color: #ffffff;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
    }

    h2 {
      color: #007bff;
    }

    a {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background-color: #dc3545;
      color: white;
      text-decoration: none;
      border-radius: 4px;
    }

    a:hover {
      background-color: #c82333;
    }
  </style>
</head>

<body>
  <div class="welcome-container">
    <h2>Chào mừng, <?php echo isset($username) ? $username : "Khách"; ?>!</h2>
    <a href="clearcookie.php">Đăng xuất</a>
  </div>
</body>

</html>