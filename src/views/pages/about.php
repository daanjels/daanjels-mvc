<?php require APPROOT . '/views/inc/header.php'; ?>
<section>
    <article>
        <h1><?php echo $data['headline']; ?></h1>
        <?php echo $data['content']; ?>
    </article>
</section>
<?php require APPROOT . '/views/inc/footer.php'; ?>
