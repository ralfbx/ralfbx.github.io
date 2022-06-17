<?php
//registratieCtrl.php

declare(strict_types = 1);

spl_autoload_register();

session_start(); 

use Business\UserService;
use Entities\Klant;
use Exceptions\OngeldigEmailadresException;
use Exceptions\KlantBestaatAlException;
use Exceptions\WachtwoordenKomenNietOvereenException;

$errors = array();
$error = "";
$userSvc = new UserService();
$gemeentenLijst = $userSvc->getGemeenten();

if (isset($_POST["btnRegistreer"])) {
    $email = "";
    $wachtwoord = "";
    $wachtwoordHerhaal = "";
    
    if (!empty($_POST["txtNaam"])) {
        $klantNaam = $_POST["txtNaam"]; 
    } else {
        $error = "De naam moet ingevuld worden !<br>";
        array_push($errors, $error);
    }
    
    if (!empty($_POST["txtVoornaam"])) {
        $voornaam = $_POST["txtVoornaam"]; 
    } else {
        $error = "De voornaam moet ingevuld worden !<br>";
        array_push($errors, $error);
    }
    
    if (!empty($_POST["txtStraat"])) {
        $straat = $_POST["txtStraat"]; 
    } else {
        $error = "De straat moet ingevuld worden !<br>";
        array_push($errors, $error);
    }
    
    if (!empty($_POST["txtStraatnummer"])) {
        $straatnummer = intval($_POST["txtStraatnummer"]);
        if ($straatnummer < 1) {
            $error = "Het straatnummer moet groter zijn dan 0 !<br>";
            array_push($errors, $error);
        }
    } else {
        $error = "Het straatnummer moet ingevuld worden !<br>";
        array_push($errors, $error);
    }
    
    if (!empty($_POST["plaatsId"])) {
        $plaatsId = $_POST["plaatsId"];
        $plaatsId = intval($plaatsId);
    } else {
        $error = "De gemeente moet ingevuld worden !<br>";
        array_push($errors, $error);
    }
    
    if (!empty($_POST["txtTelefoon"])) {
        $telefoon = $_POST["txtTelefoon"]; 
    } else {
        $error = "De telefoon moet ingevuld worden !<br>";
        array_push($errors, $error);
    }
    
    if (!empty($_POST["txtBemerkingen"])) {
        $bemerkingen = $_POST["txtBemerkingen"]; 
    } else {
        $bemerkingen = "/";
    }

/////////////////////////////// EMAIL //////////////////////////////
    
    if (!empty($_POST["txtEmail"])) {
        $email = $_POST["txtEmail"]; 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            
            throw new OngeldigEmailadresException();
            
        } else {
            $rowCount = $userSvc->emailReedsInGebruik($email);

            if ($rowCount > 0) {
                
                throw new KlantBestaatAlException();
            }
        }
    } else {
        $error = "Het e-mailadres moet ingevuld worden !<br>";
        array_push($errors, $error);
    }

/////////////////////////////// WACHTWOORD //////////////////////////////
    
    if (!empty($_POST["txtWachtwoord"]) && !empty($_POST["txtWachtwoordHerhaal"])) {
        
        $wachtwoord = $_POST["txtWachtwoord"];
        $wachtwoordHerhaal = $_POST["txtWachtwoordHerhaal"];
        
        if ($wachtwoord !== $wachtwoordHerhaal) {
            
            throw new WachtwoordenKomenNietOvereenException();
        }
        
        $wachtwoord = password_hash($wachtwoord, PASSWORD_DEFAULT);
        
    } else {
        $error = "Beide wachtwoordvelden moeten ingevuld worden !<br>";
        array_push($errors, $error);
    }
    
    if (empty($errors)) {
        try {
            $sessionKlant = $userSvc->registerKlant((string)$klantNaam, (string)$voornaam, (string)$straat, (int)$straatnummer, (int)$plaatsId, (string)$telefoon, (string)$bemerkingen, $email, $wachtwoord);
            
            $_SESSION["sessionKlant"] = serialize($sessionKlant);
            
        } catch (OngeldigEmailadresException $e) {
            
            $error = "Het ingevulde e-mailadres is geen geldig e-mailadres.<br>";
            array_push($errors, $error);
            
        } catch (WachtwoordenKomenNietOvereenException $e) {
            
            $error = "De ingevulde wachtwoorden komen niet overeen.<br>";
            array_push($errors, $error);
            
        } catch (KlantBestaatAlException $e) {
            
            $error = "Er bestaat al een klant met dit e-mailadres.<br>";
            array_push($errors, $error);
        }
    }
}

if (isset($_SESSION["sessionKlant"])) {
    header("location: index.php");
    exit(0);
}


include_once("Presentation/registratie.php");

