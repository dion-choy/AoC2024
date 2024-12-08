
<?php
$input = fopen("day8.txt", "r");

$map = [];
while(!feof($input)) {
    array_push($map, str_split(trim(fgets($input))));
}

$freqLoc = [];
foreach ($map as $rowNum => $row) {
    foreach ($row as $colNum => $tile) {
        if ($tile == '.') {
            continue;
        }

        if (!isset($freqLoc[$tile])) {
            $freqLoc[$tile] = [];
        }

        array_push($freqLoc[$tile], [$rowNum, $colNum]);
    }
}

$antiNodes = [];
foreach ($freqLoc as $freq => $locs) {
    foreach ($locs as $i => $loc) {
        for ($j=$i+1; $j < count($locs); $j++) { 
            $vertDist = $locs[$j][0] - $locs[$i][0] ;
            $horiDist = $locs[$j][1] - $locs[$i][1];
            $antiNode1 = $locs[$i];
            $antiNode2 = $locs[$j];

            while($antiNode1[0]>=0 && $antiNode1[0]<count($map) && $antiNode1[1]>=0 && $antiNode1[1]<count($map[0])) {
                $antiNodes["{$antiNode1[0]},{$antiNode1[1]}"] = true;
                $antiNode1 = [$antiNode1[0]-$vertDist, $antiNode1[1]-$horiDist];
            }

            while($antiNode2[0]>=0 && $antiNode2[0]<count($map) && $antiNode2[1]>=0 && $antiNode2[1]<count($map[0])) {
                $antiNodes["{$antiNode2[0]},{$antiNode2[1]}"] = true;
                $antiNode2 = [$antiNode2[0]+$vertDist, $antiNode2[1]+$horiDist];
            }
        }
    }
}

echo count($antiNodes);