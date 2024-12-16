<?php
$input = fopen("day15.txt", "r");
define("mapSize",50);

$pos = [0, 0];
$map = [];
for ($i=0; $i < mapSize; $i++) { 
    array_push($map, str_split(trim(fgets($input))));
    if ($col  = array_search('@', $map[$i])) {
        $pos[0] = $i;
        $pos[1] = $col;
    }
}

fgets($input);

$instruc = [];
while (!feof($input)) {
    array_push($instruc, ...str_split(trim(fgets($input))));
}

foreach($instruc as $dir) {
    $nextPos = $pos;
    $noSpace = false;
    while (true) {
        switch ($dir) {
            case '<':
                $nextPos[1]--;
                break;
            case 'v':
                $nextPos[0]++;
                break;
            case '>':
                $nextPos[1]++;
                break;
            case '^':
                $nextPos[0]--;
                break;
            default:
                echo $dir;
        }

        if ($map[$nextPos[0]][$nextPos[1]] == '#') {
            $noSpace = true;
            break;
        }

        if ($map[$nextPos[0]][$nextPos[1]] == '.') {
            break;
        }
    }

    if ($noSpace) {
        continue;
    }

    $map[$pos[0]][$pos[1]] = '.';

    switch ($dir) {
        case '<':
            $pos[1]--;
            break;
        case 'v':
            $pos[0]++;
            break;
        case '>':
            $pos[1]++;
            break;
        case '^':
            $pos[0]--;
            break;
    }

    if ($map[$pos[0]][$pos[1]] == 'O') {
        $map[$nextPos[0]][$nextPos[1]] = 'O';
    }

    $map[$pos[0]][$pos[1]] = '@';
}

$total = 0;
for ($i=0; $i < mapSize; $i++) { 
    for ($j=0; $j < mapSize; $j++) { 
        if ($map[$i][$j] == 'O') {
            $total += 100*$i + $j;
        }
    }
}

echo $total;