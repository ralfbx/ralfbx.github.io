<?php
//voegfilmtoe.php

declare(strict_types = 1);

spl_autoload_register(); 

use Business\FilmService;
use Exceptions\TitelBestaatException;

if (isset($_GET["action"]) && ($_GET["action"] === "process")) {
    if(isset($_POST["txtTitel"])) {
        try {
            var_dump($_POST["txtTitel"]);
            $filmSvc = new FilmService();
            $filmSvc->voegNieuweFilmToe($_POST["txtTitel"]);
            header("location: index.php");
            exit(0);
        } catch (TitelBestaatException $ex) {
            header("location: voegfilmtoe.php?error=titelbestaat");
        }
    }
} else {
    if (isset($_GET["error"])){
        $error = $_GET["error"]; 
    }
}
include("presentation/voegfilmtoeForm.php"); 
?>
