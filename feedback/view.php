<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'feedback_system';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT message FROM feedbacks";
$result = $conn->query($sql);

echo "<h2>📬 All Feedback Messages</h2>";

echo "
<!DOCTYPE html>
<html lang='en'>
<head>
  <meta charset='UTF-8'>
  <title>All Feedbacks</title>
  <style>
    body {
      background-color: #f0f4f8;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      padding: 40px;
      text-align: center;
    }

    h2 {
      color: purple;
      margin-bottom: 30px;
    }
td {
      color:black;
    }
    th {
    
      color: gray;
    }
      td {
  color: #333;
  word-break: break-word;  /* Breaks long words */
  white-space: pre-wrap;   /* Preserves line breaks */
}

  </style>
</head>
<body>
";

if ($result->num_rows > 0) {
    echo "<table>
            <tr>
                <th>Message</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . nl2br(htmlspecialchars($row["message"])) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No feedbacks yet 😅";
}

echo "
</body>
</html>
";

$conn->close();
?>
