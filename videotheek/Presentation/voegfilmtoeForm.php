<?php 
require_once("header.php"); 
?>

<section class="inhoud">
    <h3>NIEUWE FILM TOEVOEGEN</h3>

    <?php
    if (isset($error) && ($error === "titelbestaat")) {
    ?>
        <p style="color: red">Titel bestaat al!</p>
    <?php
    }
    ?>
    <form method="post" action="voegfilmtoe.php?action=process">
        <label for="txtTitel">Titel :</label>
        <input type="text" id="txtTitel" name="txtTitel" />
        <input class="submitBtn" type="submit" value="TOEVOEGEN" />
    </form>
</section>

<?php
require_once("footer.php"); 
?> 

