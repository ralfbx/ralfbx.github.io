<?php
//data/FilmDAO.php 

declare(strict_types=1);

namespace Data;

use \PDO;
use Exceptions\TitelBestaatException;
use Data\DBConfig;
use Entities\Film;
use Entities\Exemplaar;

class FilmDAO {
    
    public function getAllDAO(): array {
		// Adinda: dit is een overzicht van de films, gelinkt aan de exemplaren, hierdoor krijg je in de dropdown lijst bij het verwijderen van de films meerdere keren hetzelfde filmid te zien (je kan dit oplossen door een nieuwe method die enkel de films ophaalt, zonder een join met exemplaren)
        
        $sql = "SELECT VID_films.filmId as filmId, VID_films.title as titel, VID_Ex.exemplaarId as exemplaarId, VID_Ex.aanwezig as aanwezig FROM VID_films, VID_Ex WHERE VID_films.filmId = VID_Ex.filmId ORDER BY titel";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD); 
        $resultSet = $dbh->query($sql);
        $lijst = array();
        
        foreach($resultSet as $rij) {
            $exemplaar = new Exemplaar((int)$rij["exemplaarId"], (int)$rij["aanwezig"]);
            $film = new Film((int)$rij["filmId"], (string)$rij["titel"], $exemplaar);
            array_push($lijst, $film); 
        }
        $dbh = null;
        return $lijst; 
    }
	
    // Adinda toegevoegd:	
    public function getAllZonderExDAO(): array {
		// Adinda: dit is een overzicht van de films, ZONDER join met exemplaren (gebruik dit om de dropdown met filmnummers te tonen)
        
        $sql = "SELECT filmId, title as titel FROM VID_films";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD); 
        $resultSet = $dbh->query($sql);
        $lijst = array();
        
        foreach($resultSet as $rij) {
            // $exemplaar = new Exemplaar((int)$rij["exemplaarId"], (int)$rij["aanwezig"]);
            // Adinda: hier zit je vast aan de layout van de entiteit Film, deze verwacht als laatste parameter een exemplaar
			$exemplaar = new Exemplaar(0,0);  // Dit is geen mooie oplossing, enkel een workaround !
			$film = new Film((int)$rij["filmId"], (string)$rij["titel"], $exemplaar);
            array_push($lijst, $film); 
        }
        $dbh = null;
        return $lijst; 
    }
    	
    public function getById(int $filmId) : array {
        $sql = "SELECT VID_films.filmId as filmId, VID_films.title as titel, VID_Ex.exemplaarId as exemplaarId, VID_Ex.aanwezig as aanwezig FROM VID_films, VID_Ex WHERE VID_films.filmId = VID_Ex.filmId and VID_films.filmId = :filmId ORDER BY titel";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':filmId' => $filmId));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $lijst = array();
        if (!$rij) {
            //return null;
        } else {
            $exemplaar = new Exemplaar((int)$rij["exemplaarId"], (int)$rij["aanwezig"]);
            $film = new Film((int)$rij["filmId"], (string)$rij["titel"], $exemplaar);
            $dbh = null;
            array_push($lijst, $film);
            return $lijst;
        }
    }
    
    public function voegNieuweFilmToeDAO(string $titel) {
        
        $bestaandFilm = $this->getByTitel($titel);
        if (!is_null($bestaandFilm)) {
            throw new TitelBestaatException();
        }
        var_dump($titel);		
        //$sql = "insert into VID_films (titel) values (:titel)";
        //Adinda: het veld in de tabel vid_films is title in plaats van titel !!		
		$sql = "insert into VID_films (title) values (:titel)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':titel' => $titel));
        $filmId = $dbh->lastInsertId();
        var_dump($filmId);	// datatype is string	
        //$filmId = intval($filmId);
        // RALF : Blijkbaar heb ik een "intval()" functie nodig. Anders krijg ik een foutmelding van de functie "createExemplaar" ????
		// Adinda: juist, je geeft bij createExemplaar aan int $filmId
        $dbh = null;
        // $nieuwExemplaar = $this->createExemplaar($filmId);
		// Adinda: je kan ook intval() weglaten en (int) meegeven:
		$nieuwExemplaar = $this->voegNieuweExToeDAO((int)$filmId);
    }
    
    public function voegNieuweExToeDAO(int $filmId) {
        $aanwezig = 1;
        $sql = "insert into VID_Ex (aanwezig, filmId) values (:aanwezig, :filmId)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':aanwezig' => $aanwezig, ':filmId' => $filmId));
        $dbh = null;
    }
    
    public function verwijderFilmDAO(int $filmId) {
        $sql = "delete from VID_films where filmId = :filmId" ;
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':filmId' => $filmId));
        $dbh = null;
        $deleteExemplaar = $this->verwijderExemplaarDAO($filmId);
    }
    
    //Adinda: verwijder exemplaar in plaats van film	
    //public function deleteExemplaar(int $filmId) {
	public function verwijderExemplaarDAO(int $exemplaarId) {
        //$sql = "delete from VID_Ex where filmId = :filmId" ;
		$sql = "delete from VID_Ex where exemplaarId = :exemplaarId" ;
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':exemplaarId' => $exemplaarId));
        $dbh = null;
    }
	
    //Adinda: toegevoegd: verwijder in de tabel vid_ex alle exemplaren die gekoppeld zijn aan het filmid dat je verwijdert
	public function verwijderExVanFilmDAO(int $filmId) {
 	    $sql = "delete from VID_Ex where filmId = :filmId" ;
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':filmId' => $filmId));
        $dbh = null;
    }	
	
    public function updateFilmDAO(int $id, string $nieuwtitel) {
        $sql = "update VID_films set title = :title where filmId = :filmId";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':filmId' => $id, ':title' => $nieuwtitel));
        $dbh = null;
    }
    
    public function updateAanwezigheidDAO(int $id, int $aanwezigheid) {
        if ($aanwezigheid === 1) {
            $aanwezigheid = 0;
            $sql = "update VID_Ex set aanwezig = :aanwezig where exemplaarId = :exemplaarId";
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(':exemplaarId' => $id, ':aanwezig' => $aanwezigheid));
        } else {
            $aanwezigheid = 1;
            $sql = "update VID_Ex set aanwezig = :aanwezig where exemplaarId = :exemplaarId";
            $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
            $stmt = $dbh->prepare($sql);
            $stmt->execute(array(':exemplaarId' => $id, ':aanwezig' => $aanwezigheid));
        }
        $dbh = null;
    }
    
    public function getByTitel(string $titel):? Film {
        $sql = "SELECT VID_films.title as titel, VID_Ex.exemplaarId as exemplaarId, VID_Ex.aanwezig as aanwezig FROM VID_films, VID_Ex WHERE titel = :titel ORDER BY titel";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':titel' => $titel));
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$rij) {
            //return null;
        } else { 
            $exemplaar = new Exemplaar((int)$rij["exemplaarId"], (int)$rij["aanwezig"]);
            $film = new Film((int)$rij["filmId"], (string)$rij["titel"], $exemplaar);
            $dbh = null;
            return $film;
        }
    }
}
    
    
    
    
    
    
    
    