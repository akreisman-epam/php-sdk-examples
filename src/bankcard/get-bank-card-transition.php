<?php
require_once (dirname(__FILE__) . '/../../vendor/autoload.php');

$username = $argv[1];
$password = $argv[2];
$programToken = urldecode($argv[3]);
$userToken = urldecode($argv[4]);
$bankCardToken = urldecode($argv[5]);
$statusTransitionToken = urldecode($argv[6]);

$hyperwallet = new \Hyperwallet\Hyperwallet($username, $password, $programToken);

try {
    $paymentStatus = $hyperwallet->getBankCardStatusTransition($userToken, $bankCardToken, $statusTransitionToken);
    echo Utils\Utils::toJson($paymentStatus);
    echo "\n";
} catch (\Hyperwallet\Exception\HyperwalletException $e) {
    echo "ERROR:\n";
    echo $e->getMessage();
    die("\n");
}