<?php
include "vendor/autoload.php";

$kraken = new Kraken("11514c60bb216e287a2b6f357663f8e9", "e64668f982d3b443cbaa0cf0034aeb1dff2da906");

$params = array(
    "url" => "https://assets.kraken.io/assets/images/kraken-logotype.png",
    "wait" => true
);

$data = $kraken->url($params);
echo '<pre>';
var_dump($data);