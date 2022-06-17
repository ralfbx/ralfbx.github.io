<?php
//Business/PizzeriaService.php 

declare(strict_types=1);

namespace Business;

use Data\PizzeriaDAO;
use Entities\Product;
use Entities\Bestelregel;

class PizzeriaService { 
    
    public function getProducts (): array {  
        $pizzeriaDAO = new PizzeriaDAO(); 
        $lijst = $pizzeriaDAO->getProductsDAO(); 
        return $lijst; 
    }
    
    public function getProductById($productId):Product {
        $pizzeriaDAO = new PizzeriaDAO();
        $product = $pizzeriaDAO->getProductByIdDAO($productId);
        return $product;
    }
    
    public function createNewBestelling(int $sessionKlantId, string $informatie, float $totprijs) : int {
        $pizzeriaDAO = new PizzeriaDAO(); 
        $bestelId = $pizzeriaDAO->createNewBestellingDAO($sessionKlantId, $informatie, $totprijs);
        return $bestelId;
    }
    
/*    public function addBestelregel (int $bestelId, int $selectProductId) : float {
        $pizzeriaDAO = new PizzeriaDAO(); 
        $totaalRegel = $pizzeriaDAO->addBestelregelDAO($bestelId, $selectProductId);
        return $totaalRegel;
    }
*/
	// Adinda gewijzigd: de totaalprijs werd reeds berekend, hier gewoon doorgeven
    public function addBestelregel (int $bestelId, int $selectProductId, int $aantal) {
        $pizzeriaDAO = new PizzeriaDAO(); 
        $totaalRegel = $pizzeriaDAO->addBestelregelDAO($bestelId, $selectProductId, $aantal);
    }	
    
    public function getMandje (int $bestelId): array {
        $pizzeriaDAO = new PizzeriaDAO(); 
        $mandje = $pizzeriaDAO->getMandjeDAO($bestelId);
        return $mandje;
    }
	
    public function getMandje2 (int $bestelId): array {
        $pizzeriaDAO = new PizzeriaDAO(); 
        $mandje = $pizzeriaDAO->getMandje2DAO($bestelId);
        return $mandje;
    }	
    
    public function getTotaalMandje (int $bestelId, float $totaalRegel): float {
        $pizzeriaDAO = new PizzeriaDAO();
        $totaalMandje = $pizzeriaDAO->updateTotaalMandjeDAO($bestelId, $totaalRegel);
        return $totaalMandje;
    }
    
    public function updateBestelling(int $bestelId, int $sessionKlantId, string $informatie) : int {
        $pizzeriaDAO = new PizzeriaDAO(); 
        $bestelId = $pizzeriaDAO->updateBestellingDAO($bestelId, $sessionKlantId, $informatie);
        return $bestelId;
    }
}







