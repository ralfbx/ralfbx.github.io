<?php
//voegfilmtoe.php

declare(strict_types = 1);

spl_autoload_register(); 

use Business\FilmService;
use Exceptions\TitelBestaatException;

if (isset($_GET["action"]) && ($_GET["action"] === "process")) {
    try {
        $filmSvc = new FilmService();
        //$filmSvc->voegNieuweFilmToe($_POST["zoeken"]);
		$filmSvc->voegNieuweExToe((int)$_POST["zoeken"]);
        header("location: index.php");
        exit(0);
    } 
    catch (TitelBestaatException $ex) {
        header("location: voegextoe.php?error=titelbestaat");
	exit(0);
    }
} else {
    $filmSvc = new FilmService();
    $filmsLijst = $filmSvc->getFilmsOverzicht();
    if (isset($_GET["error"])){
        $error = $_GET["error"]; 
    }   
}
include("presentation/voegextoeForm.php");
?>
