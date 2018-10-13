<?php
// This program is the direct translation of a c program for decimal integer to Roman Numeral mapping
// PHP transletion is done by composed by Deep Rahman
// Create an array for storing mapped Roman Digits
$romanval = [];    //Global Scope
// Create a index variable for remembering the non-empty cells of the $romanval array
$i = 0;      //Global Scope

// Create a function for storing Roman numerals that have two consecutive characters
/**
 * string $num1 : the first character of a roman number
 * string $num2 : the second character of a roman number.
 * Example: 9 is written as IX
 */
function predigit(string $num1, string $num2):void{
    global $i, $romanval;
    $romanval[$i++] = $num1;          // Stores $num1 in i'th cell and increase it to 1.
    $romanval[$i++] = $num2;          // Stores $num2 in i'th cell and increase it to 1.
}
// Create a function for storing a chain of Roman Digit
/**
 * string $c: Roman digit
 * int $n: size of the chain.
 */
function postdigit(string $c, int $n):void{
    global $i, $romanval;
    for($j = 0; $j < $n; $j++){
        $romanval[$i++] = $c;
    }
}

// Take the input and cast it to integer.
$number = (int)$_POST['number'];
$store = $number;
// There is no roman equivalent for 0
if($number <= 0){
    echo "<br>";
    exit("Input must be greater than 0"); //Terminate the script
}
// When the input number is grater than 0, iterate the following procedure
while($number !== 0){
    //Number is greater than or equal to 1000
    if($number >= 1000){
        postdigit('M',$number/1000);   // write M  $number/1000 times in the $romanval array
        //The  input number should be reduced by 1000*($number/1000)
        $number = $number % 1000;
    }elseif($number >= 500){
        if($number < (500 +4 * 100)){
            postdigit('D', $number/500);
            $number = $number % 500;
        }else{
            predigit('C','M'); // when $number is grater than or equal to 900 but less than 1000: write CM to the array
            $number = $number - (1000-100); // //The  input number should be reduced by 900.
        }
    }elseif($number >= 100){
        if($number < (100 + 3 *100)){
            postdigit('C',$number/100);
            $number = $number % 100;
        }else{
            predigit('L','D');
            $number = $number - (500 -100);
        }
    }elseif($number >= 50){
        if($number < (50 + 4*10)){
            postdigit('L',$number/50);
            $number = $number % 50;
        }else{
            predigit('X','C');
            $number = $number - (100 -50);
        }
    }elseif($number >= 10){
        if($number < (10 + 3*10)){
            postdigit('X',$number/10);
            $number = $number % 10;
        }else{
            predigit('X','L');
            $number = $number - (50 -10);
        }
    }elseif($number >= 5){
        if($number < (5 + 4*1)){
            postdigit('V', $number/5);
            $number = $number % 5;
        }else{
            predigit('I','X');
            $number = $number - (10 - 1);
        }
    }elseif($number >= 1){
        if($number < 4){
            postdigit('I',$number/1);
            $number = $number %1;
        }else{
            predigit('I','V');
            $number = $number - (5 -1);
        }
    }
}
$result = implode($romanval);
echo "<br> $sore can be represented as Roman number  {$result}";