<?php
require_once "Main.php";
?>

<HTML>
<h1>Middelbare School - OSG Piter Jelles </h1>

<h2>Knopje om mailer class te testen</h2>
<input type='button' value='Stuur mailtje' onclick="window.alert('<?php testMailer($mentors[0]); ?>')">

<BR>
<h2>Alle leerlingen geboren in 2004</h2>
<table>
    <tr>
        <td><b>Naam</b></td>
        <td><b>Geboortedatum</b></td>
        <td><b>E-mail</b></td>
        <td><b>Telefoonnr</b></td>
    </tr>
    <?php foreach (showSpecials($students) as $student) { ?>
        <tr>
            <?php ShowStudent($student); ?>
        </tr>
    <?php } ?>
    </tr>
</table>

<h2>Alle klassen op de middelbare school</h2>

<?php showAllClasses(); ?>

</HTML>