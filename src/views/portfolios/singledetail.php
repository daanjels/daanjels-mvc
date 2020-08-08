<?php require APPROOT.'/views/inc/header.php';
// build a single image detail
$art = $data['art'];
?>
<script src="<?= URLROOT; ?>/js/main.js"></script>
<section id="details">
  <figure>
    <nav>
      <a id="prev" href="<?= URLROOT.'/portfolios/'.$data['page'].'/'.$art['prev'] ?>"></a>
      &nbsp;[ <?= $art['count'] ?> van <?= $art['total'] ?> ]&nbsp;
      <a id="next" href="<?= URLROOT.'/portfolios/'.$data['page'].'/'.$art['next'] ?>"></a>
    </nav>
    <?php 
      $dir = pathinfo(MEDIAROOT.$art['path'], PATHINFO_DIRNAME);
      $filename = basename(MEDIAROOT.$art['path'], ".jpg");
      $selectedImage = $dir."/".$filename;
      $alt = "Painting ".$data['page'].' '.$art['title'];
      echo insertPicture($selectedImage, $alt);
    ?>
    <figcaption>
      <h3><?= $art['title'] ?></h3>
      <p><?= $art['caption'] ?></p>
    </figcaption>
  </figure>
  <a id="closedetail" class="<?= $data['mosaic'] ?>" href="<?= URLROOT.'/portfolios/'.$data['page'] ?>">&nbsp;</a><!-- × -->
</section>

<script>detailKeys();</script>
</body>
</html>