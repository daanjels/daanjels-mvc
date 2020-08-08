<?php

function insertsmallPicture($selectedImage, $alt)
{
    $insert = '<picture>' .
        '<source media="(max-width: 512px)" srcset="'.$selectedImage.'_128_.jpg">' .
        '<source media="(max-width: 1024px)" srcset="'.$selectedImage.'_256_.jpg">' .
        '<source media="(max-width: 1408px)" srcset="'.$selectedImage.'_384_.jpg">' .
        '<img src="'.$selectedImage.'_512_.jpg" alt="'.$alt.'"/>' .
        '</picture>';
    return $insert;
}

function insertPicture($selectedImage, $alt)
{
    $insert = '<picture>' .
        '<source media="(max-width: 384px)" srcset="'.$selectedImage.'_384_.jpg">' .
        '<source media="(max-width: 512px)" srcset="'.$selectedImage.'_512_.jpg">' .
        '<source media="(max-width: 768px)" srcset="'.$selectedImage.'_768_.jpg">' .
        '<source media="(max-width: 1024px)" srcset="'.$selectedImage.'_1024_.jpg">' .
        '<source media="(max-width: 1408px)" srcset="'.$selectedImage.'_1408_.jpg">' .
        '<img src="'.$selectedImage.'.jpg" alt="'.$alt.'"/>' .
        '</picture>';
    return $insert;
}