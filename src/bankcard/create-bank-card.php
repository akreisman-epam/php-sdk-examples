<?php
require_once (dirname(__FILE__) . '/../../vendor/autoload.php');

$username = $argv[2];
$password = $argv[3];
$programToken = urldecode($argv[4]);
$userToken = urldecode($argv[5]);
$cardNumber  = urldecode($argv[6]);

$hyperwallet = new \Hyperwallet\Hyperwallet($username, $password);

$array=array($programToken, 'ACTIVATED', '2017-11-09T22:50:14', 'US', 'USD', 'DEBIT', $cardNumber, 'VISA', '2018-11');
$bankCard = new \Hyperwallet\Model\BankCard($array);

try {
    $bankCard = $hyperwallet->createBankCard($userToken, $bankCard);
    echo Utils\Utils::toJson($bankCard);
    echo "\n";
} catch (\Hyperwallet\Exception\HyperwalletException $e) {
    echo "ERROR:\n";
    echo $e->getMessage();
    die("\n");
}