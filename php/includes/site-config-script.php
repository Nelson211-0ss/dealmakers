<?php
declare(strict_types=1);

$siteConfig = $siteConfig ?? require __DIR__ . '/config.php';
header('Content-Type: application/javascript; charset=utf-8');
echo 'window.DEALMAKERS_SITE = ' . json_encode([
    'calendlyUrl' => $siteConfig['calendlyUrl'],
    'membershipCheckoutUrl' => $siteConfig['membershipCheckoutUrl'],
    'contactEmail' => $siteConfig['contactEmail'],
    'linkedinUrl' => $siteConfig['linkedinUrl'],
    'instagramUrl' => $siteConfig['instagramUrl'],
    'forms' => $siteConfig['forms'],
], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . ';';
