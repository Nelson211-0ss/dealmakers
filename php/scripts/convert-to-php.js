/**
 * Generate php/ from static HTML — shared layout + per-page content.
 * Run: node scripts/convert-to-php.js
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');
const phpRoot = path.join(root, 'php');

const COMMON_SCRIPTS = [
  'social-links.js',
  'book-call.js',
  'nav-active.js',
  'email-float.js',
];

function ensureDir(dir) {
  fs.mkdirSync(dir, { recursive: true });
}

function copyDir(src, dest) {
  ensureDir(dest);
  for (const entry of fs.readdirSync(src, { withFileTypes: true })) {
    const from = path.join(src, entry.name);
    const to = path.join(dest, entry.name);
    if (entry.isDirectory()) copyDir(from, to);
    else fs.copyFileSync(from, to);
  }
}

function extractBetween(html, startMarker, endMarker) {
  const start = html.indexOf(startMarker);
  if (start === -1) return '';
  const from = start + startMarker.length;
  const end = html.indexOf(endMarker, from);
  if (end === -1) return '';
  return html.slice(from, end);
}

function extractTag(html, tag) {
  const re = new RegExp(`<${tag}[^>]*>([\\s\\S]*?)<\\/${tag}>`, 'i');
  const m = html.match(re);
  return m ? m[1].trim() : '';
}

function phpEscape(str) {
  return str.replace(/\\/g, '\\\\').replace(/'/g, "\\'");
}

function parsePage(htmlFile) {
  const html = fs.readFileSync(htmlFile, 'utf8');
  const slug = path.basename(htmlFile, '.html');

  const title = extractTag(html, 'title') || 'Dealmakers';
  const pageStyles = extractTag(html, 'style');

  const headBlock = extractBetween(html, '<head>', '</head>');
  const headExtra = headBlock
    .replace(/<meta charset="UTF-8"\s*\/?>/i, '')
    .replace(/<meta name="viewport"[^>]*>/i, '')
    .replace(/<link rel="icon"[^>]*>/i, '')
    .replace(/<title>[\s\S]*?<\/title>/i, '')
    .replace(/<link rel="preconnect"[^>]*>/gi, '')
    .replace(/<link href="https:\/\/fonts\.googleapis\.com[^>]*>/i, '')
    .replace(/<link rel="stylesheet" href="css\/site\.css"\s*\/?>/i, '')
    .replace(/<style>[\s\S]*?<\/style>/i, '')
    .trim();

  const content = extractBetween(html, '</header>', '<footer').trim();

  const footerIdx = html.indexOf('<footer');
  const scriptsBlock = html.slice(footerIdx);
  const inlineMatch = scriptsBlock.match(/<script>\s*([\s\S]*?)<\/script>/i);
  const inlineScript = inlineMatch ? inlineMatch[1].trim() : '';

  const scriptMatches = [...scriptsBlock.matchAll(/<script src="scripts\/([^"]+)"[^>]*>/g)].map((m) => m[1]);
  const extraScripts = scriptMatches.filter(
    (s) => s !== 'site-config.js' && !COMMON_SCRIPTS.includes(s)
  );

  return { slug, title, pageStyles, headExtra, content, inlineScript, extraScripts };
}

function writeIncludes(headerHtml, footerHtml) {
  const includes = path.join(phpRoot, 'includes');
  ensureDir(includes);

  fs.writeFileSync(
    path.join(includes, 'config.php'),
    `<?php
declare(strict_types=1);

/**
 * Site URLs — update Calendly, checkout, and social links here.
 */
return [
    'calendlyUrl' => 'https://calendly.com/dani-dealmakersus/30min',
    'membershipCheckoutUrl' =>
        'https://zohosecurepay.com/checkout/0ycqpsx-klx9vmn3mqmw/Dealmakers-LLC',
    'contactEmail' => 'deals@dealmakersus.com',
    'linkedinUrl' => 'https://www.linkedin.com/company/dealmakers-us/?viewAsMember=true',
    'instagramUrl' => 'https://www.instagram.com/dealmakers_us/',
    'forms' => [
        'membershipInquiry' =>
            'https://forms.zohopublic.com/dealmakersllc1/form/MembershipInquiryForm/formperma/RpZ_jsKGUB8pLAfHX5HCcAjN932aduq6LnFcmR36OY4',
        'sponsorshipInquiry' =>
            'https://forms.zohopublic.com/dealmakersllc1/form/SponsorshipInterestForm/formperma/uOTtg-6ftxEwF-X5eanhjpAk9AyLuyax38aXRYxCJVo',
        'speakerIntake' =>
            'https://forms.zohopublic.com/dealmakersllc1/form/SpeakerIntakeForm/formperma/Aea_N1QI1ug_ZZrZeQosFCAm4NMbW_eQ5sn5wb_ar1Y',
        'requestAccess' => null,
    ],
];
`
  );

  fs.writeFileSync(
    path.join(includes, 'bootstrap.php'),
    `<?php
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
`
  );

  fs.writeFileSync(
    path.join(includes, 'site-config-script.php'),
    `<?php
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
`
  );

  fs.writeFileSync(
    path.join(includes, 'layout-start.php'),
    `<?php
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
<?= $headExtra . "\\n" ?>
<?php endif; ?>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;0,500;0,600;0,700;1,500&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="/css/site.css" />
<?php if ($pageStyles !== '') : ?>
  <style>
<?= $pageStyles . "\\n" ?>
  </style>
<?php endif; ?>
</head>
<body class="bg-bone font-sans text-carbon antialiased selection:bg-bronze/25 selection:text-carbon">

<?php require __DIR__ . '/header.php'; ?>
`
  );

  fs.writeFileSync(path.join(includes, 'header.php'), headerHtml.trim() + '\n');

  fs.writeFileSync(
    path.join(includes, 'layout-end.php'),
    `<?php
declare(strict_types=1);
?>
<?php require __DIR__ . '/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
  <script>
<?php if ($pageInlineScript !== '') : ?>
<?= $pageInlineScript . "\\n" ?>
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
`
  );

  fs.writeFileSync(path.join(includes, 'footer.php'), footerHtml.trim() + '\n');
}

function writePage(page) {
  const fileName = page.slug === 'index' ? 'index.php' : page.slug + '.php';
  const filePath = path.join(phpRoot, fileName);

  const lines = [
    '<?php',
    'declare(strict_types=1);',
    "require_once __DIR__ . '/includes/bootstrap.php';",
    '',
    `$pageTitle = '${phpEscape(page.title)}';`,
    `$pageSlug = '${phpEscape(page.slug)}';`,
  ];

  if (page.pageStyles) {
    lines.push("$pageStyles = <<<'CSS'");
    lines.push(page.pageStyles);
    lines.push('CSS;');
  }

  if (page.headExtra) {
    lines.push("$headExtra = <<<'HTML'");
    lines.push(page.headExtra);
    lines.push('HTML;');
  }

  if (page.extraScripts.length) {
    lines.push('$extraScripts = [');
    page.extraScripts.forEach((s) => lines.push(`  '${phpEscape(s)}',`));
    lines.push('];');
  }

  if (page.inlineScript) {
    lines.push("$pageInlineScript = <<<'JS'");
    lines.push(page.inlineScript);
    lines.push('JS;');
  }

  lines.push("require __DIR__ . '/includes/layout-start.php';");
  lines.push('?>');
  lines.push(page.content);
  lines.push("<?php require __DIR__ . '/includes/layout-end.php'; ?>");
  lines.push('');

  fs.writeFileSync(filePath, lines.join('\n'));
}

function writeRouter() {
  fs.writeFileSync(
    path.join(phpRoot, 'router.php'),
    `<?php
declare(strict_types=1);

/**
 * PHP built-in server router — clean URLs (matches .htaccess).
 * Run: php -S 127.0.0.1:8080 router.php
 */
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/');
$file = __DIR__ . $uri;

if ($uri !== '/' && is_file($file)) {
    return false;
}

if (preg_match('/\\.php$/i', $uri)) {
    $clean = preg_replace('/\\.php$/i', '', $uri) ?: '/';
    if ($clean === '/index') {
        $clean = '/';
    }
    header('Location: ' . $clean, true, 301);
    exit;
}

$slug = trim($uri, '/');
if ($slug === '' || $slug === 'index') {
    require __DIR__ . '/index.php';
    return true;
}

$candidate = __DIR__ . '/' . $slug . '.php';
if (is_file($candidate)) {
    require $candidate;
    return true;
}

http_response_code(404);
echo '404 Not Found';
return true;
`
  );

  fs.writeFileSync(
    path.join(phpRoot, '.htaccess'),
    `# Clean URLs for PHP on GoDaddy / Apache
RewriteEngine On
RewriteBase /

# /index.php → /
RewriteCond %{THE_REQUEST} \\s/+index\\.php[\\s?] [NC]
RewriteRule ^ / [R=301,L]

# /page.php → /page
RewriteCond %{THE_REQUEST} \\s/+(.+)\\.php[\\s?] [NC]
RewriteRule ^ /%1 [R=301,L]

# /page → page.php (internal only)
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteCond %{DOCUMENT_ROOT}/%1.php -f
RewriteRule ^(.+?)/?$ $1.php [L]

# Home
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^$ index.php [L]
`
  );
}

// --- main ---
ensureDir(phpRoot);

const refHtml = fs.readFileSync(path.join(root, 'membership.html'), 'utf8');
const headerHtmlClean = extractBetween(refHtml, '<!-- Header -->', '</header>').trim();
const headerHtmlFinal = '  <!-- Header -->\n  ' + headerHtmlClean + '\n  </header>';
const footerInner = extractBetween(refHtml, '<footer', '</footer>');
const footerHtmlClean = '<footer' + footerInner + '\n  </footer>';

writeIncludes(headerHtmlFinal, footerHtmlClean);

const htmlFiles = fs
  .readdirSync(root)
  .filter((f) => f.endsWith('.html'))
  .sort((a, b) => (a === 'index.html' ? -1 : b === 'index.html' ? 1 : a.localeCompare(b)));

htmlFiles.forEach((file) => {
  const page = parsePage(path.join(root, file));
  writePage(page);
  console.log('Wrote', page.slug + '.php');
});

copyDir(path.join(root, 'css'), path.join(phpRoot, 'css'));
copyDir(path.join(root, 'images'), path.join(phpRoot, 'images'));

const scriptsDest = path.join(phpRoot, 'scripts');
ensureDir(scriptsDest);
for (const file of fs.readdirSync(path.join(root, 'scripts'))) {
  if (file === 'site-config.js') continue;
  if (file.endsWith('.js')) {
    fs.copyFileSync(path.join(root, 'scripts', file), path.join(scriptsDest, file));
  }
}

writeRouter();

console.log('\\nPHP site ready in php/');
console.log('Preview: cd php && php -S 127.0.0.1:8080 router.php');
