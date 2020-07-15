<?php 
require APPROOT . '/views/inc/header.php';
    echo $data['content'];
?>
    <blockquote cite="">
        <img class="left" src="<?= URLROOT ?>/assets/patterns/slquo.svg" alt="Left quote">
        <?= $data['quote']->quote ?>
        <img class="right" src="<?= URLROOT ?>/assets/patterns/srquo.svg" alt="Right quote">
        <p><?= $data['quote']->author ?></p>
        <cite>( <?= $data['quote']->life ?> )</cite>
    </blockquote>
<?php
require APPROOT . '/views/inc/footer.php'; 
?>
