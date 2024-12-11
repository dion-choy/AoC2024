<?php
$input = fopen("day11.txt", "r");

$init = array_map('intval', explode(' ', trim(fgets($input))));
fclose($input);
error_reporting(E_ALL & ~E_WARNING);

$stones = [];
foreach ($init as $num) {
    if(!isset($stones[$num])) {
        $stones[$num] = 0;
    }
    $stones[$num]++;
}

$nextIter = $stones;
foreach (range(1, 25) as $_) {
    foreach ($stones as $num => $count) {
        if ($num == 0) {
            $nextIter[1] += $count;
        } else if (strlen((string) $num ) % 2 == 0) {
            $nextIter[(int) substr((string) $num, 0, strlen((string) $num)/2)] += $count;
            $nextIter[(int) substr((string) $num, strlen((string) $num)/2, strlen((string) $num)/2)] += $count;
        } else {
            $nextIter[$num*2024] += $count;
        }
        $nextIter[$num] -= $count;
    }

    $stones = $nextIter;
}

echo array_sum(array_values($stones));

// Uses the fact that undeclared key++ = 1
// E.g. $arr[$undeclared]++;
// 1 stored in $arr[$undeclared]