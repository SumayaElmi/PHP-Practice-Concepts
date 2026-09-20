<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My PHP Website</title>
</head>
<body>

    <?php
       

       // 1. Constant: defines a fixed value that cannot be changed during the execution of the program.
define("age", 19);
echo age . "<br>";


// 2. If-Else: checks whether the age is 18 or older and displays "adult"; otherwise, it displays "child".
$age = 20;

if ($age >= 18) {
    echo "adult", "<br>";
} else {
    echo "child";
}


// 3. Switch: checks the student's marks against different conditions and displays the appropriate grade.
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


// 4. While Loop: repeats the code as long as the condition is true, printing numbers from 1 to 5.
$age = 1;

while ($age <= 5) {
    echo $age;
    echo "<br>";
    $age++;
}


// 5. Do-While Loop: executes the code at least once and continues printing even numbers from 2 to 10.
$number = 2;

do {
    echo "even numbers : $number <br>";
    $number += 2;
} while ($number <= 10);


// 6. For Loop: uses a counter to generate and display the multiplication table of 12 from 1 to 12.
for ($count = 1; $count <= 12; ++$count) {
    echo "$count times 12 is " . $count * 12 . "<br>";
}

echo "<br>";


// 7. For Loop: uses a counter to print numbers sequentially from 1 to 15.
for ($count = 1; $count <= 15; $count++) {
    echo "$count" . "<br>";
}

echo "<br>";


// 8. For Loop: calculates and displays the square of each number from 1 to 10.
for ($i = 1; $i <= 10; $i++) {
    echo "The square of $i is " . $i * $i . "<br>";
}

?>


                   
  
</body>
</html>