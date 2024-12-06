<?php
$input = fopen("day1.txt", "r");
$list1 = [];
$list2 = [];

while (!feof($input)) {
    $tempArr = fgetcsv($input, null, " ");
    array_push($list1, $tempArr[0]);
    array_push($list2, $tempArr[3]);
}

$occurCount = [];
foreach ($list2 as $num) {
    if (!isset($occurCount[$num])) {
        $occurCount[$num] = 0;
    } 
    
    $occurCount[$num]++;
}

$sum = 0;
foreach ($list1 as $num) {
    if (isset($occurCount[$num])) {
        $sum += $num * $occurCount[$num];
    }
}

echo $sum;