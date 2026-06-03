(function () {
  function currentStem() {
    var path = (window.location.pathname || '').split('/').pop() || '';
    path = path.split('?')[0].split('#')[0];
    if (!path || path.toLowerCase() === 'index.html') return 'index';
    var m = path.match(/^(.+)\.html$/i);
    return m ? m[1].toLowerCase() : path.toLowerCase();
  }

  function highlightNav() {
    var stem = currentStem();
    document.querySelectorAll('[data-active-when]').forEach(function (el) {
      var raw = el.getAttribute('data-active-when') || '';
      var keys = raw.trim().split(/\s+/).filter(Boolean);
      if (keys.indexOf(stem) === -1) return;
      el.classList.remove('text-bone/80');
      el.classList.add('text-bone');
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', highlightNav);
  } else {
    highlightNav();
  }
})();
