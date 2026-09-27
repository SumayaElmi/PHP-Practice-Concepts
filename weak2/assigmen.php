<?php
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

echo " Lambarka ugu weyn waa: $largest <br>";
echo "Lambarka ugu yar waa: $smallest <br><br>";

//2
$num = 15;

if ($num % 3 == 0 && $num % 5 == 0) {
    echo " $num wuxuu u qeybsamaa labadoodaba (3 iyo 5).<br><br>";
} elseif ($num % 3 == 0) {
    echo "2. $num wuxuu u qeybsamaa 3 oo qura.<br><br>";
} elseif ($num % 5 == 0) {
    echo "2. $num wuxuu u qeybsamaa 5 oo qura.<br><br>";
} else {
    echo "2. $num uma qeybsamo 3 iyo 5 midkoodna.<br><br>";
}


//3echo " Lambarada aan lammaanaha aheyn (2 ilaa 20): <br>";
for ($i = 2; $i <= 20; $i++) {
    if ($i % 2 != 0) {
        echo "$i ";
    }
}

echo "<br>Lambarada lammaanaha ah (35 ilaa 50): <br>";
for ($j = 35; $j <= 50; $j++) {
    if ($j % 2 == 0) {
        echo "$j ";
    }
}
echo "<br><br>";


//4for ($i = 50; $i >= 2; $i--) {
    if ($i % 2 == 0 && $i % 5 == 0) {
        echo "$i ";
    }

echo "<br><br>";

//5
$num = 12345;
$reversed = 0;

while ($num > 1) {
    $remainder = $num % 10;
    $reversed = ($reversed * 10) + $remainder;
    $num = (int)($num / 10);
}
echo "lambarka la rogay waa $reversed <br>";



?>