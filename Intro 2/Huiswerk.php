<?PHP

// Maximum number
$maxNumber = 0;

while (!$maxNumber) {
    /* Loop until we have the right answer */
    $input = readline("Geef een maximaal getal boven 0: ");
    if (is_numeric($input) && $input >= 1) {
        // Set the maximum user input value as int
        $maxNumber = (int) $input;
    } else {
        // The user input was invalid
        echo "Het ingevoerde was geen getal of niet hoger dan 0!\n";
    }
}
// Decide the random number between 0 and maximum given number
$randNumber = rand(0, $maxNumber);

for ($i = 0; $i < 10; $i++) {
    /* Loop 10 times */
    $guessedNumber = readline("Geef een getal om te gokken: ");
    if (is_numeric($guessedNumber) && (int) $guessedNumber == $randNumber) {
        // Winner!
        echo "Goed gegokt! Getal was $randNumber\n";
        break;
    } elseif (!is_numeric($guessedNumber) || $guessedNumber < 0) {
        // The user input was invalid
        echo "Het ingevoerde was geen getal of lager dan 0\n";
    } elseif ($i == 9) {
        // End of loop, you lost
        echo "Helaas je hebt het getal niet kunnen raden. Het getal was $randNumber\n";
    } else {
        // User guessed wrong, show the attemps that the user has left
        echo "Je hebt fout gegokt, nog " . (9 - $i) . " pogingen te gaan!\n";
    }
}

