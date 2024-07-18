<?php
require_once ("ingredient.php");

/**
 * Search for the quantity of the ingredient in the string
 * @param string $data String containing data
 * @return int The quantity found in the string
 */
function searchQuantity(string $data): int
{
    $result = '';
    // Loop to filter out every single character
    while (strcspn($data, "123457890") != strlen($data)) {
        // Find the index of the first occurence of a number in the string
        $first = strcspn($data, "123457890");
        // Set the first number in the result string
        $result .= $data[$first];
        // Get remaining part of string to see if there's more than a single digit
        $data = substr($data, $first + 1);
    }

    return (int) $result;
}

/**
 * Retrieve ingredient information from string
 * @param string $line  String
 * @return Ingredient Ingredient data
 */
function getIngredient(string $line): Ingredient
{
    $quantity = searchQuantity($line);
    // Get the taste profile and ingredient by splitting the string on it's quantity (Taste Profile, Quantity, Ingredient)
    $data = explode($quantity, $line);

    return new Ingredient($data[0], $data[1], $quantity);
}

/**
 * Load all ingredients from the recipe into an associative array by taste profile
 * @param string $filename The path to the recipe
 * @return array Populated array
 */
function getRecipeArray(string $filename): array
{
    // Load file into array of single lines
    $file = explode("\n", trim(file_get_contents($filename)));
    // Prepare the associative array with it's 5 taste profiles
    $data = [
        'Spicy' => [],
        'Sweet' => [],
        'Sour' => [],
        'Bitter' => [],
        'Salty' => []
    ];
    // Process data line by line
    foreach ($file as $line) {
        $result = getIngredient(trim($line));
        // Check to see if the taste profile already contains this ingredient
        if (array_key_exists($result->ingredient, $data[$result->taste])) {
            // Increment the total quantity of ingredient
            $data[$result->taste][$result->ingredient] += $result->quantity;
        } else {
            // Add ingredient to the array
            $data[$result->taste] += [$result->ingredient => $result->quantity];
        }
    }

    return $data;
}

/**
 * Returns a float of the toxicity ratio of the dish
 * @param array $data Associative array populated with taste profiles and their ingredients
 * @return float The ratio
 */
function getToxicityRatio(array $data): float
{
    // Keep track of the total number of ingredients used
    $totalIngredients = 0;

    foreach (array_keys($data) as $taste) {
        // Gather total ingredients for specific taste profile
        $total = 0;
        foreach ($data[$taste] as $quantity) {
            $total += $quantity;
        }
        // Save result under Total key
        $data[$taste]['Total'] = $total;
        // Increment total quantity of ingredients
        $totalIngredients += $total;
    }

    return (($data['Sweet']['Total']) +
        ($data['Sour']['Total'] * 2) +
        ($data['Bitter']['Total'] * 3) +
        ($data['Salty']['Total'] * 4) +
        ($data['Spicy']['Total'] * 5)) / $totalIngredients;
}

/**
 * Returns the final verdict based on the toxicity ratio
 * @param float $toxicityratio The toxicity ratio
 * @return string The verdict in a string
 */
function getVerdict(float $toxicityratio): string
{
    $verdict = [
        "Mr. Loop's dish is surprisingly harmless, eliciting curiosity and cautious optimism from the villagers.",
        "The villagers are dubious. It's peculiar but not necessarily perilous.",
        "Alarm bells ring in Algorithmia; Mr. Loop's dish is adventurous but potentially alarming.",
        " It's time to intervene. Mr. Loop's concoction poses a real danger to his well-being.",
        "A gastronomic disaster! Urgent action is needed to prevent Mr. Loop from unleashing this perilous potion. The villagers need to save Mr. Loop from his own creation."
    ];

    return ($toxicityratio < 4) ? $verdict[(int) $toxicityratio] : $verdict[4];
}

// Load data
$data = getRecipeArray('flavor_ingredients_dataset.txt');
// Get the toxicity
$toxicityRatio = getToxicityRatio($data);
// Output the final results
echo "Toxicity ratio:\t$toxicityRatio" . PHP_EOL . "The verdict:\t" . getVerdict($toxicityRatio);
