<?php
// 1. Declare an array of one dimension with the given values
$numbers = array(5, -7, 12, 10, -7, 11, -6, 12, 1, -7, 2, 9);

// 2. Print all elements of the array
echo "<h3>2. Array Elements:</h3>";
foreach ($numbers as $value) {
    echo $value . "<br>";
}

// 3. Calculate and print total of all elements
$total = array_sum($numbers);
echo "<h3>3. Total of all elements:</h3>";
echo "The total is: $total<br>";

// 4. Calculate and print total of even elements
$even_total = 0;
foreach ($numbers as $num) {
    if ($num % 2 == 0) {
        $even_total += $num;
    }
}
echo "<h3>4. Total of even elements:</h3>";
echo "The total of even numbers is: $even_total<br>";

// 5. Calculate and print total of odd elements
$odd_total = 0;
foreach ($numbers as $num) {
    if ($num % 2 != 0) {
        $odd_total += $num;
    }
}
echo "<h3>5. Total of odd elements:</h3>";
echo "The total of odd numbers is: $odd_total<br>";

// 6. Find minimum element and its positions
$min_val = min($numbers);
$min_positions = array_keys($numbers, $min_val);
echo "<h3>6. Minimum Element:</h3>";
echo "Minimum value is: $min_val at position(s): " . implode(", ", $min_positions) . "<br>";

// 7. Find maximum element and its positions
$max_val = max($numbers);
$max_positions = array_keys($numbers, $max_val);
echo "<h3>7. Maximum Element:</h3>";
echo "Maximum value is: $max_val at position(s): " . implode(", ", $max_positions) . "<br>";

// 2. Declaring a two-dimensional associative array based on the table
$table_data = array(
    "Light" => array(
        "Red" => "Light Red",
        "Green" => "Light Green",
        "Blue" => "Light Blue"
    ),
    "Normal" => array(
        "Red" => "Normal Red",
        "Green" => "Normal Green",
        "Blue" => "Normal Blue"
    ),
    "Dark" => array(
        "Red" => "Dark Red",
        "Green" => "Dark Green",
        "Blue" => "Dark Blue"
    )
);

// Printing the array inside an HTML Table
echo "<h3>Two-Dimensional Associative Array Table</h3>";
echo "<table border='1' cellpadding='10' cellspacing='0'>";
echo "<tr>
        <th></th>
        <th>Red</th>
        <th>Green</th>
        <th>Blue</th>
      </tr>";

foreach ($table_data as $row_name => $columns) {
    echo "<tr>";
    echo "<th>$row_name</th>"; // Row name (Light, Normal, Dark)
    foreach ($columns as $color_val) {
        echo "<td>$color_val</td>";
    }
    echo "</tr>";
}
echo "</table>";


// 3. Two-dimensional associative array for the student table
$student_table = array(
    "CA221_1" => array(
        "Name" => "Mohamed Ahmed Ali",
        "Phone" => "0648440403",
        "Address" => "Laba Dhagax, Wardhiigley"
    ),
    "CA223" => array(
        "Name" => "Ahmed Abdi Jama",
        "Phone" => "0647223201",
        "Address" => "Taleex, Hodan"
    ),
    "CA221_2" => array(
        "Name" => "Amina Nur Adan",
        "Phone" => "0646990276",
        "Address" => "Macmacaanka, Dharkeynley"
    )
);

// Printing the table in HTML
echo "<h3>Student Information Table</h3>";
echo "<table border='1' cellpadding='10' cellspacing='0'>";
echo "<tr>
        <th></th>
        <th>Name</th>
        <th>Phone</th>
        <th>Address</th>
      </tr>";

foreach ($student_table as $row_key => $row_data) {
    //cleaning up key name for display (e.g., CA221_1 -> CA221)
    $display_key = substr($row_key, 0, 5); 
    
    echo "<tr>";
    echo "<th>$display_key</th>";
    echo "<td>" . $row_data['Name'] . "</td>";
    echo "<td>" . $row_data['Phone'] . "</td>";
    echo "<td>" . $row_data['Address'] . "</td>";
    echo "</tr>";
}
echo "</table>";

?>