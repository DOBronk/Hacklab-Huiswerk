<?php
require_once "Main.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST["mentor"]);
    $email = test_input($_POST["email"]);
    $text = test_input($_POST["mailtext"]);

    echo "<h3 style='background-color:Tomato;'>Je mailtje naar $name op emailadres $email met de tekst $text is hopelijk verzonden.</h3>";
}
function test_input($data): mixed
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<HTML>
<h1>Middelbare School - OSG Piter Jelles </h1>

<h2>Knopje om mailer class te testen</h2>

<BR>
<h2>Alle leerlingen geboren in 2004</h2>
<table>
    <tr>
        <td><b>Naam</b></td>
        <td><b>Geboortedatum</b></td>
        <td><b>E-mail</b></td>
        <td><b>Telefoonnr</b></td>
    </tr>
    <?php foreach (showSpecials() as $student) { ?>
        <tr>
            <?php ShowStudent($student); ?>
        </tr>
    <?php } ?>
    </tr>
</table>

<h2>Alle klassen op de middelbare school</h2>

<?php showAllClasses(); ?>

</HTML>