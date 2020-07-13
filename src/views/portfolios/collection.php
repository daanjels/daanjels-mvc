<?php require APPROOT.'/views/inc/header.php'; ?>
<header>
    <article>
        <h1><?= $data['headline']; ?></h1>
        <?= $data['intro']; ?>
    </article>
</header>
<section class="<?= $data['mosaic'] ?>">
<?php 
$works = $data['art'];
if ($data['mosaic'] == 'pins') {
    $counter = 1;
    $cols = array('col 1' => [], 'col 2' => [], 'col 3' => [], 'col 4' => []);
    foreach ($works as $key => $art) {
      if ( ($counter)%4 == 1) {
        $cols['col 1'][$key] = $art; 
      } else if ( ($counter)%4 == 2) {
        $cols['col 2'][$key] = $art; 
      } else if ( ($counter)%4 == 3) {
        $cols['col 3'][$key] = $art; 
      } else if ( ($counter)%4 == 0) {
        $cols['col 4'][$key] = $art; 
      }
      $counter++;
    }
    foreach($cols as $col => $list) { ?>
    <div class="col" id="<?= $col ?>">
        <?php foreach($list as $key => $value) { ?>
        <figure class="mosaic" onclick="showDetail('<?= $key; ?>')">
            <img src="<?= URLROOT.$value['img']; ?>" alt="Painting <?= $data['page'].' '.$value['title']; ?>"/>
        </figure>
        <?php } ?>
    </div>
    <?php }
  } else {
    $count = 0;
    foreach($works as $id => $art) {
      $count++; ?>
      <figure class="mosaic" onclick="showDetail('<?= $id; ?>')" >
        <img src="<?= URLROOT.$art['img']; ?>" alt="<?= $data['page'].' '.$art['title']; ?>">
      </figure><?php }
  } ?>
</section>
<?php require APPROOT.'/views/inc/foot.php'; ?>
</main>

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
    <img src="<?= URLROOT.$art['img'] ?>" alt="Painting <?= $data['page'] ?> <?= $art['title'] ?>">
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