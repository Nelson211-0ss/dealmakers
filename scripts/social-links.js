(function () {
  var cfg = window.DEALMAKERS_SITE || {};

  function mailtoUrl(email) {
    var subject = 'Dealmakers inquiry';
    var body = "Hi — I'd like to connect about Dealmakers.";
    return (
      'mailto:' +
      email +
      '?subject=' +
      encodeURIComponent(subject) +
      '&body=' +
      encodeURIComponent(body)
    );
  }

  document.querySelectorAll('[data-social-linkedin]').forEach(function (el) {
    if (!cfg.linkedinUrl) return;
    el.setAttribute('href', cfg.linkedinUrl);
    el.setAttribute('target', '_blank');
    el.setAttribute('rel', 'noopener noreferrer');
  });

  document.querySelectorAll('[data-social-instagram]').forEach(function (el) {
    if (!cfg.instagramUrl) return;
    el.setAttribute('href', cfg.instagramUrl);
    el.setAttribute('target', '_blank');
    el.setAttribute('rel', 'noopener noreferrer');
  });

  document.querySelectorAll('[data-social-email]').forEach(function (el) {
    var email = (cfg.contactEmail || '').trim();
    if (!email || email.indexOf('@') === -1) return;
    el.setAttribute('href', mailtoUrl(email));
  });
})();
