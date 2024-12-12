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
            $edges = 0;
            $total += flood($plot[$i][$j], $i, $j, 0) * $edges;
        }
    }
}

echo $total;

function flood($char, $row, $col, $count): int {
    global $plot;
    global $edges;

    if ($row < 0 || $row >= count($plot) || $col < 0 || $col >= count($plot[0])) {
        return 0;
    }

    if ($plot[$row][$col] == strtolower($char)) {
        return 0;
    }

    if ($plot[$row][$col] != $char) {
        return 0;
    }

    if (strtoupper($plot[$row-1][$col]) != $char && strtoupper($plot[$row][$col+1]) != $char) {
        $edges++;
    }
    if (strtoupper($plot[$row-1][$col]) != $char && strtoupper($plot[$row][$col-1]) != $char) {
        $edges++;
    }
    if (strtoupper($plot[$row+1][$col]) != $char && strtoupper($plot[$row][$col+1]) != $char) {
        $edges++;
    }
    if (strtoupper($plot[$row+1][$col]) != $char && strtoupper($plot[$row][$col-1]) != $char) {
        $edges++;
    }


    if (strtoupper($plot[$row-1][$col] . $plot[$row][$col+1]) == "$char$char" &&
    strtoupper($plot[$row-1][$col+1]) != $char) {
        $edges++;
    }
    if (strtoupper($plot[$row-1][$col] . $plot[$row][$col-1]) == "$char$char" &&
    strtoupper($plot[$row-1][$col-1]) != $char) {
        $edges++;
    }
    if (strtoupper($plot[$row+1][$col] . $plot[$row][$col+1]) == "$char$char" &&
    strtoupper($plot[$row+1][$col+1]) != $char) {
        $edges++;
    }
    if (strtoupper($plot[$row+1][$col] . $plot[$row][$col-1]) == "$char$char" &&
    strtoupper($plot[$row+1][$col-1]) != $char) {
        $edges++;
    }

    $plot[$row][$col] = strtolower($plot[$row][$col]);

    return 1 + $count + flood($char, $row-1, $col, $count) +
        flood($char, $row, $col+1, $count) +
        flood($char, $row+1, $col, $count) +
        flood($char, $row, $col-1, $count);
}