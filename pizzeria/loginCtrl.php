<?php
//loginCtrl.php

declare(strict_types = 1);

spl_autoload_register();

session_start();

use Business\UserService;
use Entities\Klant;
use Exceptions\WachtwoordIncorrectException;
use Exceptions\KlantBestaatNietException;

$errors = array();
$error = "";
$sessionKlantId = null;


if (isset($_POST["btnLogin"])) {
    $email = "";
    $wachtwoord = "";
    
    if (!empty($_POST["txtEmail"])) {
        $email = $_POST["txtEmail"];
    } else {
        $error = "Het e-mailadres moet ingevuld worden !<br>";
        array_push($errors, $error);
    }
    
    if (!empty($_POST["txtWachtwoord"])) {
        $wachtwoord = $_POST["txtWachtwoord"];
    } else {
        $error = "Het wachtwoord moet ingevuld worden !<br>";
        array_push($errors, $error);
    }
    
    if (empty($errors)) {
        try {
            $userSvc = new UserService();
            $sessionKlant = $userSvc->loginKlant($email, $wachtwoord);
            
            $_SESSION["sessionKlant"] = serialize($sessionKlant);
			unset($_SESSION["huidigebestellingid"]);
            
        } catch (WachtwoordIncorrectException $e) {
            $error = "Het wachtwoord is niet correct !<br>";
            array_push($errors, $error);
            
        } catch (KlantBestaatNietException $e) {
            $error = "Er bestaat geen gebruiker met dit e-mailadres !<br>";
            array_push($errors, $error);
        }
    }
}

if (isset($_SESSION["sessionKlant"])) {
	
	if (isset($_SESSION["wilBetalen"])) {
      header("location: afrekenenCtrl.php");
      exit(0);		
	}
	else {
	  unset($_SESSION["wilBetalen"]);
      header("location: index.php");
      exit(0);
	}
}


include_once("Presentation/login.php");

