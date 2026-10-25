
<?php

// Calculate gross salary
function calculateGrossSalary($basicSalary, $allowance)
{
    return $basicSalary + $allowance;
}

// Calculate net salary after adding bonus and subtracting deduction
function calculateNetSalary($grossSalary, $bonus, $deduction)
{
    return $grossSalary + $bonus - $deduction;
}

// Calculate employee bonus
function calculateBonus($basicSalary)
{
    if ($basicSalary >= 1000) {
        return $basicSalary * 0.10;
    } elseif ($basicSalary >= 500) {
        return $basicSalary * 0.05;
    } else {
        return 0;
    }
}

// Check salary category
function checkSalaryStatus($netSalary)
{
    if ($netSalary >= 1500) {
        return "High Salary";
    } elseif ($netSalary >= 800) {
        return "Medium Salary";
    } else { 
        yes may name is sumaya elmi farax i wamt to tak about assigment avout html css and php 
        i need to help this assigmnet 
        ka shaqe asisgment adigo ka dhigayo biggener friendly sida 2dii hore 
        marka hore samee structure folder kadib file walba  code kiisa isii raac instruction asosgmen4
        return "Low Salary";
    }
}

?>
