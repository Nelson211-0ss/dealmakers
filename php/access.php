<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = 'Access | Dealmakers';
$pageSlug = 'access';
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
$extraScripts = [
  'zoho-form-embed.js',
];
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
      <img src="images/Violet%20Crowned%20Media_Deal%20Makers-179_websize.jpg" alt="" class="object-center" width="1600" height="1067" loading="eager" fetchpriority="high" />
      <div class="page-hero__scrim"></div>
      <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_55%_45%_at_20%_0%,rgba(197,163,125,0.14),transparent)]"></div>
    </div>
    <div class="page-hero__content relative z-10 mx-auto w-full max-w-7xl px-5 pb-10 pt-24 md:px-8 md:pb-12 md:pt-28">
      <nav class="text-[11px] font-medium uppercase tracking-[0.22em] text-bone/45" aria-label="Breadcrumb">
        <a href="/#hero" class="hover:text-bronze motion-safe:transition">Home</a>
        <span class="mx-2 text-bone/30">/</span>
        <span class="text-bone/70">Access</span>
      </nav>
      <p class="fly-in mt-8 section-kicker text-bronze">Intentional — and welcoming</p>
      <h1 class="fly-in fly-stagger-1 mt-4 max-w-3xl font-heading text-3xl font-semibold leading-tight tracking-tight md:text-[2.65rem]">Curated, not closed</h1>
      <p class="fly-in fly-stagger-2 mt-6 max-w-2xl text-base leading-relaxed text-bone/70 md:text-lg">What access protects, who belongs, and how to step into the room.</p>
      <div class="fly-in fly-stagger-3 mt-10 btn-row">
        <a href="#" data-book-call class="btn btn-bronze motion-safe:transition shadow-lg shadow-bronze/25">Book a Call with Dani</a>
        <a href="#request-access" class="btn btn-green motion-safe:transition shadow-lg shadow-green/25">Request access</a>
        <a href="/#explore" class="btn btn-outline-dark motion-safe:transition">All chapters</a>
      </div>
    </div>
  </section>

  <!-- Access -->
  <section id="access" class="relative overflow-hidden bg-bone py-14 md:py-20">
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_70%_45%_at_0%_30%,rgba(31,61,43,0.06),transparent)]" aria-hidden="true"></div>
    <div class="relative mx-auto max-w-7xl px-5 md:px-8">
      <div class="grid gap-12 lg:grid-cols-2 lg:items-stretch lg:gap-16">
        <div class="min-w-0">
          <p class="fly-in section-kicker text-green">Why access matters</p>
          <h2 class="fly-in fly-stagger-1 section-title mt-3">Curated to protect the room</h2>
          <p class="fly-in fly-stagger-2 mt-4 max-w-xl text-gunmetal">Dealmakers is intentionally curated — not to keep people out, but to keep the room relevant, engaging, and worth returning to.</p>
          <p class="fly-in fly-stagger-2 mt-4 max-w-xl text-gunmetal">We review every request so familiar faces compound trust and conversations stay honest.</p>
          <ul class="fly-in fly-stagger-3 mt-8 space-y-3 text-sm text-gunmetal">
            <li class="flex gap-3"><i data-feather="shield" class="mt-0.5 h-4 w-4 shrink-0 text-bronze"></i><span>Quality over volume — fewer people, more signal</span></li>
            <li class="flex gap-3"><i data-feather="repeat" class="mt-0.5 h-4 w-4 shrink-0 text-bronze"></i><span>Continuity — the same room, over time</span></li>
            <li class="flex gap-3"><i data-feather="target" class="mt-0.5 h-4 w-4 shrink-0 text-bronze"></i><span>Fit — operators, investors, and experts who move</span></li>
          </ul>
        </div>
        <div class="fly-in fly-from-right flex min-h-0 flex-col lg:h-full">
          <div class="img-frame-fill aspect-[4/5] min-h-[14rem] rounded-3xl shadow-2xl shadow-carbon/20 ring-1 ring-gunmetal/15 lg:aspect-auto lg:min-h-[12rem] lg:flex-1">
            <img src="images/Violet%20Crowned%20Media_Deal%20Makers-39_websize.jpg" alt="Members connecting at a Dealmakers gathering" class="object-center" width="1600" height="1067" loading="lazy" />
          </div>
          <p class="mt-4 shrink-0 text-center text-xs text-gunmetal/80">In the room — Austin &amp; Dallas</p>
        </div>
      </div>

      <div class="mt-16 grid gap-6 md:grid-cols-2">
        <div class="fly-in fly-from-left rounded-3xl bg-white/70 p-8 shadow-sm ring-1 ring-gunmetal/10 backdrop-blur-sm md:p-10">
          <p class="section-kicker text-gunmetal">Access does not mean</p>
          <ul class="mt-6 space-y-4 text-sm text-gunmetal">
            <li class="flex gap-3"><i data-feather="x-circle" class="mt-0.5 h-4 w-4 shrink-0 text-gunmetal/70"></i><span>Guaranteed speaking time</span></li>
            <li class="flex gap-3"><i data-feather="x-circle" class="mt-0.5 h-4 w-4 shrink-0 text-gunmetal/70"></i><span>Selling from the back of the room</span></li>
            <li class="flex gap-3"><i data-feather="x-circle" class="mt-0.5 h-4 w-4 shrink-0 text-gunmetal/70"></i><span>Passive attendance</span></li>
          </ul>
        </div>
        <div class="fly-in fly-from-right rounded-3xl bg-carbon p-8 text-bone noise-carbon shadow-xl shadow-carbon/30 ring-1 ring-bone/10 md:p-10">
          <p class="section-kicker text-bronze">Access does mean</p>
          <ul class="mt-6 space-y-4 text-sm text-bone/85">
            <li class="flex gap-3"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-bronze"></i><span>Participation</span></li>
            <li class="flex gap-3"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-bronze"></i><span>Respect for the format</span></li>
            <li class="flex gap-3"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-bronze"></i><span>Willingness to engage thoughtfully</span></li>
          </ul>
        </div>
      </div>

      <div class="mt-20">
        <p class="fly-in section-kicker text-green">Who belongs</p>
        <h3 class="fly-in fly-stagger-1 section-title mt-3">Built for people who move</h3>
        <p class="fly-in fly-stagger-2 mt-4 max-w-2xl text-gunmetal">Serious operators, investors, and experts working in and around real estate, capital, and growth. You'll recognize the room and the people in it.</p>
        <div class="mt-10 grid gap-4 sm:grid-cols-3">
          <div class="fly-in fly-stagger-2 rounded-3xl bg-white/70 p-6 shadow-sm ring-1 ring-gunmetal/10 backdrop-blur-sm md:p-8">
            <i data-feather="briefcase" class="h-6 w-6 text-bronze"></i>
            <h4 class="mt-4 font-heading text-lg font-semibold text-carbon">Operators</h4>
            <p class="mt-2 text-sm text-gunmetal">Founders and builders executing in real estate and adjacent growth markets.</p>
          </div>
          <div class="fly-in fly-stagger-3 rounded-3xl bg-white/70 p-6 shadow-sm ring-1 ring-gunmetal/10 backdrop-blur-sm md:p-8">
            <i data-feather="trending-up" class="h-6 w-6 text-bronze"></i>
            <h4 class="mt-4 font-heading text-lg font-semibold text-carbon">Investors</h4>
            <p class="mt-2 text-sm text-gunmetal">Capital allocators and partners who move with judgment, not noise.</p>
          </div>
          <div class="fly-in fly-stagger-4 rounded-3xl bg-white/70 p-6 shadow-sm ring-1 ring-gunmetal/10 backdrop-blur-sm md:p-8">
            <i data-feather="award" class="h-6 w-6 text-bronze"></i>
            <h4 class="mt-4 font-heading text-lg font-semibold text-carbon">Experts</h4>
            <p class="mt-2 text-sm text-gunmetal">Specialists whose expertise is demonstrated in the room — not advertised from it.</p>
          </div>
        </div>
      </div>

      <div class="fly-in mt-16 rounded-3xl bg-carbon px-8 py-10 text-bone noise-carbon shadow-xl shadow-carbon/30 ring-1 ring-bone/10 md:px-12 md:py-12">
        <blockquote class="font-heading text-xl font-medium leading-relaxed text-bone md:text-2xl">
          Pattern recognition compounds when the room stays honest — judgment over noise, follow-through over performance.
        </blockquote>
        <p class="mt-6 text-sm text-bone/60">This isn't about exposure. It's about being in the right room with the right people.</p>
      </div>

      <div class="fly-in mt-12">
        <p class="text-carbon">If this feels like your kind of room, we'd like to hear from you.</p>
        <div class="mt-6 btn-row">
          <a href="#" data-book-call class="btn btn-bronze motion-safe:transition shadow-lg">
            <i data-feather="phone" class="h-4 w-4"></i>
            Book a Call with Dani
          </a>
          <a href="#request-access" class="btn btn-green motion-safe:transition shadow-lg shadow-green/20">
            <i data-feather="log-in" class="h-4 w-4"></i>
            Request access
          </a>
        </div>
      </div>
    </div>
  </section>

  <section id="request-access" class="border-t border-gunmetal/10 bg-white/50 py-14 md:py-20">
    <div class="mx-auto max-w-4xl px-5 md:px-8">
      <p class="fly-in section-kicker text-green">Request access</p>
      <h2 class="fly-in fly-stagger-1 mt-4 section-title">Step into the room</h2>
      <p class="fly-in fly-stagger-2 mt-4 text-gunmetal">Tell us who you are and what you&apos;re looking for. Every submission is reviewed to keep the ecosystem relevant and engaged.</p>
      <div class="fly-in fly-stagger-3 zoho-form-embed-wrap mt-10 rounded-3xl bg-white/80 p-2 shadow-lg shadow-carbon/5 ring-1 ring-gunmetal/10 md:p-3">
        <iframe
          id="request-access-form"
          class="zoho-form-embed"
          data-zoho-form
          title="Request Access Form"
          aria-label="Request Access Form"
          data-src="https://forms.zohopublic.com/dealmakersllc1/form/MembershipInquiryForm1"
          src="https://forms.zohopublic.com/dealmakersllc1/form/MembershipInquiryForm1"
          scrolling="no"
        ></iframe>
      </div>
      <p class="fly-in mt-6 text-center text-sm text-gunmetal">Exploring membership tiers? See <a href="/membership" class="font-semibold text-green hover:underline">Membership</a> · <a href="/contact" class="font-semibold text-green hover:underline">Contact</a></p>
    </div>
  </section>
<?php require __DIR__ . '/includes/layout-end.php'; ?>
