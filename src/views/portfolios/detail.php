<?php require APPROOT.'/views/inc/header.php'; ?>
<section id="details">
<?php 
// build the image details
// using singledetail now to display images in separate pages.
// idea: show the in a display: grid to allow for swiping
$works = $data['art'];
$count = 0;
$total = count($works);
$items = array_keys($works);
array_unshift($items, $items[$total -1]);
array_push($items, $items[1]);
foreach($works as $id => $art) {
  $count++;
  $prev = $items[$count-1];
  $next = $items[$count+1];
  $visibility = 'none';
  if ($id == $data['art_id']) {$visibility = 'block';}
  ?>
  <figure class="detail" id="<?= $id ?>" style="display: <?= $visibility ?>;">
    <nav>
      <a id="prev" href="<?= URLROOT.'/portfolios/'.$data['page'].'/'.$prev ?>">&lt;</a>
      &nbsp;[ <?= $count ?> of <?= $total ?> ]&nbsp;
      <a id="next" href="<?= URLROOT.'/portfolios/'.$data['page'].'/'.$next ?>">&gt;</a>
      <a id="closedetail" href="<?= URLROOT.'/portfolios/'.$data['page'] ?>">×</a>
    </nav>
    <img src="<?= MEDIAROOT.$art['path'] ?>" alt="Painting <?= $data['page'] ?> <?= $art['title'] ?>">
    <figcaption>
      <h3><?= $art['title'] ?></h3>
      <p><?= $art['caption'] ?></p>
    </figcaption>
  </figure>
  <?php } ?>
</section>

</body>
</html>