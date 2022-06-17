<?php
//entities/Film.php 

declare(strict_types=1);

namespace Entities;

use Entities\Exemplaar;

class Film {
    
    private int $filmId; 
    private string $titel;
    private Exemplaar $exemplaar;
    
    public function __construct(int $filmId, string $titel, Exemplaar $exemplaar) {  
        $this->filmId = $filmId;
        $this->titel = $titel;
        $this->exemplaar = $exemplaar;
    }
    
    public function getFilmId(): int {
        return $this->filmId;
    }
    
    public function getTitel() : string {
        return $this->titel;
    }
    
    public function getExemplaar() : Exemplaar {
        return $this->exemplaar;
    }
    
    public function setTitel(string $titel){ 
        $this->titel = $titel;
    }
    
    public function setExemplaar(Exemplaar $exemplaar){
        $this->film = $exemplaar;
    }
}