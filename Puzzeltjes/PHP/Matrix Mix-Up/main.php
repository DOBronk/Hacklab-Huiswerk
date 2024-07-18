<?php
// Rows
$rows = [];
// Load data
$file = trim(file_get_contents("spreadsheet_shuffle_dataset.txt"));
// Split into array of lines
$lines = explode("\n", $file);

foreach ($lines as $line) {
    // Remove start and trailing character and dump values in array by splitting the string on comma's
    $rowArray = explode(", ", substr($line, 1, -1));
    array_push($rows, $rowArray);
}

// New array for the actual rows
$newRows = [];

for ($i = 0; $i < count($rows[0]); $i++) {
    $newRow = [];
    foreach ($rows as $row) {
        array_push($newRow, $row[$i]);
    }
    array_push($newRows, $newRow);
}

$spreadsheet = "[\n";
foreach ($newRows as $columns) {
    $spreadsheet .= "\t[" . implode(', ', $columns) . "],\n";
}

print $spreadsheet . "]";



