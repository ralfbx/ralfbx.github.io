<?php
//data/PizzeriaDAO.php 

declare(strict_types=1);

namespace Data;

require_once("BaseDAO.php");
//require_once __DIR__ . "/BaseDAO.php";    WERKT NIET

use Data\BaseDAO;
use Entities\Product;
use Entities\Bestelregel;

use Entities\BestelregelProduct;

use Exceptions\WachtwoordIncorrectException;
use Exceptions\ProductBestaatNietException;

class PizzeriaDAO extends BaseDAO {
    
    public function getProductsDAO (): array {   
        $dbh = $this->db_connect();
        $resultSet = $dbh->query("SELECT productId, productNaam, beeldNaam, kostPrijs, promo, samenstelling, voedingswaarde FROM producten WHERE beschikbaarheid = 1");
        $lijst = array();
        
        foreach($resultSet as $rij) {
            $product = new Product ((int)$rij["productId"], (string)$rij["productNaam"], (string)$rij["beeldNaam"], (float)$rij["kostPrijs"], (float)$rij["promo"], (string)$rij["samenstelling"], (string)$rij["voedingswaarde"]);
            array_push($lijst, $product);
        }
        $dbh = null;
        return $lijst;
    }
        
    public function getProductByIdDAO ($productId): ?Product {
        try {
            $dbh = $this->db_connect();
            $stmt = $dbh->prepare("SELECT productId, productNaam, beeldNaam, kostPrijs, promo, samenstelling, voedingswaarde FROM producten WHERE productId = :productId");
            $stmt->bindValue(":productId", $productId);
            $stmt->execute();
            $rij = $stmt->fetch(\PDO::FETCH_ASSOC);
            if (!$rij) {
                throw new ProductBestaatNietException("Cannot find product with productId: " . $productId);
            } else {
                return new Product((int)$rij["productId"], (string)$rij["productNaam"], (string)$rij["beeldNaam"], (float)$rij["kostPrijs"], (float)$rij["promo"], (string)$rij["samenstelling"], (string)$rij["voedingswaarde"]);
            }

        } catch (\PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
        }
        return null;
    }
    
    ///////////////// BESTELLING //////////////////
    
    
    public function createNewBestellingDAO (int $sessionKlantId, string $informatie, float $totprijs): int {

        $dbh = $this->db_connect();
        $stmt = $dbh->prepare("INSERT INTO bestellingen (klantId, datumEnTijdstip, totaalPrijs, informatie) VALUES (:klantId, :datumEnTijdstip, :totaalPrijs, :informatie)");
        $stmt->bindValue(":klantId", $sessionKlantId);
        $stmt->bindValue(":datumEnTijdstip", date("Y-m-d H:i:s"));
        $stmt->bindValue(":totaalPrijs", $totprijs);
        $stmt->bindValue(":informatie", $informatie);
        $stmt->execute();
        $bestelId = $dbh->lastInsertId();
        $dbh = null;
        return intval($bestelId);
    }
    
    public function updateBestellingDAO (int $bestelId, int $sessionKlantId, string $informatie): int {
        $dbh = $this->db_connect();
        $stmt = $dbh->prepare("UPDATE bestellingen SET klantId = :klantId, informatie = :informatie WHERE bestelId = :bestelId");
        $stmt->bindValue(":bestelId", $bestelId);
        $stmt->bindValue(":klantId", $$sessionKlantId);
        $stmt->bindValue(":informatie", $informatie);
        $stmt->execute();
        $dbh = null;
    }
    
    public function updateTotaalMandjeDAO (int $bestelId, float $totaalRegel) : float {
        $dbh = $this->db_connect();
        $stmt = $dbh->prepare("UPDATE bestellingen SET totaalPrijs = :totaalPrijs WHERE bestelId = :bestelId");
        $stmt->bindValue(":bestelId", $bestelId);
        $stmt->bindValue(":totaalPrijs", $totaalRegel);
        $stmt->execute();
        $rij = $stmt->fetch(\PDO::FETCH_ASSOC);
        $totaalMandje = !$rij ? false : $rij["totaalPrijs"];
        $dbh = null;
        return floatval($totaalMandje);
    }
    
    public function getMandjeDAO (int $bestelId): array {
        $dbh = $this->db_connect();
        $stmt = $dbh->prepare("SELECT * FROM bestelregels WHERE bestelId = :bestelId");
        $stmt->bindValue(":bestelId", $bestelId);
        $stmt->execute();
        //$resultSet = $stmt->fetch(\PDO::FETCH_ASSOC);  // Adinda: als je 1 resultaat verwacht
		$resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC); // Adinda: als je meerdere resultaten verwacht
		
        $mandje = array();
        foreach($resultSet as $rij) {  // Adinda: indien je een foreach lus maakt, gebruik fetchAll
            $bestelregel = new Bestelregel((int)$rij["bestelregelId"], (int)$rij["bestelId"], (int)$rij["productId"], (int)$rij["aantal"]);
            array_push($mandje, $bestelregel);
        }
        $dbh = null;
        return $mandje;
    }
    
    ///////////////// BESTELREGELS //////////////////
    /*
    public function addBestelregelDAO (int $bestelId, int $selectProductId) : float {
        $dbh = $this->db_connect();
        $stmt = $dbh->prepare("SELECT * FROM bestelregels WHERE bestelId = :bestelId AND productId = :productId");
        $stmt->bindValue(":bestelId", $bestelId);
        $stmt->bindValue(":productId", $selectProductId);
        $stmt->execute();
        $rij = $stmt->fetch(\PDO::FETCH_ASSOC);
        $dbh = null;
        if (!$rij) {
            $dbh = $this->db_connect();
            $stmt = $dbh->prepare("INSERT INTO bestelregels (bestelId, productId, aantal) VALUES (:bestelId, :productId, :aantal)");
            $stmt->bindValue(":bestelId", $bestelId);
            $stmt->bindValue(":productId", $selectProductId);
            $stmt->bindValue(":aantal", 1);
            $stmt->execute();
            $selectProduct = $this->getProductByIdDAO ($selectProductId);
            $totaalRegel = $selectProduct->getKostPrijs();
        } else {
            $nieuweAantal = intval($rij["aantal"]+=1);
            $dbh = $this->db_connect();
            $stmt = $dbh->prepare("UPDATE bestelregels SET aantal = :aantal WHERE bestelId = :bestelId AND productId = :productId");
            $stmt->bindValue(":bestelId", $bestelId);
            $stmt->bindValue(":productId", $selectProductId);
            $stmt->bindValue(":aantal", $nieuweAantal);
            $stmt->execute();
            $selectProduct = $this->getProductByIdDAO ($selectProductId);
            $kostprijs = $selectProduct->getKostPrijs();
            $totaalRegel = $nieuweAantal*$kostprijs;
        }
        $dbh = null;
        return floatval($totaalRegel);
    }
	*/
	
    
    public function addBestelregelDAO (int $bestelId, int $selectProductId, int $aantal) {
        $dbh = $this->db_connect();
        $stmt = $dbh->prepare("INSERT INTO bestelregels (bestelId, productId, aantal) VALUES (:bestelId, :productId, :aantal)");
        $stmt->bindValue(":bestelId", $bestelId);
        $stmt->bindValue(":productId", $selectProductId);
        $stmt->bindValue(":aantal", $aantal);
        $stmt->execute();
        $dbh = null;
    }
	
}
    
   