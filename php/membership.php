<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = 'Membership | Dealmakers';
$pageSlug = 'membership';
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
  'membership-checkout.js',
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
      <img src="images/Dealmakers_0057.jpg" alt="" class="object-[center_35%]" width="1920" height="1280" loading="eager" fetchpriority="high" />
      <div class="page-hero__scrim"></div>
      <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_55%_45%_at_20%_0%,rgba(197,163,125,0.14),transparent)]"></div>
    </div>
    <div class="page-hero__content relative z-10 mx-auto w-full max-w-7xl px-5 pb-10 pt-24 md:px-8 md:pb-12 md:pt-28">
      <nav class="text-[11px] font-medium uppercase tracking-[0.22em] text-bone/45" aria-label="Breadcrumb">
        <a href="/#hero" class="hover:text-bronze motion-safe:transition">Home</a>
        <span class="mx-2 text-bone/30">/</span>
        <span class="text-bone/70">Membership</span>
      </nav>
      <h1 class="fly-in fly-stagger-1 mt-8 max-w-3xl font-heading text-3xl font-semibold leading-tight tracking-tight md:text-[2.65rem]">Belong to the ecosystem</h1>
      <p class="fly-in fly-stagger-2 mt-6 max-w-2xl text-base leading-relaxed text-bone/70 md:text-lg">Dealmakers is a high-frequency ecosystem for founders, operators, investors, and ambitious professionals shaping the future — built on relationships, not transactions.</p>
      <div class="fly-in fly-stagger-3 mt-10 btn-row">
        <a href="#" data-membership-checkout class="btn btn-green motion-safe:transition shadow-lg shadow-green/25">Join Now</a>
        <a href="#" data-book-call class="btn btn-bronze motion-safe:transition shadow-lg shadow-bronze/25">Book a Call with Dani</a>
      </div>
    </div>
  </section>

  <!-- Membership -->
  <section id="membership" class="relative overflow-hidden bg-bone py-14 md:py-20">
    <div class="pointer-events-none absolute left-0 top-0 h-56 w-56 -translate-x-1/2 bg-bronze/[0.08] blur-3xl" aria-hidden="true"></div>
    <div class="relative mx-auto max-w-7xl px-5 md:px-8">
      <header class="fly-in max-w-3xl">
        <p class="section-kicker text-green">Membership</p>
        <h2 class="section-title mt-3">Belong to the ecosystem</h2>
        <p class="mt-4 text-gunmetal">A high-frequency rhythm designed to create meaningful relationships between people who are serious about building — in the room, between events, and over time.</p>
      </header>

      <div class="mt-10 grid gap-10 lg:grid-cols-12 lg:items-start lg:gap-12">
        <div class="flex flex-col gap-8 lg:col-span-7">
          <div class="fly-in fly-stagger-1 rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gunmetal/10 md:p-8">
            <p class="section-kicker text-green">Annual membership</p>
            <p class="mt-3 font-heading text-4xl font-semibold tracking-tight text-green md:text-[2.75rem]">$500 <span class="text-lg font-medium text-gunmetal">/ year</span></p>
            <p class="mt-3 text-sm leading-relaxed text-gunmetal">Full member access to the Dealmakers rhythm — flagship events, member-only experiences, and curated community touchpoints.</p>
            <a href="#" data-membership-checkout class="btn btn-green motion-safe:transition mt-6 shadow-lg shadow-green/25">Join Now</a>
          </div>

          <div class="fly-in fly-stagger-2">
            <h3 class="section-kicker text-bronze">What&apos;s included</h3>
            <ul class="mt-4 grid gap-3 sm:grid-cols-2 sm:gap-x-10">
              <li class="flex gap-3 text-sm text-gunmetal"><i data-feather="calendar" class="mt-0.5 h-5 w-5 shrink-0 text-bronze" aria-hidden="true"></i><span><span class="font-medium text-carbon">Quarterly marquee events</span> — flagship rhythm in the CEO format</span></li>
              <li class="flex gap-3 text-sm text-gunmetal"><i data-feather="lock" class="mt-0.5 h-5 w-5 shrink-0 text-bronze" aria-hidden="true"></i><span><span class="font-medium text-carbon">Member-only experiences</span> reserved for recurring participants</span></li>
              <li class="flex gap-3 text-sm text-gunmetal"><i data-feather="sunrise" class="mt-0.5 h-5 w-5 shrink-0 text-bronze" aria-hidden="true"></i><span><span class="font-medium text-carbon">Come early / stay late access</span> — the conversations that matter</span></li>
              <li class="flex gap-3 text-sm text-gunmetal"><i data-feather="users" class="mt-0.5 h-5 w-5 shrink-0 text-bronze" aria-hidden="true"></i><span><span class="font-medium text-carbon">Curated introductions</span> when fit is clear</span></li>
              <li class="flex gap-3 text-sm text-gunmetal"><i data-feather="coffee" class="mt-0.5 h-5 w-5 shrink-0 text-bronze" aria-hidden="true"></i><span><span class="font-medium text-carbon">Founder dinners &amp; socials</span> — depth beyond the stage</span></li>
              <li class="flex gap-3 text-sm text-gunmetal"><i data-feather="heart" class="mt-0.5 h-5 w-5 shrink-0 text-bronze" aria-hidden="true"></i><span><span class="font-medium text-carbon">Wellness gatherings &amp; recreation</span> — community off the clock</span></li>
              <li class="flex gap-3 text-sm text-gunmetal sm:col-span-2"><i data-feather="zap" class="mt-0.5 h-5 w-5 shrink-0 text-bronze" aria-hidden="true"></i><span><span class="font-medium text-carbon">Priority access opportunities</span> when capacity is limited</span></li>
            </ul>
          </div>

          <div class="fly-in fly-stagger-3 btn-row">
            <a href="#" data-membership-checkout class="btn btn-green motion-safe:transition shadow-lg shadow-green/25">Join Now</a>
            <a href="#" data-book-call class="btn btn-bronze motion-safe:transition shadow-lg">Book a Call with Dani</a>
            <a href="#membership-inquiry" class="btn btn-outline motion-safe:transition">Membership inquiry</a>
          </div>
        </div>

        <div class="fly-in fly-from-right lg:col-span-5">
          <figure class="overflow-hidden rounded-2xl ring-1 ring-gunmetal/10 shadow-md">
            <div class="h-48 w-full overflow-hidden sm:h-52 lg:h-56">
              <img src="images/Violet%20Crowned%20Media_Deal%20Makers-65_websize.jpg" alt="The membership community in motion" class="h-full w-full object-cover object-center" width="1600" height="1067" loading="lazy" />
            </div>
            <figcaption class="border-t border-gunmetal/10 bg-white px-4 py-2.5 text-xs leading-snug text-gunmetal">Recurring rhythm in the room — relationships that compound over time.</figcaption>
          </figure>
          <div class="mt-3 grid grid-cols-2 gap-3">
            <figure class="overflow-hidden rounded-xl ring-1 ring-gunmetal/10">
              <div class="h-28 w-full overflow-hidden sm:h-32">
                <img src="images/Dealmakers_0057.jpg" alt="Panel discussion at a marquee event" class="h-full w-full object-cover object-[center_35%]" width="1920" height="1280" loading="lazy" />
              </div>
            </figure>
            <figure class="overflow-hidden rounded-xl ring-1 ring-gunmetal/10">
              <div class="h-28 w-full overflow-hidden sm:h-32">
                <img src="images/Dealmakers_0124.jpg" alt="Members connecting in the room" class="h-full w-full object-cover object-center" width="1920" height="1280" loading="lazy" />
              </div>
            </figure>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Business membership -->
  <section id="business-membership" class="relative border-t border-gunmetal/10 bg-white/60 py-14 md:py-20">
    <div class="pointer-events-none absolute right-0 top-0 h-64 w-64 translate-x-1/3 -translate-y-1/3 rounded-full bg-green/[0.06] blur-3xl" aria-hidden="true"></div>
    <div class="relative mx-auto max-w-7xl px-5 md:px-8">
      <div class="grid gap-10 lg:grid-cols-12 lg:items-center lg:gap-12">
        <div class="fly-in fly-from-left lg:col-span-5">
          <figure>
            <div class="img-frame img-frame--5-4 img-frame--lg ring-1 ring-gunmetal/10 shadow-md">
              <img src="images/DealMakersJuneMembersEvent_0027.jpg" alt="Business members connecting at a Dealmakers event" class="object-center" width="1920" height="1280" loading="lazy" />
            </div>
            <figcaption class="mt-3 rounded-2xl border border-gunmetal/10 bg-white px-4 py-2.5 text-xs leading-snug text-gunmetal">Team presence in the room — relationships that move deals forward.</figcaption>
          </figure>
        </div>
        <div class="lg:col-span-7">
          <p class="fly-in section-kicker text-green">Business membership</p>
          <h2 class="fly-in fly-stagger-1 section-title mt-3">Bring your company into the room.</h2>
          <p class="fly-in fly-stagger-2 mt-4 max-w-3xl text-gunmetal">Business Membership is for companies that want recurring team access, visible association with the ecosystem, and a structured way to stay close to operators, investors, and deal flow — without the full founding commitment.</p>
          <p class="fly-in fly-stagger-2 mt-3 max-w-3xl text-sm text-gunmetal">Everything in Annual Membership, extended to your team with company recognition and partnership pathways inside the Dealmakers rhythm.</p>
          <ul class="fly-in fly-stagger-3 mt-8 grid gap-2.5 sm:grid-cols-2">
            <li class="rounded-2xl border border-gunmetal/10 bg-white px-5 py-4 text-sm text-gunmetal">Named team seats in the ecosystem</li>
            <li class="rounded-2xl border border-gunmetal/10 bg-white px-5 py-4 text-sm text-gunmetal">Company recognition in the room</li>
            <li class="rounded-2xl border border-gunmetal/10 bg-white px-5 py-4 text-sm text-gunmetal">Recurring event access for key team members</li>
            <li class="rounded-2xl border border-gunmetal/10 bg-white px-5 py-4 text-sm text-gunmetal">Partnership pathways with the community</li>
            <li class="rounded-2xl border border-gunmetal/10 bg-white px-5 py-4 text-sm text-gunmetal sm:col-span-2">Curated introductions when fit is clear</li>
          </ul>
          <div class="fly-in mt-10 btn-row">
            <a href="#" data-book-call class="btn btn-bronze motion-safe:transition shadow-lg">Book a Call with Dani</a>
            <a href="#membership-inquiry" class="btn btn-green motion-safe:transition shadow-lg shadow-green/25">Business inquiry</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Founding membership -->
  <section id="founding-membership" class="relative border-t border-gunmetal/10 bg-carbon py-14 text-bone md:py-20 noise-carbon">
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_55%_45%_at_10%_0%,rgba(197,163,125,0.12),transparent)]" aria-hidden="true"></div>
    <div class="relative z-10 mx-auto max-w-7xl px-5 md:px-8">
      <div class="grid gap-10 lg:grid-cols-12 lg:items-center lg:gap-12">
        <div class="lg:col-span-7">
          <p class="fly-in section-kicker text-bronze">Founding membership</p>
          <h2 class="fly-in fly-stagger-1 section-title-light mt-3">Help build the market. Be known in the room.</h2>
          <p class="fly-in fly-stagger-2 mt-2 font-heading text-3xl font-semibold tracking-tight text-bronze md:text-4xl">$5,000<span class="text-base font-medium text-bone/60 md:text-lg"> / year</span></p>
          <p class="fly-in fly-stagger-2 mt-4 max-w-3xl text-bone/75">Founding Members are early builders shaping the Dealmakers ecosystem — a limited circle for people who want deeper proximity, stronger relationships, and a lasting role in the room itself.</p>
          <p class="fly-in fly-stagger-2 mt-3 max-w-3xl text-sm text-bone/55">Everything in Membership, plus founding recognition, retreat access, strategic touchpoints, and long-term ecosystem standing.</p>
          <ul class="fly-in fly-stagger-3 mt-8 grid gap-2.5 sm:grid-cols-2">
            <li class="rounded-2xl border border-white/10 bg-white/[0.05] px-5 py-4 text-sm text-bone/80">Founding Member recognition</li>
            <li class="rounded-2xl border border-white/10 bg-white/[0.05] px-5 py-4 text-sm text-bone/80">Founding Circle identity</li>
            <li class="rounded-2xl border border-white/10 bg-white/[0.05] px-5 py-4 text-sm text-bone/80">Annual Founding Retreat</li>
            <li class="rounded-2xl border border-white/10 bg-white/[0.05] px-5 py-4 text-sm text-bone/80">Strategic access</li>
            <li class="rounded-2xl border border-white/10 bg-white/[0.05] px-5 py-4 text-sm text-bone/80">Curated small-room experiences</li>
            <li class="rounded-2xl border border-white/10 bg-white/[0.05] px-5 py-4 text-sm text-bone/80">Market-builder designation</li>
          </ul>
          <div class="fly-in mt-10 btn-row">
            <a href="#" data-book-call class="btn btn-bronze motion-safe:transition shadow-lg">Book a Call with Dani</a>
            <a href="#membership-inquiry" class="btn btn-outline-dark motion-safe:transition">Founding inquiry</a>
          </div>
        </div>
        <div class="fly-in fly-from-right lg:col-span-5 lg:sticky lg:top-28">
          <figure>
            <div class="img-frame img-frame--5-4 img-frame--lg ring-1 ring-white/10 shadow-lg">
              <img src="images/DealmakersNovember_0003.jpg" alt="Founding members in an intimate Dealmakers gathering" class="object-[center_35%]" width="1920" height="1280" loading="lazy" />
            </div>
            <figcaption class="mt-3 rounded-2xl border border-white/10 bg-white/[0.05] px-4 py-2.5 text-xs leading-snug text-bone/60">The founding circle — deeper proximity, stronger relationships, lasting standing in the room.</figcaption>
          </figure>
        </div>
      </div>
    </div>
  </section>

  <!-- Corporate membership -->
  <section id="corporate-membership" class="border-t border-gunmetal/10 bg-white/50 py-14 md:py-20">
    <div class="mx-auto max-w-7xl px-5 md:px-8">
      <p class="fly-in section-kicker text-green">Corporate membership</p>
      <h2 class="fly-in fly-stagger-1 section-title mt-3">Partnership with the ecosystem</h2>
      <p class="fly-in fly-stagger-2 mt-4 max-w-3xl text-gunmetal">Corporate Membership is a partnership product — not sponsorship, not a seat package. It represents your company&apos;s level of association and integration with Dealmakers.</p>
      <p class="fly-in fly-stagger-2 mt-3 max-w-3xl text-sm text-gunmetal">We partner with a select group of companies seeking meaningful visibility and long-term association with operators, investors, and decision-makers — through events, experiences, and community touchpoints all year.</p>
      <div class="fly-in fly-stagger-3 mt-8 grid gap-4 lg:grid-cols-3">
        <article class="rounded-2xl bg-white p-5 ring-1 ring-gunmetal/10 shadow-sm md:p-6">
          <div class="flex items-center gap-3">
            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-green/10 text-green ring-1 ring-green/15"><i data-feather="users" class="h-5 w-5"></i></span>
            <p class="font-heading text-lg font-semibold text-carbon">Event Partner</p>
          </div>
          <p class="mt-3 text-sm text-gunmetal">Recurring access and relationship-building for key team members to join and be seen inside the ecosystem.</p>
          <a href="#membership-inquiry" class="motion-safe:transition mt-4 inline-flex items-center gap-2 text-sm font-semibold text-green hover:text-carbon">Inquire <i data-feather="arrow-right" class="h-4 w-4"></i></a>
        </article>
        <article class="rounded-2xl border-2 border-bronze/35 bg-bone p-5 shadow-sm md:p-6">
          <div class="flex items-center gap-3">
            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-bronze/15 text-bronze ring-1 ring-bronze/20"><i data-feather="briefcase" class="h-5 w-5"></i></span>
            <p class="font-heading text-lg font-semibold text-carbon">Future Partner</p>
          </div>
          <p class="mt-3 text-sm text-gunmetal">Stronger visibility, recurring integration, and long-term relationship development within the community.</p>
          <a href="#membership-inquiry" class="motion-safe:transition mt-4 inline-flex items-center gap-2 text-sm font-semibold text-green hover:text-carbon">Inquire <i data-feather="arrow-right" class="h-4 w-4"></i></a>
        </article>
        <article class="rounded-2xl bg-carbon p-5 text-bone ring-1 ring-gunmetal/20 md:p-6">
          <div class="flex items-center gap-3">
            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-bronze/20 text-bronze ring-1 ring-bronze/25"><i data-feather="globe" class="h-5 w-5"></i></span>
            <p class="font-heading text-lg font-semibold">Ecosystem Partner</p>
          </div>
          <p class="mt-3 text-sm text-bone/75">Deeper strategic presence and ongoing association with the Dealmakers brand and member ecosystem.</p>
          <a href="#membership-inquiry" class="motion-safe:transition mt-4 inline-flex items-center gap-2 text-sm font-semibold text-bronze hover:text-bone">Inquire <i data-feather="arrow-right" class="h-4 w-4"></i></a>
        </article>
      </div>
      <div class="fly-in mt-10 btn-row">
        <a href="#" data-book-call class="btn btn-bronze motion-safe:transition shadow-lg">Book a Call with Dani</a>
        <a href="#membership-inquiry" class="btn btn-green motion-safe:transition shadow-lg shadow-green/25">Corporate inquiry</a>
      </div>
    </div>
  </section>

  <section id="membership-inquiry" class="border-t border-gunmetal/10 bg-white/50 py-14 md:py-20">
    <div class="mx-auto max-w-4xl px-5 md:px-8">
      <p class="fly-in section-kicker text-green">Membership inquiry</p>
      <h2 class="fly-in fly-stagger-1 section-title mt-3">Tell us about you</h2>
      <p class="fly-in fly-stagger-2 mt-4 text-gunmetal">For Membership, Business Membership, Founding Membership, Team Membership, Strategic Partner, or Ecosystem Partner — tell us what you&apos;re building toward. We review every submission to keep the ecosystem relevant.</p>
      <div class="fly-in fly-stagger-3 zoho-form-embed-wrap mt-10 rounded-3xl bg-white/80 p-2 shadow-lg shadow-carbon/5 ring-1 ring-gunmetal/10 md:p-3">
        <iframe
          class="zoho-form-embed"
          data-zoho-form
          title="Membership Inquiry Form"
          aria-label="Membership Inquiry Form"
          src="https://forms.zohopublic.com/dealmakersllc1/form/MembershipInquiryForm/formperma/RpZ_jsKGUB8pLAfHX5HCcAjN932aduq6LnFcmR36OY4"
          scrolling="no"
        ></iframe>
      </div>
    </div>
  </section>
<?php require __DIR__ . '/includes/layout-end.php'; ?>
