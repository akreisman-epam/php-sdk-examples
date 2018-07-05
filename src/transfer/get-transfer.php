<?php
require_once (dirname(__FILE__) . '/../../vendor/autoload.php');

$username = $argv[1];
$password = $argv[2];
$programToken = urldecode($argv[3]);
$transferToken = urldecode($argv[4]);

$hyperwallet = new \Hyperwallet\Hyperwallet($username, $password);

try {
    $transfer = $hyperwallet->getTransfer($transferToken);
    echo Utils\Utils::toJson($transfer);
    echo "\n";
} catch (\Hyperwallet\Exception\HyperwalletException $e) {
    echo "ERROR:\n";
    echo $e->getMessage();
    die("\n");
}