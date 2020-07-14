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
            <img src="<?= MEDIAROOT.$value['path']; ?>" alt="Painting <?= $data['page'].' '.$value['title']; ?>"/>
        </figure>
        <?php } ?>
    </div>
    <?php }
  } else {
    $count = 0;
    foreach($works as $id => $art) {
      $count++; ?>
      <figure class="mosaic" onclick="showDetail('<?= $id; ?>')" >
        <img src="<?= MEDIAROOT.$art['path']; ?>" alt="<?= $data['page'].' '.$art['title']; ?>">
      </figure><?php }
  } ?>
</section>
<?php 
// require APPROOT.'/views/inc/footer.php';
require APPROOT.'/views/inc/foot.php'; 
?>
</main>

<?php require APPROOT.'/views/inc/detail.php'; ?>