(function () {
  var cfg = window.DEALMAKERS_SITE || {};
  var calendlyUrl = cfg.calendlyUrl;
  if (!calendlyUrl) return;

  document.querySelectorAll('[data-book-call]').forEach(function (el) {
    el.setAttribute('href', calendlyUrl);
    if (el.tagName === 'A') {
      el.setAttribute('target', '_blank');
      el.setAttribute('rel', 'noopener noreferrer');
    }
  });

  document.querySelectorAll('[data-calendly-inline]').forEach(function (el) {
    el.setAttribute('data-url', calendlyUrl);
  });

  if (document.querySelector('[data-calendly-inline]') && !window.__dmCalendlyLoaded) {
    window.__dmCalendlyLoaded = true;
    var s = document.createElement('script');
    s.src = 'https://assets.calendly.com/assets/external/widget.js';
    s.async = true;
    document.body.appendChild(s);
  }
})();
