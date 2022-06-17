<?php
//entities/Gemeente.php 

declare(strict_types=1);

namespace Entities;

class Gemeente {
    
    private int $plaatsId; 
    private int $postcode;
    private string $gemeente;
    
    public function __construct(int $plaatsId, int $postcode, string $gemeente) {  
        $this->plaatsId = $plaatsId;
        $this->postcode = $postcode;
        $this->gemeente = $gemeente;
    }
    
    public function getPlaatsId(): int {
        return $this->plaatsId;
    }
    
    public function getPostcode() : int {
        return $this->postcode;
    }
    
    public function getGemeente() : string {
        return $this->gemeente;
    }

    public function setPostcode(string $postcode){ 
        $this->postcode = $postcode;
    }
    
    public function setGemeente(string $gemeente){ 
        $this->gemeente = $gemeente;
    }
}









