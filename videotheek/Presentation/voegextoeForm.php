<?php 
require_once("header.php"); 
?>

<section class="inhoud">
    <h3>NIEUWE EXEMPLAAR TOEVOEGEN</h3>

    <?php
    if (isset($error) && ($error === "titelbestaat")) {
    ?>
        <p style="color: red">Nummer bestaat al!</p>
    <?php
    }
    ?>
    <form method="post" action="voegextoe.php?action=process">
        <select name="zoeken" id="zoeken">         
            <option value="">Zoeken op film nummer...</option>
            <?php
            foreach ($filmsLijst as $film) {
                print("<option value='{$film->getFilmId()}'>{$film->getFilmId()}</option>");   
            }
            ?>
        </select>
        <input class="submitBtn" type="submit" value="TOEVOEGEN" />
    </form>
</section>

<?php 
require_once("footer.php"); 
?> 

