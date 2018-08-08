<?php

namespace ComposerScript;

use Composer\Script\Event;

class RsaOaep256AlgorithmInstaller {

    public static function install(Event $event) {

        $vendorDir = $event->getComposer()->getConfig()->get('vendor-dir');
        file_put_contents($vendorDir . "/gree/jose/src/JOSE/JWE.php", file_get_contents($vendorDir . "/hyperwallet/sdk/src/JWE"));
    }
}