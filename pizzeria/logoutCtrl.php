<?php
//logoutCtrl.php

declare(strict_types = 1);

spl_autoload_register();

session_start();

if(isset($_GET["action"]) && $_GET["action"] === "logout" ) {
        
    unset($_SESSION["sessionKlant"]);
	unset($_SESSION["sessionKlantId"]);
	unset($_SESSION["mandje"]);
	unset($_SESSION["wilBetalen"]);
	/*
    $mandje = array();
    $totaalRegel = 0;
    $totaalMandje = 0;
	*/
    header("location: index.php");
    exit(0);
   
}
