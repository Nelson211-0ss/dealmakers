<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = 'Events | Dealmakers';
$pageSlug = 'events';
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
    .past-events-table {
      border-collapse: separate;
      border-spacing: 0 0.5rem;
    }
    .past-events-table thead th {
      background-color: #0F1115;
      color: #F4F3EF;
    }
    .past-events-table thead th:first-child {
      border-radius: 0.75rem 0 0 0.75rem;
    }
    .past-events-table thead th:last-child {
      border-radius: 0 0.75rem 0.75rem 0;
    }
    .past-events-table tbody tr {
      background-color: #ffffff;
      box-shadow: 0 1px 2px rgba(15, 17, 21, 0.05);
    }
    .past-events-table tbody tr:nth-child(even) {
      background-color: rgba(58, 63, 69, 0.06);
    }
    .past-events-table tbody td {
      border-top: 1px solid rgba(58, 63, 69, 0.12);
      border-bottom: 1px solid rgba(58, 63, 69, 0.12);
    }
    .past-events-table tbody td:first-child {
      border-left: 1px solid rgba(58, 63, 69, 0.12);
      border-radius: 0.75rem 0 0 0.75rem;
    }
    .past-events-table tbody td:last-child {
      border-right: 1px solid rgba(58, 63, 69, 0.12);
      border-radius: 0 0.75rem 0.75rem 0;
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
      <img src="images/Dealmakers_0040.jpg" alt="" class="object-[center_40%]" width="1920" height="1280" loading="eager" fetchpriority="high" />
      <div class="page-hero__scrim"></div>
      <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_55%_45%_at_20%_0%,rgba(197,163,125,0.14),transparent)]"></div>
    </div>
    <div class="page-hero__content relative z-10 mx-auto w-full max-w-7xl px-5 pb-10 pt-24 md:px-8 md:pb-12 md:pt-28">
      <nav class="text-[11px] font-medium uppercase tracking-[0.22em] text-bone/45" aria-label="Breadcrumb">
        <a href="/#hero" class="hover:text-bronze motion-safe:transition">Home</a>
        <span class="mx-2 text-bone/30">/</span>
        <span class="text-bone/70">Events</span>
      </nav>
      <p class="fly-in mt-8 section-kicker text-bronze">Calendar &amp; rooms</p>
      <h1 class="fly-in fly-stagger-1 mt-4 max-w-3xl font-heading text-3xl font-semibold leading-tight tracking-tight md:text-[2.65rem]">Momentum lives here.</h1>
      <p class="fly-in fly-stagger-2 mt-6 max-w-2xl text-base leading-relaxed text-bone/70 md:text-lg">Flagship working rooms, the upcoming session, immersions, and the full history of gatherings.</p>
      <div class="fly-in fly-stagger-3 mt-10 btn-row">
        <a href="/membership#membership-inquiry" class="btn btn-outline-dark motion-safe:transition">Request access</a>
        <a href="/sponsorship#sponsorship-inquiry" class="btn btn-outline-dark motion-safe:transition">Sponsor the room</a>
      </div>
    </div>
  </section>

  <section id="upcoming-events" class="bg-bone py-14 md:py-20">
    <div class="mx-auto max-w-7xl px-5 md:px-8">
      <div class="flex flex-col justify-between gap-8 md:flex-row md:items-end">
        <div class="fly-in">
          <p class="section-kicker text-green">Upcoming events</p>
          <p class="mt-4 max-w-xl text-gunmetal">Flagship working rooms — Community, Expertise, and Opportunities in one rhythm.</p>
        </div>
        <a href="/membership#membership-inquiry" class="btn btn-outline motion-safe:transition fly-in fly-from-right shrink-0">
          <i data-feather="key" class="h-4 w-4"></i>
          Request access
        </a>
      </div>

      <div class="fly-in mt-10 grid grid-cols-3 gap-2 sm:gap-3 md:mt-12 md:gap-4">
        <div class="overflow-hidden rounded-2xl ring-1 ring-gunmetal/10 shadow-md md:rounded-2xl">
          <img src="images/Dealmakers_0040.jpg" alt="Flagship CEO session in the room" class="object-[center_40%] motion-safe:transition hover:scale-105 motion-safe:duration-500" width="1920" height="1280" loading="lazy" />
        </div>
        <div class="img-frame img-frame--4-3"><img src="images/Violet%20Crowned%20Media_Deal%20Makers-26_websize.jpg" alt="Operators connecting between sessions" class="object-[65%_center] motion-safe:transition hover:scale-105 motion-safe:duration-500" width="1600" height="1067" loading="lazy" />
        </div>
        <div class="img-frame img-frame--4-3"><img src="images/Violet%20Crowned%20Media_Deal%20Makers-58_websize.jpg" alt="The room at full energy" class="object-center motion-safe:transition hover:scale-105 motion-safe:duration-500" width="1600" height="1067" loading="lazy" />
        </div>
      </div>

      <p class="fly-in mt-14 section-kicker text-gunmetal">CEO format</p>
      <div class="mt-5 grid gap-5 md:grid-cols-3">
        <div class="fly-in fly-stagger-1 rounded-3xl bg-white/70 p-8 shadow-sm ring-1 ring-gunmetal/10 backdrop-blur-sm md:p-10">
          <div class="mb-4 text-bronze"><i data-feather="users" class="h-6 w-6"></i></div>
          <h3 class="font-heading text-lg font-semibold text-carbon">Community</h3>
          <p class="mt-2 text-sm leading-relaxed text-gunmetal">A room where familiar faces compound trust and contribution is the default.</p>
        </div>
        <div class="fly-in fly-stagger-2 rounded-3xl bg-white/70 p-8 shadow-sm ring-1 ring-gunmetal/10 backdrop-blur-sm md:p-10">
          <div class="mb-4 text-bronze"><i data-feather="award" class="h-6 w-6"></i></div>
          <h3 class="font-heading text-lg font-semibold text-carbon">Expertise</h3>
          <p class="mt-2 text-sm leading-relaxed text-gunmetal">Insight shown through judgment and execution — not performance or pitch theater.</p>
        </div>
        <div class="fly-in fly-stagger-3 rounded-3xl bg-white/70 p-8 shadow-sm ring-1 ring-gunmetal/10 backdrop-blur-sm md:p-10">
          <div class="mb-4 text-bronze"><i data-feather="zap" class="h-6 w-6"></i></div>
          <h3 class="font-heading text-lg font-semibold text-carbon">Opportunities</h3>
          <p class="mt-2 text-sm leading-relaxed text-gunmetal">Real deals, real capital in motion — decision energy from first conversation to follow-through.</p>
        </div>
      </div>

      <div class="fly-in mt-12 overflow-hidden rounded-3xl bg-carbon text-bone noise-carbon shadow-2xl shadow-carbon/40 ring-1 ring-bone/10">
        <div class="grid gap-0 lg:grid-cols-2 lg:items-stretch">
          <div class="img-frame-fill img-frame--16-10 min-h-[220px] lg:min-h-[280px]"><img
              src="images/Violet%20Crowned%20Media_Deal%20Makers-102_websize.jpg"
              alt="Panel at a Dealmakers flagship session"
              class="object-center"
              width="1600"
              height="1067"
              loading="lazy"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-carbon via-carbon/20 to-transparent lg:bg-gradient-to-r lg:from-transparent lg:via-carbon/30 lg:to-carbon" aria-hidden="true"></div>
          </div>
          <div class="relative z-10 flex flex-col justify-center p-8 md:p-12">
            <p class="text-[11px] font-semibold uppercase tracking-[0.25em] text-bronze">Next session</p>
            <h3 class="mt-4 font-heading text-2xl font-semibold">Dealmakers CEO — Austin (Spring)</h3>
            <div class="mt-6 flex flex-wrap gap-x-8 gap-y-3 text-sm text-bone/65">
              <span class="inline-flex items-center gap-2"><i data-feather="calendar" class="h-4 w-4 text-bronze"></i> Flagship session</span>
              <span class="inline-flex items-center gap-2"><i data-feather="map-pin" class="h-4 w-4 text-bronze"></i> East End Ballroom</span>
              <span class="inline-flex items-center gap-2"><i data-feather="clock" class="h-4 w-4 text-bronze"></i> Half-day</span>
            </div>
            <p class="mt-4 text-sm text-bone/55">Members &amp; invited operators</p>
            <a href="/membership#membership-inquiry" class="btn btn-bronze motion-safe:transition mt-8 shadow-lg shadow-bronze/20">
              Request access
              <i data-feather="arrow-right" class="h-4 w-4"></i>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="past-events" class="border-t border-gunmetal/10 bg-bone py-14 md:py-20">
    <div class="mx-auto max-w-7xl px-5 md:px-8">
      <p class="fly-in section-kicker text-gunmetal">Past events</p>
      <div class="fly-in mt-6 overflow-x-auto">
        <table class="past-events-table w-full min-w-[32rem] text-left text-sm">
          <thead>
            <tr>
              <th scope="col" class="px-4 py-3.5 font-heading text-[11px] font-semibold uppercase tracking-[0.16em] md:px-6">Date</th>
              <th scope="col" class="px-4 py-3.5 font-heading text-[11px] font-semibold uppercase tracking-[0.16em] md:px-6">Theme</th>
              <th scope="col" class="px-4 py-3.5 font-heading text-[11px] font-semibold uppercase tracking-[0.16em] md:px-6">Venue</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="whitespace-nowrap px-4 py-4 font-mono text-xs text-gunmetal md:px-6 md:py-5">2025-02-12</td>
              <td class="px-4 py-4 font-medium text-carbon md:px-6 md:py-5">Capital in Motion</td>
              <td class="px-4 py-4 text-gunmetal md:px-6 md:py-5">East End Ballroom</td>
            </tr>
            <tr>
              <td class="whitespace-nowrap px-4 py-4 font-mono text-xs text-gunmetal md:px-6 md:py-5">2024-11-07</td>
              <td class="px-4 py-4 font-medium text-carbon md:px-6 md:py-5">Execution &amp; Leverage</td>
              <td class="px-4 py-4 text-gunmetal md:px-6 md:py-5">Hotel Magdalena</td>
            </tr>
            <tr>
              <td class="whitespace-nowrap px-4 py-4 font-mono text-xs text-gunmetal md:px-6 md:py-5">2024-09-18</td>
              <td class="px-4 py-4 font-medium text-carbon md:px-6 md:py-5">Credit &amp; Structure</td>
              <td class="px-4 py-4 text-gunmetal md:px-6 md:py-5">The Contemporary Austin</td>
            </tr>
            <tr>
              <td class="whitespace-nowrap px-4 py-4 font-mono text-xs text-gunmetal md:px-6 md:py-5">2024-06-05</td>
              <td class="px-4 py-4 font-medium text-carbon md:px-6 md:py-5">Growth Platforms</td>
              <td class="px-4 py-4 text-gunmetal md:px-6 md:py-5">Springdale General</td>
            </tr>
            <tr>
              <td class="whitespace-nowrap px-4 py-4 font-mono text-xs text-gunmetal md:px-6 md:py-5">2024-03-21</td>
              <td class="px-4 py-4 font-medium text-carbon md:px-6 md:py-5">Discipline &amp; Edge</td>
              <td class="px-4 py-4 text-gunmetal md:px-6 md:py-5">Lucky Arrow Retreat</td>
            </tr>
            <tr>
              <td class="whitespace-nowrap px-4 py-4 font-mono text-xs text-gunmetal md:px-6 md:py-5">2023-12-06</td>
              <td class="px-4 py-4 font-medium text-carbon md:px-6 md:py-5">Year-End Room</td>
              <td class="px-4 py-4 text-gunmetal md:px-6 md:py-5">South Congress Hotel</td>
            </tr>
            <tr>
              <td class="whitespace-nowrap px-4 py-4 font-mono text-xs text-gunmetal md:px-6 md:py-5">2023-09-14</td>
              <td class="px-4 py-4 font-medium text-carbon md:px-6 md:py-5">Operator Roundtable</td>
              <td class="px-4 py-4 text-gunmetal md:px-6 md:py-5">Umlauf Sculpture Garden</td>
            </tr>
            <tr>
              <td class="whitespace-nowrap px-4 py-4 font-mono text-xs text-gunmetal md:px-6 md:py-5">2023-06-01</td>
              <td class="px-4 py-4 font-medium text-carbon md:px-6 md:py-5">Austin Assembly</td>
              <td class="px-4 py-4 text-gunmetal md:px-6 md:py-5">East End Ballroom</td>
            </tr>
            <tr>
              <td class="whitespace-nowrap px-4 py-4 font-mono text-xs text-gunmetal md:px-6 md:py-5">2023-02-08</td>
              <td class="px-4 py-4 font-medium text-carbon md:px-6 md:py-5">Winter Working Room</td>
              <td class="px-4 py-4 text-gunmetal md:px-6 md:py-5">South Congress Hotel</td>
            </tr>
            <tr>
              <td class="whitespace-nowrap px-4 py-4 font-mono text-xs text-gunmetal md:px-6 md:py-5">2022-10-19</td>
              <td class="px-4 py-4 font-medium text-carbon md:px-6 md:py-5">Risk &amp; Judgment</td>
              <td class="px-4 py-4 text-gunmetal md:px-6 md:py-5">Hotel Magdalena</td>
            </tr>
            <tr>
              <td class="whitespace-nowrap px-4 py-4 font-mono text-xs text-gunmetal md:px-6 md:py-5">2022-07-27</td>
              <td class="px-4 py-4 font-medium text-carbon md:px-6 md:py-5">Mid-Year Working Room</td>
              <td class="px-4 py-4 text-gunmetal md:px-6 md:py-5">Lucky Arrow Retreat</td>
            </tr>
            <tr>
              <td class="whitespace-nowrap px-4 py-4 font-mono text-xs text-gunmetal md:px-6 md:py-5">2022-04-12</td>
              <td class="px-4 py-4 font-medium text-carbon md:px-6 md:py-5">Capital Stack</td>
              <td class="px-4 py-4 text-gunmetal md:px-6 md:py-5">Springdale General</td>
            </tr>
            <tr>
              <td class="whitespace-nowrap px-4 py-4 font-mono text-xs text-gunmetal md:px-6 md:py-5">2021-11-17</td>
              <td class="px-4 py-4 font-medium text-carbon md:px-6 md:py-5">Founding Room</td>
              <td class="px-4 py-4 text-gunmetal md:px-6 md:py-5">East End Ballroom</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <section id="events" class="border-t border-gunmetal/10 bg-bone py-14 md:py-20">
    <div class="mx-auto max-w-7xl px-5 md:px-8">
      <div class="fly-in grid gap-5 md:grid-cols-2">
        <div class="group overflow-hidden rounded-3xl bg-white/70 shadow-sm ring-1 ring-gunmetal/10 backdrop-blur-sm">
          <div class="img-frame-fill img-frame--16-9"><img src="images/Dealmakers_0057.jpg" alt="Speaker leading an immersion session" class="object-[center_35%] motion-safe:transition motion-safe:duration-500 group-hover:scale-105" width="1920" height="1280" loading="lazy" />
          </div>
          <div class="p-8 md:p-10">
          <div class="text-bronze"><i data-feather="book-open" class="h-6 w-6"></i></div>
          <h4 class="mt-4 font-heading text-lg font-semibold text-carbon">Immersions</h4>
          <p class="mt-3 text-sm leading-relaxed text-gunmetal">Members-only masterclasses — deeper lanes, tighter rooms, and execution-level detail.</p>
          </div>
        </div>
        <div class="group overflow-hidden rounded-3xl bg-white/70 shadow-sm ring-1 ring-gunmetal/10 backdrop-blur-sm">
          <div class="img-frame-fill img-frame--16-9"><img src="images/Violet%20Crowned%20Media_Deal%20Makers-86_websize.jpg" alt="Curated evening conversation" class="object-[center_40%] motion-safe:transition motion-safe:duration-500 group-hover:scale-105" width="1600" height="1067" loading="lazy" />
          </div>
          <div class="p-8 md:p-10">
          <div class="text-bronze"><i data-feather="star" class="h-6 w-6"></i></div>
          <h4 class="mt-4 font-heading text-lg font-semibold text-carbon">Special Events</h4>
          <p class="mt-3 text-sm leading-relaxed text-gunmetal">Curated evenings and off-sites when the moment calls for a different kind of conversation.</p>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php require __DIR__ . '/includes/layout-end.php'; ?>
