(function () {
  /**
   * Replace with your WhatsApp-enabled phone number — digits only, including country code.
   * Examples: United States '+1 512-555-0100' → '15125550100'
   */
  var DEALMAKERS_WA_E164 = '15125550100';

  var digits =
    typeof window.DEALMAKERS_WHATSAPP === 'string'
      ? String(window.DEALMAKERS_WHATSAPP).replace(/\D/g, '')
      : DEALMAKERS_WA_E164.replace(/\D/g, '');

  if (!digits || digits.length < 8) return;

  var prefill =
    typeof window.DEALMAKERS_WHATSAPP_TEXT === 'string'
      ? window.DEALMAKERS_WHATSAPP_TEXT
      : "Hi — I'd like to connect about Dealmakers.";

  var url = 'https://wa.me/' + digits + (prefill ? '?text=' + encodeURIComponent(prefill) : '');

  var pulse = !(window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches);

  var id = 'dm-wa-float-style';
  if (!document.getElementById(id)) {
    var st = document.createElement('style');
    st.id = id;
    /* Align right edge with header row: centered max-width 80rem (max-w-7xl) + horizontal padding px-5 / md:px-8 */
    st.textContent =
      '#dm-wa-float{' +
      'position:fixed;' +
      'bottom:calc(1rem + env(safe-area-inset-bottom,0px));' +
      'right:calc((100vw - min(100vw,80rem)) / 2 + 1.25rem + env(safe-area-inset-right,0px));' +
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
      '#dm-wa-float{' +
      'right:calc((100vw - min(100vw,80rem)) / 2 + 2rem + env(safe-area-inset-right,0px));' +
      '}' +
      '}' +
      '#dm-wa-float:hover,#dm-wa-float:focus-visible{' +
      'transform:scale(1.06);' +
      'box-shadow:0 6px 28px rgba(31,61,43,0.45), 0 0 0 1px rgba(197,163,125,0.35) inset;' +
      '}' +
      '#dm-wa-float:focus-visible{outline:2px solid #C5A37D;outline-offset:3px}' +
      (pulse
        ? '@keyframes dm-wa-pulse{0%,100%{box-shadow:0 4px 22px rgba(31,61,43,0.35),0 0 0 1px rgba(244,243,239,0.14) inset,0 0 0 0 rgba(31,61,43,0.45)}50%{box-shadow:0 4px 22px rgba(31,61,43,0.35),0 0 0 1px rgba(244,243,239,0.14) inset,0 0 0 10px rgba(31,61,43,0)} }#dm-wa-float{animation:dm-wa-pulse 2.6s ease-in-out infinite}'
        : '');

    document.head.appendChild(st);
  }

  if (document.getElementById('dm-wa-float')) return;

  var a = document.createElement('a');
  a.id = 'dm-wa-float';
  a.href = url;
  a.target = '_blank';
  a.rel = 'noopener noreferrer';
  a.setAttribute('aria-label', 'Chat on WhatsApp');

  a.innerHTML =
    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="26" height="26" aria-hidden="true" fill="currentColor">' +
    '<path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.435 9.884-9.883 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>' +
    '</svg>';

  document.body.appendChild(a);
})();
