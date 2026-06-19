<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = 'How it works | Dealmakers';
$pageSlug = 'how-it-works';
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
      <img src="images/Violet%20Crowned%20Media_Deal%20Makers-98_websize.jpg" alt="" class="object-center" width="1600" height="1067" loading="eager" fetchpriority="high" />
      <div class="page-hero__scrim"></div>
      <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_55%_45%_at_20%_0%,rgba(197,163,125,0.14),transparent)]"></div>
    </div>
    <div class="page-hero__content relative z-10 mx-auto w-full max-w-7xl px-5 pb-10 pt-24 md:px-8 md:pb-12 md:pt-28">
      <nav class="text-[11px] font-medium uppercase tracking-[0.22em] text-bone/45" aria-label="Breadcrumb">
        <a href="/#hero" class="hover:text-bronze motion-safe:transition">Home</a>
        <span class="mx-2 text-bone/30">/</span>
        <span class="text-bone/70">How it works</span>
      </nav>
      <p class="fly-in mt-8 section-kicker text-bronze">How the room works</p>
      <h1 class="fly-in fly-stagger-1 mt-4 max-w-3xl font-heading text-3xl font-semibold leading-tight tracking-tight md:text-[2.65rem]">Demonstrated expertise. Real opportunities.</h1>
      <p class="fly-in fly-stagger-2 mt-6 max-w-2xl text-base leading-relaxed text-bone/70 md:text-lg">The rhythm of every flagship session — community first, judgment on display, deals treated seriously.</p>
      <div class="fly-in fly-stagger-3 mt-10 btn-row">
        <a href="/membership#membership-inquiry" class="btn btn-green motion-safe:transition shadow-lg shadow-green/25">Request access</a>
        <a href="/#explore" class="btn btn-outline-dark motion-safe:transition">All chapters</a>
      </div>
    </div>
  </section>

  <!-- How it works — timeline -->
  <section id="how-it-works" class="relative overflow-hidden bg-bone py-14 md:py-20">
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_70%_45%_at_100%_20%,rgba(197,163,125,0.09),transparent)]" aria-hidden="true"></div>
    <div class="relative mx-auto max-w-7xl px-5 md:px-8">
      <div class="grid gap-12 lg:grid-cols-2 lg:items-stretch lg:gap-16">
        <div class="min-w-0">
          <h2 class="fly-in section-title">How the room works</h2>
          <p class="fly-in fly-stagger-1 mt-4 max-w-2xl text-gunmetal">Expertise is demonstrated, not advertised. Familiar faces compound trust. Opportunities are real and treated seriously.</p>

          <ol class="mt-16 space-y-5">
            <li class="fly-in fly-stagger-2 relative flex gap-6 rounded-3xl bg-white/70 p-6 pl-5 shadow-sm ring-1 ring-gunmetal/10 backdrop-blur-sm md:gap-8 md:p-8">
              <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-bronze/18 font-heading text-sm font-bold text-bronze">1</span>
              <div>
                <h3 class="font-heading text-lg font-semibold text-carbon">Community is the foundation</h3>
                <p class="mt-2 max-w-xl text-sm leading-relaxed text-gunmetal">Familiar faces compound trust.</p>
              </div>
            </li>
            <li class="fly-in fly-stagger-3 relative flex gap-6 rounded-3xl bg-white/70 p-6 pl-5 shadow-sm ring-1 ring-gunmetal/10 backdrop-blur-sm md:gap-8 md:p-8">
              <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-bronze/18 font-heading text-sm font-bold text-bronze">2</span>
              <div>
                <h3 class="font-heading text-lg font-semibold text-carbon">Expertise is demonstrated, not advertised</h3>
                <p class="mt-2 max-w-xl text-sm leading-relaxed text-gunmetal">No one performs. No one sells from the stage.</p>
              </div>
            </li>
            <li class="fly-in fly-stagger-4 relative flex gap-6 rounded-3xl bg-white/70 p-6 pl-5 shadow-sm ring-1 ring-gunmetal/10 backdrop-blur-sm md:gap-8 md:p-8">
              <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-bronze/18 font-heading text-sm font-bold text-bronze">3</span>
              <div>
                <h3 class="font-heading text-lg font-semibold text-carbon">Opportunities are real and treated seriously</h3>
                <p class="mt-2 max-w-xl text-sm leading-relaxed text-gunmetal">Decision energy, not demo-day energy.</p>
              </div>
            </li>
          </ol>
        </div>
        <div class="fly-in fly-from-right flex min-h-0 flex-col lg:h-full">
          <div class="img-frame-fill aspect-[4/5] min-h-[14rem] rounded-3xl shadow-2xl shadow-carbon/20 ring-1 ring-gunmetal/15 lg:aspect-auto lg:min-h-[12rem] lg:flex-1">
            <img
              src="images/Violet%20Crowned%20Media_Deal%20Makers-71_websize.jpg"
              alt="Dealmakers working session"
              class="object-[center_30%]"
              width="800"
              height="1000"
              loading="lazy"
            />
          </div>
          <p class="mt-4 shrink-0 text-center text-xs text-gunmetal/80">In the room — Austin &amp; Dallas</p>
        </div>
      </div>

      <div class="fly-in mt-16 rounded-3xl bg-carbon px-8 py-10 text-bone noise-carbon shadow-xl shadow-carbon/30 ring-1 ring-bone/10 md:px-12 md:py-12">
        <div class="flex flex-wrap items-start gap-4">
          <span class="text-bronze"><i data-feather="user-check" class="h-8 w-8"></i></span>
          <div>
            <h3 class="font-heading text-lg font-semibold uppercase tracking-wide text-bone md:text-xl">This is not an audience. It's participation.</h3>
            <p class="mt-4 max-w-2xl text-bone/75">Curated rooms. Capital in motion. Real conversations that lead to outcomes.</p>
            <p class="mt-3 text-sm text-bone/55">Operators, investors, and experts in the same space. Participation is expected. Contribution is assumed.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php require __DIR__ . '/includes/layout-end.php'; ?>
