<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My PHP Website</title>
</head>
<body>

    <?php
        // Echo - Display the output with line break
        echo "<h1> welcome home page php </h1> <br>";
        // use prenthesis is optional
        echo("hi sumaya <br>");

        // Echo to display argument without parenthesis
        echo "sumaya", "elmi <br>";

        // Disabled print code with multiple parameters (syntax error example)
        //    print "ca233","semert7";

        // Disabled nested echo code example
        //    echo ( echo "sumaya","elmi") ;

        // Variables and Output
        $fullname = "zuu , elmi";
        echo "my name is $fullname <br>";

                // Using built-in function to count words
        $my_str = "welcome to php";
        echo "tirada string waa ", str_word_count($my_str), "<br>";


?>


                   
  
</body>
</html>




/// next






Haye 😊 Waxaan kuu diyaarinayaa Assignment 4: Banking Account and Transaction Management System step by step, sida assignments-kii Student iyo Employee.

Assignment-kan wuxuu leeyahay 3 file oo PHP/HTML ah iyo folder-ka documents-ka.

## Project Structure

Banking_System

index.html

Banking Form

functions.php

8 PHP Functions

process.php

Validation, upload, receipt

uploads/

Customer documents

Project path-ka:

```
C:\myxampp\htdocs\exp1\Banking_System
```

Waxyaabaha assignment-ka cusub muhiimka u ah:

- Deposit iyo Withdrawal.
- Transaction fee: deposit = $0, withdrawal ka yar $500 = $2, withdrawal $500 ama ka badan = $5.
- Interest: Savings 3%, Current 5%, Business 2%.
- Account status: $5,000+ High, $1,000–$4,999.99 Medium, wax ka yar $1,000 Low.
- Future balance: final balance + simple interest.
- File upload: ugu badnaan 2 MB, file hore oo isku magac ah lama overwrite-gareynayo.

Waxaa kale oo muhiim ah in assignment-kan uu mamnuucayo `trim()`, `htmlspecialchars()`, `basename()`, `is_numeric()` iyo type casting. Code-ka waxaan ku ilaalinayaa shuruudahaas.

## Step 1: Samee `index.html`

Form-kan wuxuu qaadanayaa customer information, account type, transaction iyo identification document.

```

<!DOCTYPE html>
<html>
<head>
    <title>Banking Account System</title>

    <style>
        body {
            font-family: Arial;
            background-color: #f2f2f2;
        }

        form {
            width: 400px;
            margin: auto;
            background-color: white;
            padding: 20px;
            border: 1px solid gray;
        }

        h2 {
            text-align: center;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
        }

        button {
            padding: 10px;
            margin-top: 10px;
        }
    </style>
</head>

<body>

    <h2>Banking Account Form</h2>

    <form action="process.php" method="POST"
          enctype="multipart/form-data">

        <!-- Customer Name -->
        <label>Customer Full Name:</label>
        <input type="text" name="customer_name">
        <br><br>

        <!-- Account Number -->
        <label>Account Number:</label>
        <input type="text" name="account_number">
        <br><br>

        <!-- Gender -->
        <label>Gender:</label>
        <input type="radio" name="gender" value="Male"> Male
        <input type="radio" name="gender" value="Female"> Female
        <br><br>

        <!-- Account Type -->
        <label>Account Type:</label>
        <select name="account_type">
            <option value="">Select Account Type</option>
            <option value="Savings">Savings</option>
            <option value="Current">Current</option>
            <option value="Business">Business</option>
        </select>
        <br><br>

        <!-- Opening Balance -->
        <label>Opening Balance:</label>
        <input type="number" name="opening_balance" min="0" step="any">
        <br><br>

        <!-- Transaction Type -->
        <label>Transaction Type:</label>
        <input type="radio" name="transaction_type" value="Deposit">
        Deposit

        <input type="radio" name="transaction_type" value="Withdrawal">
        Withdrawal
        <br><br>

        <!-- Transaction Amount -->
        <label>Transaction Amount:</label>
        <input type="number" name="transaction_amount" min="0" step="any">
        <br><br>

        <!-- Account Duration -->
        <label>Account Duration (Years):</label>
        <input type="number" name="account_duration" min="0" step="1">
        <br><br>

        <!-- Identification Document -->
        <label>Identification Document:</label>
        <input type="file" name="identification_document">
        <br><br>

        <!-- Buttons -->
        <button type="submit">Process Transaction</button>
        <button type="reset">Reset</button>

    </form>

</body>
</html>

```

### Step 1 waxa uu qabtaa

- `POST` wuxuu form-ka xogta u gudbiyaa `process.php`.
- `multipart/form-data` wuxuu oggolaanayaa document upload.
- Account Type wuxuu leeyahay Savings, Current iyo Business.
- Transaction Type wuxuu leeyahay Deposit iyo Withdrawal.
- Reset wuxuu nadiifinayaa form-ka.

## Step 2: `functions.php`

Waxaan samaynaynaa 8 functions:

1. `calculateDeposit()`
2. `calculateWithdrawal()`
3. `calculateTransactionFee()`
4. `calculateInterest()`
5. `calculateTotalCharges()`
6. `calculateFinalBalance()`
7. `checkAccountStatus()`
8. `calculateFutureBalance()`

Halkan waa code-ka functions-ka:

```

<?php

// Add deposit amount to opening balance
function calculateDeposit($openingBalance, $transactionAmount)
{
    return $openingBalance + $transactionAmount;
}

// Subtract withdrawal amount from opening balance
function calculateWithdrawal($openingBalance, $transactionAmount)
{
    return $openingBalance - $transactionAmount;
}

// Calculate transaction fee
function calculateTransactionFee($transactionType, $transactionAmount)
{
    if ($transactionType == "Deposit") {
        return 0;
    } elseif ($transactionType == "Withdrawal"
        && $transactionAmount < 500) {
        return 2;
    } elseif ($transactionType == "Withdrawal"
        && $transactionAmount >= 500) {
        return 5;
    } else {
        return 0;
    }
}

// Calculate simple interest based on account type
function calculateInterest($finalBalance, $accountType, $duration)
{
    if ($accountType == "Savings") {
        $rate = 0.03;
    } elseif ($accountType == "Current") {
        $rate = 0.05;
    } elseif ($accountType == "Business") {
        $rate = 0.02;
    } else {
        $rate = 0;
    }

    return $finalBalance * $rate * $duration;
}

// Calculate total banking charges
function calculateTotalCharges($transactionFee)
{
    return $transactionFee;
}

// Calculate final account balance
function calculateFinalBalance(
    $openingBalance,
    $transactionType,
    $transactionAmount,
    $totalCharges
) {
    if ($transactionType == "Deposit") {
        return $openingBalance + $transactionAmount - $totalCharges;
    } elseif ($transactionType == "Withdrawal") {
        return $openingBalance - $transactionAmount - $totalCharges;
    } else {
        return $openingBalance;
    }
}

// Check account balance status
function checkAccountStatus($finalBalance)
{
    if ($finalBalance >= 5000) {
        return "High Balance";
    } elseif ($finalBalance >= 1000) {
        return "Medium Balance";
    } else {
        return "Low Balance";
    }
}

// Calculate future balance
// Default duration is 1 year
function calculateFutureBalance($finalBalance, $interest, $duration = 1)
{
    return $finalBalance + $interest;
}

?>

```

Fiiro gaar ah: `calculateFutureBalance()` wuxuu leeyahay default argument `1`. Function-ka kore wuxuu qaataa interest hore loo xisaabiyey, duration-na wuxuu u hayaa default-ka assignment-ka. Waxaan ka dhigi doonaa in `process.php` uu duration-ka customer-ka ku gudbiyo marka loo baahdo, si projection-ku u isticmaalo sannadaha la geliyey.

## Step 3: `process.php`

File-kan wuxuu:

- Soo qaadanayaa xogta `$_POST`.
- Hubinayaa customer information.
- Xisaabinayaa fee, interest, final balance iyo future balance.
- Hubinayaa document-ka.
- Kaydinayaa document-ka.
- Soo bandhigayaa Banking Transaction Receipt.

```

<?php

// Include banking functions
require_once "functions.php";

// Check form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get customer information
    $customerName = $_POST["customer_name"] ?? "";
    $accountNumber = $_POST["account_number"] ?? "";
    $gender = $_POST["gender"] ?? "";
    $accountType = $_POST["account_type"] ?? "";

    $openingBalance = $_POST["opening_balance"] ?? "";
    $transactionType = $_POST["transaction_type"] ?? "";
    $transactionAmount = $_POST["transaction_amount"] ?? "";
    $accountDuration = $_POST["account_duration"] ?? "";

    // Assume information is valid
    $valid = true;

    echo "<h2>Banking Account System</h2>";

    // Validate customer name
    if (empty($customerName)) {
        echo "Error: Customer name is required.<br>";
        $valid = false;
    }

    // Validate account number
    if (empty($accountNumber)) {
        echo "Error: Account number is required.<br>";
        $valid = false;
    }

    // Validate gender
    if (empty($gender)) {
        echo "Error: Please select gender.<br>";
        $valid = false;
    }

    // Validate account type
    if (empty($accountType)) {
        echo "Error: Please select account type.<br>";
        $valid = false;
    }

    // Validate opening balance
    if ($openingBalance === "" || $openingBalance < 0) {
        echo "Error: Opening balance must be zero or greater.<br>";
        $valid = false;
    }

    // Validate transaction type
    if (empty($transactionType)) {
        echo "Error: Please select transaction type.<br>";
        $valid = false;
    }

    // Validate transaction amount
    if ($transactionAmount === "" || $transactionAmount <= 0) {
        echo "Error: Transaction amount must be greater than zero.<br>";
        $valid = false;
    }

    // Validate account duration
    if ($accountDuration === "" || $accountDuration < 0
        || !ctype_digit($accountDuration)) {

        echo "Error: Duration must be a non-negative whole number.<br>";
        $valid = false;
    }

    // Prepare document information
    $documentName = "";
    $fileType = "";
    $fileSize = 0;
    $temporaryFile = "";

    // Check identification document
    if (!isset($_FILES["identification_document"])
        || $_FILES["identification_document"]["error"] == UPLOAD_ERR_NO_FILE) {

        echo "Error: Please select an identification document.<br>";
        $valid = false;

    } elseif ($_FILES["identification_document"]["error"] != UPLOAD_ERR_OK) {

        echo "Error: Document upload failed.<br>";
        $valid = false;

    } else {

        // Get uploaded document information
        $documentName = $_FILES["identification_document"]["name"];
        $fileType = $_FILES["identification_document"]["type"];
        $fileSize = $_FILES["identification_document"]["size"];
        $temporaryFile = $_FILES["identification_document"]["tmp_name"];

        // Check file size
        if ($fileSize > 2 * 1024 * 1024) {
            echo "Error: Document must not exceed 2 MB.<br>";
            $valid = false;
        }

        // Check whether the document already exists
        if (file_exists(__DIR__ . "/uploads/" . $documentName)) {
            echo "Error: This document already exists. Rename it.<br>";
            $valid = false;
        }
    }

    // Validate transaction information before calculating
    if ($openingBalance !== "" && $openingBalance >= 0
        && $transactionAmount !== "" && $transactionAmount > 0
        && ($transactionType == "Deposit"
        || $transactionType == "Withdrawal")) {

        // Calculate transaction fee
        $transactionFee = calculateTransactionFee(
            $transactionType,
            $transactionAmount
        );

        // Check withdrawal amount and fee
        if ($transactionType == "Withdrawal"
            && $transactionAmount + $transactionFee > $openingBalance) {

            echo "Error: Withdrawal and fee cannot exceed opening balance.<br>";
            $valid = false;
        }

        // Calculate total charges
        $totalCharges = calculateTotalCharges($transactionFee);

        // Calculate final balance
        $finalBalance = calculateFinalBalance(
            $openingBalance,
            $transactionType,
            $transactionAmount,
            $totalCharges
        );

        // Calculate interest
        $interest = calculateInterest(
            $finalBalance,
            $accountType,
            $accountDuration
        );

        // Calculate future balance
        $futureBalance = calculateFutureBalance(
            $finalBalance,
            $interest,
            $accountDuration
        );

        // Check account status
        $accountStatus = checkAccountStatus($finalBalance);

    } else {

        $valid = false;
    }

    // Upload document only when information is valid
    if ($valid == true) {

        if (move_uploaded_file(
            $temporaryFile,
            __DIR__ . "/uploads/" . $documentName
        )) {

            // Display banking receipt
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

