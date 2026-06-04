#!/bin/sh
# Build a single ZIP for GoDaddy (File Manager: upload zip → Extract).
set -eu

ROOT="$(CDPATH= cd -- "$(dirname "$0")/.." && pwd)"
OUT="$ROOT/dealmakers-deploy.zip"
STAGE="$ROOT/.deploy-staging"

cd "$ROOT"
npm run build >/dev/null 2>&1 || npm run build

rm -rf "$STAGE"
mkdir -p "$STAGE/css" "$STAGE/images" "$STAGE/scripts"

cp ./*.html "$STAGE/"
cp .htaccess "$STAGE/" 2>/dev/null || true
cp css/site.css "$STAGE/css/"

cp -R images/. "$STAGE/images/"

for js in site-config.js social-links.js book-call.js nav-active.js email-float.js zoho-form-embed.js; do
  cp "scripts/$js" "$STAGE/scripts/" 2>/dev/null || true
done

rm -f "$OUT"
(cd "$STAGE" && zip -r -q "$OUT" .)

rm -rf "$STAGE"
echo "Created: $OUT ($(du -h "$OUT" | cut -f1))"
echo "Upload this ONE file to public_html, then Extract in cPanel File Manager."
