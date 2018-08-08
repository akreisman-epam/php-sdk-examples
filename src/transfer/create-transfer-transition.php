<?php
require_once (dirname(__FILE__) . '/../../vendor/autoload.php');

$username = $argv[1];
$password = $argv[2];
$transferToken = urldecode($argv[4]);
$encryptionEnabled = $argv[5];

$encryptionData;
if ($encryptionEnabled == 'true') {
    $encryptionData = array('clientPrivateKeySetLocation' => Utils\Utils::CLIENT_PRIVATE_KEYSET_PATH,
        'hyperwalletKeySetLocation' => Utils\Utils::HYPERWALLET_KEYSET_PATH);
}
$hyperwallet = new \Hyperwallet\Hyperwallet($username, $password, null, 'https://sandbox.hyperwallet.com', $encryptionData);

$transferStatusTransition = new \Hyperwallet\Model\TransferStatusTransition();
$transferStatusTransition
    ->setTransition(\Hyperwallet\Model\TransferStatusTransition::TRANSITION_SCHEDULED);

try {
    $transfer = $hyperwallet->createTransferStatusTransition($transferToken, $transferStatusTransition);
    echo Utils\Utils::toJson($transfer);
    echo "\n";
} catch (\Hyperwallet\Exception\HyperwalletException $e) {
    echo "ERROR:\n";
    echo $e->getMessage();
    die("\n");
}