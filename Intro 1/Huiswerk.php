<?PHP
$array = [42, 67, 35, 89, 24, 76, 58, 93, 7, 30, 83, 46, 13, 25, 98, 53, 17, 79, 57, 8];
$results = ['even' => 0, 'oneven' => 0];

foreach ($array as $number) {
    if ($number % 2 == 0) {
        $results['even']++;
    } else {
        $results['oneven']++;
    }
}

echo 'Even getallen: ' . $results['even'] . "\nOneven getallen: " . $results['oneven'];
