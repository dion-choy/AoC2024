<?php
$input = fopen("day13.txt", "r");

$machines = [];
while(!feof($input)) {
    $tempArr1 = [];
    $tempArr2 = [];
    $tempArr3 = [];
    preg_match_all('/[0-9]{1,}/', fgets($input), $tempArr1);
    preg_match_all('/[0-9]{1,}/', fgets($input), $tempArr2);
    preg_match_all('/[0-9]{1,}/', fgets($input), $tempArr3);
    array_push($machines, [...$tempArr1, ...$tempArr2, ...$tempArr3]);
    fgets($input);
}

// [x1, x2][a] = xtarget
// [y1, y2][b] = ytarget
$total = 0;
foreach ($machines as $machine) {
    $invMat = [[$machine[1][1], -$machine[1][0]], [-$machine[0][1], $machine[0][0]]];
    $detReci = 1/($machine[0][0]*$machine[1][1] - $machine[0][1]*$machine[1][0]);

    $btnA = $detReci*($machine[1][1]*$machine[2][0] - $machine[1][0]*$machine[2][1]);
    $btnB = $detReci*($machine[0][0]*$machine[2][1] - $machine[0][1]*$machine[2][0]);
    if ("$btnA" == floor("$btnA") && "$btnB" == floor("$btnB")) {
        $total += 3*$btnA + $btnB;
    }
}
echo $total;