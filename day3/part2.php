<?php
$input = fopen("input.txt", "r", true);
$strIn = "";

while(!feof($input)) {
    $strIn .= fgets($input);
}

$matches = [];

preg_match_all("/don't\(\)|mul\(\d{1,3}\,\d{1,3}\)|do\(\)/",$strIn, $matches);

$matches = array_map( function ($exp) {
    if(substr($exp, 0, 4) == "mul(") {
        return explode(",", substr($exp,4, strlen($exp)-5));
    } else if($exp == "don't()") {
        return 0;
    } else {
        return 1;
    }
}, ...$matches);

$sum = 0;
$do = 1;
foreach ($matches as $item) {
    if (gettype($item) == "array") {
        $sum += $item[0]*$item[1]*$do;
    } else {
        $do = $item;
    }
}

echo $sum;