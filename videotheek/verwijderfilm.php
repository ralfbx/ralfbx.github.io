<?php
//verwijderfilm.php

declare(strict_types = 1);

spl_autoload_register(); 

use Business\FilmService;
use Exceptions\TitelBestaatNietException;

if (isset($_GET["action"]) && ($_GET["action"] === "delete")) {
    try {
        $filmSvc = new FilmService();
        $filmSvc->verwijderFilm((int)$_POST["zoeken"]);
		
		//Adinda: verwijder in de tabel vid_ex alle exemplaren die gekoppeld zijn aan het filmid dat je verwijdert
		$filmSvc->verwijderExVanFilm((int)$_POST["zoeken"]);
		
		
        header("location: index.php");
        exit(0);
    } 
    catch (TitelBestaatNietException $ex) {
        header("location: verwijderfilm.php?error=titelbestaatniet");
	exit(0);
    }
} else {
    $filmSvc = new FilmService();
    //$filmsLijst = $filmSvc->getFilmsOverzicht();
	// Adinda: aangepast om dubbel filmid's in de dropdown te verwijderen
	 $filmsLijst = $filmSvc->getFilmsOverzichtZonderExemplaren();
    if (isset($_GET["error"])){
        $error = $_GET["error"]; 
    }
}
include("presentation/verwijderfilmForm.php"); 