<?PHP
define("CHEAT", false);
define("RUITEN", 'R');
define("SCHOPPEN", 'S');
define("KLAVER", 'K');
define("HARTEN", 'H');

$guessed = [];
$attempts = 10;
$secretCard = "";

$cardTypes = [2, 3, 4, 5, 6, 7, 8, 9, 10, 'J', 'Q', 'K', 'A'];
$cardColors = [RUITEN, SCHOPPEN, HARTEN, KLAVER];


$cardColors = [RUITEN, SCHOPPEN, HARTEN, KLAVER]; # / Deze symbolen maken het niet makkelijker voor UI dus kleine vervangen met de volgende: ["♦", "♠", "♥", "♣"];

/**
 * Laat alle tot nu toe geraden kaarten zien
 * @return void
 */
function drawMistakes()
{
    global $guessed;
    echo "De volgende kaarten zijn al fout geraden: " . implode(' ', $guessed) . "\n\n";
}

/**
 * Kijk of de kaart kloppend is
 * @return bool
 */
function guessCard($input)
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
 * Behandeld de user input
 * @return bool|string
 */
function handleInput()
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
 * Stelt een willekeurige kaart in
 * @return void
 */
function getRandomcard()
{
    global $cards, $secretCard;
    $secretCard = $cards[array_rand($cards)];
}

/**
 * Initialiseer alle mogelijke kaarten in het spel. Is eventueel aan te passen op klaverjassen etcetera
 * @return void
 */
function initCards()
{
    global $cards, $cardColors, $cardTypes;
    foreach ($cardTypes as $card) {
        foreach ($cardColors as $color) {
            array_push($cards, $color . $card);
        }
    }
}

/**
 * Initialiseer spel, om cheat aan of uit te zetten zet de cheat define/constant op false
 * @return void
 */
function init()
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



