<?php
require_once "Main.php";
?>

<HTML>
<h1>Middelbare School - OSG Piter Jelles </h1>
<br><input type='button' value='Stuur mailtje' onclick="window.alert('<?php testMailer($mentors[0]); ?>')">

<BR>
<?php showAllClasses(); ?>

</HTML>