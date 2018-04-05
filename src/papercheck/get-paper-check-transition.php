<?php
require_once (dirname(__FILE__) . '/../../vendor/autoload.php');

$username = $argv[1];
$password = $argv[2];
$userToken = urldecode($argv[4]);
$paperCheckToken = urldecode($argv[5]);
$transitionToken = urldecode($argv[6]);

$hyperwallet = new \Hyperwallet\Hyperwallet($username, $password);

try {
    $paymentStatus = $hyperwallet->getPaperCheckStatusTransition($userToken, $paperCheckToken, $transitionToken);
    echo Utils\Utils::toJson($paymentStatus);
    echo "\n";
} catch (\Hyperwallet\Exception\HyperwalletException $e) {
    echo "ERROR:\n";
    echo $e->getMessage();
    die("\n");
}