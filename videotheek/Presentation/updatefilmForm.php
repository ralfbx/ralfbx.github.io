<?php 
require_once("header.php"); 
?>

<section class="inhoud">
    <h3>FILM BIJWERKEN</h3>

    <form method="post" action="updatefilm.php?action=updateThisfilm">
        Titel : <input type="text" name="txtTitel" id="txtTitel" value="<?php print $film;?>">
        <input class="submitBtn" type="submit" value="BIJWERKEN" />
    </form>
</section>

<?php 
require_once("footer.php"); 
?>
