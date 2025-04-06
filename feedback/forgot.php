<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'feedback_system';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ""; // result message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_username = $_POST['current_username']; // Get current username
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];

    $sql = "UPDATE users SET username=?, password=? WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $new_username, $new_password, $current_username); // Pass 3 variables

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        $message = "✅ Username and password updated successfully!";
        header("Location: login.html");
        exit();
    } else {
        $message = "❌ Update failed. Please check the current username.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update Username/Password</title>
  <style>
    body {
      background-color: #f7f9fc;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .form-box {
      background-color: #fff;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
    }

    label {
      font-weight: bold;
      display: block;
      margin-top: 15px;
      color: #555;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 16px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      width: 100%;
      margin-top: 25px;
      background-color: #007bff;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #0056b3;
    }

    .message {
      text-align: center;
      margin-bottom: 15px;
      font-weight: bold;
      color: #d9534f;
    }
    .message.success {
      color: #28a745;
    }
    
  </style>
</head>
<body>
  <div class="form-box">
    <h2>Change Your Login Details</h2>

    <?php if (!empty($message)) {
      $msg_class = (str_starts_with($message, "✅")) ? "success" : "";
      echo "<p class='message $msg_class'>$message</p>";
    } ?>

    <form method="POST" action="">
      <label>Current Username:</label>
      <input type="text" name="current_username" required>

      <label>New Username:</label>
      <input type="text" name="new_username" required>

      <label>New Password:</label>
      <input type="password" name="new_password" required>

      <input type="submit" value="Update">
    </form>
  </div>
</body>
</html>
