<?php
$input = fopen("day9.txt", "r");
$diskMap = fgets($input);
fclose($input);

$memory = [];
foreach(str_split($diskMap) as $i => $space) {
    if ($i % 2 == 0) {
        $char = $i/2;
    } else {
        $char = '.';
    }

    array_push($memory, [$space, $char]);

}


for ($i=count($memory)-1; $i >= 0; $i--) { 
    if ($memory[$i][1] == '.') {
        continue;
    }

    for ($j=0; $j < $i; $j++) { 
        if ($memory[$j][1] != '.') {    // if not empty continue search
            continue;
        }

        if ($memory[$i][0] > $memory[$j][0]) {  // if not enough space continue search
            continue;
        }

        if ($memory[$i][0] == $memory[$j][0]) {     // if enough space replace, exit search
            $memory[$j][1] = $memory[$i][1];
        } else {
            array_splice($memory, $j, 1, [$memory[$i], [$memory[$j][0]-$memory[$i][0], '.']]);
            $i++;
        }

        $memory[$i][1] = '.';

        break;
    }
}

$total = 0;
$calcPtr = 0;
foreach($memory as $space) {
    for ($i=$calcPtr; $i < $calcPtr+$space[0]; $i++) { 
        $total += $space[1]=='.' ? 0 : $space[1] * $i;
    }
    $calcPtr = $i;
}

echo $total;