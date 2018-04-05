<?php
require_once(dirname(__FILE__) . '/../../vendor/autoload.php');

$username = $argv[1];
$password = $argv[2];
$programToken = urldecode($argv[3]);
$userToken = urldecode($argv[4]);
$bankCardToken = urldecode($argv[5]);

$hyperwallet = new \Hyperwallet\Hyperwallet($username, $password, $programToken);

$paymentStatus = new \Hyperwallet\Model\BankCardStatusTransition();
$paymentStatus
    ->setTransition(\Hyperwallet\Model\BankCardStatusTransition::TRANSITION_DE_ACTIVATED);

try {
    $paymentStatus = $hyperwallet->createBankCardStatusTransition($userToken, $bankCardToken, $paymentStatus);
    echo Utils\Utils::toJson($paymentStatus);
    echo "\n";
} catch (\Hyperwallet\Exception\HyperwalletException $e) {
    echo "ERROR:\n";
    echo $e->getMessage();
    die("\n");
}