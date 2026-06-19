<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = 'Launch a city | Dealmakers';
$pageSlug = 'launch-a-city';
$pageStyles = <<<'CSS'
html {
      scroll-padding-top: 100px;
    }
    @media (prefers-reduced-motion: no-preference) {
      html {
        scroll-behavior: smooth;
      }
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

      initScrollFlyIn();
      initCounters();
    })();
JS;
require __DIR__ . '/includes/layout-start.php';
?>
<section class="page-hero noise-carbon">
    <div class="page-hero__bg" aria-hidden="true">
      <img src="images/DealmakersNovember_0003.jpg" alt="" class="object-center" width="1920" height="1280" loading="eager" fetchpriority="high" />
      <div class="page-hero__scrim"></div>
      <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_55%_45%_at_20%_0%,rgba(197,163,125,0.14),transparent)]"></div>
    </div>
    <div class="page-hero__content relative z-10 mx-auto w-full max-w-7xl px-5 pb-10 pt-24 md:px-8 md:pb-12 md:pt-28">
      <nav class="text-[11px] font-medium uppercase tracking-[0.22em] text-bone/45" aria-label="Breadcrumb">
        <a href="/#hero" class="hover:text-bronze motion-safe:transition">Home</a>
        <span class="mx-2 text-bone/30">/</span>
        <span class="text-bone/70">Launch a city</span>
      </nav>
      <p class="fly-in mt-8 section-kicker text-bronze">Own the room in your market</p>
      <h1 class="fly-in fly-stagger-1 mt-4 max-w-3xl font-heading text-3xl font-semibold leading-tight tracking-tight md:text-[2.65rem]">One Dealmaker per city</h1>
      <p class="fly-in fly-stagger-2 mt-6 max-w-2xl text-base leading-relaxed text-bone/70 md:text-lg">Economics, expectations, and the playbook for stewarding Dealmakers locally.</p>
      <div class="fly-in fly-stagger-3 mt-10 btn-row">
        <a href="#" data-book-call class="btn btn-bronze motion-safe:transition shadow-lg shadow-bronze/25">Book a Call with Dani</a>
        <a href="/contact" class="btn btn-outline-dark motion-safe:transition">Contact</a>
        <a href="/#explore" class="btn btn-outline-dark motion-safe:transition">All chapters</a>
      </div>
    </div>
  </section>

  <!-- Launch a City -->
  <section id="launch-city" class="relative overflow-hidden bg-carbon py-20 text-bone noise-carbon md:py-28">
    <div class="pointer-events-none absolute left-1/2 top-0 h-[28rem] w-[28rem] -translate-x-1/2 rounded-full bg-green/[0.12] blur-3xl" aria-hidden="true"></div>
    <div class="relative z-10 mx-auto max-w-7xl px-5 md:px-8">
      <h2 class="fly-in font-heading text-2xl font-semibold md:text-4xl">Own the room <em class="not-italic text-bronze">in your market.</em></h2>
      <p class="fly-in fly-stagger-1 mt-4 max-w-2xl text-[11px] font-semibold uppercase leading-relaxed tracking-[0.2em] text-bone/50">One Dealmaker per market. This position closes once appointed.</p>

      <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-5">
        <div class="fly-in fly-stagger-1 rounded-2xl bg-carbon/80 p-6 shadow-lg shadow-carbon/20 ring-1 ring-bone/10 motion-safe:transition hover:ring-bronze/35">
          <div class="text-bronze"><i data-feather="map-pin" class="h-5 w-5"></i></div>
          <p class="mt-3 text-[10px] font-semibold uppercase tracking-wider text-bronze">Local authority</p>
          <p class="mt-2 text-sm text-bone/70">Brand-aligned stewardship of the working room in your city.</p>
        </div>
        <div class="fly-in fly-stagger-2 rounded-2xl bg-carbon/80 p-6 shadow-lg shadow-carbon/20 ring-1 ring-bone/10 motion-safe:transition hover:ring-bronze/35">
          <div class="text-bronze"><i data-feather="user-plus" class="h-5 w-5"></i></div>
          <p class="mt-3 text-[10px] font-semibold uppercase tracking-wider text-bronze">Curated pipeline</p>
          <p class="mt-2 text-sm text-bone/70">Support building a bench of operators, capital, and experts who fit the room.</p>
        </div>
        <div class="fly-in fly-stagger-3 rounded-2xl bg-carbon/80 p-6 shadow-lg shadow-carbon/20 ring-1 ring-bone/10 motion-safe:transition hover:ring-bronze/35">
          <div class="text-bronze"><i data-feather="book" class="h-5 w-5"></i></div>
          <p class="mt-3 text-[10px] font-semibold uppercase tracking-wider text-bronze">Playbook &amp; format</p>
          <p class="mt-2 text-sm text-bone/70">CEO format, programming guardrails, and production standards — maintained, not improvised.</p>
        </div>
        <div class="fly-in fly-stagger-4 rounded-2xl bg-carbon/80 p-6 shadow-lg shadow-carbon/20 ring-1 ring-bone/10 motion-safe:transition hover:ring-bronze/35">
          <div class="text-bronze"><i data-feather="globe" class="h-5 w-5"></i></div>
          <p class="mt-3 text-[10px] font-semibold uppercase tracking-wider text-bronze">National signal</p>
          <p class="mt-2 text-sm text-bone/70">Connection to the broader Dealmakers constellation without diluting the local room.</p>
        </div>
        <div class="fly-in fly-stagger-5 rounded-2xl bg-carbon/80 p-6 shadow-lg shadow-carbon/20 ring-1 ring-bone/10 motion-safe:transition hover:ring-bronze/35 sm:col-span-2 lg:col-span-1">
          <div class="text-bronze"><i data-feather="anchor" class="h-5 w-5"></i></div>
          <p class="mt-3 text-[10px] font-semibold uppercase tracking-wider text-bronze">Long-term alignment</p>
          <p class="mt-2 text-sm text-bone/70">Renewals tied to room quality, conduct, and outcomes — not vanity metrics.</p>
        </div>
      </div>

      <div class="mt-14 grid gap-6 lg:grid-cols-2">
        <div class="fly-in fly-from-left rounded-3xl bg-bone/5 p-8 ring-1 ring-bone/10">
          <p class="section-kicker text-bronze">Economics</p>
          <p class="mt-6 font-heading text-2xl font-semibold md:text-3xl">Economics discussed conversationally</p>
          <p class="mt-4 text-sm text-bone/65">Launch investment is scoped per market after alignment — not published on the public site.</p>
        </div>
        <div class="fly-in fly-from-right rounded-3xl bg-bone/5 p-8 ring-1 ring-bone/10">
          <p class="section-kicker text-bronze">Comparison</p>
          <p class="mt-4 text-sm text-bone/75">Most operators spread budget across marketing and sponsorships that rarely compound. Launching a city consolidates into a single, defensible room with recurring deal flow.</p>
        </div>
      </div>

      <div class="fly-in mt-10 rounded-3xl bg-bone/5 p-8 ring-1 ring-bone/10">
        <p class="section-kicker text-bronze">Expectations</p>
        <ul class="mt-6 grid gap-3 sm:grid-cols-2 text-sm text-bone/70">
          <li>4 flagship events per year</li>
          <li>10+ qualified attendees per event</li>
          <li>Brand-aligned conduct in every touchpoint</li>
          <li>Performance-based renewal</li>
        </ul>
      </div>
    </div>
  </section>
<?php require __DIR__ . '/includes/layout-end.php'; ?>
