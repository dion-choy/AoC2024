<?php
$input = fopen("day17.txt", "r");

$inputStr = fgets($input);
$instruc = explode(',', trim($inputStr));
$regA = 65804993;
$regB = 0;
$regC = 0;

fclose($input);

$string = "";
for ($i=0; $i < count($instruc); $i+=2) { 
    switch ($instruc[$i+1]) {
        case '0': case '1': case '2': case '3':
            $combo = (int) $instruc[$i+1];
            break;
        case '4':
            $combo = $regA;
            break;
        case '5':
            $combo = $regB;
            break;
        case '6':
            $combo = $regC;
            break;
    }

    switch ($instruc[$i]) {
        case '0':
            $regA = floor($regA / (2 ** $combo));
            break;
        case '1':
            $regB ^= (int) $instruc[$i+1];
            break;
        case '2':
            $regB = $combo % 8;
            break;
        case '3':
            $i = ($regA > 0) ? (int) $instruc[$i+1] - 2 : $i;
            break;
        case '4':
            $regB ^= $regC;
            break;
        case '5':
            $out = $combo % 8;
            $string = ($string == "") ? $out : $string . ",$out";
            break;
        case '6':
            $regB = floor($regA / (2 ** $combo));
            break;
        case '7':
            $regC = floor($regA / (2 ** $combo));
            break;
    }
}
echo $string;