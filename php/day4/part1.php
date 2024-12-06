<?php
$input = fopen("day4.txt", "r");
$arr = [];

$sum = 0;

while (!feof($input)) {
    $tempStr = fgets($input);
    $tempArr = str_split($tempStr);

    $sum += substr_count($tempStr, "XMAS");
    $sum += substr_count($tempStr, "SAMX");

    $tempArr = str_split(trim($tempStr));
    array_push($arr, $tempArr);
}
countVert($arr);

$arrUpLeft = $arr;
for($i = 0; $i<count($arr); $i++) {
    $arrUpLeft[$i] = array_pad($arrUpLeft[$i], -$i-count($arr), " ");
}
countVert($arrUpLeft);

$arrUpRight = $arr;
for($i = 0; $i<count($arr); $i++) {
    $arrUpRight[count($arr)-$i-1] = array_pad($arrUpRight[count($arr)-$i-1], -$i-count($arr), " ");
}
countVert($arrUpRight);

echo $sum;
fclose($input);

function countVert($arr) {
    global $sum;

    $arrT= array_map(null, ...$arr);
    foreach ($arrT as $tempArr) {
        $tempStr = implode("", $tempArr);

        $sum += substr_count($tempStr, "XMAS");
        $sum += substr_count($tempStr, "SAMX");
    }
}