<?php
require_once (dirname(__FILE__) . '/../../vendor/autoload.php');

$username = $argv[1];
$password = $argv[2];
$userToken = urldecode($argv[4]);
$paperCheckToken = urldecode($argv[5]);
$encryptionEnabled = $argv[6];

$encryptionData;
if ($encryptionEnabled == 'true') {
    $encryptionData = array('clientPrivateKeySetLocation' => Utils\Utils::CLIENT_PRIVATE_KEYSET_PATH,
        'hyperwalletKeySetLocation' => Utils\Utils::HYPERWALLET_KEYSET_PATH);
}
$hyperwallet = new \Hyperwallet\Hyperwallet($username, $password, null, 'https://sandbox.hyperwallet.com', $encryptionData);

$paperCheckStatusTransition = new \Hyperwallet\Model\PaperCheckStatusTransition();
$paperCheckStatusTransition
    ->setTransition(\Hyperwallet\Model\PaperCheckStatusTransition::TRANSITION_DE_ACTIVATED);

try {
    $paperCheck = $hyperwallet->createPaperCheckStatusTransition($userToken, $paperCheckToken, $paperCheckStatusTransition);
    echo Utils\Utils::toJson($paperCheck);
    echo "\n";
} catch (\Hyperwallet\Exception\HyperwalletException $e) {
    echo "ERROR:\n";
    echo $e->getMessage();
    die("\n");
}