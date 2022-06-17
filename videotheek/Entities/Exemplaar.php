<?php
//entities/Film.php 

declare(strict_types=1);

namespace Entities;

class Exemplaar {
    
    private int $exemplaarId; 
    private int $aanwezigheid;
    
    public function __construct(int $exemplaarId, int $aanwezigheid) {  
        $this->exemplaarId = $exemplaarId;
        $this->aanwezigheid = $aanwezigheid;
    }
    
    public function getExId(): int {
        return $this->exemplaarId;
    }
    
    public function getAanwezigheid() : int {
        return $this->aanwezigheid;
    }
    
    public function setAanwezigheid(int $aanwezigheid) : int{ 
        $this->aanwezigheid = $aanwezigheid;
    }
}