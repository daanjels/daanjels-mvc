<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Global site tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-166821411-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-166821411-1');
  </script>

    <meta charset="UTF-8">
    <meta name="description" content="Artworks by Daanjels">
    <meta name="keywords" content="art,daanjels,artwork,painting,drawing,paintings,drawings,oilpainting,canvas,watercolor,watercolour">
    <meta name="author" content="Wim Daniels">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0">
    <title><?= $data['title'] ?></title>
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="icon" sizes="16x16 32x32 64x64" href="/favicon.ico">
    <link rel="stylesheet" href="<?= URLROOT; ?>/css/daanjels.css">
</head>
<body class="<?= $data['wrap'] ?>-wrap">
<?php if (!isset($data['nav'])) { ?>
    <main id="main">
    <?php require APPROOT . '/views/inc/navigation.php';
} ?>
