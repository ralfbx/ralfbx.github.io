<?php
//data/PizzeriaDAO.php 

declare(strict_types=1);

namespace Data;

require_once("BaseDAO.php");

use Data\BaseDAO;
use Entities\Gemeente;
use Entities\Klant;
use Entities\SessionKlant;
use Exceptions\KlantBestaatNietException;
use Exceptions\WachtwoordIncorrectException;


class UserDAO extends BaseDAO {
    
    public function getGemeentenDAO (): array {        
        $dbh = $this->db_connect(); 
        $resultSet = $dbh->query("SELECT plaatsId, postcode, gemeente FROM plaatsen");
        $lijst = array();
        
        foreach($resultSet as $rij) {
            $gemeente = new Gemeente ((int)$rij["plaatsId"], (int)$rij["postcode"], (string)$rij["gemeente"]);
            array_push($lijst, $gemeente);
        }
        $dbh = null;
        return $lijst;
    }
    
    public function emailReedsInGebruikDAO ($email): int {
        
        $dbh = $this->db_connect();
        $stmt = $dbh->prepare("SELECT * FROM klanten WHERE email = :email");
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        $dbh = null;
        return $rowCount; 
    }
    
    public function registerKlantDAO (string $klantNaam, string $voornaam, string $straat, int $straatnummer, int $plaatsId, string $telefoon, string $bemerkingen, $email, $wachtwoord): SessionKlant {
        
        $dbh = $this->db_connect();
        //$stmt = $dbh->prepare("insert into klanten (klantNaam, voornaam, straat, straatnummer, plaatsId, telefoon, bemerkingen, email, wachtwoord, promo) values (:klantNaam, :voornaam, :straat, :straatnummer, :plaatsId, :telefoon, :bemerkingen, :email, :wachtwoord, :korting)");
		$stmt = $dbh->prepare("insert into klanten (klantNaam, voornaam, straat, straatnummer, plaatsId, telefoon, bemerkingen, email, wachtwoord, korting) values (:klantNaam, :voornaam, :straat, :straatnummer, :plaatsId, :telefoon, :bemerkingen, :email, :wachtwoord, :korting)");
        $stmt->bindValue(":klantNaam", $klantNaam);
        $stmt->bindValue(":voornaam", $voornaam);
        $stmt->bindValue(":straat", $straat);
        $stmt->bindValue(":straatnummer", $straatnummer);
        $stmt->bindValue(":plaatsId", $plaatsId);
        $stmt->bindValue(":telefoon", $telefoon);
        $stmt->bindValue(":bemerkingen", $bemerkingen);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":wachtwoord", $wachtwoord);
        $stmt->bindValue(":email", $email);
        $stmt->bindValue(":korting", 0);
        $stmt->execute();
        $sessionKlantId = $dbh->lastInsertId();
        $dbh = null;
        $sessionKlant = new SessionKlant ((int) $sessionKlantId, (string) $klantNaam, (string) $voornaam, (string) $straat, (int) $straatnummer, (int) $plaatsId, (string) $telefoon, (string) $bemerkingen, (string) $email, (int) $korting);
        return $sessionKlant; 
    }
 
    public function loginKlantDAO ($email, $wachtwoord): SessionKlant {
        
        $rowCount = $this->emailReedsInGebruikDAO($email);
        if ($rowCount == 0) {
            throw new KlantBestaatNietException();
        }
        $dbh = $this->db_connect();
        $stmt = $dbh->prepare("SELECT * FROM klanten WHERE email = :email");
        $stmt->execute(array(':email' => $email));
        $resultSet = $stmt->fetch(\PDO::FETCH_ASSOC);
        $isWachtwoordCorrect = password_verify($wachtwoord, $resultSet["wachtwoord"]);
        if (!$isWachtwoordCorrect) { 
            throw new WachtwoordIncorrectException();
        }        
        $dbh = null;
        $sessionKlant = new SessionKlant ((int) $resultSet["klantId"], (string) $resultSet["klantNaam"], (string) $resultSet["voornaam"], (string) $resultSet["straat"], (int) $resultSet["straatnummer"], (int) $resultSet["plaatsId"], (string) $resultSet["telefoon"], (string) $resultSet["bemerkingen"], (string) $resultSet["email"], (int) $resultSet["korting"]);
        return $sessionKlant; 
    }
}
    
    
    
    
    
    
    
    