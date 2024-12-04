<?php

$input = fopen("input.txt", "r", true);
$list1 = [];
$list2 = [];

while(!feof($input)) {
    $tempArr = fgetcsv($input, null, " ");
    array_push($list1, $tempArr[0]);
    array_push($list2, $tempArr[3]);
}

$sum = 0;
while(count($list1) > 0) {
    $list1Min = min($list1);
    unset($list1[array_search($list1Min, $list1)]);
    
    $list2Min = min($list2);
    unset($list2[array_search($list2Min, $list2)]);

    $diff = $list1Min - $list2Min;
    $sum += ($diff > 0) ? $diff : -$diff;
}

echo $sum;