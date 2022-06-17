<?php
//Presentation/afrekenen.php

require_once("header.php"); 

//session_start();

$totaalMandje = 0;
$sessieMandje = $_SESSION["mandje"]; 
$mandje = unserialize($sessieMandje);

?>

<main class="container">
    <section class="divleft">
        <table width="50%" id="betaling">
            <tr>
                <td width="50%"><input class="betalingPic" type="image" src="./Presentation/img/bancontact.jpg"></td>
                <td width="50%"><input class="betalingPic" type="image" src="./Presentation/img/ideal.jpg"></td>
            </tr>
            <tr>
                <td width="50%"><input class="betalingPic" type="image" src="./Presentation/img/visa.jpg"></td>
                <td width="50%"><input class="betalingPic" type="image" src="./Presentation/img/paypal.jpg"></td>
            </tr>
        </table>
        <table width="50%" id="betalingform">
            <form action="./afrekenenCtrl.php?action=betalen" method="post"><br>
                <tr height="30px">
                    <td width="50%">Voornaam en naam : </td>
                    <td width="50%"><input type="text" name="voornaamEnNaam" required></td>
                </tr>
                <tr height="30px">
                    <td width="50%">Kaartnummer : </td>
                    <td width="50%"><input type="text" name="kaartnummer" required></td>
                </tr>
                <tr height="30px">
                    <td width="50%">CVC-code : </td>
                    <td width="50%"><input type="text" name="cvccode" required></td>
                </tr>
                <tr height="50px">
                    <td></td>
                    <td><button type="submit" name="btnBevestigen">BEVESTIGEN</button></td>
                </tr>
            </form>
        </table>
    </section>
    <section class="divright">
       <!-- <form method="post">-->
            <table width="100%" id="maandje">
                <thead>
                    <tr>
                        <th colspan="4" id="mandjetitle">MANDJE OVERZICHT <img src="./Presentation/img/mandje.jpg" id="mandjepic"></th>
                    </tr>
                    <tr id="infos">
                        <th width="30%">Product</th>
                        <th width="30%">Aantal</th>
                        <th width="30%">Kostprijs</th>
                        <th width="10%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($mandje as $rij) {
                        ?>
                        <tr height="30px">
                            <td><?php print($rij->getProductNaam());?></td>
                            <td><?php print($rij->getAantal());?></td>
                            <td><?php print(number_format((float)$rij->getKostPrijs(), 2, '.', '').' €');?></td>
                            <!--<td><input type="submit" id="min" value="-"/></td>-->
							<td><form action="./afrekenenCtrl.php?action=subtract&productId=<?php print($rij->getProductId());?>" method="post"><input type="submit" id="min" value="-"/></form></td>
                        </tr>
                        <?php $totaalMandje += ( (float)$rij->getKostprijs() * (int)$rij->getAantal() );  } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td>TOTAAL : </td>
                        <td colspan="2"><?php print(number_format((float)$totaalMandje, 2, '.', '').' €'); ?></td>
                    </tr>
                </tfoot>
            </table>
   <!--     </form>-->
    </section>
</main>

<?php 
require_once("footer.php"); 
?> 



