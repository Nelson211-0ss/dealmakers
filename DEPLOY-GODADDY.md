# Deploy on GoDaddy (static + clean URLs)

Visitors see `/membership` instead of `/membership.html`. The `.htaccess` file uses **absolute** redirects so links work on GoDaddy.

## Build and upload

```bash
npm install
npm run package:godaddy
```

Upload `dealmakers-deploy.zip` to `public_html` → **Extract** (overwrite `.htaccess`).

## Test

- `https://www.dealmakersus.com/`
- `https://www.dealmakersus.com/membership`
- Visiting `https://www.dealmakersus.com/membership.html` should redirect to `/membership`

If links redirect to a path containing `public_html`, the `.htaccess` is wrong — use the one from this repo only.

## Update links after editing HTML

```bash
node scripts/patch-clean-urls.js
```

## Local preview

```bash
npm run dev
```

Open `http://127.0.0.1:5501/membership`
