<?php require APPROOT.'/views/inc/header.php'; ?>
<header>
	<article>
		<h1><?php echo $data['headline']; ?></h1>
		<?php echo $data['content']; ?>
	</article>
</header>

<section id="prices">
	<p>&nbsp;</p>
	<?php 
		$works = $data['art'];
		$count = 0;
		foreach($works as $key => $art) {
			$dir = pathinfo(MEDIAROOT.$art['path'], PATHINFO_DIRNAME);
			$filename = basename(MEDIAROOT.$art['path'], ".jpg");
			$selectedImage = $dir."/".$filename;
			$count++; ?>
			<a href="<?= URLROOT.'/shop/'.$art['collection'].'/'.$art['url'] ?>" id="<?= $art['url'] ?>">
				<?php echo insertsmallPicture($selectedImage, "Painting ".$art['title'], 'style="margin-top: 1.5rem;margin-right: 1rem;height: 7.8rem;width: auto;float: left;padding-top: 2px;"'); ?>
			</a>
			<h2><?= $art['title'] ?></h2>
			<p><?= $art['caption'] ?></p>
			<p>&nbsp;</p>
			<?php if ($art['stock'] == 'Te koop') { ?>
					<h4>Te koop voor &nbsp;<a href="<?= URLROOT.'/shop/order/'.$art['collection'].'/'.$art['url'] ?>" class="button">&euro; <?= $art['price'] ?></a></h4>
				<?php } else { ?>
					<h4><?= $art['stock'] ?></h4>
				<?php } ?>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
		<?php } ?>
	</section>
<?php 
require APPROOT.'/views/inc/footer.php';
