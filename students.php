<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "your_database_name";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all students
$sql = "SELECT name, cgpa FROM students";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Students and CGPA</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 18px;
            text-align: left;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>List of Students and their CGPA</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>CGPA</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . htmlspecialchars($row["name"]) . "</td><td>" . htmlspecialchars($row["cgpa"]) . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='2'>No students found</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>
</html>
