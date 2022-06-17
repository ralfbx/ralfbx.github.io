<?php
//Business/UserService.php 

declare(strict_types=1);

namespace Business;

use Data\UserDAO;
use Entities\SessionKlant;

class UserService { 
    
    public function getGemeenten (): array {  
        $userDAO = new UserDAO(); 
        $lijst = $userDAO->getGemeentenDAO(); 
        return $lijst; 
    }
    
    public function emailReedsInGebruik ($email): int {
        $userDAO = new UserDAO(); 
        $rowCount = $userDAO->emailReedsInGebruikDAO ($email);
        return $rowCount;
    }
    
    public function registerKlant(string $klantNaam, string $voornaam, string $straat, int $straatnummer, int $plaatsId, string $telefoon, string $bemerkingen, $email, $wachtwoord):SessionKlant {
        $userDAO = new UserDAO(); 
        $sessionKlant = $userDAO->registerKlantDAO($klantNaam, $voornaam, $straat, $straatnummer, $plaatsId, $telefoon, $bemerkingen, $email, $wachtwoord);
        return $sessionKlant;
    }
    
    public function loginKlant($email, $wachtwoord):SessionKlant {
        $userDAO = new UserDAO(); 
        $sessionKlant = $userDAO->loginKlantDAO($email, $wachtwoord);
        return $sessionKlant;
    }
}





