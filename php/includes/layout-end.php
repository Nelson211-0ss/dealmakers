<?php
declare(strict_types=1);
?>
<?php require __DIR__ . '/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <script>
<?php if ($pageInlineScript !== '') : ?>
<?= $pageInlineScript . "\n" ?>
<?php endif; ?>
  </script>
  <script src="/includes/site-config-script.php" defer></script>
<?php foreach ($extraScripts as $script) : ?>
  <script src="/scripts/<?= htmlspecialchars($script, ENT_QUOTES, 'UTF-8') ?>" defer></script>
<?php endforeach; ?>
<?php foreach (['social-links.js', 'book-call.js', 'nav-active.js', 'email-float.js'] as $script) : ?>
  <script src="/scripts/<?= htmlspecialchars($script, ENT_QUOTES, 'UTF-8') ?>" defer></script>
<?php endforeach; ?>
</body>
</html>
