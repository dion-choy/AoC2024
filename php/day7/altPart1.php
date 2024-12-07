<?php
$input = fopen("day7.txt", "r");

$records = [];
while(!feof($input)) {
    array_push($records, array_map('intval', explode(" ", trim(fgets($input)))));
}

$total = 0;
foreach($records as $row) {
    if(getRes($row[0], $row[1], array_slice($row, 2))) {
        $total += $row[0];
    }
}

echo $total;

// Use recursive method instead of brute force permutations
function getRes($target, $cur, $arr) {
    if (count($arr) == 0) {
        return $target == $cur;
    }

    if (getRes($target, $cur+$arr[0], array_values(array_slice($arr, 1)))) {
        return true;
    } else if (getRes($target, $cur*$arr[0], array_values(array_slice($arr, 1)))) {
        return true;
    }

    return false;
}