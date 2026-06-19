(function () {
  var cfg = window.DEALMAKERS_SITE || {};
  var url = cfg.membershipCheckoutUrl;
  if (!url) return;

  document.querySelectorAll('[data-membership-checkout]').forEach(function (el) {
    el.setAttribute('href', url);
    if (el.tagName === 'A') {
      el.setAttribute('target', '_blank');
      el.setAttribute('rel', 'noopener noreferrer');
    }
  });
})();
