<?php
require_once (dirname(__FILE__) . '/../../vendor/autoload.php');

$username = $argv[1];
$password = $argv[2];
$programToken = urldecode($argv[3]);
$paymentToken = urldecode($argv[4]);

$hyperwallet = new \Hyperwallet\Hyperwallet($username, $password);

$paymentStatus = new \Hyperwallet\Model\PaymentStatusTransition();
$paymentStatus
    ->setTransition(\Hyperwallet\Model\PaymentStatusTransition::TRANSITION_CANCELLED);

try {
    $paymentStatus = $hyperwallet->createPaymentStatusTransition($paymentToken, $paymentStatus);
    echo Utils\Utils::toJson($paymentStatus);
    echo "\n";
} catch (\Hyperwallet\Exception\HyperwalletException $e) {
    echo "ERROR:\n";
    echo $e->getMessage();
    die("\n");
}