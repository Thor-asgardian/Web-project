<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collecting form data using the $_POST superglobal
    $name = htmlspecialchars($_POST['name']);
    $math = (int) $_POST['math'];
    $science = (int) $_POST['science'];
    $english = (int) $_POST['english'];

    // Performing basic validation
    if (!empty($name) && $math >= 0 && $math <= 100 && $science >= 0 && $science <= 100 && $english >= 0 && $english <= 100) {
        // Displaying the input data
        echo "<h1>Student Details</h1>";
        echo "Name: " . $name . "<br>";
        echo "Math Grade: " . $math . "<br>";
        echo "Science Grade: " . $science . "<br>";
        echo "English Grade: " . $english . "<br>";
    } else {
        echo "Invalid input. Please ensure all grades are between 0 and 100.";
    }
} else {
    echo "Invalid request method.";
}
?>
