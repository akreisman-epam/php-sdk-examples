<?php
require_once (dirname(__FILE__) . '/../../vendor/autoload.php');

$username = $argv[1];
$password = $argv[2];
$programToken = urldecode($argv[3]);
$sourceToken = urldecode($argv[4]);
$destinationToken = urldecode($argv[5]);

$hyperwallet = new \Hyperwallet\Hyperwallet($username, $password);

date_default_timezone_set('UTC');
$transfer = new \Hyperwallet\Model\Transfer();
$transfer
    ->setSourceToken($sourceToken)
    ->setDestinationToken($destinationToken)
	->setClientTransferId(date('m/d/Y/h/i/s/a', time()));

try {
    $transfer = $hyperwallet->createTransfer($transfer);
    echo Utils\Utils::toJson($transfer);
    echo "\n";
} catch (\Hyperwallet\Exception\HyperwalletException $e) {
    echo "ERROR:\n";
    echo $e->getMessage();
    die("\n");
}