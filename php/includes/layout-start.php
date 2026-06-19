<?php
declare(strict_types=1);
?><!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="/images/favicon.png" type="image/png" />
  <title><?= htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8') ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin />
<?php if ($headExtra !== '') : ?>
<?= $headExtra . "\n" ?>
<?php endif; ?>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;1,500&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="/css/site.css" />
<?php if ($pageStyles !== '') : ?>
  <style>
<?= $pageStyles . "\n" ?>
  </style>
<?php endif; ?>
</head>
<body class="bg-bone font-sans text-carbon antialiased selection:bg-bronze/25 selection:text-carbon">

<?php require __DIR__ . '/header.php'; ?>
