<!DOCTYPE HTML>
<!-- presentation/nieuwefilmForm -->
<?php 
require_once("header.php"); 
?>

<section class="inhoud">
    <h1>NIEUWE FILM TOEVOEGEN</h1>

    <?php
    if (isset($error) && ($error === "titelbestaat")) {
    ?>
        <p style="color: red">Titel bestaat al!</p>
    <?php
    }
    ?>
    <form method="post" action="../voegfilmtoe.php?action=process">
        <table>
            <tr>
                <td>Titel:</td>
                <td>
                    <input type="text" name="txtTitel" />
                </td>
            </tr>
            <tr>
                <td>
                    <br>
                    <input class="submitBtn" type="submit" value="TOEVOEGEN" />
                </td>
            </tr>
        </table>
    </form>
</section>   

<?php 
require_once("footer.php"); 
?> 