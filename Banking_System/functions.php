<?php

function calculateDeposit($openingBalance, $transactionAmount)
{
    return $openingBalance + $transactionAmount;
}

function calculateWithdrawal($openingBalance, $transactionAmount)
{
    return $openingBalance - $transactionAmount;
}

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

function calculateTotalCharges($transactionFee)
{
    return $transactionFee;
}

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


function calculateFutureBalance($finalBalance, $interest, $duration = 1)
{
    return $finalBalance + $interest;
}

?>