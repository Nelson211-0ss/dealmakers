/**
 * One-off: rewrite internal links to extensionless paths. Safe to re-run.
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');
const pages = [
  'index',
  'events',
  'membership',
  'sponsorship',
  'apply',
  'access',
  'contact',
  'framework',
  'how-it-works',
  'the-room',
  'launch-a-city',
];

function patchContent(text) {
  var out = text;

  out = out.replace(/href="index\.html#/gi, 'href="/#');
  out = out.replace(/href="index\.html"/gi, 'href="/"');

  pages.forEach(function (page) {
    if (page === 'index') return;
    var reHash = new RegExp('href="' + page + '\\.html#', 'gi');
    var rePlain = new RegExp('href="' + page + '\\.html"', 'gi');
    out = out.replace(reHash, 'href="/' + page + '#');
    out = out.replace(rePlain, 'href="/' + page + '"');
  });

  return out;
}

fs.readdirSync(root)
  .filter(function (f) {
    return f.endsWith('.html');
  })
  .forEach(function (file) {
    var filePath = path.join(root, file);
    var original = fs.readFileSync(filePath, 'utf8');
    var updated = patchContent(original);
    if (updated !== original) {
      fs.writeFileSync(filePath, updated);
      console.log('patched', file);
    }
  });

const navPath = path.join(root, 'scripts', 'nav-active.js');
let nav = fs.readFileSync(navPath, 'utf8');
const navOld = nav;
nav = nav.replace(
  /if \(!path \|\| path\.toLowerCase\(\) === 'index\.html'\) return 'index';/,
  "if (!path || path.toLowerCase() === 'index' || path.toLowerCase() === 'index.html') return 'index';"
);
if (nav !== navOld) {
  fs.writeFileSync(navPath, nav);
  console.log('patched scripts/nav-active.js');
}

console.log('done');
