
<?php

require "functions.php";

if (isset($_POST["customer_name"])) {

    $customerName = $_POST["customer_name"];
    $accountNumber = $_POST["account_number"];
    $gender = $_POST["gender"];
    $accountType = $_POST["account_type"];

    $openingBalance = $_POST["opening_balance"];
    $transactionType = $_POST["transaction_type"];
    $transactionAmount = $_POST["transaction_amount"];
    $accountDuration = $_POST["account_duration"];

    $valid = true;

    echo "<h2>Banking Account System</h2>";

    // Check customer name
    if (empty($customerName)) {
        echo "Error: Customer name is required.<br>";
        $valid = false;
    }

    // Check account number
    if (empty($accountNumber)) {
        echo "Error: Account number is required.<br>";
        $valid = false;
    }

    // Check gender
    if (empty($gender)) {
        echo "Error: Please select gender.<br>";
        $valid = false;
    }

    // Check account type
    if (empty($accountType)) {
        echo "Error: Please select account type.<br>";
        $valid = false;
    }

    // Check opening balance
    if ($openingBalance == "" || $openingBalance < 0) {
        echo "Error: Opening balance must be zero or greater.<br>";
        $valid = false;
    }

    // Check transaction type
    if (empty($transactionType)) {
        echo "Error: Please select transaction type.<br>";
        $valid = false;
    }

    // Check transaction amount
    if ($transactionAmount == "" || $transactionAmount <= 0) {
        echo "Error: Transaction amount must be greater than zero.<br>";
        $valid = false;
    }

    // Check account duration
    if ($accountDuration == "" || $accountDuration < 0) {
        echo "Error: Duration must be zero or greater.<br>";
        $valid = false;
    }

    // Check identification document
    $documentName = "";
    $fileType = "";
    $fileSize = 0;
    $temporaryFile = "";

    if (isset($_FILES["identification_document"])
        && $_FILES["identification_document"]["name"] != "") {

        $documentName = $_FILES["identification_document"]["name"];
        $fileType = $_FILES["identification_document"]["type"];
        $fileSize = $_FILES["identification_document"]["size"];
        $temporaryFile = $_FILES["identification_document"]["tmp_name"];

        // Check file size (2 MB)
        if ($fileSize > 2 * 1024 * 1024) {
            echo "Error: Document must not exceed 2 MB.<br>";
            $valid = false;
        }

        // Check whether the file already exists
        if (file_exists("uploads/" . $documentName)) {
            echo "Error: This document already exists. Rename it.<br>";
            $valid = false;
        }

    } else {
        echo "Error: Please select an identification document.<br>";
        $valid = false;
    }

    // Calculate transaction information
    if ($valid == true) {

        $transactionFee = calculateTransactionFee(
            $transactionType,
            $transactionAmount
        );

        // Check withdrawal balance
        if ($transactionType == "Withdrawal"
            && $transactionAmount + $transactionFee > $openingBalance) {

            echo "Error: Withdrawal and fee cannot exceed opening balance.<br>";
            $valid = false;
        }

        if ($valid == true) {

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
                $interest
            );

            $accountStatus = checkAccountStatus($finalBalance);

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

            // Upload document
            if (move_uploaded_file(
                $temporaryFile,
                "uploads/" . $documentName
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
                    . $openingBalance . "</td></tr>";

                echo "<tr><td>Transaction Type</td><td>"
                    . $transactionType . "</td></tr>";

                echo "<tr><td>Transaction Amount</td><td>"
                    . $transactionAmount . "</td></tr>";

                echo "<tr><td>Transaction Fee</td><td>"
                    . $transactionFee . "</td></tr>";

                echo "<tr><td>Total Banking Charges</td><td>"
                    . $totalCharges . "</td></tr>";

                echo "<tr><td>Final Balance</td><td>"
                    . $finalBalance . "</td></tr>";

                echo "<tr><td>Account Status</td><td>"
                    . $accountStatus . "</td></tr>";

                echo "<tr><td>Account Duration</td><td>"
                    . $accountDuration . " Years</td></tr>";

                echo "<tr><td>Interest Rate</td><td>"
                    . $interestRate . "</td></tr>";

                echo "<tr><td>Calculated Interest</td><td>"
                    . $interest . "</td></tr>";

                echo "<tr><td>Projected Future Balance</td><td>"
                    . $futureBalance . "</td></tr>";

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
    }

} else {
    echo "Please submit the banking form first.";
}

?>
