<?php
$input = fopen("day14.txt", "r");

$robots = [];
while(!feof($input)) {
    $tempArr = [];
    preg_match_all('/-?[0-9]{1,}/', fgets($input), $tempArr);
    array_push($robots, ...$tempArr);
}

define("height", 103);
define("width", 101);

$sec = 0;
do {
    $pos = [];
    $sec++;
    $notFound = false;
    foreach ($robots as $robot) {
        $finalX = ($robot[0] + $sec*$robot[2]) % width;
        $finalY = ($robot[1] + $sec*$robot[3]) % height;
        $finalX = ($finalX < 0) ? width+$finalX : $finalX;
        $finalY = ($finalY < 0) ? height+$finalY : $finalY;
        if (isset($pos["$finalX,$finalY"])) {
            $notFound = true;
            break;
        }

        $pos["$finalX,$finalY"] = true;
    }

} while ($notFound);

echo $sec;