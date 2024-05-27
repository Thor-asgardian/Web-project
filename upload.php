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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $fileName = $_FILES["file"]["tmp_name"];

    if ($_FILES["file"]["size"] > 0) {
        $file = fopen($fileName, "r");

        // Read the file line by line and insert into database
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $name = $column[0];
            $cgpa = $column[1];

            $sqlInsert = "INSERT INTO students (name, cgpa) VALUES (?, ?)";
            $stmt = $conn->prepare($sqlInsert);
            $stmt->bind_param("sd", $name, $cgpa);
            $stmt->execute();
        }

        fclose($file);

        echo "CSV file has been successfully imported.";
    } else {
        echo "Error: File is empty.";
    }
} else {
    echo "Error: Please upload a valid CSV file.";
}

$conn->close();
?>
