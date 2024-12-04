<?php
$input = fopen("input.txt", "r", true);
$strIn = "";

while(!feof($input)) {
    $strIn .= fgets($input);
}

$matches = [];

preg_match_all("/mul\(\d{1,3}\,\d{1,3}\)/", $strIn, $matches);

$matches = array_map( function ($exp) {
    return explode(",", substr($exp,4, strlen($exp)-5));
}, ...$matches);

echo array_reduce($matches, function($carry, $item) {
    return $carry += $item[0]*$item[1];
});