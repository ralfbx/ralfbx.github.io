<?php
//entities/Gemeente.php 

declare(strict_types=1);

namespace Entities;

class Bestelregel {
    
    private int $bestelregelId; 
    private int $bestelId;
    private int $productId;
    private int $aantal;
    
    public function __construct(int $bestelregelId, int $bestelId, int $productId, int $aantal) {  
        $this->bestelregelId = $bestelregelId;
        $this->bestelId = $bestelId;
        $this->productId = $productId;
        $this->aantal = $aantal;
    }
    
    public function getBestelregelId(): int {
        return $this->bestelregelId;
    }
    
    public function getBestelId() : int {
        return $this->bestelId;
    }
    
    public function getProductId() : int {
        return $this->productId;
    }
    
    public function getAantal() : int {
        return $this->aantal;
    }    
    
    public function setAantal(int $aantal) { 
        $this->aantal = $aantal;
    }
}









