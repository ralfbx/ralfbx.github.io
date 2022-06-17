<?php
//entities/NieuweKlant.php 

declare(strict_types=1);

namespace Entities;

use Entities\Gemeente;

class Klant {
    
    private int $klantId; 
    private string $klantNaam;
    private string $voornaam;
    private string $straat;
    private int $straatnummer;
    private Gemeente $gemeente;
    private string $telefoon;
    private string $bemerkingen;
    private $email;
    private $wachtwoord;
    private int $korting;
    
    public function __construct($cklantId = null, string $klantNaam, string $voornaam, string $straat, int $straatnummer, Gemeente $gemeente, string $telefoon, string $bemerkingen, $cemail = null, $cwachtwoord = null, int $korting) {  
        
        $this->klantId = $cklantId;
        $this->klantNaam = $klantNaam;
        $this->voornaam = $voornaam;
        $this->straat = $straat;
        $this->straatnummer = $straatnummer;
        $this->gemeente = $gemeente;
        $this->telefoon = $telefoon;
        $this->bemerkingen = $bemerkingen;
        $this->email = $cemail;
        $this->wachtwoord = $cwachtwoord;
        $this->korting = $korting;
    }
    
    public function getKlantId() : int {
        
        return $this->klantId; 
    }
    
    public function getKlantNaam() : string {
        
        return $this->klantNaam; 
    }

    public function getVoornaam() : string {
        
        return $this->voornaam;
    }
    
    public function getStraat() : string {
        
        return $this->straat; 
    }
    
    public function getStraatnummer() : int {
        
        return $this->straatnummer; 
    }
    
    public function getGemeente() : Gemeente {
        
        return $this->plaatsId; 
    }
    
    public function getTelefoon() : string {
        
        return $this->telefoon; 
    }
    
    public function getBemerkingen() : string {
        
        return $this->bemerkingen; 
    }
    
    public function getEmail() : string {
        
        return $this->email; 
    }
    
    public function getWachtwoord() {
        
        return $this->wachtwoord; 
    }
    
    public function getKorting() : int {
        
        return $this->korting; 
    }

    
//////////////////SET///////////////////
    
    
    public function setKlantNaam(string $klantNaam) {
        
        $this->klantNaam = $klantNaam;
        
    }
    
    public function setVoornaam(string $voornaam) {
        
        $this->voornaam = $voornaam;
 
    }
    
    public function setStraat(string $straat) {
        
        $this->straat = $straat;
        
    }
    
    public function setStraatnummer(int $straatnummer) {
        
        $this->straatnummer = $straatnummer;
        
    }
    
    public function setTelefoon(string $telefoon) {
        
        $this->telefoon = $telefoon;
        
    }
    
    public function setBemerkingen(string $bemerkingen) {
        
        $this->bemerkingen = $bemerkingen;
        
    }
    
    public function setEmail($email) {
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            
            throw new OngeldigEmailadresException();
        }
        
        $this->email = $email; 
    }
    
    public function setWachtwoord($wachtwoord, $herhaalwachtwoord) {
        
        if ($wachtwoord !== $herhaalwachtwoord) {
            
            throw new WachtwoordenKomenNietOvereenException();
        }
        $this->wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
    }
    
    public function setKorting(int $korting) {
        
        $this->korting = $korting;
        
    }
}









