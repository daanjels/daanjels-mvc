<?php require APPROOT . '/views/inc/header.php'; ?>

<section>
    <article class="form">
        <h1>Contact</h1>
        <?php if ($data['retval'] == true) { ?>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>Bedankt voor je bericht!</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
        <?php } else { ?>
        <form method="POST" action="<?= URLROOT; ?>/contact">
            <input  type="text" 
                    name="Firstname" 
                    value="<?php echo($data['voornaam']) ?>" 
                    placeholder="<?php echo($data['PH_voornaam']) ?>">
            <input  type="text" 
                    name="Lastname" 
                    value="<?php echo(htmlspecialchars($data['familienaam'])) ?>" 
                    placeholder="<?php echo($data['PH_familienaam']) ?>">
            <?php if (!empty($data['fout_email'])) { ?>
                <label><?= $data['fout_email'] ?></label>
            <?php } ?>
            <input  type="text" 
                    name="Email" 
                    value="<?= $data['email'] ?>" 
                    placeholder="<?= $data['PH_email'] ?>">
            <?php if (!empty($fout_bericht)) { ?>
                <label><?= $data['fout_bericht'] ?></label> 
            <?php } ?>
            <textarea name="Message" rows="10" placeholder="<?= $data['PH_bericht'] ?>" ><?= $data['bericht'] ?></textarea>
            <input type="submit" value="Verzenden">
        </form>
        <?php } ?>
    </article>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>