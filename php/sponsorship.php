<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/bootstrap.php';

$pageTitle = 'Partnership | Dealmakers';
$pageSlug = 'sponsorship';
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
    .tier-ring {
      background: linear-gradient(135deg, rgba(197, 163, 125, 0.35), rgba(31, 61, 43, 0.45));
      padding: 1px;
      border-radius: 1.5rem;
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
      .sponsorship-tier-card {
        transition: transform 0.25s cubic-bezier(0.22, 1, 0.36, 1), box-shadow 0.25s ease;
      }
      .sponsorship-tier-card:hover {
        transform: translateY(-4px);
      }
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

      if (typeof feather !== 'undefined') {
        feather.replace();
      }
    })();
JS;
require __DIR__ . '/includes/layout-start.php';
?>
<!-- Hero -->
  <section class="page-hero page-hero--light">
    <div class="page-hero__bg" aria-hidden="true">
      <img src="images/Violet%20Crowned%20Media_Deal%20Makers-58_websize.jpg" alt="" class="object-center" width="1600" height="1067" loading="eager" />
      <div class="page-hero__scrim"></div>
      <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_80%_50%_at_100%_0%,rgba(31,61,43,0.09),transparent),radial-gradient(ellipse_50%_40%_at_0%_100%,rgba(197,163,125,0.12),transparent)]"></div>
    </div>
    <div class="page-hero__content relative z-10 mx-auto w-full max-w-7xl px-5 pb-10 pt-24 md:px-8 md:pb-12 md:pt-28">
      <div class="max-w-3xl">
        <nav class="text-[11px] font-medium uppercase tracking-[0.22em] text-gunmetal/80" aria-label="Breadcrumb">
          <a href="/#hero" class="hover:text-bronze motion-safe:transition">Home</a>
          <span class="mx-2 text-gunmetal/40">/</span>
          <span class="text-carbon">Partnership</span>
        </nav>
        <div class="fly-in mt-8 flex flex-wrap items-center gap-2">
          <span class="inline-flex items-center gap-2 rounded-full border border-green/25 bg-green/[0.07] px-3 py-1.5 font-heading text-[10px] font-semibold uppercase tracking-[0.2em] text-green">Featured session</span>
          <span class="inline-flex items-center gap-1.5 rounded-full border border-gunmetal/15 bg-white/70 px-3 py-1.5 text-[11px] font-medium text-gunmetal backdrop-blur-sm">
            <i data-feather="map-pin" class="h-3.5 w-3.5 text-bronze"></i>
            Austin · East End Ballroom
          </span>
          <span class="inline-flex items-center gap-1.5 rounded-full border border-gunmetal/15 bg-white/70 px-3 py-1.5 text-[11px] font-medium text-gunmetal backdrop-blur-sm">
            <i data-feather="calendar" class="h-3.5 w-3.5 text-bronze"></i>
            Friday, April 10
          </span>
        </div>
        <h1 class="fly-in fly-stagger-1 mt-4 max-w-3xl font-heading text-3xl font-semibold leading-tight tracking-tight text-carbon md:text-[2.65rem]">Dealmakers <span class="text-green">Partnership</span> Overview</h1>
        <p class="fly-in fly-stagger-2 mt-6 max-w-2xl text-base leading-relaxed text-gunmetal md:text-lg">Be in the room where capital, operators, and deal flow actually meet — with visibility that compounds month over month.</p>
        <div class="fly-in fly-stagger-3 btn-row mt-10">
          <a href="#packages" class="btn btn-green motion-safe:transition shadow-lg shadow-green/25">View packages</a>
          <a href="#process" class="btn btn-outline motion-safe:transition">How it works</a>
        </div>
      </div>
    </div>
  </section>

  <!-- Introduction -->
  <section id="overview" class="relative border-y border-gunmetal/10 bg-carbon text-bone noise-carbon">
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_60%_55%_at_15%_20%,rgba(197,163,125,0.12),transparent)]" aria-hidden="true"></div>
    <div class="relative z-10 mx-auto max-w-7xl px-5 py-20 md:px-8 md:py-28">
      <div class="grid gap-12 lg:grid-cols-[1fr_1.15fr] lg:gap-16 lg:items-center">
        <div class="fly-in img-frame img-frame--16-11 img-frame--xl img-frame--lg ring-white/10"><img src="images/Dealmakers_0057.jpg" alt="Expert panel conversation at Dealmakers" class="object-[center_35%] opacity-95" width="1920" height="1280" loading="lazy" />
        </div>
        <div class="fly-in fly-from-right">
          <p class="section-kicker text-bronze">Introduction</p>
          <h2 class="mt-4 font-heading text-2xl font-semibold leading-tight tracking-tight md:text-4xl md:leading-[1.1]">&ldquo;A room full of your best prospects&rdquo;</h2>
          <p class="mt-6 text-base leading-relaxed text-bone/75 md:text-lg">Dealmakers is built for sponsors who want <em class="text-bone not-italic font-medium">real access</em> — not booths collecting business cards. It is networking and sponsorship designed to connect businesses and professionals with high-value prospects across real estate, capital, and the investment ecosystem.</p>
          <div class="mt-8 flex gap-6 border-t border-white/10 pt-8">
            <div>
              <p class="font-heading text-2xl font-semibold text-bronze md:text-3xl">CEO</p>
              <p class="mt-1 text-xs uppercase tracking-wider text-bone/45">Community · Expertise · Opportunities</p>
            </div>
            <div class="h-14 w-px bg-white/10" aria-hidden="true"></div>
            <div>
              <p class="font-heading text-lg font-semibold text-bone">High-signal</p>
              <p class="mt-1 text-sm text-bone/55">Relationships that move paperwork, not just LinkedIn invites.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Audience -->
  <section id="audience" class="relative bg-bone py-14 md:py-20">
    <div class="mx-auto max-w-7xl px-5 md:px-8">
      <div class="grid gap-12 lg:grid-cols-2 lg:gap-16 lg:items-start">
        <div class="fly-in">
          <p class="section-kicker text-green">Target audience</p>
          <h2 class="mt-4 section-title">&ldquo;These are your people&rdquo;</h2>
          <p class="mt-5 max-w-lg text-gunmetal">Attendees are curated for signal: people who can source, underwrite, fund, or execute — and who show up to do business, not to be pitched at.</p>
          <ul class="mt-10 space-y-4">
            <li class="flex gap-4 rounded-2xl border border-gunmetal/10 bg-white/60 p-4 shadow-sm backdrop-blur-sm">
              <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-green/10 text-green"><i data-feather="home" class="h-5 w-5"></i></span>
              <div><p class="font-medium text-carbon">Active builders &amp; developers</p><p class="mt-0.5 text-sm text-gunmetal">Ground-up and value-add teams looking for partners and paper.</p></div>
            </li>
            <li class="flex gap-4 rounded-2xl border border-gunmetal/10 bg-white/60 p-4 shadow-sm backdrop-blur-sm">
              <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-green/10 text-green"><i data-feather="trending-up" class="h-5 w-5"></i></span>
              <div><p class="font-medium text-carbon">Private investors &amp; capital partners</p><p class="mt-0.5 text-sm text-gunmetal">Allocators who want dealflow that cleared the room first.</p></div>
            </li>
            <li class="flex gap-4 rounded-2xl border border-gunmetal/10 bg-white/60 p-4 shadow-sm backdrop-blur-sm">
              <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-green/10 text-green"><i data-feather="shield" class="h-5 w-5"></i></span>
              <div><p class="font-medium text-carbon">Lenders &amp; private credit</p><p class="mt-0.5 text-sm text-gunmetal">Structured capital for projects that already passed peer scrutiny.</p></div>
            </li>
            <li class="flex gap-4 rounded-2xl border border-gunmetal/10 bg-white/60 p-4 shadow-sm backdrop-blur-sm">
              <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-green/10 text-green"><i data-feather="tool" class="h-5 w-5"></i></span>
              <div><p class="font-medium text-carbon">Deal-focused service providers</p><p class="mt-0.5 text-sm text-gunmetal">Trusted operators whose work touches closings.</p></div>
            </li>
            <li class="flex gap-4 rounded-2xl border border-gunmetal/10 bg-white/60 p-4 shadow-sm backdrop-blur-sm">
              <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-bronze/15 text-green"><i data-feather="award" class="h-5 w-5"></i></span>
              <div><p class="font-medium text-carbon">Local market leaders</p><p class="mt-0.5 text-sm text-gunmetal">Faces the room recognizes — and listens to.</p></div>
            </li>
          </ul>
        </div>
        <div class="fly-in fly-from-right">
          <div class="sticky top-28 space-y-5">
            <div class="img-frame img-frame--4-3 img-frame--xl img-frame--lg shadow-xl"><img src="images/DealmakersNovember_0003.jpg" alt="Curated attendees connecting at Dealmakers" class="object-center" width="1920" height="1280" loading="lazy" />
            </div>
            <div class="rounded-3xl bg-green p-6 text-bone shadow-lg shadow-green/30 md:p-8">
              <p class="font-heading section-kicker text-bronze">Selection</p>
              <p class="mt-3 text-lg font-medium leading-relaxed text-bone/95">Relationships are deliberate here: attendees are chosen so conversations default to relevance, reciprocity, and real deal-making.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Format -->
  <section id="format" class="border-t border-gunmetal/10 bg-white/40 py-14 md:py-20">
    <div class="mx-auto max-w-7xl px-5 md:px-8">
      <div class="mx-auto max-w-3xl text-center">
        <p class="fly-in section-kicker text-bronze">Event structure</p>
        <h2 class="fly-in fly-stagger-1 mt-3 section-title">&ldquo;What actually happens in the room&rdquo;</h2>
        <p class="fly-in fly-stagger-2 mt-5 text-gunmetal">The format is tight and intentional — built for genuine interaction instead of a tradeshow floor.</p>
      </div>
      <div class="fly-in fly-stagger-3 mt-14 grid gap-6 md:grid-cols-5 md:gap-4">
        <div class="group relative overflow-hidden rounded-2xl bg-bone p-5 ring-1 ring-gunmetal/10 md:col-span-1 md:row-span-2 md:flex md:flex-col md:justify-end">
          <img src="images/Violet%20Crowned%20Media_Deal%20Makers-58_websize.jpg" alt="Open networking on arrival" class="absolute inset-0 h-full w-full object-cover object-center opacity-25 motion-safe:transition motion-safe:duration-500 group-hover:scale-105 group-hover:opacity-30" width="1600" height="1067" loading="lazy" />
          <div class="relative">
            <i data-feather="log-in" class="h-6 w-6 text-green"></i>
            <p class="mt-3 font-heading text-sm font-semibold text-carbon">Arrival</p>
            <p class="mt-1 text-xs leading-relaxed text-gunmetal">Open networking while the room finds its pace.</p>
          </div>
        </div>
        <div class="rounded-2xl bg-green/10 p-5 ring-1 ring-green/20 md:col-span-2">
          <i data-feather="zap" class="h-6 w-6 text-green"></i>
          <p class="mt-3 font-heading text-sm font-semibold text-carbon">Community spotlight</p>
          <p class="mt-1 text-sm text-gunmetal">Highlight the people and projects shaping the market.</p>
        </div>
        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gunmetal/10 md:col-span-2">
          <i data-feather="message-circle" class="h-6 w-6 text-bronze"></i>
          <p class="mt-3 font-heading text-sm font-semibold text-carbon">Expert panel</p>
          <p class="mt-1 text-sm text-gunmetal">Judgment-heavy conversation — not talking heads.</p>
        </div>
        <div class="rounded-2xl bg-white p-5 shadow-sm ring-1 ring-gunmetal/10 md:col-span-2">
          <i data-feather="briefcase" class="h-6 w-6 text-bronze"></i>
          <p class="mt-3 font-heading text-sm font-semibold text-carbon">Live deal presentations</p>
          <p class="mt-1 text-sm text-gunmetal">Real opportunities, unpacked in front of aligned capital.</p>
        </div>
        <div class="tier-ring md:col-span-2">
          <div class="h-full rounded-[calc(1.5rem-1px)] bg-bone p-5 md:p-6">
            <i data-feather="coffee" class="h-6 w-6 text-green"></i>
            <p class="mt-3 font-heading text-sm font-semibold text-carbon">Closing &amp; networking</p>
            <p class="mt-1 text-sm text-gunmetal">Where the best conversations spill past the programmed hour.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Packages -->
  <section id="packages" class="relative bg-bone py-14 md:py-20">
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_60%_50%_at_50%_0%,rgba(197,163,125,0.08),transparent)]" aria-hidden="true"></div>
    <div class="relative mx-auto max-w-7xl px-5 md:px-8">
      <div class="fly-in max-w-2xl">
        <p class="section-kicker text-green">Partnership packages</p>
        <h2 class="mt-3 section-title">Annual partnership tiers</h2>
        <p class="mt-4 text-gunmetal">Year-round visibility, recognition, and association with the Dealmakers community throughout the year.</p>
      </div>
      <div class="mt-12 grid gap-6 pt-4 lg:mt-16 lg:grid-cols-3 lg:items-stretch lg:gap-5 lg:pt-6 xl:gap-6">
        <article class="sponsorship-tier-card fly-in fly-stagger-1 flex flex-col rounded-3xl bg-green p-6 text-bone shadow-xl shadow-green/30 ring-1 ring-bone/15 md:p-7">
          <div class="flex items-start justify-between gap-3">
            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-bone/15 text-bronze ring-1 ring-bone/20"><i data-feather="calendar" class="h-5 w-5"></i></span>
            <span class="rounded-full bg-bone/10 px-3 py-1 text-[10px] font-semibold uppercase tracking-[0.16em] text-bronze">Tier 1</span>
          </div>
          <h3 class="mt-5 font-heading text-xl font-semibold text-bone">Event Partner</h3>
          <p class="mt-2 text-sm font-medium leading-snug text-bone/75">Be Present Where Relationships Are Built</p>
          <p class="mt-5 font-heading text-3xl font-semibold tracking-tight text-bronze">$10,000 <span class="text-sm font-medium text-bone/60">annually</span></p>
          <p class="mt-5 flex-1 text-sm leading-relaxed text-bone/80">Event Partners receive visibility across all four annual Dealmakers marquee events and become associated with the conversations, relationships, and opportunities created inside the community throughout the year.</p>
          <p class="mt-6 border-t border-bone/15 pt-6 section-kicker text-bronze">Includes</p>
          <ul class="mt-3 space-y-2.5">
            <li class="flex gap-2.5 text-sm text-bone/85"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-bronze"></i> Presence at all four annual marquee events.</li>
            <li class="flex gap-2.5 text-sm text-bone/85"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-bronze"></i> Recognition as an Event Partner.</li>
            <li class="flex gap-2.5 text-sm text-bone/85"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-bronze"></i> Brand visibility across event communications.</li>
            <li class="flex gap-2.5 text-sm text-bone/85"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-bronze"></i> Visibility on event materials and event signage.</li>
            <li class="flex gap-2.5 text-sm text-bone/85"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-bronze"></i> Attendance and participation opportunities.</li>
          </ul>
          <a href="#sponsorship-inquiry" class="btn btn-bronze btn-block motion-safe:transition mt-6 shadow-lg shadow-bronze/20">Inquire</a>
        </article>
        <article class="sponsorship-tier-card fly-in fly-stagger-2 flex flex-col rounded-3xl bg-bronze p-6 text-carbon shadow-xl shadow-bronze/25 ring-1 ring-carbon/10 md:p-7">
          <div class="flex items-start justify-between gap-3">
            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-carbon/10 text-carbon ring-1 ring-carbon/15"><i data-feather="star" class="h-5 w-5"></i></span>
            <span class="rounded-full bg-carbon/10 px-3 py-1 text-[10px] font-semibold uppercase tracking-[0.16em] text-carbon">Tier 2</span>
          </div>
          <h3 class="mt-5 font-heading text-xl font-semibold text-carbon">Featured Partner</h3>
          <p class="mt-2 text-sm font-medium leading-snug text-carbon/80">Become Known by the Community</p>
          <p class="mt-5 font-heading text-3xl font-semibold tracking-tight text-carbon">$15,000 <span class="text-sm font-medium text-carbon/70">annually</span></p>
          <p class="mt-5 flex-1 text-sm leading-relaxed text-carbon/85">Featured Partners receive recurring visibility across both marquee events and member experiences. This partnership is designed for businesses that want to move beyond simple exposure and become recognized, trusted, and remembered by the people inside the Dealmakers community.</p>
          <p class="mt-6 border-t border-carbon/15 pt-6 section-kicker text-carbon">Includes</p>
          <ul class="mt-3 space-y-2.5">
            <li class="flex gap-2.5 text-sm text-carbon/90"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-green"></i> Everything included in Event Partnership.</li>
            <li class="flex gap-2.5 text-sm text-carbon/90"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-green"></i> Featured recognition during marquee events.</li>
            <li class="flex gap-2.5 text-sm text-carbon/90"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-green"></i> Recognition in event communications.</li>
            <li class="flex gap-2.5 text-sm text-carbon/90"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-green"></i> Attendance at member dinners and select member experiences.</li>
            <li class="flex gap-2.5 text-sm text-carbon/90"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-green"></i> In-person recognition at community gatherings where appropriate.</li>
            <li class="flex gap-2.5 text-sm text-carbon/90"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-green"></i> Additional visibility throughout the year across Dealmakers communication channels.</li>
          </ul>
          <a href="#sponsorship-inquiry" class="btn btn-green btn-block motion-safe:transition mt-6 shadow-lg shadow-green/30">Inquire</a>
        </article>
        <article class="sponsorship-tier-card fly-in fly-stagger-3 flex flex-col rounded-3xl bg-carbon p-6 text-bone shadow-2xl shadow-carbon/40 ring-1 ring-bronze/25 md:p-7">
          <div class="flex items-start justify-between gap-3">
            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-bronze/20 text-bronze ring-1 ring-bronze/35"><i data-feather="globe" class="h-5 w-5"></i></span>
            <span class="rounded-full bg-bronze/15 px-3 py-1 text-[10px] font-semibold uppercase tracking-[0.16em] text-bronze">Premier</span>
          </div>
          <h3 class="mt-5 font-heading text-xl font-semibold text-bone">Ecosystem Partner</h3>
          <p class="mt-2 text-sm font-medium leading-snug text-bone/70">Align Your Brand with the Community</p>
          <p class="mt-5 font-heading text-3xl font-semibold tracking-tight text-bronze">$25,000 <span class="text-sm font-medium text-bone/55">annually</span></p>
          <p class="mt-5 flex-1 text-sm leading-relaxed text-bone/75">Ecosystem Partner is the premier annual partnership tier. This relationship is designed for organizations whose audience closely aligns with the Dealmakers audience and who want to be consistently present and featured alongside Dealmakers wherever the community gathers.</p>
          <p class="text-sm leading-relaxed text-bone/70">Ecosystem Partners become deeply associated with the relationships, experiences, and opportunities that define the Dealmakers brand.</p>
          <p class="mt-6 border-t border-bronze/25 pt-6 section-kicker text-bronze">Includes</p>
          <ul class="mt-3 space-y-2.5">
            <li class="flex gap-2.5 text-sm text-bone/75"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-bronze"></i> Everything included in Featured Partnership.</li>
            <li class="flex gap-2.5 text-sm text-bone/75"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-bronze"></i> Premier visibility across all marquee events.</li>
            <li class="flex gap-2.5 text-sm text-bone/75"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-bronze"></i> Premier visibility across member experiences.</li>
            <li class="flex gap-2.5 text-sm text-bone/75"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-bronze"></i> Priority recognition in communications.</li>
            <li class="flex gap-2.5 text-sm text-bone/75"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-bronze"></i> Featured positioning at community gatherings.</li>
            <li class="flex gap-2.5 text-sm text-bone/75"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-bronze"></i> Priority consideration for collaborative activations.</li>
            <li class="flex gap-2.5 text-sm text-bone/75"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-bronze"></i> Custom partnership opportunities where appropriate.</li>
            <li class="flex gap-2.5 text-sm text-bone/75"><i data-feather="check" class="mt-0.5 h-4 w-4 shrink-0 text-bronze"></i> Association with the Dealmakers community throughout the year.</li>
          </ul>
          <a href="#sponsorship-inquiry" class="btn btn-bronze btn-block motion-safe:transition mt-6 shadow-lg shadow-bronze/25">Inquire</a>
        </article>
      </div>
      <div class="fly-in mt-12 btn-row justify-center">
        <a href="#" data-book-call class="btn btn-bronze motion-safe:transition shadow-lg">Book a Call with Dani</a>
        <a href="#sponsorship-inquiry" class="btn btn-green motion-safe:transition shadow-lg shadow-green/25">Sponsorship inquiry</a>
      </div>
    </div>
  </section>

  <!-- Long-term value -->
  <section id="compound" class="border-t border-gunmetal/10 bg-bone py-14 md:py-20">
    <div class="mx-auto max-w-7xl px-5 md:px-8">
      <div class="grid gap-12 lg:grid-cols-2 lg:gap-20 lg:items-center">
        <div class="fly-in relative order-2 lg:order-1">
          <div class="img-frame img-frame--5-4 img-frame--xl img-frame--lg shadow-xl"><img src="images/Violet%20Crowned%20Media_Deal%20Makers-26_websize.jpg" alt="Sponsor visibility beside real operator conversations" class="object-[65%_center]" width="1600" height="1067" loading="lazy" />
          </div>
          <div class="absolute -bottom-6 -right-4 max-w-[14rem] rounded-2xl border border-gunmetal/10 bg-white/95 p-4 text-sm shadow-lg backdrop-blur-md md:-right-8 md:p-5">
            <p class="font-medium text-carbon">Show up again</p>
            <p class="mt-1 text-xs leading-relaxed text-gunmetal">Familiarity is a moat in this room — trust accrues when people see you next to good judgment, repeatedly.</p>
          </div>
        </div>
        <div class="fly-in fly-from-right order-1 lg:order-2">
          <p class="section-kicker text-green">Long-term value</p>
          <h2 class="mt-4 section-title">&ldquo;This works best because it repeats&rdquo;</h2>
          <p class="mt-5 text-gunmetal">The model rewards consistency. One-off impressions struggle here; sponsors who return become part of the fabric of the room.</p>
          <ul class="mt-10 space-y-5">
            <li class="flex gap-4">
              <span class="mt-1 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-green/10 text-xs font-bold text-green">1</span>
              <div><p class="font-medium text-carbon">Familiar faces beat one-time logos</p><p class="mt-1 text-sm text-gunmetal">You are recognized as a participant in the room — not a pop-up brand.</p></div>
            </li>
            <li class="flex gap-4">
              <span class="mt-1 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-green/10 text-xs font-bold text-green">2</span>
              <div><p class="font-medium text-carbon">Trust compounds with presence</p><p class="mt-1 text-sm text-gunmetal">Credibility shows up the same way deals do: across multiple touchpoints.</p></div>
            </li>
            <li class="flex gap-4">
              <span class="mt-1 flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-green/10 text-xs font-bold text-green">3</span>
              <div><p class="font-medium text-carbon">Consecutive months win</p><p class="mt-1 text-sm text-gunmetal">Best outcomes cluster around sponsors who plan for a rhythm, not a single night.</p></div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Metrics -->
  <section id="metrics" class="relative overflow-hidden bg-carbon py-20 text-bone md:py-28 noise-carbon">
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_50%_40%_at_70%_0%,rgba(31,61,43,0.45),transparent),radial-gradient(ellipse_40%_50%_at_0%_100%,rgba(197,163,125,0.1),transparent)]" aria-hidden="true"></div>
    <div class="relative z-10 mx-auto max-w-7xl px-5 md:px-8">
      <div class="mx-auto max-w-2xl text-center">
        <p class="fly-in section-kicker text-bronze">Performance &amp; influence</p>
        <h2 class="fly-in fly-stagger-1 mt-3 font-heading text-2xl font-semibold md:text-4xl">&ldquo;Influence compounds faster than promotion&rdquo;</h2>
        <p class="fly-in fly-stagger-2 mt-4 text-sm text-bone/65 md:text-base">Compared to scattered advertising, anchored, in-person repetition builds recognition that actually transfers to trust.</p>
      </div>
      <div class="fly-in fly-stagger-3 mt-14 grid gap-5 sm:grid-cols-2 lg:grid-cols-12">
        <div class="rounded-3xl border border-white/10 bg-white/[0.04] p-8 backdrop-blur-sm lg:col-span-5">
          <p class="font-heading text-5xl font-semibold tracking-tight text-bronze md:text-6xl">5–7×</p>
          <p class="mt-3 text-sm leading-relaxed text-bone/70">Trust multiplier from repeated in-person exposure versus one-off ads — because people buy who they remember in context.</p>
        </div>
        <div class="grid gap-5 sm:col-span-2 sm:grid-cols-2 lg:col-span-7">
          <div class="rounded-3xl border border-white/10 bg-white/[0.04] p-6 backdrop-blur-sm">
            <p class="font-heading text-4xl font-semibold text-bone">25</p>
            <p class="mt-1 text-[11px] font-semibold uppercase tracking-wider text-bone/45">minutes</p>
            <p class="mt-3 text-sm text-bone/65">Expert panel discussions sized for substance — not sound bites.</p>
          </div>
          <div class="rounded-3xl border border-white/10 bg-white/[0.04] p-6 backdrop-blur-sm">
            <p class="font-heading text-4xl font-semibold text-bone">&lt;5</p>
            <p class="mt-1 text-[11px] font-semibold uppercase tracking-wider text-bone/45">seats on stage</p>
            <p class="mt-3 text-sm text-bone/65">Kept scarce so every voice carries weight.</p>
          </div>
          <div class="rounded-3xl border border-white/10 bg-white/[0.04] p-6 backdrop-blur-sm">
            <p class="font-heading text-4xl font-semibold text-bone">80%</p>
            <p class="mt-1 text-[11px] font-semibold uppercase tracking-wider text-bone/45">of attendees</p>
            <p class="mt-3 text-sm text-bone/65">Actively seeking deal flow <em class="text-bone/80 not-italic">or</em> capital partnerships.</p>
          </div>
          <div class="rounded-3xl border border-white/10 bg-white/[0.04] p-6 backdrop-blur-sm">
            <p class="font-heading text-4xl font-semibold text-bone">75+</p>
            <p class="mt-1 text-[11px] font-semibold uppercase tracking-wider text-bone/45">in the room</p>
            <p class="mt-3 text-sm text-bone/65">Attendance that fills the ballroom without diluting the signal.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Process -->
  <section id="process" class="relative bg-bone py-14 md:py-20">
    <div class="mx-auto max-w-7xl px-5 md:px-8">
      <div class="grid gap-12 lg:grid-cols-12 lg:gap-10">
        <div class="fly-in lg:col-span-5">
          <p class="section-kicker text-green">Sponsorship process</p>
          <h2 class="mt-4 section-title">&ldquo;How sponsorship works&rdquo;</h2>
          <p class="mt-5 text-gunmetal">Designed to stay simple while protecting the chemistry of the room — limited participation, anchored in conversations and referrals.</p>
          <div class="mt-10 space-y-4">
            <div class="flex gap-4 rounded-2xl border border-gunmetal/10 bg-white p-5 shadow-sm">
              <span class="font-heading text-2xl font-semibold text-bronze">01</span>
              <div><p class="font-medium text-carbon">Pick your tier</p><p class="mt-1 text-sm text-gunmetal">Exhibitor, panelist, or featured — weighted to how you want to lead the narrative.</p></div>
            </div>
            <div class="flex gap-4 rounded-2xl border border-gunmetal/10 bg-white p-5 shadow-sm">
              <span class="font-heading text-2xl font-semibold text-bronze">02</span>
              <div><p class="font-medium text-carbon">Secure your month</p><p class="mt-1 text-sm text-gunmetal">Monthly rhythm; sponsors often stack consecutive months.</p></div>
            </div>
            <div class="flex gap-4 rounded-2xl border border-gunmetal/10 bg-white p-5 shadow-sm">
              <span class="font-heading text-2xl font-semibold text-bronze">03</span>
              <div><p class="font-medium text-carbon">Show up recognizable</p><p class="mt-1 text-sm text-gunmetal">We handle logistics, visibility, recognition, and in-room placement.</p></div>
            </div>
          </div>
          <div class="mt-8 rounded-2xl bg-green/[0.08] p-5 ring-1 ring-green/15">
            <p class="text-sm leading-relaxed text-gunmetal"><span class="font-medium text-green">Availabilities are conversational.</span> Sponsorship opens by referral and direct conversation — if you belong in this room, we will find the right tier together.</p>
          </div>
        </div>
        <div class="fly-in fly-from-right lg:col-span-7">
          <div class="relative overflow-hidden rounded-3xl ring-1 ring-gunmetal/10">
            <div class="img-frame-fill img-frame--16-10 img-frame--xl">
              <img src="images/Violet%20Crowned%20Media_Deal%20Makers-65_websize.jpg" alt="Dealmakers evening event — sponsors in the room" class="object-center" width="1600" height="1067" loading="lazy" />
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-carbon/80 via-transparent to-transparent" aria-hidden="true"></div>
            <div class="absolute bottom-0 left-0 right-0 p-6 md:p-10">
              <p class="font-heading section-kicker text-bronze">Current terms</p>
              <ul class="mt-4 grid gap-3 text-sm text-bone/85 sm:grid-cols-2">
                <li class="rounded-xl bg-white/10 px-4 py-3 backdrop-blur-md">Flexible month-to-month when space permits</li>
                <li class="rounded-xl bg-white/10 px-4 py-3 backdrop-blur-md">Limited sponsor slots each market cycle</li>
                <li class="rounded-xl bg-white/10 px-4 py-3 backdrop-blur-md">Scoped to your annual partnership tier</li>
                <li class="rounded-xl bg-white/10 px-4 py-3 backdrop-blur-md">Investment discussed conversationally</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Summary strip -->
  <section class="border-t border-gunmetal/10 bg-white/60 py-16 md:py-20">
    <div class="mx-auto max-w-4xl px-5 text-center md:px-8">
      <p class="fly-in section-kicker text-green">Overview</p>
      <p class="fly-in fly-stagger-1 mt-6 text-xl font-medium leading-relaxed text-carbon md:text-2xl md:leading-snug">
        Premium, relationship-centric rooms for sponsors who allocate to <span class="text-green">credibility</span>, not impressions — stacking trust and deal flow through curated, recurring in-person presence.
      </p>
      <div class="fly-in fly-stagger-2 mt-12 btn-row justify-center">
        <a href="#" data-book-call class="btn btn-bronze motion-safe:transition shadow-lg shadow-bronze/25">
          Book a Call with Dani
          <i data-feather="arrow-right" class="h-4 w-4"></i>
        </a>
        <a href="#sponsorship-inquiry" class="btn btn-green motion-safe:transition shadow-lg shadow-green/25">
          Sponsorship inquiry
        </a>
      </div>
    </div>
  </section>

  <section id="sponsorship-inquiry" class="border-t border-gunmetal/10 bg-bone py-14 md:py-20">
    <div class="mx-auto max-w-4xl px-5 md:px-8">
      <p class="fly-in section-kicker text-green">Sponsorship interest</p>
      <h2 class="fly-in fly-stagger-1 mt-4 section-title">Start the conversation</h2>
      <p class="fly-in fly-stagger-2 mt-4 text-gunmetal">For Event Partner, Featured Partner, or Ecosystem Partner — share your company, market, and goals. We&apos;ll align on scope together.</p>
      <div class="fly-in fly-stagger-3 zoho-form-embed-wrap mt-10 rounded-3xl bg-white/80 p-2 shadow-lg shadow-carbon/5 ring-1 ring-gunmetal/10 md:p-3">
        <iframe
          class="zoho-form-embed"
          data-zoho-form
          title="Sponsorship Interest Form"
          aria-label="Sponsorship Interest Form"
          src="https://forms.zohopublic.com/dealmakersllc1/form/SponsorshipInterestForm/formperma/uOTtg-6ftxEwF-X5eanhjpAk9AyLuyax38aXRYxCJVo"
          scrolling="no"
        ></iframe>
      </div>
    </div>
  </section>
<?php require __DIR__ . '/includes/layout-end.php'; ?>
