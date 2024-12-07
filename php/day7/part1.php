<?php
$input = fopen("day7.txt", "r");

$records = [];
while(!feof($input)) {
    array_push($records, array_map('intval', explode(" ", trim(fgets($input)))));
}

$total = 0;
foreach($records as $row) {
    $nums = array_slice($row, 1);
    
    $maxFind = 2**(count($nums)-1);
    for($i=0;$i<$maxFind;$i++) {
         $rowTotal = $nums[0];
         // Brute force permutations, using binary to represent operations
         foreach(str_split(sprintf("%1$0".(count($nums)-1)."b", $i)) as $j => $op) {
            switch ($op) {
                case 0:
                     $rowTotal += $nums[$j+1];
                     break;
                case 1:
                     $rowTotal *= $nums[$j+1];
            }
        }
   
        
        if ($rowTotal == $row[0]) {
            $total += $rowTotal;
            break;
        }
    }
}

echo $total;