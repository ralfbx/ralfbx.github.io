<?php
//Business/FilmService.php 

declare(strict_types=1);

namespace Business;

use Data\FilmDAO;
use Entities\Film;

class FilmService { 
    
    public function getFilmsOverzicht(): array {  
        $filmDAO = new FilmDAO(); 
        $lijst = $filmDAO->getAllDAO(); 
        return $lijst; 
    }
	
    public function getFilmsOverzichtZonderExemplaren(): array {  
        $filmDAO = new FilmDAO(); 
        $lijst = $filmDAO->getAllZonderExDAO(); 
        return $lijst; 
    }	
    
    public function voegNieuweFilmToe(string $titel) {
        $filmDAO = new FilmDAO();
        $filmDAO->voegNieuweFilmToeDAO($titel);
    }
    
    public function voegNieuweExToe(int $id) {
        $filmDAO = new FilmDAO();
        $filmDAO->voegNieuweExToeDAO($id);
    }
    
    public function verwijderFilm(int $id) {
        $filmDAO = new FilmDAO();
        $filmDAO->verwijderFilmDAO($id);
    }
    
    public function verwijderExemplaar(int $id) {
        $filmDAO = new FilmDAO();
        $filmDAO->verwijderExemplaarDAO($id);
    }
	
    //Adinda toegevoegd:	
    public function verwijderExVanFilm(int $id) {
        $filmDAO = new FilmDAO();
        $filmDAO->verwijderExVanFilmDAO($id);
    }	
   
    public function haalFilmOp(int $id) : array {
        $filmDAO = new FilmDAO();
        $film = $filmDAO->getById($id);
        return $film;
    }
    
    public function updateFilm(int $filmId, string $titel) {
        $filmDAO = new FilmDAO();
        $film = $filmDAO->updateFilmDAO($filmId, $titel);
    }
    
    public function updateAanwezigheid(int $id, int $aanwezigheid) {
        $filmDAO = new FilmDAO();
        $filmDAO->updateAanwezigheidDAO($id, $aanwezigheid);
    }
}
    
    
    
    
    
    
    