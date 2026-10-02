<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chapter 3 - Arrays and Functions in PHP</title>
</head>
<body>
<?php

// Creating Multidimensional Array
$info = array(
    array(10, 28, "CA233", 98.12),
    array("123", " Qali Abdullahi Hassan", "CA2313", 98.12)
);
 
// Display
foreach ($info as $list) {
    print_r($list);
    echo "<br>";
}
 
$info = array(
    array(10, 28, "CA233", 98.12),
    array("123", " Qali Abdullahi Hassan", "CA2313", 98.12)
);
 
foreach ($info as $list) {
    foreach ($list as $value) {
        echo $value . " ";
    }
    echo "<br>";
}
 
$student = array(
    array("sumaya", "2002", "yaqshiid", "11111"),
    array("yusra", "2006", "wwadajir", "22222"),
    array("xanaan", "2008", "hiliwaa", "33333")
);
echo "<h3>student information</h3>";
 
echo "<table border='1' cellpadding='10' cellspacing='0'>";
 
echo "<tr>";
echo "<th>Name</th>";
echo "<th>Year</th>";
echo "<th>Address</th>";
echo "<th>Phone</th>";
echo "</tr>";
 
foreach ($student as $k) {
    echo "<tr>";
    echo "<td>$k[0]</td>";
    echo "<td>$k[1]</td>";
    echo "<td>$k[2]</td>";
    echo "<td>$k[3]</td>";
    echo "</tr>";
}
 
echo "</table>";
    echo "<br>";

//is array
$student = array("Qali", "Yusra", "Sumaya");
 
if (is_array($student)) {
    echo "Yes,  is  array";
} else {
    echo "Not  array";
}
echo "<br>";
 
//is not array
$student = "Qali";
 
if (is_array($student)) {
    echo "Yes  is  array";
} else {
    echo "Not array";
}
echo "<br>";
// Creating an array
$info = array(10, 20, 30, 40, 50);
 
// Creating a multidimensional array
$MULTI = array(
    array(80, 90, 100),
    array(60, 70, 80)
);
echo "<br>";
 
// Checking if 90 is inside the first array
if (in_array(90, $MULTI[0]))
{
    echo "Waan Soo Helay";
}
else
{
    echo "Kuma Jiro";
}
echo "<br>";
//array_merge
$a1 = array("Qali", "Yusra");
$a2 = array("Sumaya", "Aisha");
 
$merge = array_merge($a1, $a2);
 
print_r($merge);
echo "<br>";
 
//array_reverse
$student = array("Qali", "Yusra", "Sumaya");
 
$reverse = array_reverse($student);
 
print_r($reverse);
echo "<br>";
 //creating functionin php sum
    function sum($x,$y=100){
        $z = $x + $y;
        echo "The sum of $x and $y is: $z<br>";
    }

    //calling the function
    sum(10,200);

    function multiply($x, $y)
    {
        return $x * $y;
    }

    echo "The multiplication result is: " . multiply(10, 200) . "<br>";
    echo "<br>";
    
 // Your function, completed: two parameters, $y has a default value
function sumV2($x, $y = 100) {
    echo "<br>Sum of $x and $y is : " . ($x + $y);
}

sumV2(5, 10);
sumV2(5);             
// Check that a function exists 

if (function_exists("factorial"))
    echo "<br>This function exists";
 
?>

</body>
</html>