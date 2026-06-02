/**
 * Local dev server with extensionless URLs: /events → events.html
 * Run: npm run dev  (default http://127.0.0.1:5501)
 */
const express = require('express');
const path = require('path');
const fs = require('fs');

var root = path.join(__dirname, '..');
var port = Number(process.env.PORT) || 5501;
var host = process.env.HOST || '127.0.0.1';

var app = express();

app.use(function (req, res, next) {
  if (/\.html$/i.test(req.path) && req.path !== '/') {
    var clean = req.path.replace(/\.html$/i, '') || '/';
    return res.redirect(301, clean);
  }
  next();
});

app.use(express.static(root, { extensions: ['html'] }));

app.get('*', function (req, res, next) {
  var urlPath = req.path.split('?')[0];
  if (urlPath.length > 1 && urlPath.endsWith('/')) {
    urlPath = urlPath.slice(0, -1);
  }

  if (!urlPath || urlPath === '/') {
    return res.sendFile(path.join(root, 'index.html'), function (err) {
      if (err) next(err);
    });
  }

  if (path.extname(urlPath)) {
    return next();
  }

  var htmlFile = path.join(root, urlPath + '.html');
  if (fs.existsSync(htmlFile)) {
    return res.sendFile(htmlFile, function (err) {
      if (err) next(err);
    });
  }

  next();
});

app.listen(port, host, function () {
  console.log('Dealmakers → http://' + host + ':' + port + '/');
  console.log('Clean URLs enabled (e.g. /events, not /events.html)');
});
