<?php 
require_once("header.php"); 
?>

<section class="inhoud">
    <h3>EXEMPLAAR VERWIJDEREN</h3>

    <?php
    if (isset($error) && ($error === "exemplaarbestaatniet")) {
    ?>
        <p style="color: red">Exemplaar bestaat niet!</p>
    <?php
    }
    ?>

    <form method="post" action="verwijderex.php?action=delete">
        <select name="zoeken" id="zoeken">         
            <option value="">Zoeken op exemplaar nummer...</option>
            <?php
            foreach ($filmsLijst as $film) {
                $exemplaar=$film->getExemplaar();
                print("<option value='{$exemplaar->getExId()}'>{$exemplaar->getExId()}</option>");   
            }
            ?>
        </select>
        <input class="submitBtn" type="submit" value="VERWIJDEREN" />
    </form>
</section>

<?php 
require_once("footer.php"); 
?> 

