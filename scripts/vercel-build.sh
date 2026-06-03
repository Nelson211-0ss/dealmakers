#!/bin/sh
set -eu

mkdir -p public/css public/images public/scripts

cp ./*.html public/

cp -R css/. public/css/
cp -R images/. public/images/

for f in scripts/*.js; do
  base=$(basename "$f")
  case "$base" in
    patch-*|vercel-build.js|dev-server.js) ;;
    *) cp "$f" public/scripts/ ;;
  esac
done

echo "Vercel output ready:"
ls -la public/
test -f public/index.html
test -f public/css/site.css
