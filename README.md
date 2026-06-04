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
npm run package:godaddy
```

This creates a fresh `dealmakers-deploy.zip` with:

- All `.html` pages
- `css/site.css` (built from Tailwind)
- `scripts/` (site config, forms, checkout, etc.)
- `images/`
- `.htaccess` (clean URL redirects)

Upload the zip to GoDaddy `public_html` → **Extract** (overwrite `.htaccess`).

### After upload, verify

- `https://www.dealmakersus.com/membership` loads
- `https://www.dealmakersus.com/membership.html` redirects to `/membership`

Redirects are controlled only by `.htaccess` — layout and content edits do not change redirect behavior as long as you deploy the zip from this repo.

More detail: [DEPLOY-GODADDY.md](./DEPLOY-GODADDY.md)

## Scripts

| Command | Purpose |
|---------|---------|
| `npm run dev` | Local server with clean URLs (port 5501) |
| `npm run build` | Rebuild CSS |
| `npm run package:godaddy` | Build CSS and create deploy zip |

## Site config

Update external links in `scripts/site-config.js` (Calendly, Zoho checkout, social URLs, form embeds).
