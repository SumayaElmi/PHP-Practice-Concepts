<?php
require_once "functions.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $customerName = $_POST["customer_name"] ?? "";
    $accountNumber = $_POST["account_number"] ?? "";
    $gender = $_POST["gender"] ?? "";
    $accountType = $_POST["account_type"] ?? "";

    $openingBalance = $_POST["opening_balance"] ?? "";
    $transactionType = $_POST["transaction_type"] ?? "";
    $transactionAmount = $_POST["transaction_amount"] ?? "";
    $accountDuration = $_POST["account_duration"] ?? "";

    $valid = true;

    echo "<h2>Banking Account System</h2>";

    if (empty($customerName)) {
        echo "Error: Customer name is required.<br>";
        $valid = false;
    }

    if (empty($accountNumber)) {
        echo "Error: Account number is required.<br>";
        $valid = false;
    }

    if (empty($gender)) {
        echo "Error: Please select gender.<br>";
        $valid = false;
    }

    if (empty($accountType)) {
        echo "Error: Please select account type.<br>";
        $valid = false;
    }

    if ($openingBalance === "" || $openingBalance < 0) {
        echo "Error: Opening balance must be zero or greater.<br>";
        $valid = false;
    }

    if (empty($transactionType)) {
        echo "Error: Please select transaction type.<br>";
        $valid = false;
    }

    if ($transactionAmount === "" || $transactionAmount <= 0) {
        echo "Error: Transaction amount must be greater than zero.<br>";
        $valid = false;
    }

    if ($accountDuration === "" || $accountDuration < 0
        || !ctype_digit($accountDuration)) {

        echo "Error: Duration must be a non-negative whole number.<br>";
        $valid = false;
    }

    $documentName = "";
    $fileType = "";
    $fileSize = 0;
    $temporaryFile = "";

    if (!isset($_FILES["identification_document"])
        || $_FILES["identification_document"]["error"] == UPLOAD_ERR_NO_FILE) {

        echo "Error: Please select an identification document.<br>";
        $valid = false;

    } elseif ($_FILES["identification_document"]["error"] != UPLOAD_ERR_OK) {

        echo "Error: Document upload failed.<br>";
        $valid = false;

    } else {

        $documentName = $_FILES["identification_document"]["name"];
        $fileType = $_FILES["identification_document"]["type"];
        $fileSize = $_FILES["identification_document"]["size"];
        $temporaryFile = $_FILES["identification_document"]["tmp_name"];

        if ($fileSize > 2 * 1024 * 1024) {
            echo "Error: Document must not exceed 2 MB.<br>";
            $valid = false;
        }

        if (file_exists(__DIR__ . "/uploads/" . $documentName)) {
            echo "Error: This document already exists. Rename it.<br>";
            $valid = false;
        }
    }

    if ($openingBalance !== "" && $openingBalance >= 0
        && $transactionAmount !== "" && $transactionAmount > 0
        && ($transactionType == "Deposit"
        || $transactionType == "Withdrawal")) {

        $transactionFee = calculateTransactionFee(
            $transactionType,
            $transactionAmount
        );

        if ($transactionType == "Withdrawal"
            && $transactionAmount + $transactionFee > $openingBalance) {

            echo "Error: Withdrawal and fee cannot exceed opening balance.<br>";
            $valid = false;
        }

        $totalCharges = calculateTotalCharges($transactionFee);

        $finalBalance = calculateFinalBalance(
            $openingBalance,
            $transactionType,
            $transactionAmount,
            $totalCharges
        );

        $interest = calculateInterest(
            $finalBalance,
            $accountType,
            $accountDuration
        );

        $futureBalance = calculateFutureBalance(
            $finalBalance,
            $interest,
            $accountDuration
        );

        $accountStatus = checkAccountStatus($finalBalance);

    } else {

        $valid = false;
    }

    if ($valid == true) {

        if (move_uploaded_file(
            $temporaryFile,
            __DIR__ . "/uploads/" . $documentName
        )) {

            echo "<h2>Banking Transaction Receipt</h2>";

            echo "<table border='1' cellpadding='8' cellspacing='0'>";

            echo "<tr><th>Banking Information</th><th>Value</th></tr>";

            echo "<tr><td>Customer Full Name</td><td>"
                . $customerName . "</td></tr>";

            echo "<tr><td>Account Number</td><td>"
                . $accountNumber . "</td></tr>";

            echo "<tr><td>Gender</td><td>"
                . $gender . "</td></tr>";

            echo "<tr><td>Account Type</td><td>"
                . $accountType . "</td></tr>";

            echo "<tr><td>Opening Balance</td><td>"
                . number_format($openingBalance, 2) . "</td></tr>";

            echo "<tr><td>Transaction Type</td><td>"
                . $transactionType . "</td></tr>";

            echo "<tr><td>Transaction Amount</td><td>"
                . number_format($transactionAmount, 2) . "</td></tr>";

            echo "<tr><td>Transaction Fee</td><td>"
                . number_format($transactionFee, 2) . "</td></tr>";

            echo "<tr><td>Total Banking Charges</td><td>"
                . number_format($totalCharges, 2) . "</td></tr>";

            echo "<tr><td>Final Balance</td><td>"
                . number_format($finalBalance, 2) . "</td></tr>";

            echo "<tr><td>Account Status</td><td>"
                . $accountStatus . "</td></tr>";

            echo "<tr><td>Account Duration</td><td>"
                . $accountDuration . " Years</td></tr>";

            // Display interest rate
            if ($accountType == "Savings") {
                $interestRate = "3%";
            } elseif ($accountType == "Current") {
                $interestRate = "5%";
            } elseif ($accountType == "Business") {
                $interestRate = "2%";
            } else {
                $interestRate = "0%";
            }

            echo "<tr><td>Interest Rate</td><td>"
                . $interestRate . "</td></tr>";

            echo "<tr><td>Calculated Interest</td><td>"
                . number_format($interest, 2) . "</td></tr>";

            echo "<tr><td>Projected Future Balance</td><td>"
                . number_format($futureBalance, 2) . "</td></tr>";

            echo "<tr><td>Document Name</td><td>"
                . $documentName . "</td></tr>";

            echo "<tr><td>File Type</td><td>"
                . $fileType . "</td></tr>";

            echo "<tr><td>File Size</td><td>"
                . $fileSize . " Bytes</td></tr>";

            echo "<tr><td>Upload Status</td><td>"
                . "Successful</td></tr>";

            echo "</table>";

            echo "<br>";

            echo "<a href='index.html'>Back to Banking Form</a>";

        } else {

            echo "Error: Failed to save identification document.";

        }
    }

} else {

    echo "Please submit the banking form first.";

}

?>