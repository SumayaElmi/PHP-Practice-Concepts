<?php

require_once "functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $name = trim($_POST["student_name"] ?? "");
    $studentID = trim($_POST["student_id"] ?? "");
    $gender = $_POST["gender"] ?? "";
    $faculty = $_POST["faculty"] ?? "";

    $phpMark = $_POST["php_mark"] ?? "";
    $databaseMark = $_POST["database_mark"] ?? "";
    $networkingMark = $_POST["networking_mark"] ?? "";

    $valid = true;

    echo "<h2>Student Grade Management System</h2>";

  
    if (empty($name)) {
        echo "Error: Student name is required.<br>";
        $valid = false;
    }


    if (empty($studentID)) {
        echo "Error: Student ID is required.<br>";
        $valid = false;
    }


    if (empty($gender)) {
        echo "Error: Please select gender.<br>";
        $valid = false;
    }

  
    if (empty($faculty)) {
        echo "Error: Please select faculty.<br>";
        $valid = false;
    }

 
    if ($phpMark === "" || !is_numeric($phpMark)
        || $phpMark < 0 || $phpMark > 100) {

        echo "Error: PHP mark must be between 0 and 100.<br>";
        $valid = false;
    }

  
    if ($databaseMark === "" || !is_numeric($databaseMark)
        || $databaseMark < 0 || $databaseMark > 100) {

        echo "Error: Database mark must be between 0 and 100.<br>";
        $valid = false;
    }


    if ($networkingMark === "" || !is_numeric($networkingMark)
        || $networkingMark < 0 || $networkingMark > 100) {

        echo "Error: Networking mark must be between 0 and 100.<br>";
        $valid = false;
    }

    $certificateName = "";
    $fileType = "";
    $fileSize = 0;

    if (!isset($_FILES["certificate"])
        || $_FILES["certificate"]["error"] == UPLOAD_ERR_NO_FILE) {

        echo "Error: Please select a certificate.<br>";
        $valid = false;

    } elseif ($_FILES["certificate"]["error"] != UPLOAD_ERR_OK) {

        echo "Error: Certificate upload failed.<br>";
        $valid = false;

    } else {

        $certificateName = basename($_FILES["certificate"]["name"]);
        $fileType = $_FILES["certificate"]["type"];
        $fileSize = $_FILES["certificate"]["size"];

        if ($fileSize > 2 * 1024 * 1024) {
            echo "Error: Certificate must not exceed 2 MB.<br>";
            $valid = false;
        }

        if (file_exists("uploads/" . $certificateName)) {
            echo "Error: This file name already exists. Rename the file.<br>";
            $valid = false;
        }
    }

    if ($valid == true) {

        if (move_uploaded_file(
            $_FILES["certificate"]["tmp_name"],
            "uploads/" . $certificateName
        )) {

            echo "<h3>Student Examination Results</h3>";

            $total = calculateTotal(
                $phpMark,
                $databaseMark,
                $networkingMark
            );

            $average = calculateAverage($total);
            $grade = calculateGrade($average);
            $result = checkResult($average);

            echo "<table border='1' cellpadding='8' cellspacing='0'>";

            echo "<tr><th>Information</th><th>Result</th></tr>";

            echo "<tr><td>Student Full Name</td><td>"
                . htmlspecialchars($name) . "</td></tr>";

            echo "<tr><td>Student ID</td><td>"
                . htmlspecialchars($studentID) . "</td></tr>";

            echo "<tr><td>Gender</td><td>"
                . htmlspecialchars($gender) . "</td></tr>";

            echo "<tr><td>Faculty</td><td>"
                . htmlspecialchars($faculty) . "</td></tr>";

            echo "<tr><td>PHP Mark</td><td>"
                . htmlspecialchars((string)$phpMark) . "</td></tr>";

            echo "<tr><td>Database Mark</td><td>"
                . htmlspecialchars((string)$databaseMark) . "</td></tr>";

            echo "<tr><td>Networking Mark</td><td>"
                . htmlspecialchars((string)$networkingMark) . "</td></tr>";

            echo "<tr><td>Total Marks</td><td>"
                . $total . "</td></tr>";

            echo "<tr><td>Average Marks</td><td>"
                . number_format($average, 2) . "</td></tr>";

            echo "<tr><td>Grade</td><td>"
                . $grade . "</td></tr>";

            echo "<tr><td>Pass or Fail</td><td>"
                . $result . "</td></tr>";

            echo "<tr><td>Certificate Name</td><td>"
                . htmlspecialchars($certificateName) . "</td></tr>";

            echo "<tr><td>File Type</td><td>"
                . htmlspecialchars($fileType) . "</td></tr>";

            echo "<tr><td>File Size</td><td>"
                . number_format($fileSize / 1024, 2) . " KB</td></tr>";

            echo "<tr><td>Upload Status</td><td>"
                . "Upload Successful" . "</td></tr>";

            echo "</table>";

        } else {

            echo "Error: Failed to save the certificate.";

        }
    }

} else {

    echo "Please submit the student information form first.";

}

?>