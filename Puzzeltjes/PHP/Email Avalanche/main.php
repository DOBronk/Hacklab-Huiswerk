<?php

// Load the filecontents in string
$file = file_get_contents("email_categorization.json");
// Decode JSON to Array
$data = json_decode($file, true);
// Seperate mail subjects
$mailSubjects = $data["emailSubjects"];
// Seperate keyword array
$categoryKeywords = $data["categoryKeywords"];
// Category total subjects
$categoryTotals = [];

foreach ($mailSubjects as $mailSubject) {
    // Loop through every emailsubject
    foreach ($categoryKeywords as $key => $categoryKeyword) {
        // Loop through all keywords to look for in email subject
        if (str_contains(strtolower($mailSubject), $categoryKeyword)) {
            // Found keyword in subject
            if (!array_key_exists($key, $categoryTotals)) {
                // Create new key in the totals variable
                $categoryTotals[$key] = 0;
            }
            $categoryTotals[$key]++;
            break;
        }
    }
}

// Display category totals
foreach ($categoryTotals as $key => $quantity) {
    echo "$key: $quantity\n";
}

$total = 0;
// Sum all category quantities
foreach ($categoryTotals as $quantity) {
    $total += $quantity;
}

// Output the confirmation information
echo "\nEmail subjects: " . count($mailSubjects) . PHP_EOL;
echo "Counts sum: $total";
