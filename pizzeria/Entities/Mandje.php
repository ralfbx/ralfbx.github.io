<?php
//entities/Mandje.php 

declare(strict_types=1);

namespace Entities;

class Mandje {

    private int $productId;
	private string $productNaam;
    private int $aantal;	
	private float $kostprijs;
    
    public function __construct(int $productId, string $productNaam, int $aantal, float $kostprijs) {  
        $this->productId = $productId;
 		$this->productNaam = $productNaam;
        $this->aantal = $aantal;		
		$this->kostprijs = $kostprijs;
    }
    
    public function getProductId() : int {
        return $this->productId;
    }
	
    public function getProductNaam() : string {
        return $this->productNaam;
    }  	
	
    public function getKostprijs() : float {
        return $this->kostprijs;
    }	
    
    public function getAantal() : int {
        return $this->aantal;
    }    
    
    public function setAantal(int $aantal) { 
        $this->aantal = $aantal;
    }
	
}









