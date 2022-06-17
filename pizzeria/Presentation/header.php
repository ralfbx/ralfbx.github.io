<!DOCTYPE HTML>
<!-- presentation/header -->
<html>
    <head>
        <meta charset=utf-8>
        <title>PIZZERIA NAPOLI</title>
        <link rel="stylesheet" type="text/css" href="./Presentation/style.css">
    </head>
    <body>
        <header>
            <h1><a href="./index.php">PIZZERIA NAPOLI</a></h1>
            <nav>
                <button class="rubriek" onclick="location.href='./index.php'">Menu</button>
                
                <?php if (!isset($_SESSION["sessionKlant"])) { ?>
                    <button class="rubriek" onclick="location.href='./loginopties.php'">Inloggen</button>
                <?php } else { ?>
                    <button class="rubriek" onclick="location.href='./logoutCtrl.php?action=logout'">Uitloggen</button>
                <?php } ?>
                
                <button class="rubriek" onclick="location.href='./wiezijnwijCtrl.php'">Wie zijn wij ?</button>
                <br><br>
            </nav>
        </header>
