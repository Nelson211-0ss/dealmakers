# Dealmakers

Static site for [dealmakersus.com](https://www.dealmakersus.com).

## Local preview

```bash
npm install
npm run dev
```

Open `http://127.0.0.1:5501/membership` (clean URLs, same as production).

See [DEPLOY-GODADDY.md](./DEPLOY-GODADDY.md) for Go Live / Live Server options.

## Deploy to GoDaddy

**Always rebuild the zip before uploading.** `dealmakers-deploy.zip` is not updated automatically when you edit HTML, CSS, or scripts. An old zip will miss your latest changes.

```bash
npm install
npm run optimize:images   # after adding or replacing photos
npm run package:godaddy
```

This creates a fresh `dealmakers-deploy.zip` with:

- All `.html` pages
- `css/site.css` (built from Tailwind)
- `scripts/` (site config, forms, checkout, etc.)
- `images/`
- `.htaccess` (clean URL redirects)

Upload the zip to GoDaddy `public_html` → **Extract** (overwrite `.htaccess`).

**Zip size:** expect about **10–12MB**. If the zip is **50MB+**, run `npm run optimize:images` before packaging — unoptimized photos are usually the cause. See [DEPLOY-GODADDY.md](./DEPLOY-GODADDY.md#images-and-zip-size).

### After upload, verify

- `https://www.dealmakersus.com/membership` loads
- `https://www.dealmakersus.com/membership.html` redirects to `/membership`

Redirects are controlled only by `.htaccess` — layout and content edits do not change redirect behavior as long as you deploy the zip from this repo.

More detail: [DEPLOY-GODADDY.md](./DEPLOY-GODADDY.md)

## PHP version

A server-side PHP copy lives in [`php/`](./php/). Preview with `cd php && php -S 127.0.0.1:8080 router.php`. Regenerate after HTML edits with `npm run convert:php`. See [php/README.md](./php/README.md).

## Scripts

| Command | Purpose |
|---------|---------|
| `npm run dev` | Local server with clean URLs (port 5501) |
| `npm run build` | Rebuild CSS |
| `npm run convert:php` | Build CSS and regenerate `php/` from HTML |
| `npm run dev:php` | Regenerate and preview PHP site (port 8080) |
| `npm run optimize:images` | Compress photos and remove unused images before deploy |
| `npm run package:godaddy` | Build CSS and create deploy zip |
| `npm run convert:php` | Regenerate `php/` from static HTML |
| `npm run dev:php` | Local PHP preview (port 8080) |
| `npm run convert:php` | Regenerate `php/` from static HTML |

## Site config

Update external links in `scripts/site-config.js` (Calendly, Zoho checkout, social URLs, form embeds).

## PHP version

A server-side copy lives in `php/`. It uses shared layout includes and the same clean URLs as the static site.

**Regenerate from HTML** (after editing `.html` pages):

```bash
npm run convert:php
```

**Local preview:**

```bash
npm run dev:php
```

Open `http://127.0.0.1:8080/membership` (requires PHP 8+).

Site URLs (Calendly, checkout, forms) are in `php/includes/config.php` and exposed to the browser via `php/includes/site-config-script.php`.

**Deploy:** upload the contents of `php/` to GoDaddy `public_html` (includes `php/.htaccess` for clean URLs). Re-run `npm run convert:php` before deploying so CSS and pages stay in sync.
