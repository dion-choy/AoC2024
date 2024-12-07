<?php
define("orderLen", 1176);
$input = fopen("day5.txt", "r");
$smaller = [];

for ($i=0; $i < orderLen; $i++) { 
    $tempArr = explode("|", trim(fgets($input)));

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

        if(isset($smaller[$cur]) && array_intersect($left, $smaller[$cur]) != $left) {
            $orderedFlag = false;
            break;
        }
        
    }

    if(!$orderedFlag) {
        $sum += reorder($update)[(count($update)-1)/2];
    }
}

echo $sum;

function reorder($update) {
    global $smaller;

    for ($i=0; $i < count($update); $i++) { 
        $cur = $update[$i];
        $left = array_slice($update, 0, $i);

        if(isset($smaller[$cur]) && array_intersect($left, $smaller[$cur]) != $left) {
            $min = min(array_keys(array_diff($left, array_intersect($left, $smaller[$cur]))));
            $moveNum = array_splice($update, $i, 1);
            array_splice($update, $min, 0, $moveNum);
        }
    }

    return $update;
}