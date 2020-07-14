<?php require APPROOT.'/views/inc/header.php';
// build a single image detail
$art = $data['art'];
?>
<script src="<?= URLROOT; ?>/js/main.js"></script>
<section id="details">
  <figure>
    <nav>
      <a id="prev" href="<?= URLROOT.'/portfolios/'.$data['page'].'/'.$art['prev'] ?>">&lt;</a>
      &nbsp;[ <?= $art['count'] ?> of <?= $art['total'] ?> ]&nbsp;
      <a id="next" href="<?= URLROOT.'/portfolios/'.$data['page'].'/'.$art['next'] ?>">&gt;</a>
      <a id="closedetail" href="<?= URLROOT.'/portfolios/'.$data['page'] ?>">×</a>
    </nav>
    <img src="<?= MEDIAROOT.$art['path'] ?>" alt="Painting <?= $data['page'] ?> <?= $art['title'] ?>">
    <figcaption>
      <h3><?= $art['title'] ?></h3>
      <p><?= $art['caption'] ?></p>
    </figcaption>
  </figure>
</section>

<script>detailKeys();</script>
<!-- adapt script for keypresses -->
</body>
</html>