<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = 'Dealmakers | Real Estate | Austin, TX';
$pageSlug = 'index';
$pageStyles = <<<'CSS'
html {
      scroll-padding-top: 100px;
    }
    @media (prefers-reduced-motion: no-preference) {
      html {
        scroll-behavior: smooth;
      }
    }
    @keyframes fade-up {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    @keyframes marquee {
      0% { transform: translateX(0); }
      100% { transform: translateX(-50%); }
    }
    .animate-marquee {
      animation: marquee 50s linear infinite;
    }
    @keyframes sponsors-marquee {
      0% { transform: translateX(0); }
      100% { transform: translateX(-50%); }
    }
    @media (prefers-reduced-motion: no-preference) {
      .animate-sponsors-marquee {
        animation: sponsors-marquee 55s linear infinite;
      }
      .sponsors-track:hover .animate-sponsors-marquee {
        animation-play-state: paused;
      }
    }
    @keyframes sponsor-logo-breathe {
      0%, 100% { transform: scale(1); opacity: 0.88; }
      50% { transform: scale(1.06); opacity: 1; }
    }
    .sponsor-logo-tile {
      display: inline-flex;
      height: 4.625rem;
      min-width: 7rem;
      max-width: 12rem;
      flex-shrink: 0;
      align-items: center;
      justify-content: center;
      border-radius: 0.75rem;
      border-width: 1px;
      border-style: solid;
      padding: 0.625rem 1rem;
      box-shadow: 0 4px 6px -1px rgba(15, 17, 21, 0.08);
    }
    @media (min-width: 768px) {
      .sponsor-logo-tile {
        height: 5.375rem;
        max-width: 13rem;
        border-radius: 1rem;
        padding: 0.75rem 1.25rem;
      }
    }
    .sponsor-logo-tile--dark {
      background-color: #0F1115;
      border-color: rgba(244, 243, 239, 0.12);
    }
    .sponsor-logo-tile--dark img {
      filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.35));
    }
    .sponsor-logo-tile--light {
      background-color: #ffffff;
      border-color: rgba(58, 63, 69, 0.14);
      box-shadow: 0 4px 14px rgba(15, 17, 21, 0.06);
    }
    .sponsor-logo-tile--light img {
      filter: none;
    }
    .sponsor-logo-tile--bone {
      background-color: #F4F3EF;
      border-color: rgba(197, 163, 125, 0.28);
      box-shadow: 0 4px 14px rgba(15, 17, 21, 0.05);
    }
    .sponsor-logo-tile--bone img {
      filter: none;
    }
    .sponsor-logo-tile--green {
      background-color: #1F3D2B;
      border-color: rgba(197, 163, 125, 0.22);
    }
    .sponsor-logo-tile--green img {
      filter: drop-shadow(0 1px 2px rgba(0, 0, 0, 0.25));
    }
    .sponsor-logo-anim {
      animation: sponsor-logo-breathe 4.5s ease-in-out infinite;
    }
    @media (prefers-reduced-motion: reduce) {
      .sponsor-logo-anim {
        animation: none;
        opacity: 1;
      }
    }
    @media (prefers-reduced-motion: no-preference) {
      .reveal {
        animation: fade-up 0.85s cubic-bezier(0.22, 1, 0.36, 1) both;
      }
      .reveal-delay-1 { animation-delay: 0.1s; }
      .reveal-delay-2 { animation-delay: 0.18s; }
      .reveal-delay-3 { animation-delay: 0.26s; }
    }
    .noise-carbon {
      position: relative;
    }
    .noise-carbon::after {
      content: '';
      position: absolute;
      inset: 0;
      z-index: 0;
      pointer-events: none;
      opacity: 0.06;
      mix-blend-mode: overlay;
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
    }
    .pillars-grid {
      display: grid;
      grid-template-columns: 1fr;
      gap: 0.75rem;
    }
    @media (min-width: 1024px) {
      .pillars-grid {
        grid-template-columns: repeat(6, 1fr);
        grid-template-rows: auto auto;
        gap: 0.75rem;
      }
      .pillar-a { grid-column: span 3; }
      .pillar-b { grid-column: span 3; }
      .pillar-c { grid-column: span 2; }
      .pillar-d { grid-column: span 2; }
      .pillar-span { grid-column: 1 / -1; }
    }
    .hero-slide {
      position: absolute;
      inset: 0;
      opacity: 0;
      transition: opacity 1.1s ease-in-out;
      z-index: 0;
    }
    .hero-slide.is-active {
      opacity: 1;
      z-index: 1;
    }
    @media (prefers-reduced-motion: reduce) {
      .hero-slide {
        transition: none;
      }
    }
    /* Scroll fly-in (IntersectionObserver adds .is-visible) */
    @media (prefers-reduced-motion: no-preference) {
      .fly-in {
        opacity: 0;
        transform: translateY(2.25rem);
        transition:
          opacity 0.75s cubic-bezier(0.22, 1, 0.36, 1),
          transform 0.75s cubic-bezier(0.22, 1, 0.36, 1);
        transition-delay: var(--fly-delay, 0s);
      }
      .fly-in.fly-from-left {
        transform: translateX(-2rem);
      }
      .fly-in.fly-from-right {
        transform: translateX(2rem);
      }
      .fly-in.is-visible {
        opacity: 1;
        transform: translate(0, 0);
      }
      .fly-in.fly-stagger-1 { --fly-delay: 0.06s; }
      .fly-in.fly-stagger-2 { --fly-delay: 0.12s; }
      .fly-in.fly-stagger-3 { --fly-delay: 0.18s; }
      .fly-in.fly-stagger-4 { --fly-delay: 0.24s; }
      .fly-in.fly-stagger-5 { --fly-delay: 0.3s; }
      .fly-in.fly-stagger-6 { --fly-delay: 0.36s; }
    }
    @media (prefers-reduced-motion: reduce) {
      .fly-in {
        opacity: 1;
        transform: none;
        transition: none;
      }
    }
CSS;
$headExtra = <<<'HTML'
<link rel="preload" as="image" href="images/Violet%20Crowned%20Media_Deal%20Makers-4_websize.jpg" />
HTML;
$pageInlineScript = <<<'JS'
(function () {
      var toggle = document.getElementById('menu-toggle');
      var mobileNav = document.getElementById('mobile-nav');
      var mobileLinks = mobileNav ? mobileNav.querySelectorAll('a') : [];

      function setOpen(open) {
        if (!toggle || !mobileNav) return;
        mobileNav.classList.toggle('hidden', !open);
        toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      }

      if (toggle && mobileNav) {
        toggle.addEventListener('click', function () {
          setOpen(mobileNav.classList.contains('hidden'));
        });
        mobileLinks.forEach(function (link) {
          link.addEventListener('click', function () {
            setOpen(false);
          });
        });
      }

      var y = document.getElementById('year');
      if (y) y.textContent = String(new Date().getFullYear());

      function initCounters() {
        var nodes = document.querySelectorAll('[data-counter]');
        if (!nodes.length) return;
        var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        function run(el) {
          var raw = el.getAttribute('data-counter');
          var target = parseInt(raw, 10);
          if (Number.isNaN(target)) return;
          var prefix = el.getAttribute('data-prefix') || '';
          var suffix = el.getAttribute('data-suffix') || '';
          if (reduced) {
            el.textContent = prefix + String(target) + suffix;
            return;
          }
          var duration = 1100;
          var t0 = null;
          function tick(now) {
            if (t0 == null) t0 = now;
            var p = Math.min((now - t0) / duration, 1);
            var eased = 1 - Math.pow(1 - p, 2.6);
            el.textContent = prefix + String(Math.round(target * eased)) + suffix;
            if (p < 1) requestAnimationFrame(tick);
          }
          requestAnimationFrame(tick);
        }
        if (!('IntersectionObserver' in window) || reduced) {
          nodes.forEach(run);
          return;
        }
        var io = new IntersectionObserver(
          function (entries) {
            entries.forEach(function (entry) {
              if (!entry.isIntersecting) return;
              run(entry.target);
              io.unobserve(entry.target);
            });
          },
          { rootMargin: '0px', threshold: 0.25 }
        );
        nodes.forEach(function (n) {
          io.observe(n);
        });
      }

      function initHeroSlider() {
        var root = document.getElementById('hero-slides');
        if (!root) return;
        var slides = root.querySelectorAll('.hero-slide');
        var n = slides.length;
        if (!n) return;
        var dotsWrap = document.getElementById('hero-dots');
        var prev = document.getElementById('hero-prev');
        var next = document.getElementById('hero-next');
        var i = 0;
        var timer = null;
        var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        function dotClass(active) {
          return active
            ? 'hero-dot h-2 shrink-0 rounded-full bg-bone motion-safe:transition w-8'
            : 'hero-dot h-2 w-2 shrink-0 rounded-full bg-bone/40 motion-safe:transition hover:bg-bone/70';
        }

        function go(to) {
          i = ((to % n) + n) % n;
          slides.forEach(function (s, j) {
            s.classList.toggle('is-active', j === i);
          });
          if (dotsWrap) {
            var btns = dotsWrap.querySelectorAll('.hero-dot');
            btns.forEach(function (b, j) {
              b.className = dotClass(j === i);
              b.setAttribute('aria-current', j === i ? 'true' : 'false');
            });
          }
        }

        if (dotsWrap) {
          for (var d = 0; d < n; d++) {
            (function (idx) {
              var b = document.createElement('button');
              b.type = 'button';
              b.className = dotClass(false);
              b.setAttribute('aria-label', 'Show slide ' + (idx + 1));
              b.addEventListener('click', function () {
                go(idx);
                resetTimer();
              });
              dotsWrap.appendChild(b);
            })(d);
          }
        }

        function resetTimer() {
          if (timer) clearInterval(timer);
          if (reduced) return;
          timer = window.setInterval(function () {
            go(i + 1);
          }, 6500);
        }

        if (prev) {
          prev.addEventListener('click', function () {
            go(i - 1);
            resetTimer();
          });
        }
        if (next) {
          next.addEventListener('click', function () {
            go(i + 1);
            resetTimer();
          });
        }

        go(0);
        resetTimer();
      }

      initHeroSlider();
      if (typeof feather !== 'undefined') {
        feather.replace();
      }

      function initScrollFlyIn() {
        var els = document.querySelectorAll('.fly-in');
        if (!els.length) return;
        var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (reduced) {
          els.forEach(function (el) {
            el.classList.add('is-visible');
          });
          return;
        }
        if (!('IntersectionObserver' in window)) {
          els.forEach(function (el) {
            el.classList.add('is-visible');
          });
          return;
        }
        var io = new IntersectionObserver(
          function (entries) {
            entries.forEach(function (entry) {
              if (!entry.isIntersecting) return;
              entry.target.classList.add('is-visible');
              io.unobserve(entry.target);
            });
          },
          { rootMargin: '0px 0px -7% 0px', threshold: 0.07 }
        );
        els.forEach(function (el) {
          io.observe(el);
        });
      }

      function initSponsors() {
        var wrap = document.getElementById('sponsors-wrap');
        var track = document.getElementById('sponsors-marquee');
        var empty = document.getElementById('sponsors-empty');
        if (!wrap || !track) return;

        function showEmpty() {
          wrap.classList.add('hidden');
          if (empty) empty.classList.remove('hidden');
        }

        function normalizeLogo(entry) {
          if (typeof entry === 'string') {
            return { src: entry, tile: 'dark' };
          }
          return { src: entry.src, tile: entry.tile || 'dark' };
        }

        function showStrip(files) {
          if (!files || !files.length) {
            showEmpty();
            return;
          }
          var base = 'images/sponsors/';
          var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
          var html = files
            .map(normalizeLogo)
            .filter(function (logo) {
              return logo.src && logo.src.length > 0;
            })
            .map(function (logo, i) {
              var delay = ((i % 6) * 0.45).toFixed(2);
              var src = base + logo.src.split('/').map(encodeURIComponent).join('/');
              var animClass = reducedMotion ? '' : ' sponsor-logo-anim';
              var tileClass = 'sponsor-logo-tile sponsor-logo-tile--' + logo.tile;
              return (
                '<div class="' +
                tileClass +
                '">' +
                '<img src="' +
                src +
                '" alt="" class="max-h-11 w-auto max-w-full object-contain md:max-h-[3.5rem]' +
                animClass +
                '" style="animation-delay:' +
                delay +
                's" loading="lazy" decoding="async" />' +
                '</div>'
              );
            })
            .join('');
          if (!html) {
            showEmpty();
            return;
          }
          track.className = reducedMotion
            ? 'mx-auto flex w-full flex-wrap items-center justify-center gap-3 px-1 md:gap-4'
            : 'flex w-max items-center gap-4 animate-sponsors-marquee md:gap-6';
          wrap.classList.toggle('overflow-hidden', !reducedMotion);
          track.innerHTML = reducedMotion ? html : html + html;
          wrap.classList.remove('hidden');
          if (empty) empty.classList.add('hidden');
        }

        fetch('images/sponsors/manifest.json')
          .then(function (r) {
            if (!r.ok) throw new Error('manifest');
            return r.json();
          })
          .then(showStrip)
          .catch(showEmpty);
      }

      initScrollFlyIn();
      initCounters();
      initSponsors();
    })();
JS;
require __DIR__ . '/includes/layout-start.php';
?>
<!-- Hero — full-viewport image slider -->
  <section id="hero" class="relative flex min-h-[100svh] flex-col bg-carbon text-bone">
    <div class="pointer-events-none absolute inset-0 z-[2]" aria-hidden="true">
      <div class="absolute inset-0 bg-gradient-to-r from-carbon via-carbon/75 to-carbon/35 md:from-carbon md:via-carbon/55 md:to-transparent"></div>
      <div class="absolute inset-0 bg-gradient-to-t from-carbon via-transparent to-carbon/40"></div>
    </div>
    <div id="hero-slides" class="absolute inset-0 z-0" aria-hidden="true">
      <div class="hero-slide is-active">
        <img src="images/Violet%20Crowned%20Media_Deal%20Makers-4_websize.jpg" alt="" class="h-full w-full object-cover object-center" width="1600" height="1067" loading="eager" fetchpriority="high" />
      </div>
      <div class="hero-slide">
        <img src="images/DealMakersJuneMembersEvent_0027.jpg" alt="" class="h-full w-full object-cover object-center" width="1920" height="1280" loading="eager" />
      </div>
      <div class="hero-slide">
        <img src="images/Violet%20Crowned%20Media_Deal%20Makers-58_websize.jpg" alt="" class="h-full w-full object-cover object-center" width="1600" height="1067" loading="eager" />
      </div>
      <div class="hero-slide">
        <img src="images/Violet%20Crowned%20Media_Deal%20Makers-65_websize.jpg" alt="" class="h-full w-full object-cover object-center" width="1600" height="1067" loading="eager" />
      </div>
      <div class="hero-slide">
        <img src="images/Dealmakers_0040.jpg" alt="" class="h-full w-full object-cover object-[center_40%]" width="1920" height="1280" loading="eager" />
      </div>
    </div>

    <div class="relative z-10 flex flex-1 flex-col justify-center pb-36 pt-28 md:pb-40 md:pt-32">
      <div class="mx-auto w-full max-w-7xl px-5 md:px-8">
        <div class="max-w-xl lg:max-w-2xl">
          <div class="reveal flex items-center gap-2 text-bronze">
            <i data-feather="map-pin" class="h-4 w-4"></i>
            <p class="text-[11px] font-medium uppercase tracking-[0.22em] text-bone/70">Austin, TX · Curated, not closed</p>
          </div>
          <h1 class="reveal reveal-delay-1 mt-4 font-heading text-[2.85rem] font-semibold leading-[1.03] tracking-tight sm:text-[3.15rem] md:mt-5 md:text-[3.65rem] lg:text-[4.15rem] xl:text-[4.5rem]">
            Relationships <em class="not-italic text-bronze">that move</em> deals.
          </h1>
          <p class="reveal reveal-delay-2 mt-4 max-w-xl text-lg leading-snug text-bone/85 md:mt-5 md:text-xl md:leading-relaxed">
            A private, expert-led room where operators, investors, and capital connect around real opportunities.
          </p>
          <p class="reveal reveal-delay-2 mt-2 max-w-md text-sm leading-snug text-bone/55 md:mt-3">The right rooms. The right people. The right outcomes.</p>
          <div class="reveal reveal-delay-3 btn-row mt-6 md:mt-7">
            <a href="/access#request-access" class="btn btn-green motion-safe:transition group shadow-lg shadow-green/25">
              Request access
              <i data-feather="arrow-right" class="h-4 w-4 motion-safe:transition-transform group-hover:translate-x-1"></i>
            </a>
            <a href="/the-room" class="btn btn-outline-light motion-safe:transition">
              <i data-feather="layers" class="h-4 w-4"></i>
              How the room works
            </a>
          </div>
          <div class="reveal reveal-delay-3 mt-8 space-y-2 md:mt-9">
            <p class="section-kicker text-bronze">In the room</p>
            <ul class="space-y-2 text-[14px] text-bone/75">
              <li class="flex gap-3"><i data-feather="users" class="mt-0.5 h-4 w-4 shrink-0 text-bronze"></i><span>Operators &amp; investors</span></li>
              <li class="flex gap-3"><i data-feather="briefcase" class="mt-0.5 h-4 w-4 shrink-0 text-bronze"></i><span>Capital in motion</span></li>
              <li class="flex gap-3"><i data-feather="shield" class="mt-0.5 h-4 w-4 shrink-0 text-bronze"></i><span>Curated, not closed</span></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="pointer-events-none absolute bottom-[4.5rem] left-0 right-0 z-20 flex justify-center px-4 md:bottom-24" aria-hidden="true">
      <div id="hero-dots" class="pointer-events-auto flex items-center gap-2 rounded-full border border-bone/15 bg-carbon/40 px-3 py-2 backdrop-blur-md"></div>
    </div>
    <button type="button" id="hero-prev" class="motion-safe:transition absolute left-2 top-1/2 z-20 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-bone/20 bg-carbon/45 text-bone backdrop-blur-md hover:border-bronze/50 hover:bg-carbon/60 md:left-3 md:h-12 md:w-12" aria-label="Previous slide">
      <i data-feather="chevron-left" class="h-6 w-6"></i>
    </button>
    <button type="button" id="hero-next" class="motion-safe:transition absolute right-2 top-1/2 z-20 flex h-10 w-10 -translate-y-1/2 items-center justify-center rounded-full border border-bone/20 bg-carbon/45 text-bone backdrop-blur-md hover:border-bronze/50 hover:bg-carbon/60 md:right-3 md:h-12 md:w-12" aria-label="Next slide">
      <i data-feather="chevron-right" class="h-6 w-6"></i>
    </button>

    <div class="relative z-10 mt-auto overflow-hidden border-t border-bone/10 bg-carbon/80 backdrop-blur-md">
      <div class="flex w-max animate-marquee whitespace-nowrap py-3.5 text-[10px] font-semibold uppercase tracking-[0.4em] text-bone/45">
        <span class="px-10">East End Ballroom</span>
        <span class="px-10">Lucky Arrow Retreat</span>
        <span class="px-10">The Contemporary Austin</span>
        <span class="px-10">Hotel Magdalena</span>
        <span class="px-10">Umlauf Sculpture Garden</span>
        <span class="px-10">Springdale General</span>
        <span class="px-10">South Congress Hotel</span>
        <span class="px-10">East End Ballroom</span>
        <span class="px-10">Lucky Arrow Retreat</span>
        <span class="px-10">The Contemporary Austin</span>
        <span class="px-10">Hotel Magdalena</span>
        <span class="px-10">Umlauf Sculpture Garden</span>
        <span class="px-10">Springdale General</span>
        <span class="px-10">South Congress Hotel</span>
      </div>
    </div>
  </section>

  <!-- Stats / counters -->
  <section id="stats" class="relative z-20 -mt-10 bg-transparent px-4 pb-4 md:-mt-14 md:px-6">
    <div class="mx-auto max-w-7xl rounded-3xl bg-bone/95 p-8 shadow-xl shadow-carbon/10 ring-1 ring-gunmetal/10 backdrop-blur-md md:p-10">
      <p class="fly-in section-kicker text-gunmetal">In the room</p>
      <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-4 lg:gap-6">
        <div class="fly-in fly-stagger-1 flex gap-4 rounded-2xl bg-gunmetal/[0.05] p-5 ring-1 ring-gunmetal/5">
          <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-green/12 text-green"><i data-feather="users" class="h-5 w-5"></i></span>
          <div>
            <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-bronze">Close to</p>
            <p class="font-heading text-3xl font-semibold tracking-tight text-carbon md:text-4xl"><span data-counter="150" data-suffix="+">0</span></p>
            <p class="mt-1 text-sm leading-snug text-gunmetal">Attendees — investors, operators &amp; connectors — across Texas</p>
          </div>
        </div>
        <div class="fly-in fly-stagger-2 flex gap-4 rounded-2xl bg-gunmetal/[0.05] p-5 ring-1 ring-gunmetal/5">
          <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-green/12 text-green"><i data-feather="map-pin" class="h-5 w-5"></i></span>
          <div>
            <p class="font-heading text-3xl font-semibold tracking-tight text-carbon md:text-4xl"><span data-counter="2">0</span></p>
            <p class="mt-1 text-sm leading-snug text-gunmetal">Cities in the room: Dallas &amp; Austin</p>
          </div>
        </div>
        <div class="fly-in fly-stagger-3 flex gap-4 rounded-2xl bg-gunmetal/[0.05] p-5 ring-1 ring-gunmetal/5">
          <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-green/12 text-green"><i data-feather="dollar-sign" class="h-5 w-5"></i></span>
          <div>
            <p class="font-heading text-3xl font-semibold tracking-tight text-carbon md:text-4xl"><span data-counter="120" data-prefix="$" data-suffix="M+">0</span></p>
            <p class="mt-1 text-sm leading-snug text-gunmetal">In live deals pitched in the room</p>
          </div>
        </div>
        <div class="fly-in fly-stagger-4 flex gap-4 rounded-2xl bg-gunmetal/[0.05] p-5 ring-1 ring-gunmetal/5">
          <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-green/12 text-green"><i data-feather="mic" class="h-5 w-5"></i></span>
          <div>
            <p class="font-heading text-3xl font-semibold tracking-tight text-carbon md:text-4xl"><span data-counter="85" data-suffix="+">0</span></p>
            <p class="mt-1 text-sm leading-snug text-gunmetal">Deals pitched on stage in the room</p>
          </div>
        </div>
      </div>
      <p class="fly-in fly-stagger-5 mt-10 text-center font-heading text-lg font-medium leading-snug text-carbon md:text-xl md:tracking-tight">
        Austin's premier <span class="text-bronze">Real Estate Community</span>
      </p>
    </div>
  </section>

  <!-- Problem -->
  <section id="problem" class="relative overflow-hidden rounded-t-[2rem] bg-bone py-14 md:py-20">
    <div class="pointer-events-none absolute right-0 top-0 h-[min(80vw,520px)] w-[min(80vw,520px)] translate-x-1/3 -translate-y-1/2 rounded-full bg-green/[0.07] blur-3xl" aria-hidden="true"></div>
    <div class="relative mx-auto max-w-7xl px-5 md:px-8">
      <div class="fly-in max-w-3xl">
        <p class="section-kicker text-gunmetal">Why this room exists</p>
        <h2 class="mt-3 section-title uppercase leading-snug tracking-wide md:leading-tight">
          Most networks don't produce <span class="text-bronze">real outcomes.</span>
        </h2>
        <p class="mt-4 max-w-2xl text-base leading-relaxed text-gunmetal md:text-[17px]">The gap isn't effort — it's structure. One side collects contacts. The other builds continuity.</p>
      </div>

      <div class="mt-10 grid gap-6 lg:grid-cols-2 lg:gap-8 lg:items-stretch">
        <article class="fly-in fly-from-left flex h-full flex-col overflow-hidden rounded-3xl bg-white/80 shadow-md ring-1 ring-gunmetal/10">
          <div class="relative aspect-[16/10] shrink-0 overflow-hidden bg-gunmetal/5">
            <img
              src="images/DealMakersJuneMembersEvent_0034.jpg"
              alt="Typical networking — surface-level conversation at a crowded event"
              class="absolute inset-0 h-full w-full object-cover object-center"
              width="1920"
              height="1280"
              loading="lazy"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-carbon/25 to-transparent" aria-hidden="true"></div>
          </div>
          <div class="flex flex-1 flex-col p-6 md:p-8">
            <div class="flex items-center gap-3">
              <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gunmetal/10 text-gunmetal"><i data-feather="alert-circle" class="h-5 w-5"></i></span>
              <p class="section-kicker text-gunmetal">The problem</p>
            </div>
            <p class="mt-5 text-lg font-medium leading-snug text-carbon">They collect business cards. They talk. Nothing carries forward.</p>
            <ul class="mt-5 space-y-3 text-sm leading-relaxed text-gunmetal">
              <li class="flex gap-3"><i data-feather="x" class="mt-0.5 h-4 w-4 shrink-0 text-gunmetal/50"></i><span>No continuity from one event to the next</span></li>
              <li class="flex gap-3"><i data-feather="x" class="mt-0.5 h-4 w-4 shrink-0 text-gunmetal/50"></i><span>No judgment about who belongs in the room</span></li>
              <li class="flex gap-3"><i data-feather="x" class="mt-0.5 h-4 w-4 shrink-0 text-gunmetal/50"></i><span>No follow-through after the handshake</span></li>
            </ul>
          </div>
        </article>

        <article class="fly-in fly-from-right flex h-full flex-col overflow-hidden rounded-3xl bg-white/80 shadow-md ring-1 ring-gunmetal/10">
          <div class="relative aspect-[16/10] shrink-0 overflow-hidden bg-gunmetal/5">
            <img
              src="images/DealMakersJuneMembersEvent_0027.jpg"
              alt="Members enjoying a positive conversation at Dealmakers"
              class="absolute inset-0 h-full w-full object-cover object-center"
              width="1920"
              height="1280"
              loading="lazy"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-carbon/25 to-transparent" aria-hidden="true"></div>
          </div>
          <div class="flex flex-1 flex-col p-6 md:p-8">
            <div class="flex items-center gap-3">
              <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-green/10 text-green"><i data-feather="check-circle" class="h-5 w-5"></i></span>
              <p class="section-kicker text-green">The alternative</p>
            </div>
            <p class="mt-5 text-lg font-medium leading-snug text-carbon">A working room built for people who deploy capital, build companies, and execute deals.</p>
            <p class="mt-4 text-sm leading-relaxed text-gunmetal">Dealmakers is a private, curated room where real estate, capital, and execution converge — with the rhythm to turn conversations into outcomes.</p>
            <ul class="mt-5 space-y-3 text-sm leading-relaxed text-gunmetal">
              <li class="flex gap-3"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-green"></i><span>Curated access, not an open invite list</span></li>
              <li class="flex gap-3"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-green"></i><span>Judgment-heavy conversation, not pitch theater</span></li>
              <li class="flex gap-3"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-green"></i><span>Follow-through built into how the room runs</span></li>
            </ul>
          </div>
        </article>
      </div>

      <div class="fly-in mt-8 grid gap-3 sm:grid-cols-3">
        <div class="rounded-2xl bg-white/80 px-5 py-4 shadow-md ring-1 ring-gunmetal/10">
          <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-bronze">Real estate</p>
          <p class="mt-1 text-sm font-medium text-carbon">Operators &amp; investors executing deals</p>
        </div>
        <div class="rounded-2xl bg-white/80 px-5 py-4 shadow-md ring-1 ring-gunmetal/10">
          <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-bronze">Capital</p>
          <p class="mt-1 text-sm font-medium text-carbon">Relationships that move paperwork</p>
        </div>
        <div class="rounded-2xl bg-white/80 px-5 py-4 shadow-md ring-1 ring-gunmetal/10">
          <p class="text-[10px] font-semibold uppercase tracking-[0.2em] text-bronze">Execution</p>
          <p class="mt-1 text-sm font-medium text-carbon">Continuity from first conversation forward</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Sponsors -->
  <section id="sponsors" class="relative overflow-hidden border-y border-gunmetal/10 bg-bone py-16 md:py-20" aria-label="Partnership">
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_80%_50%_at_50%_50%,rgba(31,61,43,0.06),transparent)]" aria-hidden="true"></div>
    <div class="relative mx-auto max-w-7xl px-5 md:px-8">
      <div class="flex flex-col items-center text-center">
        <p class="fly-in section-kicker text-bronze">Partnership</p>
        <h2 class="fly-in fly-stagger-1 mt-3 font-heading text-xl font-semibold text-carbon md:text-2xl">The operators who help underwrite the room</h2>
        <p class="fly-in fly-stagger-2 mt-5 max-w-2xl text-sm leading-relaxed text-gunmetal md:text-[15px]">From booths to moderated panels — partner where the room earns trust. Visibility compounds when sponsors return month after month.</p>
        <div class="fly-in fly-stagger-3 btn-row mt-7 justify-center">
          <a href="/sponsorship" class="btn btn-green motion-safe:transition shadow-md shadow-green/20"><i data-feather="award" class="h-3.5 w-3.5"></i> Partnership overview</a>
          <a href="/events" class="btn btn-outline motion-safe:transition">Featured session</a>
        </div>
        <p id="sponsors-empty" class="fly-in fly-stagger-4 mt-10 hidden max-w-lg text-sm text-gunmetal">Add logos under <code class="rounded bg-gunmetal/10 px-1.5 py-0.5 text-[13px] text-carbon">images/sponsors</code> and list filenames in <code class="rounded bg-gunmetal/10 px-1.5 py-0.5 text-[13px] text-carbon">images/sponsors/manifest.json</code>.</p>
      </div>
    </div>
    <div class="relative mx-auto mt-12 max-w-7xl px-5 md:px-8">
      <div id="sponsors-wrap" class="sponsors-track relative hidden w-full overflow-hidden py-2 md:overflow-x-clip">
        <div id="sponsors-marquee" class="flex w-max items-center gap-4 animate-sponsors-marquee md:gap-6"></div>
      </div>
    </div>
  </section>

  <!-- Explore -->
  <section id="explore" class="relative overflow-hidden bg-bone py-14 md:py-20">
    <div class="relative mx-auto max-w-7xl px-5 md:px-8">
      <p class="fly-in section-kicker text-green">Go deeper</p>
      <h2 class="fly-in fly-stagger-1 section-title mt-3 max-w-3xl">
        Everything in the room, <span class="text-bronze">by chapter.</span>
      </h2>
      <p class="fly-in fly-stagger-2 mt-4 max-w-2xl text-gunmetal">Each page mirrors how we run the working room — same palette, same tone, full detail.</p>

      <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
        <a href="/the-room" class="fly-in fly-stagger-1 group dm-card dm-card--green">
          <div class="dm-card-head">
            <span class="dm-card-icon"><i data-feather="layers" class="h-5 w-5"></i></span>
            <h3 class="dm-card-title">The room</h3>
          </div>
          <p class="dm-card-body">Real estate, capital, growth, life — the four filters that define who belongs here.</p>
          <span class="mt-4 inline-flex items-center text-bronze" aria-hidden="true"><i data-feather="arrow-right" class="h-3.5 w-3.5 motion-safe:transition-transform group-hover:translate-x-1"></i></span>
        </a>
        <a href="/how-it-works" class="fly-in fly-stagger-2 group dm-card dm-card--green">
          <div class="dm-card-head">
            <span class="dm-card-icon"><i data-feather="git-branch" class="h-5 w-5"></i></span>
            <h3 class="dm-card-title">How it works</h3>
          </div>
          <p class="dm-card-body">Community, demonstrated expertise, and real opportunities — the rhythm of every session.</p>
          <span class="mt-4 inline-flex items-center text-bronze" aria-hidden="true"><i data-feather="arrow-right" class="h-3.5 w-3.5 motion-safe:transition-transform group-hover:translate-x-1"></i></span>
        </a>
        <a href="/events" class="fly-in fly-stagger-3 group dm-card dm-card--green sm:col-span-2 lg:col-span-1">
          <div class="dm-card-head">
            <span class="dm-card-icon"><i data-feather="calendar" class="h-5 w-5"></i></span>
            <h3 class="dm-card-title">Events</h3>
          </div>
          <p class="dm-card-body">CEO format flagship rooms, past schedule, immersions — and where to request access.</p>
          <span class="mt-4 inline-flex items-center text-bronze" aria-hidden="true"><i data-feather="arrow-right" class="h-3.5 w-3.5 motion-safe:transition-transform group-hover:translate-x-1"></i></span>
        </a>
        <a href="/access" class="fly-in fly-stagger-4 group dm-card dm-card--green">
          <div class="dm-card-head">
            <span class="dm-card-icon"><i data-feather="key" class="h-5 w-5"></i></span>
            <h3 class="dm-card-title">Access</h3>
          </div>
          <p class="dm-card-body">Curated and welcoming — what access means, what it doesn&apos;t, and who the room is for.</p>
          <span class="mt-4 inline-flex items-center text-bronze" aria-hidden="true"><i data-feather="arrow-right" class="h-3.5 w-3.5 motion-safe:transition-transform group-hover:translate-x-1"></i></span>
        </a>
        <a href="/membership" class="fly-in fly-stagger-5 group dm-card dm-card--green">
          <div class="dm-card-head">
            <span class="dm-card-icon"><i data-feather="credit-card" class="h-5 w-5"></i></span>
            <h3 class="dm-card-title">Membership</h3>
          </div>
          <p class="dm-card-body">Annual rhythm from $500/year — member benefits and how to stay closest to the deal flow.</p>
          <span class="mt-4 inline-flex items-center text-bronze" aria-hidden="true"><i data-feather="arrow-right" class="h-3.5 w-3.5 motion-safe:transition-transform group-hover:translate-x-1"></i></span>
        </a>
        <a href="/launch-a-city" class="fly-in fly-stagger-6 group dm-card dm-card--green">
          <div class="dm-card-head">
            <span class="dm-card-icon"><i data-feather="map" class="h-5 w-5"></i></span>
            <h3 class="dm-card-title">Launch a city</h3>
          </div>
          <p class="dm-card-body">Own the Dealmakers room in your market — economics, expectations, and alignment.</p>
          <span class="mt-4 inline-flex items-center text-bronze" aria-hidden="true"><i data-feather="arrow-right" class="h-3.5 w-3.5 motion-safe:transition-transform group-hover:translate-x-1"></i></span>
        </a>
        <a href="/sponsorship" class="fly-in group dm-card dm-card--green sm:col-span-2 lg:col-span-1">
          <div class="dm-card-head">
            <span class="dm-card-icon"><i data-feather="trending-up" class="h-5 w-5"></i></span>
            <h3 class="dm-card-title">Sponsorship</h3>
          </div>
          <p class="dm-card-body">Tiered partnerships from exhibitor to featured moderator — engineered for recurring presence beside real deal flow.</p>
          <span class="mt-4 inline-flex items-center text-bronze" aria-hidden="true"><i data-feather="arrow-right" class="h-3.5 w-3.5 motion-safe:transition-transform group-hover:translate-x-1"></i></span>
        </a>
        <a href="/apply" class="fly-in group dm-card dm-card--green sm:col-span-2 lg:col-span-2">
          <div class="dm-card-head">
            <span class="dm-card-icon"><i data-feather="mic" class="h-5 w-5"></i></span>
            <h3 class="dm-card-title">Apply to speak</h3>
          </div>
          <p class="dm-card-body">Bring judgment, facilitate tension, and leave the room with something worth carrying.</p>
          <span class="mt-4 inline-flex items-center text-bronze" aria-hidden="true"><i data-feather="arrow-right" class="h-3.5 w-3.5 motion-safe:transition-transform group-hover:translate-x-1"></i></span>
        </a>
      </div>
    </div>
  </section>

  <!-- Final CTA -->
  <section id="contact" class="relative overflow-hidden bg-bone py-14 md:py-20">
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_60%_40%_at_0%_100%,rgba(31,61,43,0.07),transparent)]" aria-hidden="true"></div>
    <div class="relative mx-auto max-w-7xl px-5 md:px-8">
      <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-16">
        <div class="fly-in fly-from-left min-w-0">
          <div class="img-frame img-frame--16-10 img-frame--lg rounded-3xl shadow-xl ring-1 ring-gunmetal/10">
            <img
              src="images/Dealmakers_0057.jpg"
              alt="Dealmakers community gathering"
              class="object-[center_35%]"
              width="1920"
              height="1280"
              loading="lazy"
            />
          </div>
        </div>
        <div class="fly-in fly-from-right min-w-0">
          <h2 class="section-title max-w-xl leading-snug">If this feels like your kind of room — we'd like to hear from you.</h2>
          <div class="mt-8 btn-row">
            <a href="#" data-book-call class="btn btn-bronze motion-safe:transition shadow-lg shadow-bronze/25">
              <span>Book a Call with Dani</span>
              <i data-feather="arrow-right" class="h-4 w-4"></i>
            </a>
            <a href="/access#request-access" class="btn btn-green motion-safe:transition shadow-lg shadow-green/25">
              <span>Request access</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
<?php require __DIR__ . '/includes/layout-end.php'; ?>
