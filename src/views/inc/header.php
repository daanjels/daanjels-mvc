<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>
    <link rel="stylesheet" href="<?= URLROOT; ?>/css/daanjels.css">
</head>
<body class="<?= $data['wrap'] ?>-wrap">
<?php if (!isset($data['nav'])) { ?>
    <main id="main">
    <?php require APPROOT . '/views/inc/navigation.php';
} ?>
