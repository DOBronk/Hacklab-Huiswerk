<?PHP
define("CHEAT", false);

$guessed = [];
$attempts = 10;
$secretCard = "";
$cards = [];
$cardTypes = [2, 3, 4, 5, 6, 7, 8, 9, 10, 'J', 'Q', 'K', 'A'];
$cardColors = ['R', 'S', 'H', 'A'];     // Replacement for the following characters since my VSCode terminal hates them ["♦", "♠", "♥", "♣"];

/**
 * Show all the cards that have been currently guessed
 *
 * @return void
 */
function drawMistakes(): void
{
    global $guessed;
    echo "De volgende kaarten zijn al fout geraden: " . implode(' ', $guessed) . "\n\n";
}

/**
 * Check if the given card is valid, ohterwise add it to the guessed cards array
 *
 * @param string $input The input card to check against
 * @return bool
 */
function guessCard($input): bool
{
    global $guessed, $attempts, $secretCard;
    if ($input != $secretCard) {
        array_push($guessed, $input);
        $attempts--;
        return false;
    }
    return true;
}

/**
 * Handle the user input
 *
 * @return bool|string
 */
function handleInput(): bool|string
{
    global $cardColors, $cards;
    echo "Keuze uit volgende kleuren: " . implode(" ", $cardColors) . "\n\n";
    $input = strtoupper(readline("Selecteer kaart (bij. RK of H9): "));

    if (!in_array($input, $cards)) {
        echo "Wat je hebt ingevoerd klopt niet.\n\n";
        return false;
    }
    return $input;
}

/**
 * Sets a random card
 *
 * @return void
 */
function getRandomcard(): void
{
    global $cards, $secretCard;
    $secretCard = $cards[array_rand($cards)];
}

/**
 * Initialize all possible cards in the game (probably 52 for this game)
 *
 * @return void
 */
function initCards(): void
{
    global $cards, $cardColors, $cardTypes;
    foreach ($cardTypes as $card) {
        foreach ($cardColors as $color) {
            array_push($cards, $color . $card);
        }
    }
}

/**
 * Initialize the game, enable cheat by setting CHEAT constant to true value
 *
 * @return void
 */
function init(): void
{
    global $attempts, $secretCard;
    initCards();
    getRandomcard();

    if (CHEAT) {
        echo "Willkeurige kaart is $secretCard!\n";
    }

    while ($attempts > 0) {
        $userTry = handleInput();
        if ($userTry && guessCard($userTry)) {
            echo "Gewonnen de kaart was $secretCard";
            return;
        }
        echo "Je hebt nog $attempts pogingen om de juiste kaart te raden.\n\n";
        drawMistakes();
    }
    echo "Spel verloren!\n";
}

init();



