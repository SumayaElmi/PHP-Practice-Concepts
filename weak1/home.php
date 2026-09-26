<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My PHP Website</title>
</head>
<body>

    <?php
        // Echo - Display the output with line break
        echo "<h1> welcome home page php </h1> <br>";
        // use prenthesis is optional
        echo("hi sumaya <br>");

        // Echo to display argument without parenthesis
        echo "sumaya", "elmi <br>";

        // Disabled print code with multiple parameters (syntax error example)
        //    print "ca233","semert7";

        // Disabled nested echo code example
        //    echo ( echo "sumaya","elmi") ;

        // Variables and Output
        $fullname = "zuu , elmi";
        echo "my name is $fullname <br>";

                // Using built-in function to count words
        $my_str = "welcome to php";
        echo "tirada string waa ", str_word_count($my_str), "<br>";


?>


                   
  
</body>
</html>