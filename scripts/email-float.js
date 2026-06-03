(function () {
  var cfg = window.DEALMAKERS_SITE || {};
  var email =
    typeof window.DEALMAKERS_CONTACT_EMAIL === 'string'
      ? window.DEALMAKERS_CONTACT_EMAIL.trim()
      : (cfg.contactEmail || '').trim();

  if (!email || email.indexOf('@') === -1) return;

  var subject =
    typeof window.DEALMAKERS_EMAIL_SUBJECT === 'string'
      ? window.DEALMAKERS_EMAIL_SUBJECT
      : 'Dealmakers inquiry';

  var body =
    typeof window.DEALMAKERS_EMAIL_BODY === 'string'
      ? window.DEALMAKERS_EMAIL_BODY
      : "Hi — I'd like to connect about Dealmakers.";

  var url =
    'mailto:' +
    encodeURIComponent(email) +
    '?subject=' +
    encodeURIComponent(subject) +
    '&body=' +
    encodeURIComponent(body);

  var pulse = !(window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches);

  var id = 'dm-email-float-style';
  if (!document.getElementById(id)) {
    var st = document.createElement('style');
    st.id = id;
    st.textContent =
      '#dm-email-float{' +
      'position:fixed;' +
      'bottom:calc(1rem + env(safe-area-inset-bottom,0px));' +
      'right:calc(1.25rem + env(safe-area-inset-right,0px));' +
      'z-index:60;' +
      'display:flex;' +
      'align-items:center;' +
      'justify-content:center;' +
      'width:3.5rem;' +
      'height:3.5rem;' +
      'border-radius:9999px;' +
      'background-color:#1F3D2B;' +
      'color:#F4F3EF;' +
      'box-shadow:0 4px 22px rgba(31,61,43,0.35), 0 0 0 1px rgba(244,243,239,0.14) inset;' +
      'text-decoration:none;' +
      'transition:transform 0.2s ease, box-shadow 0.2s ease;' +
      '}' +
      '@media (min-width:768px){' +
      '#dm-email-float{right:calc(2rem + env(safe-area-inset-right,0px));}' +
      '}' +
      '#dm-email-float:hover,#dm-email-float:focus-visible{' +
      'transform:scale(1.06);' +
      'box-shadow:0 6px 28px rgba(31,61,43,0.45), 0 0 0 1px rgba(197,163,125,0.35) inset;' +
      '}' +
      '#dm-email-float:focus-visible{outline:2px solid #C5A37D;outline-offset:3px}' +
      (pulse
        ? '@keyframes dm-email-pulse{0%,100%{box-shadow:0 4px 22px rgba(31,61,43,0.35),0 0 0 1px rgba(244,243,239,0.14) inset,0 0 0 0 rgba(31,61,43,0.45)}50%{box-shadow:0 4px 22px rgba(31,61,43,0.35),0 0 0 1px rgba(244,243,239,0.14) inset,0 0 0 10px rgba(31,61,43,0)} }#dm-email-float{animation:dm-email-pulse 2.6s ease-in-out infinite}'
        : '');

    document.head.appendChild(st);
  }

  if (document.getElementById('dm-email-float')) return;

  var a = document.createElement('a');
  a.id = 'dm-email-float';
  a.href = url;
  a.setAttribute('aria-label', 'Email Dealmakers');

  a.innerHTML =
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' +
    '<path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>' +
    '<polyline points="22,6 12,13 2,6"/>' +
    '</svg>';

  document.body.appendChild(a);
})();
