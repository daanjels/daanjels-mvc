<?php require APPROOT.'/views/inc/header.php'; ?>
<header>
    <article>
        <h1>daanjelShop</h1>
        <p>Welkom in de winkel</p>
    </article>
</header>

<section class="<?= $data['mosaic'] ?>">
<?php 
$works = $data['art'];
// var_dump($works);
if ($data['mosaic'] == 'pins') { // for the pins, build four columns
    $counter = 1;
    $cols = array('col 1' => [], 'col 2' => [], 'col 3' => [], 'col 4' => []);
    foreach ($works as $key => $art) { // distribute the images over the columns
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
    foreach($cols as $col => $list) { // iterate through the four columns to fill them
    ?> 
    <div class="col" id="<?= $col ?>">
      <?php foreach($list as $key => $value) { // go through the list of artworks per column
      $dir = pathinfo(MEDIAROOT.$value['path'], PATHINFO_DIRNAME);
      $filename = basename(MEDIAROOT.$value['path'], ".jpg");
      $selectedImage = $dir."/".$filename;
        ?>
				<!-- .$data['page'].'/' -->
        <a href="<?= URLROOT.'/shop/'.$value['url'] ?>">
          <figure class="mosaic">
            <?php echo insertsmallPicture($selectedImage, "Painting ".$data['page']." ".$value['title']); ?>
          </figure>
        </a>
      <?php } ?>
    </div>
    <?php }
  } else { // for grids just loop through all the images
    $count = 0;
    foreach($works as $key => $art) {
      $dir = pathinfo(MEDIAROOT.$art['path'], PATHINFO_DIRNAME);
      $filename = basename(MEDIAROOT.$art['path'], ".jpg");
      $selectedImage = $dir."/".$filename;
      $count++; ?>
      <a href="<?= URLROOT.'/shop/'.$data['page'].'/'.$art['url'] ?>">
        <figure class="mosaic">
				<?php if ($data['mosaic'] == 'grid-2') {
					echo inserthalfPicture($selectedImage, "Painting ".$data['page']." ".$art['title']);
				} else {
					echo insertsmallPicture($selectedImage, "Painting ".$data['page']." ".$art['title']);
				} ?>
        </figure>
      </a><?php }
  } ?>
</section>
<?php 
require APPROOT.'/views/inc/footer.php';