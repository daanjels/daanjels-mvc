<?php 
    $voornaam = "";
    $familienaam = "";
    $fout = "";
    $email = "";
    $bericht = "";
    $PH_voornaam = "Naam";
    $PH_familienaam = "Familienaam";
    $PH_email = "E-mail";
    $PH_bericht = "Jouw bericht";
    $retval = "";

    if (!empty($_POST)) {
        $voornaam = trim(filter_input(INPUT_POST, 'Firstname', FILTER_SANITIZE_STRING));
        $familienaam = trim(filter_input(INPUT_POST, 'Lastname', FILTER_SANITIZE_STRING));
        $email = trim(filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_STRING));
        $bericht = trim(filter_input(INPUT_POST, 'Message', FILTER_SANITIZE_STRING));
        
        if ($voornaam == '') { // geen voornaam ingevuld
            $PH_voornaam = "Je hebt je naam niet ingevuld...";
        } else if ($familienaam == '') { // geen familienaam ingevuld
            $PH_familienaam = "Je hebt je familienaam niet ingevuld...";
        } else if ($email == '') { // geen e-mail ingevuld
            $PH_email = "Je hebt je e-mailadres niet ingevuld...";
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $fout_email = "Controleer je e-mail adres even, dat lijkt niet correct.";
        } else if ($bericht == '') { // geen bericht geschreven
            $PH_bericht = "Je hebt geen bericht geschreven !!";
        } else if (strlen($bericht) > 1000) { // te lang bericht gemaakt
            $fout_bericht = "Je bericht bevat <strong>".strlen($bericht)." </strong>tekens. Slechts 1000 toegelaten.";
        } else {
            $to = "info@daanjels.be";
            $subject = "Vraag via de site";
            $message = $bericht . "\n" . $voornaam . " " . $familienaam;
            $headers[] = "From: " . $email;
            $headers[] = "Content-Type: text/plain; charset=utf-8";
            $header = implode("\r\n", $headers);
            $retval = mail ($to,$subject,$message,$header);
            if( $retval == true ) {
                header( 'refresh:2;url='.URLROOT.'/index' );
                // exit(0);
            } else {
                echo "Message could not be sent...";
            }
        }
    }

    require APPROOT . '/views/inc/header.php'; 
?>

<section>
    <article>
        <h1 class="form">Contact</h1>
        <?php if ($retval == true) { ?>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p class="form">Bedankt voor je bericht!</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
        <?php } else { ?>
        <form method="POST" action="<?= URLROOT; ?>/contact">
            <input  type="text" 
                    name="Firstname" 
                    value="<?php echo($voornaam) ?>" 
                    placeholder="<?php echo($PH_voornaam) ?>">
            <input  type="text" 
                    name="Lastname" 
                    value="<?php echo(htmlspecialchars($familienaam)) ?>" 
                    placeholder="<?php echo($PH_familienaam) ?>">
            <?php if (!empty($fout_email)) {
                echo("<label>$fout_email</label>");
            } ?>
            <input  type="text" 
                    name="Email" 
                    value="<?php echo($email) ?>" 
                    placeholder="<?php echo($PH_email) ?>">
            <?php if (!empty($fout_bericht)) {
                echo("<label>$fout_bericht</label>"); 
            }?>
            <textarea name="Message" rows="10" placeholder="<?php echo($PH_bericht) ?>" ><?php echo($bericht) ?></textarea>
            <input type="submit" value="Verzenden">
        </form>
        <?php } ?>
    </article>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>