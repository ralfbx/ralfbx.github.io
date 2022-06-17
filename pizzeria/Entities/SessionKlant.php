<?php
//entities/NieuweKlant.php 

declare(strict_types=1);

namespace Entities;

class SessionKlant {
    
    private int $klantId; 
    private string $klantNaam;
    private string $voornaam;
    private string $straat;
    private int $straatnummer;
    private int $plaatsId;
    private string $telefoon;
    private string $bemerkingen;
    private string $email;
    private int $korting;
    
    public function __construct(int $klantId, string $klantNaam, string $voornaam, string $straat, int $straatnummer, int $plaatsId, string $telefoon, string $bemerkingen, string $email, int $korting) {  
        
        $this->klantId = $klantId;
        $this->klantNaam = $klantNaam;
        $this->voornaam = $voornaam;
        $this->straat = $straat;
        $this->straatnummer = $straatnummer;
        $this->plaatsId = $plaatsId;
        $this->telefoon = $telefoon;
        $this->bemerkingen = $bemerkingen;
        $this->email = $email;
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
    
    public function getPlaatsId() : int {
        
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

    public function getKorting() : int {
        
        return $this->korting; 
    }
}