# Deploy on GoDaddy (static + clean URLs)

Visitors see `/membership` instead of `/membership.html`. The `.htaccess` file uses **absolute** redirects so links work on GoDaddy.

## Build and upload

```bash
npm install
npm run optimize:images   # run after adding or replacing photos
npm run package:godaddy
```

Upload `dealmakers-deploy.zip` to `public_html` → **Extract** (overwrite `.htaccess`).

A typical deploy zip is about **10–12MB**. If the zip is much larger (e.g. 50MB+), new photos were probably added without optimization.

## Images and zip size

The deploy zip includes the entire `images/` folder. Full-resolution camera JPEGs are often **5–7MB each**; several of those can push the zip toward **60MB** even though the site only needs web-sized files.

**Before packaging**, run:

```bash
npm run optimize:images
```

This script:

- Resizes event photos to **1920px** max width at **JPEG quality 80** (usually ~500–650KB each)
- Tunes `*_websize*.jpg` gallery files
- Compresses sponsor logos
- Removes known unused files (including June event photos not linked from any page)

**When you add new photos:**

1. Put files in `images/`
2. Reference them from the relevant `.html` page
3. Add the filename to the compress list in `scripts/optimize-images.sh` if it is a new event photo pattern
4. Run `npm run optimize:images`, then `npm run package:godaddy`

Only images linked from HTML should stay in `images/`. Unused full-resolution files can be deleted or added to the unused list in `scripts/optimize-images.sh` so they are not shipped in the zip.

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
