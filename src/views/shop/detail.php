<?php 
require APPROOT.'/views/inc/header.php';
// build a single image detail
$art = $data['art'];
?>
<script src="<?= URLROOT; ?>/js/main.js"></script>
<section id="prices">
	<nav>
		<a id="prev" href="<?= URLROOT.'/shop/'.$art['collection'].'/'.$art['prev'] ?>"></a>
		<a id="next" href="<?= URLROOT.'/shop/'.$art['collection'].'/'.$art['next'] ?>"></a>
	</nav>
  <figure class="<?=$art['orientation'] ?>">
    <?php
      $dir = pathinfo(MEDIAROOT.$art['path'], PATHINFO_DIRNAME);
      $filename = basename(MEDIAROOT.$art['path'], ".jpg");
      $selectedImage = $dir."/".$filename;
      $alt = "Painting ".$art['collection'].' '.$art['title'];
      echo insertPicture($selectedImage, $alt);
    ?>
    <figcaption>
      <h3><?= $art['title'] ?></h3>
      <p><?= $art['caption'] ?></p>
			<?php if ($art['stock'] == 'Te koop') { ?>
				<h5>Te koop voor &nbsp;<a href="<?= URLROOT.'/shop/order/'.$art['collection'].'/'.$art['url'] ?>" class="button">&euro; <?= $art['price'] ?></a></h5>
			<?php } else { ?>
				<h5><?= $art['stock'] ?></h5>
			<?php } ?>
    </figcaption>
  </figure>
  <a id="closedetail" class="<?= $data['mosaic'] ?>" href="<?= URLROOT.'/shop/'.$art['collection'] ?>">&nbsp;</a><!-- × -->
</section>

<script>detailKeys();</script>
</body>
</html>