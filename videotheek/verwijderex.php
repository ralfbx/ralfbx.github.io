<?php
//verwijderex.php

declare(strict_types = 1);

spl_autoload_register(); 

use Business\FilmService;
use Exceptions\TitelBestaatException;

if (isset($_GET["action"]) && ($_GET["action"] === "delete")) {
    try {
        $filmSvc = new FilmService();
        //$filmSvc->verwijderExemplaar((int)$_GET["zoeken"]);
		$filmSvc->verwijderExemplaar((int)$_POST["zoeken"]);
        header("location: index.php");
        exit(0);
    } 
    catch (ExemplaarBestaatNietException $ex) {
        header("location: verwijderex.php?error=exemplaarbestaatniet");
	exit(0);
    }
} else {
    $filmSvc = new FilmService();
    $filmsLijst = $filmSvc->getFilmsOverzicht();
    if (isset($_GET["error"])){
        $error = $_GET["error"]; 
    }
}
include("presentation/verwijderexForm.php"); 
