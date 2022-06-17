<?php 
require_once("header.php"); 
?>

<section id="zoekveld">
    <form action="index.php?action=search" method="post">

        <select name="zoeken" id="zoeken">         
            <option value="">Zoeken op film nummer...</option>
            <?php
            foreach ($filmsLijst as $film) {
                print("<option value='{$film->getFilmId()}'>{$film->getFilmId()}</option>");
            }
            ?>
        </select>
        <input class="submitBtn" type="submit" value="ZOEKEN" />
    </form>
</section>

<section class="inhoud" id="overzicht">
    <table>
        <thead>
            <tr>
                <th colspan='4'>FILMS OVERZICHT</th>
            </tr>
        </thead>
        <tr>
            <th class="subtitle" width="35%">Titel</th>
            <th class="subtitle" width="15%">Film ID</th>
            <th class="subtitle" width="25%">Exemplaren Nummer(s)</th>
            <th class="subtitle" width="25%">Exemplaren aanwezig</th>
        </tr>
        <?php 
        foreach ($filmsLijst as $film) {
            ?>
            <tr>
                <td>
                    <a href="updatefilm.php?action=updatefilm&thisid=<?php print($film->getFilmId());?>&thisfilm=<?php print($film->getTitel());?>">
                    <?php print($film->getTitel());?>
                    </a>
                </td>
                <td class="tdNummers">
                    <?php print($film->getFilmId());?>
                </td>
                <td class="tdNummers">
                    <?php 
                    $exemplaar=$film->getExemplaar();
                    $aanwezig=$exemplaar->getAanwezigheid();
                    if ($aanwezig === 1) { ?>
                        <button class="exBtnEen" onclick="location.href='index.php?action=updateaanwezigheid&id=<?php print($exemplaar->getExId());?>&aanwezigheid=<?php print($exemplaar->getAanwezigheid());?>'"><?php print($exemplaar->getExId());?></button>
                    <?php } else { ?>
                        <button class="exBtnNull" onclick="location.href='index.php?action=updateaanwezigheid&id=<?php print($exemplaar->getExId());?>&aanwezigheid=<?php print($exemplaar->getAanwezigheid());?>'"><?php print($exemplaar->getExId());?></button>
                    <?php } ?>
                </td>
                <td class="tdNummers">
                    <?php $exemplaar=$film->getExemplaar();?>
                    <?php print($exemplaar->getAanwezigheid());?>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</section>

<?php 
require_once("footer.php"); 
?> 



