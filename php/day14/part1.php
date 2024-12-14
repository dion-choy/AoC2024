<?php
$input = fopen("day14.txt", "r");

$robots = [];
while(!feof($input)) {
    $tempArr = [];
    preg_match_all('/-?[0-9]{1,}/', fgets($input), $tempArr);
    array_push($robots, ...$tempArr);
}

define("sec", 100);
define("height", 103);
define("width", 101);
$quad1 = 0;
$quad2 = 0;
$quad3 = 0;
$quad4 = 0;
foreach ($robots as $robot) {
    $finalX = ($robot[0] + sec*$robot[2]) % width;
    $finalY = ($robot[1] + sec*$robot[3]) % height;
    $finalX = ($finalX < 0) ? width+$finalX : $finalX;
    $finalY = ($finalY < 0) ? height+$finalY : $finalY;

    if ($finalX < (width-1)/2 && $finalY < (height-1)/2) {
        $quad1++;
    } else if ($finalX > (width-1)/2 && $finalY < (height-1)/2) {
        $quad2++;
    } else if ($finalX < (width-1)/2 && $finalY > (height-1)/2) {
        $quad3++;
    } else if ($finalX > (width-1)/2 && $finalY > (height-1)/2) {
        $quad4++;
    }
}

echo $quad1*$quad2*$quad3*$quad4;