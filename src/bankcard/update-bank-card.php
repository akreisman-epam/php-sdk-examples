<?php
require_once (dirname(__FILE__) . '/../../vendor/autoload.php');

$username = $argv[1];
$password = $argv[2];
$programToken = urldecode($argv[3]);
$userToken = urldecode($argv[4]);
$bankCardToken  = urldecode($argv[5]);
$dateOfExpiry   = urldecode($argv[6]);

$hyperwallet = new \Hyperwallet\Hyperwallet($username, $password, $programToken);

$UTC = new \DateTimeZone("UTC");

$bankCard = new \Hyperwallet\Model\BankCard();
$bankCard->setToken($bankCardToken);
$bankCard->setDateOfExpiry(new \DateTime($dateOfExpiry, $UTC));

try {
    $bankCard = $hyperwallet->updateBankCard($userToken, $bankCard);
    echo Utils\Utils::toJson($bankCard);
    echo "\n";
} catch (\Hyperwallet\Exception\HyperwalletException $e) {
    echo "ERROR:\n";
    echo $e->getMessage();
    die("\n");
}