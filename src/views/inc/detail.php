<section id="details">
<?php // build the image details
$count = 0;
$total = count($works);
$items = array_keys($works);
array_unshift($items, $items[$total -1]);
array_push($items, $items[1]);
foreach($works as $id => $art) {
  $count++;
  $prev = $items[$count-1];
  $next = $items[$count+1]; ?>
  <figure class="detail" id="<?= $id ?>" style="display: none;">
    <nav>
      <button id="prev" onclick="showDetail(<?= $prev ?>)">&lt;</button>
      &nbsp;[ <?= $count ?>of <?= $total ?> ]&nbsp;
      <button id="next" onclick="showDetail(<?= $next ?>)">&gt;</button>
      <button id="closedetail" onclick="hideDetail('<?= $id ?>')" alt="overzicht">×</button>
    </nav>
    <img src="<?= MEDIAROOT.$art['path'] ?>" alt="Painting <?= $data['page'] ?> <?= $art['title'] ?>">
    <figcaption>
      <h3><?= $art['title'] ?></h3>
      <p><?= $art['caption'] ?></p>
    </figcaption>
  </figure>
  <?php } ?>
</section>

<script src="<?= URLROOT; ?>/js/main.js"></script>
</body>
</html>