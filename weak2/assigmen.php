<?php
//1
$a = 10;
$b = 25;
$c = 15;

if ($a >= $b && $a >= $c) {
    $largest = $a;
} elseif ($b >= $a && $b >= $c) {
    $largest = $b;
} else {
    $largest = $c;
}

if ($a <= $b && $a <= $c) {
    $smallest = $a;
} elseif ($b <= $a && $b <= $c) {
    $smallest = $b;
} else {
    $smallest = $c;
}

echo "Su'aasha 1: Lambarka ugu weyn ee saddexda lambar waa: <b>$largest</b> | Lambarka ugu yar waa: <b>$smallest</b> <br><br>";

//2
$num = 15;

if ($num % 3 == 0 && $num % 5 == 0) {
    echo "Su'aasha 2: Lambarka $num wuxuu u qeybsamaa labadoodaba (3 iyo 5).<br><br>";
} elseif ($num % 3 == 0) {
    echo "Su'aasha 2: Lambarka $num wuxuu u qeybsamaa 3 oo qura.<br><br>";
} elseif ($num % 5 == 0) {
    echo "Su'aasha 2: Lambarka $num wuxuu u qeybsamaa 5 oo qura.<br><br>";
} else {
    echo "Su'aasha 2: Lambarka $num uma qeybsamo 3 iyo 5 midkoodna.<br><br>";
}

//3
echo "Su'aasha 3 - Lambarada aan lammaanaha aheyn (Odd numbers 2 ilaa 20): <br>";
for ($i = 2; $i <= 20; $i++) {
    if ($i % 2 != 0) {
        echo "$i ";
    }
}

echo "<br>Su'aasha 3 - Lambarada lammaanaha ah (Even numbers 35 ilaa 50): <br>";
for ($j = 35; $j <= 50; $j++) {
    if ($j % 2 == 0) {
        echo "$j ";
    }
}
echo "<br><br>";

//4
echo "Su'aasha 4 - Lambarada u dhexeeya 50 iyo 2 ee u qaybsami kara 2 iyo 5 waa: <br>";
for ($i = 50; $i >= 2; $i--) {
    if ($i % 2 == 0 && $i % 5 == 0) {
        echo "$i ";
    }
}
echo "<br><br>";

//5
$num = 12345;
$reversed = 0;

while ($num > 0) {
    $remainder = $num % 10;
    $reversed = ($reversed * 10) + $remainder;
    $num = (int)($num / 10);
}
echo "Su'aasha 5 - Lambarka la rogay (Reversed number) waa: <b>$reversed</b> <br><br>";

//6
$a = 8; $b = 12; $max = ($a > $b) ? $a : $b; 
while(true) { 
    if($max % $a == 0 && $max % $b == 0) { 
        echo "Su'aasha 6 - Lowest Common Multiple (LCM) ee 8 iyo 12 waa: <b>$max</b> <br><br>";
        break; 
    }
    $max++;
}

//7
$a = 18; $b = 24; $hcf = 1; 
for($i=1; $i<=$a && $i<=$b; $i++) { 
    if($a%$i == 0 && $b%$i == 0) $hcf = $i; 
} 
echo "Su'aasha 7 - Highest Common Factor (HCF) ee 18 iyo 24 waa: <b>$hcf</b> <br><br>";

//8
echo "Su'aasha 8:";
echo "<h3>Multiplication Table (12 * 12)</h3>";
echo "<table border='1'>"; 
for($i=1; $i<=12; $i++){ 
    echo "<tr>"; 
    for($j=1; $j<=12; $j++) { 
        echo "<td>".($i*$j)."</td>"; 
    } 
    echo "</tr>"; 
} 
echo "</table><br>";

//9
$num = 17; $prime = true; 
for($i=2; $i<=sqrt($num); $i++) { 
    if($num%$i == 0) $prime = false; 
} 
$resultText = $prime ? "Prime (Waa lambar prime ah)" : "Non-prime (Ma aha lambar prime ah)";
echo "Su'aasha 9 - Hubinta Lambarka 17: <b>$resultText</b><br><br>";

//10
echo "Su'aasha 10 - Dhammaan lambarada Prime-ka ah ee u dhexeeya 10 iyo 50 waa: <br>";
for($i=10; $i<=50; $i++){ 
    $p=true; 
    for($j=2; $j<=sqrt($i); $j++) { 
        if($i%$j==0) $p=false; 
    } 
    if($p) echo "$i "; 
} 
echo "<br><br><br>"; 
?>

<table border="1" cellpadding="5" cellspacing="0">
    <caption><b>Student List</b></caption>
    <tr>
        <th>ID</th>
        <th>Name</th>
    </tr>
    <?php
    $names = ["Sumaya", "Amina", "Farhiya", "Khadija", "Hinda"];

    for ($i = 0; $i < count($names); $i++) {
        echo "<tr><td>" . ($i + 1) . "</td><td>" . $names[$i] . "</td></tr>";
    }
    ?>
</table>