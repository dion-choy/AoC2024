<?php
$input = fopen("day7.txt", "r");

$records = [];
while(!feof($input)) {
    array_push($records, array_map('intval', explode(" ", trim(fgets($input)))));
}

$total = 0;
foreach($records as $row) {
    $nums = array_slice($row, 1);
    if($nums[0] > $row) {
        continue;
    }
    
    $maxFind = 3**(count($nums)-1);
    for($i=0;$i<$maxFind;$i++) {
         $rowTotal = $nums[0];
         // Brute force permutations, using Base-3 to represent operations
         foreach(base($i,3,count($nums)-1) as $j => $op) {
            switch ($op) {
                case 0:
                     $rowTotal += $nums[$j+1];
                     break;
                case 1:
                     $rowTotal *= $nums[$j+1];
                     break;
                case 2:
                     $rowTotal .= $nums[$j+1];
                     $rowTotal = (int) $rowTotal;
            }
        }
        
        if ($rowTotal == $row[0]) {
            $total += $rowTotal;
            break;
        }
    }
}

echo $total;


function base($num, $base, $padLen) {
    $arr = [];
    while($num > 0) {
         array_push($arr, $num%$base);
         $num = floor($num/$base);
    }

    return array_pad(array_reverse($arr), -$padLen, 0);
}