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

// Check if the required parameters are present
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'add' && isset($_GET['name']) && isset($_GET['cgpa'])) {
        $name = $_GET['name'];
        $cgpa = floatval($_GET['cgpa']);

        // Insert student data into the database
        $sqlInsert = "INSERT INTO students (name, cgpa) VALUES (?, ?)";
        $stmt = $conn->prepare($sqlInsert);
        $stmt->bind_param("sd", $name, $cgpa);

        if ($stmt->execute()) {
            echo "Student data has been successfully added.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } elseif ($action == 'list') {
        // Fetch all students from the database
        $sqlSelect = "SELECT name, cgpa FROM students";
        $result = $conn->query($sqlSelect);

        if ($result->num_rows > 0) {
            echo "<h1>List of Students and their CGPA</h1>";
            echo "<table border='1'>";
            echo "<tr><th>Name</th><th>CGPA</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . htmlspecialchars($row['name']) . "</td><td>" . htmlspecialchars($row['cgpa']) . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No students found.";
        }
    } else {
        echo "Error: Invalid action or missing parameters.";
    }
} else {
    echo "Error: Action parameter is required.";
}

$conn->close();
?>
