<?php 
	require APPROOT . '/views/inc/header.php';
?>
<section>
	<article class="form">
    <h1>Bestelling</h1>
			<?php if ($data['retval'] == true) { ?>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p><?= $data['accepted'] ?></p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<a href="<?= URLROOT ?>/expo ?>">Terug naar de expo pagina</a>
			<?php } else { ?>
			<form method="POST" action="<?= URLROOT; ?>/expo/order/<?= $data['art'] ?>">
				<figure>
					<?php
						$dir = pathinfo(MEDIAROOT.$data['path'], PATHINFO_DIRNAME);
						$filename = basename(MEDIAROOT.$data['path'], ".jpg");
						$selectedImage = $dir."/".$filename;
						$alt = "Painting ".$data['art'];
						echo insertPicture($selectedImage, $alt);
					?>
				</figure>
				<textarea name="Message" rows="5" placeholder="<?= $data['PH_bericht'] ?>" ><?= $data['bericht'] ?></textarea>
				<?php if (!empty($fout_bericht)) { ?>
						<label><?= $data['fout_bericht'] ?></label> 
				<?php } ?>
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
				<input  type="text" 
								name="Telephone" 
								value="<?php echo($data['telefoon']) ?>" 
								placeholder="<?php echo($data['PH_telefoon']) ?>">

				<input type="submit" value="Verzenden">
				<h5><a href="<?= URLROOT ?>/shop/<?= $data['collection'] ?>" >Nee, ik twijfel nog...</a></h5>
				<!-- onclick="history.back()" -->
			</form>
		<?php } ?>
	</article>
</section>

<?php require APPROOT . '/views/inc/footer.php'; ?>