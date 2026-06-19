# Dealmakers (PHP)

Server-side PHP copy of the static Dealmakers site. Same pages, styling, and behavior — with shared layout includes and PHP-driven site config.

## Local preview

Requires PHP 8.0+.

```bash
cd php
php -S 127.0.0.1:8080 router.php
```

Open `http://127.0.0.1:8080/membership` (clean URLs, same as production).

## Deploy to GoDaddy

Upload the contents of `php/` to `public_html`:

- All `.php` pages at the document root
- `includes/` (config, layout, site-config script)
- `css/`, `images/`, `scripts/`
- `.htaccess` (clean URL rewrites for PHP)

**Site config:** edit `includes/config.php` (Calendly, Zoho checkout, social URLs, form embeds). The old `scripts/site-config.js` is replaced by `includes/site-config-script.php`, which outputs the same `window.DEALMAKERS_SITE` object for the client scripts.

## Regenerate from static HTML

After editing the root `.html` files, rebuild the PHP copy:

```bash
node scripts/convert-to-php.js
```

This rewrites all pages in `php/`, refreshes shared includes, and copies `css/`, `images/`, and `scripts/` (except `site-config.js`).

## Structure

| Path | Purpose |
|------|---------|
| `index.php`, `membership.php`, … | Page content + per-page styles/scripts |
| `includes/config.php` | Site URLs and form embeds |
| `includes/header.php`, `footer.php` | Shared layout |
| `includes/layout-start.php`, `layout-end.php` | HTML shell |
| `includes/site-config-script.php` | Serves `DEALMAKERS_SITE` to JS |
| `router.php` | Built-in PHP dev server (clean URLs) |
| `.htaccess` | Apache clean URLs on GoDaddy |
