<?php
$input = fopen("input.txt", "r", true) or die("Unable to open file");
$arr = [];

while (!feof($input)) {
    $tempStr = fgets($input);
    $tempArr = str_split(trim($tempStr));

    array_push($arr, $tempArr);
}

$arrUpLeft = $arr;
for($i = 0; $i<count($arr); $i++) {
    $arrUpLeft[$i] = array_pad($arrUpLeft[$i], -$i-count($arr), " ");
    $arrUpLeft[$i] = array_pad($arrUpLeft[$i], count($arr)*2-1,0);
}

$arrUpRight = $arr;
for($i = 0; $i<count($arr); $i++) {
    $arrUpRight[count($arr)-$i-1] = array_pad($arrUpRight[count($arr)-$i-1], -$i-count($arr), " ");
}

echo count(array_intersect(getPos($arrUpLeft), getPos($arrUpRight)));
fclose($input);

function getPos($arr): array {
    $retArr = [];

    $arrT= array_map(null, ...$arr);
    $counter = 0;

    foreach ($arrT as $tempArr) {
        $tempStr = implode("", $tempArr);

        $offset = 0;
        while(strpos($tempStr, "MAS", $offset) !== false) {
            $offset = strpos($tempStr, "MAS", $offset) + 1;
            array_push($retArr,
                ($counter - substr_count(implode("", $arr[$offset]), " ")) . ", $offset"
            );
        }

        $offset = 0;
        while(strpos($tempStr, "SAM", $offset) !== false) {
            $offset = strpos($tempStr, "SAM", $offset) + 1;
            array_push($retArr,
                ($counter - substr_count(implode("", $arr[$offset]), " ")) . ", $offset"
            );
        }

        $counter++;
    }

    return $retArr;
}