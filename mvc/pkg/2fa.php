<?php
require __DIR__ . '/../../vendor/autoload.php';

function GetQR($secret, $accountName = "MyAccount")
{
    $link = \Sonata\GoogleAuthenticator\GoogleQrUrl::generate($accountName, $secret, 'opentalks');
    return $link;
}

function VerifyPassCode($passCode, $secret)
{
    $g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
    if ($g->checkCode($secret, $passCode)) {
        return true;
    }
    return false;
}

function GenerateSecret()
{
    $g = new \Sonata\GoogleAuthenticator\GoogleAuthenticator();
    return $g->generateSecret();
}

?>