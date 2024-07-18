<?php
// Holds the total number of chunks as specified in the files
$length = 0;

/**
 * Opens the file and filters out the data chunks and their positions
 * @param string $file Path to file
 * @return array  Returns associative array with all found password chunks using their position as key
 */
function parseTextFile(string $file): array
{
    global $length;

    $file_data = file_get_contents($file);
    $lines = explode("\n", $file_data);
    $pieces = [];

    foreach ($lines as $line) {
        // Check to see if the line contains a character that is only used in password chunks
        if (str_contains($line, "[")) {
            $begin = strstr($line, "[");
            // If we haven't set the total length yet, now is the time to do so.
            if (!$length) {
                $length = (int) strstr(explode('/', $begin)[1], ']', true);
            }
            $pos = substr(explode('/', $begin)[0], 1);
            $pieces[$pos] = explode("]", $line)[1];
        }
    }

    return $pieces;
}
/**
 * Construct the password by creating and merging arrays with chunks together and looping through them by number
 * @param string $files All files to be parsed
 * @return string Constructed password
 */
function constructPassword(string ...$files): string
{
    global $length;

    $final = [];
    $result = '';
    // Parse each text file and then merge it with final array
    foreach ($files as $file) {
        $final += parseTextFile($file);
    }
    // Return an error if the number of chunks don't match up with what's expected
    if (count($final) != $length) {
        return "ERROR: There should be $length chunks available, but " . count($final) .
            " chunks were found. Did you include all files in the arguments?";
    }
    // Construct the final string by itterating from 1 to total chunks
    for ($i = 1; $i < $length + 1; $i++) {
        $result .= $final[$i];
    }

    return $result;
}

// Print the result
echo constructPassword(
    "Data/FitnessPlan.txt",
    "Data/GroceryList.txt",
    "Data/RecipeCollection.txt",
    "Data/TravelItinerary.txt",
    "Data/WorkSchedule.txt"
);

