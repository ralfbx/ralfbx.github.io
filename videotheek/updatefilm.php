<?php
//updatefilm.php
declare(strict_types=1);

spl_autoload_register(); 

use Business\FilmService;
use Exceptions\TitelBestaatException;

$film = $_GET["thisfilm"];
$filmId = intval($_GET["thisid"]);

if (isset($_GET["action"]) && ($_GET["action"] === "updateThisfilm")) {
    if (isset($_POST["txtTitel"])) {
        var_dump($_POST["txtTitel"]);
        var_dump($film);
        var_dump($filmId);
        $filmSvc = new FilmService();
        $filmSvc->updateFilm((int)$filmId, $_POST["txtTitel"]);
        header("location: index.php");
        exit(0);
    }
}
include("presentation/updatefilmForm.php"); 