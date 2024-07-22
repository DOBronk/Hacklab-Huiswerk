<?php
// The Mysterious Case of Vanishing Disk Space
// Dirty code edition

/**
 * Parse pathstring and add values to array
 * @param array $output_array Reference this to an empty array to be filled
 * @param string $line Line to be parsed
 * @return void
 */
function parseLine(array &$output_array, string $line): void
{
    $line1 = explode("/", $line);
    $x = count($line1) - 1;

    // Get the filesize to be added to dir
    $line2 = explode(" - ", $line1[$x]);
    $size = explode(" ", $line2[1])[0];

    for ($i = 0; $i < $x; $i++) {
        // First handle all subdirectorties
        if (!array_key_exists($line1[$i], $output_array)) {
            $output_array += [$line1[$i] => []];
            $output_array = &$output_array[$line1[$i]];
            $output_array['size'] = 0;
        } else {
            if ($i) {
                $output_array += [$line1[$i] => []];
            }
            $output_array = &$output_array[$line1[$i]];
        }
        $output_array['size'] += (int) $size;
    }
}
/**
 * Load the file contents into an array
 * @param string $path Filepath
 * @return array Filled array with the key 'size' nested for total size in folder
 */
function loadArray(string $path): array
{
    $file_contents = trim(file_get_contents($path));
    $output_array = [];

    foreach (explode("\n", $file_contents) as $line) {
        parseLine($output_array, $line);
    }

    return $output_array;
}
/**
 * Ouput each key from each nested array and it's path
 * @param array $array Array filled with data
 * @param string $output Reference to output string 
 * @param string $previous For recursive purpose, shows previous part of path
 * @return void
 */
function recurseMe(array $array, string &$output, string $previous = ''): void
{
    foreach ($array as $key => $value) {
        if (gettype($value) == 'array' && array_key_exists('size', $value)) {
            $repeat = $previous . '/' . $key;
            $output .= $repeat . '/ - ' . $value['size'] . ' bytes' . PHP_EOL;
            recurseMe($value, $output, $repeat);
        }
    }
}

// Load data into array
$output_array = loadArray("disk_space_challenge_data.txt");
// Prepare empty string for reference
$output = '';
// Get all directories and their totals
recurseMe($output_array, $output);
// Convert to array
$lines = explode("\n", $output);
// Sort array in descending order
rsort($lines, SORT_STRING);
// Echo reconstructed string from sorted array
echo implode("\n", $lines);
