<?php
$input = fopen("day6.txt", "r");

$map = [];
while(!feof($input)) {
    array_push($map, str_split( trim(fgets($input))));
}

//find start
foreach($map as $rowNum => $row) {
    foreach($row as $colNum => $col) {
        if($col == "^") {
            $pos = array($rowNum, $colNum);
            break;
        }
    }
}
$startPos = $pos;

$dir = 0;   //0: up, 1:right, 2:down, 3:left
$visited = [];
while(true) {
    $visited["{$pos[0]},{$pos[1]}"] = true;
    
    $nextPos = $pos;
    switch ($dir) {
        case 0:
            $nextPos[0] -= 1;
            break;
        case 1:
            $nextPos[1] += 1;
            break;
        case 2:
            $nextPos[0] += 1;
            break;
        case 3:
            $nextPos[1] -= 1;
            break;
        default:
            throw new RuntimeException("\$dir can't be less than 0 or more than 3");
    }

    if ($nextPos[0]<0 || $nextPos[0]>=count($map) || $nextPos[1]<0 || $nextPos[1]>=count($map[0])) {
        break;
    }

    if ($map[$nextPos[0]][$nextPos[1]] == "#") {
        $dir += 1;
        $dir %= 4;
    } else {
        $pos = $nextPos;
    }
}

$count = 0;
foreach(array_keys($visited) as $testPos) {
    $testPos = explode(",", $testPos);
    if ($map[$testPos[0]][$testPos[1]] == "^" || $map[$testPos[0]][$testPos[1]] == "#") {
        continue;
    }
    $map[$testPos[0]][$testPos[1]] = "#";
    if(findLoop( $startPos)) {
        $count++;
    }

    $map[$testPos[0]][$testPos[1]] = ".";
}
echo $count;


function findLoop($pos) {
    global $map;

    $dir = 0;   //0: up, 1:right, 2:down, 3:left
    $corners = [];
    while(true) {
        $nextPos = $pos;
        switch ($dir) {
            case 0:
                $nextPos[0] -= 1;
                break;
            case 1:
                $nextPos[1] += 1;
                break;
            case 2:
                $nextPos[0] += 1;
                break;
            case 3:
                $nextPos[1] -= 1;
                break;
            default:
                throw new RuntimeException("\$dir can't be less than 0 or more than 3");
        }

        if ($nextPos[0]<0 || $nextPos[0]>=count($map) || $nextPos[1]<0 || $nextPos[1]>=count($map[0])) {
            break;
        }

        if ($map[$nextPos[0]][$nextPos[1]] == "#") {
            if(!isset($corners["{$pos[0]},{$pos[1]}"])) {
                $corners["{$pos[0]},{$pos[1]}"] = true;
            } else if ($oldPos != $pos) {
                return true;
            }

            $dir += 1;
            $dir %= 4;
            $oldPos = $pos;
        } else {
            $oldPos = $pos;
            $pos = $nextPos;
        }
    }
    return false;
}