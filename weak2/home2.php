<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My PHP Website</title>
</head>
<body>

<?php

// 1. Constant: defines a fixed value.
define("age", 19);
echo age . "<br>";


// 2. If-Else: checks whether the age is 18 or older.
$age = 20;

if ($age >= 18) {
    echo "adult" . "<br>";
} else {
    echo "child" . "<br>";
}


// 3. Switch: checks the student's marks and displays the grade.
$marks = 100;

switch (true) {
    case ($marks >= 90):
        echo "A <br>";
        break;

    case ($marks >= 80):
        echo "B <br>";
        break;

    case ($marks >= 70):
        echo "C <br>";
        break;

    case ($marks >= 60):
        echo "D <br>";
        break;

    default:
        echo "F <br>";
        break;
}


// 4. While Loop: prints numbers from 1 to 5.
$age = 1;

while ($age <= 5) {
    echo $age . "<br>";
    $age++;
}


// 5. Do-While Loop: prints even numbers from 2 to 10.
$number = 2;

do {
    echo "even numbers : $number <br>";
    $number += 2;
} while ($number <= 10);


// 6. For Loop: displays the multiplication table of 12.
for ($count = 1; $count <= 12; $count++) {
    echo "$count times 12 is " . ($count * 12) . "<br>";
}

echo "<br>";


// 7. For Loop: prints numbers from 1 to 15.
for ($count = 1; $count <= 15; $count++) {
    echo $count . "<br>";
}

echo "<br>";


// 8. For Loop: calculates the square of numbers from 1 to 10.
for ($i = 1; $i <= 10; $i++) {
    echo "The square of $i is " . ($i * $i) . "<br>";
}


// 9. Creates an empty indexed array.
$names = array();


// 10. Adds values to the array using numeric indexes.
$names[0] = "sumaya im programmer";
$names[1] = 123;
$names[] = 12.34;


// 11. Displays each value from the array.
echo $names[0] . "<br>";
echo $names[1] . "<br>";
echo $names[2] . "<br>";


// 12. Displays all array values and their data types.
echo "<br>";
echo "<pre>";
var_dump($names);
echo "</pre>";


// 13. Creates an indexed array with personal information.
$info = array(
    "101",
    "sumaya elmi",
    20,
    "yaqshiid District",
    "single"
);


// 14. Uses a for loop to display all array values.
echo "Array values using for loop: <br>";

for ($i = 0; $i < count($info); $i++) {
    echo $info[$i] . "<br>";
}


// 15. Creates an associative array using named keys.
$info = array(
    "id" => "101",
    "name" => "sumaya elmi",
    "age" => 20,
    "address" => "yaqshiid District",
    "status" => "single",
    "weight" => 160.5
);


// 16. Displays the associative array information.
echo "<pre>";
echo "Information about the person: <br>";
print_r($info);
var_dump($info);
echo "</pre>";

?>

</body>
</html>