<?php
$input = fopen("day12.txt", "r");

$plot = [];
while(!feof($input)) {
    array_push($plot, str_split(trim(fgets($input))));
}
fclose($input);

$total = 0;
for ($i=0; $i < count($plot); $i++) { 
    for ($j=0; $j < count($plot[$i]); $j++) { 
        if ($plot[$i][$j] != strtolower($plot[$i][$j])) {
            $visited = 0;
            $total += flood($plot[$i][$j], $i, $j) * $visited;
        }
    }
}

echo $total;

function flood($char, $row, $col) {
    global $plot;
    global $visited;

    if ($row < 0 || $row >= count($plot) || $col < 0 || $col >= count($plot[0])) {
        return 1;
    }

    if ($plot[$row][$col] == strtolower($char)) {
        return 0;
    }

    if ($plot[$row][$col] != $char) {
        return 1;
    }

    $visited++;
    $plot[$row][$col] = strtolower($plot[$row][$col]);

    return flood($char, $row-1, $col) +
        flood($char, $row, $col+1) +
        flood($char, $row+1, $col) +
        flood($char, $row, $col-1);
}