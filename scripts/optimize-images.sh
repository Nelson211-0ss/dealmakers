#!/bin/sh
# Compress site images for web delivery (macOS sips). Safe to re-run.
set -eu

ROOT="$(CDPATH= cd -- "$(dirname "$0")/.." && pwd)"
IMG="$ROOT/images"

if ! command -v sips >/dev/null 2>&1; then
  echo "sips not found (macOS). Install ImageMagick or run on a Mac." >&2
  exit 1
fi

optimize_jpeg() {
  file="$1"
  max_px="$2"
  quality="$3"
  [ -f "$file" ] || return 0
  tmp="${file}.opt.$$"
  cp "$file" "$tmp"
  sips -Z "$max_px" "$tmp" >/dev/null 2>&1
  sips -s format jpeg -s formatOptions "$quality" "$tmp" --out "$file" >/dev/null 2>&1
  rm -f "$tmp"
}

optimize_png() {
  file="$1"
  max_px="$2"
  [ -f "$file" ] || return 0
  sips -Z "$max_px" "$file" >/dev/null 2>&1
}

echo "Removing unused full-resolution photos (not linked from any page)..."
for unused in \
  Pics-073.jpg Pics-078.jpg Pics-098.jpg Pics-099.jpg \
  "DM BLACK TRANSPARENT.png"
do
  if [ -f "$IMG/$unused" ]; then
    rm -f "$IMG/$unused"
    echo "  deleted $unused"
  fi
done

echo "Compressing event photos (max 1920px, JPEG quality 80)..."
for photo in \
  Dealmakers_0040.jpg Dealmakers_0057.jpg Dealmakers_0124.jpg Dealmakers_0125.jpg \
  DealmakersNovember_0003.jpg
do
  if [ -f "$IMG/$photo" ]; then
    before=$(stat -f%z "$IMG/$photo" 2>/dev/null || stat -c%s "$IMG/$photo")
    optimize_jpeg "$IMG/$photo" 1920 80
    after=$(stat -f%z "$IMG/$photo" 2>/dev/null || stat -c%s "$IMG/$photo")
    echo "  $photo: $((before / 1024))KB -> $((after / 1024))KB"
  fi
done

echo "Tuning websize gallery JPEGs (quality 82, keep 1600px)..."
for photo in "$IMG"/*_websize*.jpg; do
  [ -f "$photo" ] || continue
  optimize_jpeg "$photo" 1600 82
done

echo "Compressing sponsor logos (max 400px)..."
if [ -d "$IMG/sponsors" ]; then
  for logo in "$IMG/sponsors"/*; do
    case "$logo" in
      *.json) continue ;;
      *.png) optimize_png "$logo" 400 ;;
      *.jpg|*.jpeg) optimize_jpeg "$logo" 400 82 ;;
      *.webp) ;;
    esac
  done
fi

if [ -d "$ROOT/public/images" ]; then
  echo "Removing stale public/images (rebuilt on deploy)..."
  rm -rf "$ROOT/public/images"
fi

echo ""
echo "images/ total:"
du -sh "$IMG"
