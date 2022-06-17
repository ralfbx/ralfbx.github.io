<?php
//afrekenenCtrl.php

declare(strict_types = 1);

spl_autoload_register();
session_start();

use Entities\Mandje;  // Adinda: toegevoegd
use Business\PizzeriaService;
$pizzeriaSvc = new PizzeriaService();


if (isset($_GET["action"]) && $_GET["action"] === "subtract") {
    if (isset($_GET["productId"])) {
		$sessieMandje = $_SESSION["mandje"]; 
        $mandje = unserialize($sessieMandje);
		$indx = 0;
		foreach($mandje as $rij){
			if ($rij->getProductId() == (int)$_GET["productId"]){
				$rij->setAantal(($rij->getAantal()-1));
				if ((int)$rij->getAantal() == 0){
					unset($mandje[$indx]);
				}
			}
			$indx++;	
		}
		$strMandje = serialize($mandje);
		$_SESSION["mandje"] = $strMandje;
	}
}


if (isset($_GET["action"]) && $_GET["action"] === "betalen") {
	
      if (!isset($_SESSION["sessionKlant"])) {
          $_SESSION["wilBetalen"] = true;
          header("location: loginCtrl.php");
          exit(0);		
      }
	
	  $sessieMandje = $_SESSION["mandje"]; 
      $mandje = unserialize($sessieMandje);
	  $totprijs = 0;
	  foreach($mandje as $rij){
		  //bereken totaalprijs volledige bestelling:
		  $totprijs += (int)$rij->getAantal() * $rij->getKostprijs();
	  }
	
	  $sessionKlant = unserialize($_SESSION["sessionKlant"]);
      $sessionKlantId = $sessionKlant->getKlantId();
      $informatie = $sessionKlant->getBemerkingen();
      //$bestelId = $pizzeriaSvc->createNewBestelling((int) $sessionKlantId, (string) $informatie);
	  // Adinda: nog de totaalprijs toegevoegd vooraleer je de bestelling toevoegt
	  $bestelId = $pizzeriaSvc->createNewBestelling((int) $sessionKlantId, (string) $informatie, $totprijs);

	  foreach($mandje as $rij){
		  $totaalRegel = $pizzeriaSvc->addBestelregel((int) $bestelId, (int) $rij->getProductId(), (int) $rij->getAantal());
	  }
	  //$totaalMandje = $pizzeriaSvc->getTotaalMandje((int) $_SESSION["huidigebestellingid"], (float) $totaalRegel);	
      unset($_SESSION["mandje"]);
	  unset($_SESSION["wilBetalen"]);
	  unset($_SESSION["sessionKlant"]);
	  unset($_SESSION["sessionKlantId"]);
	  //je zou eventueel nog een bedankt pagina kunnen uitwerken, of gewoon doorsturen naar index.php
	  header("location: bedanktCtrl.php");
	  //header("location: index.php");
      exit(0);
}

include_once("Presentation/afrekenen.php");
//require("Session.php");
