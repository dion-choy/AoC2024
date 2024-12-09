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

    $memory = array_pad($memory, count($memory) + $space, $char);
}

for ($i=0; $i < count($memory); $i++) { 
    if ($memory[$i] == '.') {
        do {
            $replace = array_pop($memory);
        } while($replace == '.');
        $memory[$i] = $replace;
    }
}

$total = 0;
foreach (array_values($memory) as $i => $num) {
    $total += $i*$num;
}

echo $total;