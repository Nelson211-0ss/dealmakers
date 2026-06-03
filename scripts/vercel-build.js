/**
 * Vercel build: compile CSS and copy static assets into public/
 */
const fs = require('fs');
const path = require('path');
const { execSync } = require('child_process');

var root = path.join(__dirname, '..');
var out = path.join(root, 'public');

var scriptSkip = ['patch-header-nav.js', 'patch-clean-urls.js', 'vercel-build.js', 'dev-server.js'];

function resetOutDir() {
  if (fs.existsSync(out)) {
    fs.rmSync(out, { recursive: true, force: true });
  }
  fs.mkdirSync(out, { recursive: true });
}

function copyDir(src, dest, filter) {
  if (!fs.existsSync(src)) return;
  fs.mkdirSync(dest, { recursive: true });
  fs.readdirSync(src, { withFileTypes: true }).forEach(function (entry) {
    var from = path.join(src, entry.name);
    var to = path.join(dest, entry.name);
    if (filter && !filter(from, entry)) return;
    if (entry.isDirectory()) {
      copyDir(from, to, filter);
    } else {
      fs.copyFileSync(from, to);
    }
  });
}

resetOutDir();
execSync('npm run build:css', { cwd: root, stdio: 'inherit' });

fs.readdirSync(root).forEach(function (name) {
  if (!name.endsWith('.html')) return;
  fs.copyFileSync(path.join(root, name), path.join(out, name));
});

copyDir(path.join(root, 'css'), path.join(out, 'css'));
copyDir(path.join(root, 'images'), path.join(out, 'images'));
copyDir(path.join(root, 'scripts'), path.join(out, 'scripts'), function (filePath, entry) {
  if (!entry.isFile()) return true;
  return scriptSkip.indexOf(entry.name) === -1;
});

console.log('Vercel static output → public/');
