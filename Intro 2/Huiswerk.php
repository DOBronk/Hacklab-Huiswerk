<?PHP

// Maximale getal ingesteld door de gebruiker
$maxNumber = 0;

while (!$maxNumber) {
    /* Loopje tot we een juist antwoord hebben */
    $input = readline("Geef een maximaal getal boven 0: ");
    if (is_numeric($input) && $input >= 1) {
        // Stel het maximale getal in, cast naar int om eventuele float van floor te krijgen
        $maxNumber = (int) $input;
    } else {
        echo "Het ingevoerde was geen getal of niet hoger dan 0!\n";
    }
}

// Bepaal het willekeurige getal tussen 0 en $maxNumber
$randNumber = rand(0, $maxNumber);

for ($i = 0; $i < 10; $i++) {
    /* For loopje voor 10 pogingen */
    $guessedNumber = readline("Geef een getal om te gokken: ");
    if (is_numeric($guessedNumber) && (int) $guessedNumber == $randNumber) {
        // Winner!
        echo "Goed gegokt! Getal was $randNumber\n";
        break;
    } elseif (!is_numeric($guessedNumber) || $guessedNumber < 0) {
        // Invoer klopt niet
        echo "Het ingevoerde was geen getal of lager dan 0\n";
    } elseif ($i == 9) {
        // Loop loopt tegen zijn einde, helaas pindakaas
        echo "Helaas je hebt het getal niet kunnen raden. Het getal was $randNumber\n";
    } else {
        echo "Je hebt fout gegokt, nog " . 9 - $i . " pogingen te gaan!\n";
    }
}

