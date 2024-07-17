<?php

/**
 * Opens the file and filters out the data chunks and their positions 
 * @param string $file   Path to file
 * @return array  Returns associative array with all found password chunks using their position as key
 */
function handleTextFile(string $file): array
{
    $file_data = file_get_contents($file);
    $lines = explode("\n", $file_data);
    $pieces = [];

    foreach ($lines as $line) {
        if (str_contains($line, "[")) {
            $begin = strstr($line, "[");
            $pos = substr(explode('/', $begin)[0], 1);
            $pieces[$pos] = explode("]", $line)[1];
        }
    }

    return $pieces;
}

$final = handleTextFile("Data/FitnessPlan.txt");
$final += handleTextFile("Data/GroceryList.txt");
$final += handleTextFile("Data/RecipeCollection.txt");
$final += handleTextFile("Data/TravelItinerary.txt");
$final += handleTextFile("Data/WorkSchedule.txt");

$result = '';

for ($i = 1; $i < 21; $i++) {
    $result .= $final[$i];
}

echo $result . PHP_EOL;
