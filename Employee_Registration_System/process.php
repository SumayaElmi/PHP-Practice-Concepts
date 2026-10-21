
<?php

// Include the salary functions
require_once "functions.php";

// Check whether the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get employee information from the form
    $employeeName = trim($_POST["employee_name"] ?? "");
    $employeeID = trim($_POST["employee_id"] ?? "");
    $gender = $_POST["gender"] ?? "";
    $department = $_POST["department"] ?? "";

    $basicSalary = $_POST["basic_salary"] ?? "";
    $allowance = $_POST["allowance"] ?? "";
    $deduction = $_POST["deduction"] ?? "";

    // Assume the information is valid
    $valid = true;

    echo "<h2>Employee Registration System</h2>";

    // Validate employee name
    if (empty($employeeName)) {
        echo "Error: Employee name is required.<br>";
        $valid = false;
    }

    // Validate employee ID
    if (empty($employeeID)) {
        echo "Error: Employee ID is required.<br>";
        $valid = false;
    }

    // Validate gender
    if (empty($gender)) {
        echo "Error: Please select gender.<br>";
        $valid = false;
    }

    // Validate department
    if (empty($department)) {
        echo "Error: Please select department.<br>";
        $valid = false;
    }

    // Validate basic salary
    if ($basicSalary === "" || !is_numeric($basicSalary)
        || $basicSalary <= 0) {

        echo "Error: Basic salary must be greater than zero.<br>";
        $valid = false;
    }

    // Validate allowance
    if ($allowance === "" || !is_numeric($allowance)
        || $allowance < 0) {

        echo "Error: Allowance is required and cannot be negative.<br>";
        $valid = false;
    }

    // Validate deduction
    if ($deduction === "" || !is_numeric($deduction)
        || $deduction < 0) {

        echo "Error: Deduction is required and cannot be negative.<br>";
        $valid = false;
    }

    // Prepare document information
    $documentName = "";
    $fileType = "";
    $fileSize = 0;

    // Check whether a document was selected
    if (!isset($_FILES["employee_document"])
        || $_FILES["employee_document"]["error"] == UPLOAD_ERR_NO_FILE) {

        echo "Error: Please select an employee document.<br>";
        $valid = false;

    } elseif ($_FILES["employee_document"]["error"] != UPLOAD_ERR_OK) {

        echo "Error: Document upload failed.<br>";
        $valid = false;

    } else {

        // Get the uploaded document information
        $documentName = basename($_FILES["employee_document"]["name"]);
        $fileType = $_FILES["employee_document"]["type"];
        $fileSize = $_FILES["employee_document"]["size"];

        // Check document size (maximum 2 MB)
        if ($fileSize > 2 * 1024 * 1024) {
            echo "Error: Document must not exceed 2 MB.<br>";
            $valid = false;
        }

        // Check whether the same file name already exists
        if (file_exists(__DIR__ . "/uploads/" . $documentName)) {
            echo "Error: This document already exists. Rename the file.<br>";
            $valid = false;
        }
    }

    // Calculate salaries only when salary inputs are valid
    if (is_numeric($basicSalary) && $basicSalary > 0
        && is_numeric($allowance) && $allowance >= 0
        && is_numeric($deduction) && $deduction >= 0) {

        $grossSalary = calculateGrossSalary(
            $basicSalary,
            $allowance
        );

        $bonus = calculateBonus($basicSalary);

        // Check deduction against gross salary plus bonus
        if ($deduction > $grossSalary + $bonus) {
            echo "Error: Deduction cannot exceed gross salary plus bonus.<br>";
            $valid = false;
        }

    } else {
        $valid = false;
    }

    // Upload the document and display results if validation passes
    if ($valid == true) {

        if (move_uploaded_file(
            $_FILES["employee_document"]["tmp_name"],
            __DIR__ . "/uploads/" . $documentName
        )) {

            // Calculate final salary results
            $netSalary = calculateNetSalary(
                $grossSalary,
                $bonus,
                $deduction
            );

            $salaryStatus = checkSalaryStatus($netSalary);

            echo "<h3>Employee Salary Results</h3>";

            echo "<table border='1' cellpadding='8' cellspacing='0'>";

            echo "<tr><th>Information</th><th>Result</th></tr>";

            echo "<tr><td>Employee Full Name</td><td>"
                . htmlspecialchars($employeeName) . "</td></tr>";

            echo "<tr><td>Employee ID</td><td>"
                . htmlspecialchars($employeeID) . "</td></tr>";

            echo "<tr><td>Gender</td><td>"
                . htmlspecialchars($gender) . "</td></tr>";

            echo "<tr><td>Department</td><td>"
                . htmlspecialchars($department) . "</td></tr>";

            echo "<tr><td>Basic Salary</td><td>"
                . number_format((float)$basicSalary, 2) . "</td></tr>";

            echo "<tr><td>Allowance</td><td>"
                . number_format((float)$allowance, 2) . "</td></tr>";

            echo "<tr><td>Gross Salary</td><td>"
                . number_format($grossSalary, 2) . "</td></tr>";

            echo "<tr><td>Bonus</td><td>"
                . number_format($bonus, 2) . "</td></tr>";

            echo "<tr><td>Deduction</td><td>"
                . number_format((float)$deduction, 2) . "</td></tr>";

            echo "<tr><td>Net Salary</td><td>"
                . number_format($netSalary, 2) . "</td></tr>";

            echo "<tr><td>Salary Status</td><td>"
                . htmlspecialchars($salaryStatus) . "</td></tr>";

            echo "<tr><td>Uploaded Document Name</td><td>"
                . htmlspecialchars($documentName) . "</td></tr>";

            echo "<tr><td>File Type</td><td>"
                . htmlspecialchars($fileType) . "</td></tr>";

            echo "<tr><td>File Size</td><td>"
                . number_format($fileSize / 1024, 2) . " KB</td></tr>";

            echo "<tr><td>Upload Status</td><td>"
                . "Upload Successful" . "</td></tr>";

            echo "</table>";

        } else {

            echo "Error: Failed to save the document. Check the uploads folder.";

        }git status
    }

} else {

    echo "Please submit the employee registration form first.";

}

?>
