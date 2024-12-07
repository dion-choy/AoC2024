<?php
define("orderLen", 1176);
$input = fopen("day5.txt", "r");
$smaller = [];

for ($i=0; $i < orderLen; $i++) { 
    $tempArr = explode("|", trim(fgets($input)));

    if(!isset($bigger[$tempArr[0]])) {
        $bigger[$tempArr[0]] = [];
    }
    array_push($bigger[$tempArr[0]], $tempArr[1]);

    if(!isset($smaller[$tempArr[1]])) {
        $smaller[$tempArr[1]] = [];
    }
    array_push($smaller[$tempArr[1]], $tempArr[0]);
}

fgets($input);

$updates = [];
while(!feof($input)) {
    array_push($updates, explode(",", trim(fgets($input))));
}


$sum = 0;
foreach ($updates as $update) {
    $orderedFlag = true;

    for ($i=0; $i < count($update); $i++) { 
        $cur = $update[$i];
        $left = array_slice($update, 0, $i);
        $right = array_slice($update, $i+1, count($update));

        if(isset($bigger[$cur]) && array_intersect($right, $bigger[$cur]) != $right) {
            $orderedFlag = false;
            break;
        }

        if(isset($smaller[$cur]) && array_intersect($left, $smaller[$cur]) != $left) {
            $orderedFlag = false;
            break;
        }
        
    }

    if($orderedFlag) {
        $sum += $update[(count($update)-1)/2];
    }
}

echo $sum;