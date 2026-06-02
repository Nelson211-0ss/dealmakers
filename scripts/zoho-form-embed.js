/**
 * Zoho Forms: auto-resize iframes so the full form shows without inner scrolling.
 */
(function () {
  function withResizeParam(url) {
    if (!url) return url;
    try {
      var u = new URL(url, window.location.href);
      u.searchParams.set('zf_rszfm', '1');
      return u.toString();
    } catch (e) {
      return url + (url.indexOf('?') > -1 ? '&' : '?') + 'zf_rszfm=1';
    }
  }

  function initIframes() {
    var cfg = window.DEALMAKERS_SITE;
    var requestAccess = cfg && cfg.forms && cfg.forms.requestAccess;
    if (requestAccess) {
      var accessFrame = document.getElementById('request-access-form');
      if (accessFrame) accessFrame.setAttribute('data-src', requestAccess);
    }

    document.querySelectorAll('iframe[data-zoho-form]').forEach(function (iframe) {
      var raw = iframe.getAttribute('data-src') || iframe.getAttribute('src') || '';
      if (raw) iframe.src = withResizeParam(raw);
      iframe.setAttribute('scrolling', 'no');
      iframe.setAttribute('loading', 'lazy');
    });
  }

  window.addEventListener('message', function (event) {
    if (!event.data || typeof event.data !== 'string' || event.data.indexOf('|') === -1) return;
    if (event.origin.indexOf('zohopublic.com') === -1 && event.origin.indexOf('zoho') === -1) return;

    var parts = event.data.split('|');
    if (parts.length < 2) return;

    var perma = parts[0];
    var height = parseInt(parts[1], 10);
    if (!height || isNaN(height)) return;

    document.querySelectorAll('iframe[data-zoho-form]').forEach(function (iframe) {
      var src = iframe.src || '';
      if (src.indexOf('formperma') === -1) return;
      if (perma && src.indexOf(perma) === -1) return;
      iframe.style.height = height + 24 + 'px';
    });
  });

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initIframes);
  } else {
    initIframes();
  }
})();
