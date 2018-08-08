<?php
require_once (dirname(__FILE__) . '/../../vendor/autoload.php');

$username = $argv[1];
$password = $argv[2];
$programToken = urldecode($argv[3]);
$sourceToken = urldecode($argv[4]);
$destinationToken = urldecode($argv[5]);
$encryptionEnabled = $argv[6];

$encryptionData;
if ($encryptionEnabled == 'true') {
    $encryptionData = array('clientPrivateKeySetLocation' => Utils\Utils::CLIENT_PRIVATE_KEYSET_PATH,
        'hyperwalletKeySetLocation' => Utils\Utils::HYPERWALLET_KEYSET_PATH);
}
$hyperwallet = new \Hyperwallet\Hyperwallet($username, $password, null, 'https://sandbox.hyperwallet.com', $encryptionData);

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