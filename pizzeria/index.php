<?php
//index.php

declare(strict_types = 1);

//session_destroy(); // Adinda: om te testen... Session_destroy() had ik tijdelijk gebruikt om het winkemandje te kunnen testen. Het werkt beter als je de browser sluit en opnieuw opent.

spl_autoload_register();

session_start();

use Business\PizzeriaService;
use Entities\Product;
use Entities\Bestelregel;
use Entities\Mandje; // Adinda: toegevoegd
$mandje = array(); // Adinda: toegevoegd

$pizzeriaSvc = new PizzeriaService();
$productenLijst = $pizzeriaSvc->getProducts();

if (isset($_SESSION["sessionKlant"])) {
    $sessionKlant = unserialize($_SESSION["sessionKlant"]);
    $sessionKlantId = $sessionKlant->getKlantId();
	$_SESSION["sessionKlantId"] = $sessionKlantId;
    $informatie = $sessionKlant->getBemerkingen();
}

if (isset($_GET["action"]) && $_GET["action"] === "add") {
    if (isset($_GET["productId"])) {
	    $gevonden = false;
        if (isset($_SESSION["mandje"])) {			
            $sessieMandje = $_SESSION["mandje"]; 
            $mandje = unserialize($sessieMandje);
            foreach($mandje as $rij){
                if ($rij->getProductId() == (int)$_GET["productId"]){
                    $rij->setAantal(($rij->getAantal() +1));
                    $gevonden = true;
                }
            }
        }
	    if ($gevonden == false) {
            $product = $pizzeriaSvc->getProductById((int)$_GET["productId"]);
            $newItem = new Mandje((int)$_GET["productId"], $product->getProductNaam(), 1, $product->getKostprijs());
            array_push($mandje, $newItem);
		}
		$strMandje = serialize($mandje);
		$_SESSION["mandje"] = $strMandje;
    }
}

if (isset($_GET["action"]) && $_GET["action"] === "subtract") {
    if (isset($_GET["productId"])) {
		$sessieMandje = $_SESSION["mandje"]; 
        $mandje = unserialize($sessieMandje);
		$productmetaantalnul = -1;
	    //
		foreach($mandje as $rij){
			if ((int)$rij->getProductId() == (int)$_GET["productId"]){
                $rij->setAantal(($rij->getAantal()-1));
				if ((int)$rij->getAantal() == 0){
					$productmetaantalnul = (int)$rij->getProductId(); // bewaar het productid van item met aantal nul
				}
		    } // einde productid gevonden
	      }  // einde foreach
 // Adinda: ik vind onderstaande een minder goede oplossing om nogmaals te navigeren door het mandje om het item met aantal = 0 te verwijderen, maar het is een work-around die blijkt te werken
        foreach ($mandje as $key => $object) {
            if ($object->getProductId() == $productmetaantalnul) {
              unset($mandje[$key]);
           }
        }		
        $strMandje = serialize($mandje);
        $_SESSION["mandje"] = $strMandje;
    }  //isset
}  //subtract

include_once("Presentation/menu.php");
