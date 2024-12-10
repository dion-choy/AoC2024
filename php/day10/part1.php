<?php
$input = fopen("day10.txt", "r");
$grid = [];
while(!feof($input)) {
    array_push($grid,array_map('intval', str_split(trim(fgets($input)))));
}
fclose($input);

$total = 0;
for ($i=0; $i < count($grid); $i++) { 
    for ($j=0; $j < count($grid[0]); $j++) { 
        if ($grid[$i][$j] === 0) {
            $ends = [];
            getScore($i, $j, -1, -1);
            $total += count($ends);
        }
    }
}

echo $total;

function getScore($row, $col, $oldRow, $oldCol) {
    global $grid;
    global $ends;

    if ($row < 0 || $row >= count($grid) || $col < 0 || $col >= count($grid[0])) {
        return;
    }

    if ($oldRow != -1 || $oldCol != -1) {
        if ($grid[$row][$col] - $grid[$oldRow][$oldCol] != 1) {
            return;
        }

        if ($grid[$row][$col] === 9) {
            $ends["$row,$col"] = true;
            return;
        }
    }

    getScore($row-1, $col, $row, $col);
    getScore($row, $col+1, $row, $col);
    getScore($row+1, $col, $row, $col);
    getScore($row, $col-1, $row, $col);
}