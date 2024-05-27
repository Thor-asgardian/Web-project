<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Function to convert letter grades to grade points
    function gradeToPoint($grade) {
        $grade = strtoupper(trim($grade));
        switch ($grade) {
            case 'A+': return 4.0;
            case 'A': return 4.0;
            case 'A-': return 3.7;
            case 'B+': return 3.3;
            case 'B': return 3.0;
            case 'B-': return 2.7;
            case 'C+': return 2.3;
            case 'C': return 2.0;
            case 'C-': return 1.7;
            case 'D+': return 1.3;
            case 'D': return 1.0;
            case 'F': return 0.0;
            default: return 0.0;
        }
    }

    // Retrieve and process input data
    $grades = explode(',', $_POST['grades']);
    $credits = explode(',', $_POST['credits']);

    // Validate that the number of grades matches the number of credits
    if (count($grades) != count($credits)) {
        die("Error: The number of grades does not match the number of credits.");
    }

    $totalPoints = 0;
    $totalCredits = 0;

    // Calculate total grade points and total credits
    for ($i = 0; $i < count($grades); $i++) {
        $gradePoint = gradeToPoint($grades[$i]);
        $credit = floatval(trim($credits[$i]));
        $totalPoints += $gradePoint * $credit;
        $totalCredits += $credit;
    }

    // Calculate GPA
    $gpa = $totalCredits > 0 ? $totalPoints / $totalCredits : 0;

    // Display the result
    echo "<h1>Your GPA is: " . number_format($gpa, 2) . "</h1>";
}
?>
