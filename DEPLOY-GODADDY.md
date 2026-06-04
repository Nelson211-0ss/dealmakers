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

**Recommended** — clean URLs (same as production):

```bash
npm install
npm run dev
```

Open `http://127.0.0.1:5501/membership`

**VS Code “Go Live”** — uses port **5500** with route mounts in `.vscode/settings.json`. After changing settings, stop and restart Live Server, then open `http://127.0.0.1:5500/membership`.

If you see `Cannot GET /membership`, you are on a static server without URL rewriting. Use `npm run dev` on port **5501**, or Go Live on port **5500** (not 5501).
