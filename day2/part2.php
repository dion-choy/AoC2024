<?php
$input = fopen("input.txt", "r", true);
$arr = [];

while(!feof($input)) {
    array_push($arr, fgetcsv($input, null, " "));
}

$count = 0;
foreach($arr as $record) {
    if(isSafe($record)) {
        $count++;
    } else {
        for($i=0; $i<count($record); $i++) {
            $dampRecord = $record;
            unset($dampRecord[$i]);
            if(isSafe(array_values($dampRecord))) {
                $count++;
                break;
            }
        }
    }
}

echo $count;

function isSafe($record) {
    if($record[0]<$record[1]) {
        $asc = true;
    } else {
        $asc = false;
    }

    $nextAsc = $asc;

    $safeFlag = true;
    for($i = 0; $i<count($record)-1; $i++) {
        if($record[$i] < $record[$i+1]) {
            $nextAsc = true;
        } else {
            $nextAsc = false;
        }

        if ($nextAsc != $asc) {
            $safeFlag = false;
            break;
        }

        $diff = $record[$i] - $record[$i+1];
        if( $diff > 3 || $diff < -3 || $diff == 0) {
            $safeFlag = false;
            break;
        }
    }

    return $safeFlag;
}