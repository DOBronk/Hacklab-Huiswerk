<?php
// Load the filecontents in string
$file = file_get_contents("games_list.json");
// Decode JSON to Array
$data = json_decode($file, true);
// Result string
$result = '';

foreach ($data as $value) {
    // Add # to result if matches requirements or . when unsuitable
    $result .= ($value[1] <= 7 && $value[2] == "Adventure") ? '#' : '.';
    if (strlen($result) == 18) {
        // Result line reached 18 characters, time to spit out some data and add a newline
        echo $result . PHP_EOL;
        // Clear the output
        $result = '';
    }
}

if (strlen($result) < 18) {
    echo $result . PHP_EOL;
}

