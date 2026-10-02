# Chapter 3: Arrays and Functions (PHP Code Explanation)



## 📋 Qaybaha Koodka iyo Sharaxaaddooda

### 1. Multidimensional Arrays & `print_r` Display
**Koodka:**
```php
$info = array(
    array(10, 28, "CA233", 98.12),
    array("123", " Qali Abdullahi Hassan", "CA2313", 98.12)
);
 
foreach ($info as $list) {
    print_r($list);
    echo "<br>";
}
Sharaxaadda: Qaybtani waxay dhisaysaa laba-cabbir array (Multidimensional Array) waxayna isticmaashaa print_r si ay u soo bandhigto xogta ceeriin (raw data) ee ku jirta saf walba.

2. Nested Loops (Soo Saarista Xogta Mid Mid)
Koodka:

PHP
foreach ($info as $list) {
    foreach ($list as $value) {
        echo $value . " ";
    }
    echo "<br>";
}
Sharaxaadda: Waxay isticmaashaa nested foreach loop (labo loop oo midna kan kale ku dhex jiro) si ay u soo saarto qiimaha shakhsi ahaaneed ee ku dhex jira array-ga hoose iyadoon la isticmaalin print_r.

3. Dhisidda Dynamic HTML Table
Koodka:

PHP
$student = array(
    array("sumaya", "2002", "yaqshiid", "11111"),
    array("yusra", "2006", "wwadajir", "22222"),
    array("xanaan", "2008", "hiliwaa", "33333")
);
echo "<h3>student information</h3>";
echo "<table border='1' cellpadding='10' cellspacing='0'>";
echo "<tr><th>Name</th><th>Year</th><th>Address</th><th>Phone</th></tr>";
foreach ($student as $k) {
    echo "<tr><td>$k[0]</td><td>$k[1]</td><td>$k[2]</td><td>$k[3]</td></tr>";
}
echo "</table>";
Sharaxaadda: Waxay qaadaysaa xogta ardayda ee ku jirta array-ga, waxayna si otomaatig ah ugu dhex habaynaysaa shax HTML ah (<table>) iyadoo loop-ku u kala saarayo safaf (<tr>) iyo tiirar (<td>).

4. Array Checking Functions (is_array & in_array)
Koodka:

PHP
$student = array("Qali", "Yusra", "Sumaya");
if (is_array($student)) {
    echo "Yes, is array";
} else {
    echo "Not array";
}

$MULTI = array(
    array(80, 90, 100),
    array(60, 70, 80)
);
if (in_array(90, $MULTI[0])) {
    echo "Waan Soo Helay";
} else {
    echo "Kuma Jiro";
}
Sharaxaadda:

is_array(): Waxay hubinaysaa in variable-ku yahay array sax ah iyo in kale.

in_array(): Waxay baaraysaa in qiime gaar ah (tusaale nambarka 90) uu ka dhex jiro array hoosaadka gudihiisa.

5. Array Manipulation (array_merge & array_reverse)
Koodka:

PHP
$a1 = array("Qali", "Yusra");
$a2 = array("Sumaya", "Aisha");
$merge = array_merge($a1, $a2);
print_r($merge);

$student = array("Qali", "Yusra", "Sumaya");
$reverse = array_reverse($student);
print_r($reverse);
Sharaxaadda:

array_merge(): Waxay isku xiraysaa ama isu geysaa laba array oo kala duwan.

array_reverse(): Waxay rogaysaa nidaamka siday u kala horreeyeen xubnaha array-gu.

6. PHP Functions & Default Parameters
Koodka:

PHP
function sum($x,$y=100){
    $z = $x + $y;
    echo "The sum of $x and $y is: $z<br>";
}
sum(10,200);

function multiply($x, $y) {
    return $x * $y;
}
echo "The multiplication result is: " . multiply(10, 200) . "<br>";

function sumV2($x, $y = 100) {
    echo "Sum of $x and $y is : " . ($x + $y);
}
sumV2(5, 10);
sumV2(5); 

if (function_exists("factorial"))
    echo "This function exists";
Sharaxaadda:

Waxay qeexaysaa shaqooyin (functions) qaata parameters oo xisaabiya wadarta iyo isku-dhufashada.

Waxay isticmaashaa default parameter (sida $y=100 halkaasoo haddii aan la gelin qiime labaad uu isticmaalayo 100).

function_exists(): Waxay hubinaysaa in shaqo gaar ahi ay jirto kahor intaan la wicin.