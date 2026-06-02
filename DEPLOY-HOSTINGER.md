# Deploying Dealmakers on Hostinger

## Option A — Static hosting (recommended)

This site is mostly HTML/CSS/JS. You do **not** need Node in production if you use **Web Hosting** (not Node.js app).

1. On your computer, run:
   ```bash
   npm install
   npm run build
   ```
2. Upload the **project root** to `public_html` (or your domain folder):
   - All `*.html` files
   - `css/`, `scripts/`, `images/`
   - `.htaccess` (enables clean URLs like `/events` instead of `/events.html`)
3. Do **not** set an application entry file in Hostinger — there is no Node server required.
4. Open `https://yourdomain.com/` — `index.html` is served automatically.

---

## Option B — Node.js application

Use this if Hostinger is configured as a **Node.js** app (build + start commands).

| Setting | Value |
|--------|--------|
| **Entry file** | `server.js` |
| **Build command** | `npm install && npm run build` |
| **Start command** | `npm start` |

`server.js` runs the same Express static server as local dev (`scripts/dev-server.js`), including extensionless URLs.

After deploy, set your domain to point at the Node app port Hostinger assigns (usually automatic in their panel).

---

## Troubleshooting

- **“server.js does not exist”** — Pull latest repo; entry file is `server.js` at the project root.
- **Styles missing** — Run `npm run build` before deploy so `css/site.css` is up to date.
- **Clean URLs 404 on static hosting** — Ensure `.htaccess` was uploaded and Apache `mod_rewrite` is enabled (default on Hostinger).
