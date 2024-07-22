<?php

/**
 * Retrieve an array of all sales with date set as key from a CSV formatted file
 * @param string $filename
 * @return array
 */
function getSales(string $filename): array
{
    $allSales = [];
    $fileContents = explode("\n", trim(file_get_contents($filename)));
    // Remove the first line of CSV file (header with column names)
    array_shift($fileContents);
    foreach ($fileContents as $line) {
        $data = explode(",", trim($line));
        if (array_key_exists($data[0], $allSales)) {
            $allSales[$data[0]] += [$data[1] => $data[2]];
        } else {
            $allSales[$data[0]] = [$data[1] => $data[2]];
        }
    }
    return $allSales;
}

/**
 * Retrieve an array of all inventory logs with date set as key from a CSV formatted file
 * @param string $filename
 * @return array
 */
function getInventoryLog(string $filename): array
{
    $allLogs = [];
    $fileContents = explode("\n", trim(file_get_contents($filename)));
    // Remove the first line of CSV file (header with column names)
    array_shift($fileContents);
    foreach ($fileContents as $line) {
        $data = explode(",", trim($line));
        if (array_key_exists($data[0], $allLogs)) {
            $allLogs[$data[0]] += [$data[1] => [$data[2], $data[3], $data[4]]];
        } else {
            $allLogs[$data[0]] = [$data[1] => [$data[2], $data[3], $data[4]]];
        }
    }
    return $allLogs;
}


$sales = getSales("cookies_sales.csv");
$inventory = getInventoryLog("inventory_log.csv");

// Array for storing total discrepancies of productys
$final = [];

foreach (array_keys($sales) as $date) {
    $name = $sales[$date];
    foreach ($name as $product => $qty) { {
            // Sum of Starting inventory + delivered - quantity sold
            $sum = ((int) $inventory[$date][$product][0] + (int) $inventory[$date][$product][1]) - (int) $qty;
            // Ending inventory log
            $log = (int) $inventory[$date][$product][2];
            if ($sum != $log) {
                $missing = $sum - $log;
                if (!array_key_exists($product, $final)) {
                    $final[$product] = $missing;
                } else {
                    $final[$product] += $missing;
                }
                echo "Date: $date\tProduct:" . str_pad($product, 15, ' ', STR_PAD_LEFT) . "\t\tLog Inventory: $log\tSales sum: $sum\tMissing: $missing\n";
            }
        }
    }
}


// Output totals and find product with highest difference in stock
$highest = $missingProduct = 0;

echo "\nTotals\n\n";
foreach ($final as $product => $missing) {
    if ($missing > $highest) {
        $highest = $missing;
        $missingProduct = $product;
    }
    echo "Product: " . str_pad($product, 15, ' ', STR_PAD_LEFT) . "\tMissing: $missing\n";
}


echo "\nMost common missing product: $missingProduct with a total difference of $highest";

// The product mostly missing doesn't seem that important here though, the thief seems to dislike a particular product.


