<?php
require_once (dirname(__FILE__) . '/../../vendor/autoload.php');

$username = $argv[1];
$password = $argv[2];
$programToken = urldecode($argv[3]);
$userToken = urldecode($argv[4]);
$encryptionEnabled = $argv[5];

$encryptionData;
if ($encryptionEnabled == 'true') {
    $encryptionData = array('clientPrivateKeySetLocation' => Utils\Utils::CLIENT_PRIVATE_KEYSET_PATH,
        'hyperwalletKeySetLocation' => Utils\Utils::HYPERWALLET_KEYSET_PATH);
}
$hyperwallet = new \Hyperwallet\Hyperwallet($username, $password, null, 'https://sandbox.hyperwallet.com', $encryptionData);

$paperCheck = new \Hyperwallet\Model\PaperCheck();
$paperCheck
    ->setType(\Hyperwallet\Model\PaperCheck::TYPE_PAPER_CHECK)
	->setBankAccountRelationship(\Hyperwallet\Model\PaperCheck::BANK_ACCOUNT_RELATIONSHIP_SELF)
	->setProfileType(\Hyperwallet\Model\PaperCheck::PROFILE_TYPE_INDIVIDUAL)
	->setTransferMethodCountry('US')
	->setTransferMethodCurrency('USD');

try {
    $paperCheck = $hyperwallet->createPaperCheck($userToken, $paperCheck);
    echo Utils\Utils::toJson($paperCheck);
    echo "\n";
} catch (\Hyperwallet\Exception\HyperwalletException $e) {
    echo "ERROR:\n";
    echo $e->getMessage();
    die("\n");
}