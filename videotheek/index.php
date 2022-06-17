<?php
//toonallefilms.php
declare(strict_types = 1);

spl_autoload_register(); 

use Business\FilmService;

if (isset($_GET["action"]) && ($_GET["action"] === "search")) {
    if(isset($_POST["zoeken"])) {
        try {
            $filmSvc = new FilmService();
            $filmsLijst = $filmSvc->haalFilmOp((int)$_POST["zoeken"]);
        }
        catch (IdBestaatNiet $ex) { 
            header("location: index.php?id=".$_POST["zoeken"]."&error=idBestaatNiet");
            exit(0);
        }
    }
} else if (isset($_GET["action"]) && ($_GET["action"] === "updateaanwezigheid")) {
    if(isset($_GET["id"])) {
        $filmSvc = new FilmService();
        $aanwzigheid = $filmSvc->updateAanwezigheid((int)$_GET["id"], (int)$_GET["aanwezigheid"]);
        $filmsLijst = $filmSvc->getFilmsOverzicht();
    }
} else {
    $filmSvc = new FilmService();
    $filmsLijst = $filmSvc->getFilmsOverzicht();
}

include("Presentation/filmslijst.php");