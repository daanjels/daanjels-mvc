<?php 
require APPROOT . '/resources/quotes.php';
$id = idate('W'); // pick this weeks quote (we have only 53 quotes)
// $id = random_int( 1, count($quotes));
?>
<blockquote cite="">
    <img class="left" src="<?= URLROOT; ?>/public/assets/patterns/slquo.svg" alt="Left quote">
    <?php echo $quotes[$id]['quote']; ?>
    <img class="right" src="<?= URLROOT; ?>/public/assets/patterns/srquo.svg" alt="Right quote">
    <p><?php echo $quotes[$id]['author']; ?></p>
    <cite>( <?php echo $quotes[$id]['life']; ?> )</cite>
</blockquote>
