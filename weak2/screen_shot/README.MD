# PHP Practice Concepts

This project contains basic PHP programming concepts and examples.

Each section demonstrates a different PHP concept with a simple example, output, and screenshot.

## 📚 Topics Covered

1. Constant
2. If-Else Statement
3. Switch Statement
4. While Loop
5. Do-While Loop
6. For Loop – Multiplication Table
7. For Loop – Numbers 1–15
8. For Loop – Square Numbers 1–10

---

## 1. Constant

A **constant** is a fixed value that cannot be changed after it has been defined.

### Example

```php
define("age", 19);
echo age;
```

### Output

```text
19
```

### Screenshot

**Screenshot name:** `01-constant.png`

![Constant Output](screenshots/01-constant.png)

---

## 2. If-Else Statement

The **if-else statement** is used to make a decision based on a condition.

If the condition is true, the `if` block runs. Otherwise, the `else` block runs.

### Example

```php
$age = 20;

if ($age >= 18) {
    echo "adult";
} else {
    echo "child";
}
```

### Output

```text
adult
```

### Screenshot

**Screenshot name:** `02-if-else.png`

![If Else Output](screenshots/02-if-else.png)

---

## 3. Switch Statement

The **switch statement** is used to check different conditions and execute the matching case.

In this example, it is used to determine a student's grade based on marks.

### Example

```php
$marks = 100;

switch (true) {
    case ($marks >= 90):
        echo "A";
        break;

    case ($marks >= 80):
        echo "B";
        break;

    case ($marks >= 70):
        echo "C";
        break;

    case ($marks >= 60):
        echo "D";
        break;

    default:
        echo "F";
}
```

### Output

```text
A
```

### Screenshot

**Screenshot name:** `03-switch.png`

![Switch Output](screenshots/03-switch.png)

---

## 4. While Loop

A **while loop** repeatedly executes a block of code as long as the condition is true.

In this example, the loop prints numbers from 1 to 5.

### Example

```php
$age = 1;

while ($age <= 5) {
    echo $age;
    echo "<br>";
    $age++;
}
```

### Output

```text
1
2
3
4
5
```

### Screenshot

**Screenshot name:** `04-while-loop.png`

![While Loop Output](screenshots/04-while-loop.png)

---

## 5. Do-While Loop

A **do-while loop** executes the code at least once before checking the condition.

In this example, the program prints even numbers from 2 to 10 by adding 2 each time.

### Example

```php
$number = 2;

do {
    echo "even numbers : $number";
    $number += 2;
} while ($number <= 10);
```

### Output

```text
even numbers : 2
even numbers : 4
even numbers : 6
even numbers : 8
even numbers : 10
```

### Screenshot

**Screenshot name:** `05-do-while-loop.png`

![Do While Loop Output](screenshots/05-do-while-loop.png)

---

## 6. For Loop – Multiplication Table

A **for loop** is useful when we know how many times we want to repeat a block of code.

In this example, the loop generates the multiplication table of 12 from 1 to 12.

### Example

```php
for ($count = 1; $count <= 12; ++$count) {
    echo "$count times 12 is " . $count * 12 . "<br>";
}
```

### Output

```text
1 times 12 is 12
2 times 12 is 24
3 times 12 is 36
4 times 12 is 48
5 times 12 is 60
6 times 12 is 72
7 times 12 is 84
8 times 12 is 96
9 times 12 is 108
10 times 12 is 120
11 times 12 is 132
12 times 12 is 144
```

### Screenshot

**Screenshot name:** `06-for-loop-multiplication.png`

![Multiplication Table Output](screenshots/06-for-loop-multiplication.png)

---

## 7. For Loop – Numbers 1–15

This **for loop** uses a counter to print numbers sequentially from 1 to 15.

### Example

```php
for ($count = 1; $count <= 15; $count++) {
    echo "$count" . "<br>";
}
```

### Output

```text
1
2
3
4
5
6
7
8
9
10
11
12
13
14
15
```

### Screenshot

**Screenshot name:** `07-for-loop-numbers.png`

![Numbers 1 to 15 Output](screenshots/07-for-loop-numbers.png)

---

## 8. For Loop – Square Numbers

This **for loop** calculates the square of each number from 1 to 10.

A square is calculated by multiplying a number by itself.

### Example

```php
for ($i = 1; $i <= 10; $i++) {
    echo "The square of $i is " . $i * $i . "<br>";
}
```

### Output

```text
The square of 1 is 1
The square of 2 is 4
The square of 3 is 9
The square of 4 is 16
The square of 5 is 25
The square of 6 is 36
The square of 7 is 49
The square of 8 is 64
The square of 9 is 81
The square of 10 is 100
```

### Screenshot

**Screenshot name:** `08-for-loop-square.png`

![Square Numbers Output](screenshots/08-for-loop-square.png)

---

## 📸 Complete Code

The screenshot below shows the complete `home2.php` code.

**Screenshot name:** `00-all-code.png`

![Complete Code](screenshots/00-all-code.png)

---

## 📁 Project Structure

```text
PHP_Practice_Concepts/
│
├── weak2/
│   └── home2.php
│
├── screenshots/
│   ├── README.md
│   ├── 00-all-code.png
│   ├── 01-constant.png
│   ├── 02-if-else.png
│   ├── 03-switch.png
│   ├── 04-while-loop.png
│   ├── 05-do-while-loop.png
│   ├── 06-for-loop-multiplication.png
│   ├── 07-for-loop-numbers.png
│   └── 08-for-loop-square.png
│
└── README.md
```

## 🛠️ Technologies Used

* PHP
* HTML
* XAMPP
* GitHub

## 🎯 Learning Objectives

This practice helps demonstrate the basic PHP concepts of:

* Constants
* Variables
* Conditional statements
* Switch statements
* While loops
* Do-while loops
* For loops
* Basic arithmetic operations

## 📸 Screenshot Documentation

The `screenshots` folder contains individual screenshots for each PHP concept, as well as a complete code screenshot.

A separate `README.md` file is included inside the `screenshots` folder to describe all screenshot files.

## 👩‍💻 Author

**Sumaya Elmi**
