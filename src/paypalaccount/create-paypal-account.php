<?php
require_once (dirname(__FILE__) . '/../../vendor/autoload.php');

$username = $argv[1];
$password = $argv[2];
$programToken = urldecode($argv[3]);
$userToken = urldecode($argv[4]);
$userEmail = urldecode($argv[5]);

$hyperwallet = new \Hyperwallet\Hyperwallet($username, $password);

$payPalAccount = new \Hyperwallet\Model\PayPalAccount();
$payPalAccount
    ->setType('PAYPAL_ACCOUNT')
	->setTransferMethodCountry('US')
	->setTransferMethodCurrency('USD')
	->setEmail($userEmail);

try {
    $payPalAccount = $hyperwallet->createPayPalAccount($userToken, $payPalAccount);
    echo Utils\Utils::toJson($payPalAccount);
    echo "\n";
} catch (\Hyperwallet\Exception\HyperwalletException $e) {
    echo "ERROR:\n";
    echo $e->getMessage();
    die("\n");
}