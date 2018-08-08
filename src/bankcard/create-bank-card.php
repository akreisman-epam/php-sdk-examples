<?php
require_once (dirname(__FILE__) . '/../../vendor/autoload.php');

$username = $argv[1];
$password = $argv[2];
$programToken = urldecode($argv[3]);
$userToken = urldecode($argv[4]);
$cardNumber  = urldecode($argv[5]);
$encryptionEnabled = $argv[6];

$encryptionData;
if ($encryptionEnabled == 'true') {
    $encryptionData = array('clientPrivateKeySetLocation' => Utils\Utils::CLIENT_PRIVATE_KEYSET_PATH,
        'hyperwalletKeySetLocation' => Utils\Utils::HYPERWALLET_KEYSET_PATH);
}
$hyperwallet = new \Hyperwallet\Hyperwallet($username, $password, null, 'https://sandbox.hyperwallet.com', $encryptionData);

$UTC = new \DateTimeZone("UTC");
$bankCard = new \Hyperwallet\Model\BankCard();
$bankCard
    ->setCardNumber($cardNumber)
    ->setTransferMethodCountry('US')
    ->setTransferMethodCurrency('USD')
    ->setDateOfExpiry(new \DateTime('2020-01-1', $UTC))
    ->setType('BANK_CARD');

try {
    $bankCard = $hyperwallet->createBankCard($userToken, $bankCard);
    echo Utils\Utils::toJson($bankCard);
    echo "\n";
} catch (\Hyperwallet\Exception\HyperwalletException $e) {
    echo "ERROR:\n";
    echo $e->getMessage();
    die("\n");
}