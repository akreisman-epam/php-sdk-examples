<?php
require_once (dirname(__FILE__) . '/../../vendor/autoload.php');

$username = $argv[1];
$password = $argv[2];
$userToken = urldecode($argv[4]);
$paperCheckToken = urldecode($argv[5]);
$addressLine1 = urldecode($argv[6]);
$encryptionEnabled = $argv[7];

$encryptionData;
if ($encryptionEnabled == 'true') {
    $encryptionData = array('clientPrivateKeySetLocation' => Utils\Utils::CLIENT_PRIVATE_KEYSET_PATH,
        'hyperwalletKeySetLocation' => Utils\Utils::HYPERWALLET_KEYSET_PATH);
}
$hyperwallet = new \Hyperwallet\Hyperwallet($username, $password, null, 'https://sandbox.hyperwallet.com', $encryptionData);

$paperCheck = new \Hyperwallet\Model\PaperCheck();
$paperCheck
    ->setToken($paperCheckToken)
    ->setAddressLine1($addressLine1);

try {
    $paperCheck = $hyperwallet->updatePaperCheck($userToken, $paperCheck);
    echo Utils\Utils::toJson($paperCheck);
    echo "\n";
} catch (\Hyperwallet\Exception\HyperwalletException $e) {
    echo "ERROR:\n";
    echo $e->getMessage();
    die("\n");
}