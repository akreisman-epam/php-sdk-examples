<?php
require_once(dirname(__FILE__) . '/../../vendor/autoload.php');

$username = $argv[2];
$password = $argv[3];
$programToken = urldecode($argv[4]);
$userToken = urldecode($argv[5]);

$hyperwallet = new \Hyperwallet\Hyperwallet($username, $password);

try {
    $listResponse = $hyperwallet->listBankCards($userToken);
    echo Utils\Utils::toJson($listResponse);
    echo "\n";
} catch (\Hyperwallet\Exception\HyperwalletException $e) {
    echo "ERROR:\n";
    echo $e->getMessage();
    die("\n");
}