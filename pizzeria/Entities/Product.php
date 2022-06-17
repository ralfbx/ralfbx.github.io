<?php
//entities/Product.php 

declare(strict_types=1);

namespace Entities;

use Entities\Product;

class Product {
    
    private int $productId;
    private string $productNaam;
    private string $beeldNaam;
    private float $kostPrijs;
    private float $promo;
    private string $samenstelling;
    private string $voedingswaarde;
    
    
    public function __construct(int $productId, string $productNaam, string $beeldNaam, float $kostPrijs, float $promo, string $samenstelling, string $voedingswaarde) { 
    
        $this->productId = $productId;
        $this->productNaam = $productNaam;
        $this->beeldNaam = $beeldNaam;
        $this->kostPrijs = $kostPrijs;
        $this->promo = $promo;
        $this->samenstelling = $samenstelling;
        $this->voedingswaarde = $voedingswaarde;
        
    }
    
    public function getProductId(): int {
        return $this->productId;
    }
    
    public function getProductNaam() : string {
        return $this->productNaam;
    }
    
    public function getBeeldNaam() : string {
        return $this->beeldNaam;
    }
    
    public function getKostPrijs() : float {
        return $this->kostPrijs;
    }
    
    public function getPromo() : float {
        return $this->promo;
    }
    
    public function getSamenstelling() : string {
        return $this->samenstelling;
    }
    
    public function getVoedingswaarde() : string {
        return $this->voedingswaarde;
    }
    
    public function getProductNaamById(int $productId) : string {
        return $this->productNaam;
    }
    
    public function getKostPrijsById(int $productId) : float {
        return $this->kostPrijs;
    }
    
    public function getPromoById(int $productId) : float {
        return $this->promo;
    }
    
    public function setBeeldNaam(string $beeldNaam){ 
        $this->beeldNaam = $beeldNaam;
    }
    
    public function setProductNaam(string $productNaam){ 
        $this->productNaam = $productNaam;
    }
    
    public function setSamenstelling(string $samenstelling){ 
        $this->samenstelling = $samenstelling;
    }
    
    public function setVoedingswaarde(string $voedingswaarde){ 
        $this->voedingswaarde = $voedingswaarde;
    }
}









