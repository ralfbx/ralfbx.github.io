<?php 
require_once("header.php");




?>

<main class="container">
    <div class="divleft">
        <?php 
        if (empty($errors) && isset($_SESSION["klant"])) {

        echo "<span style=\"font-weight:bold;\">U bent succesvol geregistreerd !</span>";

        } else if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<span style=\"color:red;font-weight:bold;\"> ERROR ! " . $error . "</span>";
            }
        }
        ?>
        <form action="./loginCtrl.php" autocomplete="off" method="POST">
            <table width="100%" id="login">
                <tr>
                    <td width="20%">E-mailadres : </td>
                    <td><input autocomplete="off" width="40%" type="email" id="txtEmail" name="txtEmail" required><br></td>
                </tr>
                <tr>
                    <td width="20%">Wachtwoord : </td>
                    <td><input autocomplete="off" width="40%" type="password" id="txtWachtwoord" name="txtWachtwoord" required><br></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button type="submit" name="btnLogin">INLOGGEN</button></td>
                </tr>
            </table>
        </form>
    </div>
</main>

<?php 
require_once("footer.php"); 
?> 



