<?php
require_once (dirname(__FILE__) . '/../../vendor/autoload.php');

$username = $argv[1];
$password = $argv[2];
$programToken = urldecode($argv[3]);
$sourceToken = urldecode($argv[4]);

$hyperwallet = new \Hyperwallet\Hyperwallet($username, $password);

try {
    $transfers = $hyperwallet->listTransfers(array('limit':'5', 'sourceToken':$sourceToken));
    echo Utils\Utils::toJson($transfers);
    echo "\n";
} catch (\Hyperwallet\Exception\HyperwalletException $e) {
    echo "ERROR:\n";
    echo $e->getMessage();
    die("\n");
}