<?php
require_once (dirname(__FILE__) . '/../../vendor/autoload.php');

$username = $argv[2];
$password = $argv[3];
$programToken = urldecode($argv[4]);
$userToken = urldecode($argv[5]);
$bankCardToken  = urldecode($argv[6]);
$dateOfExpiry   = urldecode($argv[6]);

$hyperwallet = new \Hyperwallet\Hyperwallet($username, $password);

$data =array();
$data['token'] = $bankCardToken;
$data['dateOfExpiry']  = $dateOfExpiry;
$bankCard = new \Hyperwallet\Model\BankCard($data);

try {
    $bankCard = $hyperwallet->updateBankCard($userToken, $bankCard);
    echo Utils\Utils::toJson($bankCard);
    echo "\n";
} catch (\Hyperwallet\Exception\HyperwalletException $e) {
    echo "ERROR:\n";
    echo $e->getMessage();
    die("\n");
}