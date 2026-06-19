<?php
declare(strict_types=1);

if (!isset($pageTitle)) {
    $pageTitle = 'Dealmakers | Real Estate | Austin, TX';
}
if (!isset($pageSlug)) {
    $pageSlug = 'index';
}
if (!isset($pageStyles)) {
    $pageStyles = '';
}
if (!isset($headExtra)) {
    $headExtra = '';
}
if (!isset($extraScripts)) {
    $extraScripts = [];
}
if (!isset($pageInlineScript)) {
    $pageInlineScript = '';
}

$siteConfig = require __DIR__ . '/config.php';
