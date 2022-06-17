<?php 
require_once("header.php"); 
?>

<section class="inhoud">
    <h3>FILM VERWIJDEREN</h3>

    <?php
    if (isset($error) && ($error === "titelbestaatniet")) {
    ?>
        <p style="color: red">Film bestaat niet!</p>
    <?php
    }
    ?>
    <form method="post" action="verwijderfilm.php?action=delete">
        <select name="zoeken" id="zoeken">         
            <option value="">Zoeken op film nummer...</option>
            <?php
            foreach ($filmsLijst as $film) {
                print("<option value='{$film->getFilmId()}'>{$film->getFilmId()}</option>");   
            }
            ?>
        </select>
        <input class="submitBtn" type="submit" value="VERWIJDEREN" />
    </form>
</section>

<?php 
require_once("footer.php"); 
?> 

