<?php
$input = fopen("day11.txt", "r");

$stones = array_map('intval', explode(' ', trim(fgets($input))));
fclose($input);

foreach (range(1, 25) as $_) {
    for ($i=0; $i < count($stones); $i++) { 
        if ($stones[$i] == 0) {
            $stones[$i] = 1;
        } else if (count(str_split((string) $stones[$i])) % 2 == 0) {
            array_splice($stones, $i, 1, [
                (int) substr((string) $stones[$i], 0, count(str_split((string) $stones[$i]))/2),
                (int) substr((string) $stones[$i],  count(str_split((string) $stones[$i]))/2, count(str_split((string) $stones[$i]))/2)
            ]);
            $i++;
        } else {
            $stones[$i] *= 2024;
        }
    }
}

echo count($stones);
// brute force method (very slow O(n^2))