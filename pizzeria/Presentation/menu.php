<?php 
require_once("header.php"); 

if (isset($_SESSION["mandje"])) {
    $sessieMandje = $_SESSION["mandje"]; 
    $mandje = unserialize($sessieMandje);
}
$totaalMandje = 0;

?>

<main class="container">
    <section class="divleft" id="menu">
        <table>
            <?php
            foreach ($productenLijst as $product) {
            ?>
            <tr width="100%">
                <form action="./index.php?action=add&productId=<?php print($product->getProductId());?>" method="post">
                    <td width="15%"><img src="./Presentation/img/<?php echo $product->getBeeldNaam().'.jpg';?>"></td>
                    <td width="20%" style="text-align:left"><?php print($product->getProductNaam());?></td>
                    <td width="35%" style="font-style:italic;text-align:left;font-size:15px"><?php print($product->getSamenstelling());?></td>
                    <td width="10%"><?php print($product->getVoedingswaarde());?></td>
                    <td width="10%"><?php print(number_format((float)$product->getKostPrijs(), 2, '.', '').' €');?></td>
                    <td width="10%"><input type="submit" id="plus" value="+"/></td>
                </form>
            </tr>
            <?php
            }
            ?>
        </table>
    </section>
    <section class="divright">
<!--        <form action=<?php //if(isset($_SESSION["sessionKlant"])) { print("./afrekenenCtrl.php?action=afrekenen"); } else { print("./Presentation/loginopties.php?action=login"); }?> method="post">-->
       <!-- <form action="./afrekenenCtrl.php?action=afrekenen" method="post">	-->		
			
            <table width="100%" id="maandje">
                <thead>
                    <tr>
                        <th colspan="4" id="mandjetitle">MANDJE <img src="./Presentation/img/mandje.jpg" id="mandjepic"></th>
                    </tr>
                    <tr id="infos">
                        <th width="30%">Product</th>
                        <th width="30%">Aantal</th>
                        <th width="30%">Kostprijs</th>
                        <th width="10%"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($mandje)) {
                        foreach ($mandje as $rij) {
                        $productId = $rij->getProductId();
                        ?>
                        <tr height="30px">
                            <td><?php print($rij->getProductNaam());?></td>
                            <td><?php print((int)$rij->getAantal());?></td>
                            <td><?php print(number_format((float)$rij->getKostprijs(), 2, '.', '').' €');?></td>
                            <!--<td><input type="submit" id="min" value="-"/></td>-->
							<td><form action="./index.php?action=subtract&productId=<?php print($productId);?>" method="post"><input type="submit" id="min" value="-"/></form></td>
                        </tr>
                        <?php $totaalMandje += ( (float)$rij->getKostprijs() * (int)$rij->getAantal() ); } } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td>TOTAAL : </td>
                        <td colspan="2"><?php print(number_format((float)$totaalMandje, 2, '.', '').' €');?></td>
                    </tr>
                </tfoot>
            </table>
<!--            <button type="submit" name="btnRegistreer" <?php //echo empty($mandje) ? 'disabled="true"' : ''; ?>>AFREKENEN</button>-->
		<!--<a href="./afrekenenCtrl.php?action=afrekenen">AFREKENEN</a>	-->		
		<button onclick="window.location.href='afrekenenCtrl.php?action=afrekenen'">AFREKENEN</button>

       <!-- </form>-->
    </section>
</main>

<?php 
require_once("footer.php"); 
?> 



