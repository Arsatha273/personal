<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'feedback_system';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = $_POST['message'];
$message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

$sql = "INSERT INTO feedbacks (message) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $message);

if ($stmt->execute()) {
    echo "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <title>Feedback Received</title>
        <style>
            body {
                background-color: #f2f2f2;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                text-align: center;
                padding-top: 100px;
            }

            .box {
                background-color: #ffffff;
                padding: 40px;
                margin: auto;
                border-radius: 15px;
                max-width: 500px;
                box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            }

            h2 {
                color:purple;
                font-size: 24px;
                margin-bottom: 20px;
            }

            a {
                display: inline-block;
                text-decoration: none;
                background-color: #28a745;
                color: white;
                padding: 10px 20px;
                border-radius: 8px;
                font-size: 16px;
                transition: background-color 0.3s ease;
            }

            a:hover {
                background-color: #218838;
            }
        </style>
    </head>
    <body>
        <div class='box'>
            <h2>🎉 Thanks for your feedback!</h2>
            
        </div>
    </body>
    </html>
    ";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
