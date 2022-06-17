<?php 
require_once("header.php"); 
?>

<main class="container">
    <section class="divleft" style="border: 1px solid black">

        <?php
        if (empty($errors) && isset($_SESSION["klant"])) {

            echo "<span style=\"font-weight:bold;\">U bent succesvol geregistreerd !</span>";

        } else if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<span style=\"color:red;font-weight:bold;\"> ERROR ! " . $error . "</span>";
            }
        }?>

        <form action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" autocomplete="off" method="POST">
            <table width="100%"  id="registratie" >
                <tr>
                    <td width="30%">Naam : </td>
                    <td width="70%" colspan="3"><input width="100%" type="text" name="txtNaam"></td>
                </tr>
                <tr>
                    <td width="30%">Voornaam : </td>
                    <td width="70%" colspan="3"><input width="100%" type="text" name="txtVoornaam"></td>
                </tr>
                <tr>
                    <td width="30%">Straat : </td>
                    <td width="50%"><input type="text" name="txtStraat"></td>
                    <td width="5%" style="text-align: center"> N° : </td>
                    <td width="15%"><input type="number" name="txtStraatnummer"></td>
                </tr>
                <tr>
                    <td width="30%">Gemeente : </td>
                    <td width="70%" colspan="3">
                        <select name="plaatsId" id="plaatsId" >
                            <option value="">Kies een beschikbare gemeente...</option>
                            <?php
                                foreach ($gemeentenLijst as $gemeente) {
                                    print("<option value='{$gemeente->getPlaatsId()}'>{$gemeente->getPostcode()} - {$gemeente->getGemeente()}</option>"); }?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td width="30%">Telefoon/GSM : </td>
                    <td width="70%" colspan="3"><input width="100%" type="text" name="txtTelefoon"></td>
                </tr>
                <tr>
                    <td width="30%" style="vertical-align: top;">Bemerkingen* : </td>
                    <td width="70%" colspan="3"><input width="100%" type="text" name="txtBemerkingen" id="txtBemerkingen" style="text-align:  -align: top;"></td>
                </tr><br><br>
                <tr>
                    <td width="30%">Email : </td>
                    <td width="70%" colspan="3"><input width="100%" type="email" name="txtEmail" required><br></td>
                </tr>
                <tr>
                    <td width="30%">Wachtwoord : </td>
                    <td width="70%" colspan="3"><input width="100%" type="password" name="txtWachtwoord" required></td>
                </tr>
                <tr>
                    <td width="30%">Herhaal wachtwoord : </td>
                    <td width="70%" colspan="3"><input width="100%" type="password" name="txtWachtwoordHerhaal" required></td>
                </tr>
                <tr>
                    <td width="30%"></td>
                    <td width="70%" colspan="3"><button type="submit" name="btnRegistreer">REGISTREREN</button></td>
                </tr>
            </table>
        </form>
        <p style="font-size: 12px;">*Optionneel</p>
    </section>
</main>

<?php
require_once("footer.php");
?> 



