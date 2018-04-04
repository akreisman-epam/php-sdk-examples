<?php
require_once (dirname(__FILE__) . '/../../vendor/autoload.php');

$username = $argv[2];
$password = $argv[3];
$programToken = urldecode($argv[4]);
$userToken = urldecode($argv[5]);
$bankCardToken = urldecode($argv[6]);
$statusTransitionToken = urldecode($argv[7]);

$hyperwallet = new \Hyperwallet\Hyperwallet($username, $password);

try {
    $paymentStatus = $hyperwallet->getBankCardStatusTransition($userToken, $bankCardToken, $statusTransitionToken);
    echo Utils\Utils::toJson($paymentStatus);
    echo "\n";
} catch (\Hyperwallet\Exception\HyperwalletException $e) {
    echo "ERROR:\n";
    echo $e->getMessage();
    die("\n");
}