/**
 * One-off patch: reorder header nav + restore About dropdown.
 * Run: node scripts/patch-header-nav.js
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');
const files = fs.readdirSync(root).filter((f) => f.endsWith('.html'));

const desktopNav = `      <nav class="hidden items-center gap-1 xl:gap-1.5 2xl:gap-2 lg:flex" aria-label="Primary">
        <a class="motion-safe:transition inline-flex items-center gap-1.5 rounded-lg px-1 py-1.5 text-[15px] font-semibold tracking-tight text-bone/80 hover:bg-bone/10 hover:text-bone xl:text-base" href="index.html#hero" data-active-when="index">
          <i data-feather="home" class="h-[18px] w-[18px] shrink-0 text-bronze xl:h-5 xl:w-5"></i>
          Home
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-1.5 rounded-lg px-1 py-1.5 text-[15px] font-semibold tracking-tight text-bone/80 hover:bg-bone/10 hover:text-bone xl:text-base" href="membership.html" data-active-when="membership">
          <i data-feather="credit-card" class="h-[18px] w-[18px] shrink-0 text-bronze xl:h-5 xl:w-5"></i>
          Membership
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-1.5 rounded-lg px-1 py-1.5 text-[15px] font-semibold tracking-tight text-bone/80 hover:bg-bone/10 hover:text-bone xl:text-base" href="sponsorship.html" data-active-when="sponsorship">
          <i data-feather="award" class="h-[18px] w-[18px] shrink-0 text-bronze xl:h-5 xl:w-5"></i>
          Sponsorship
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-1.5 rounded-lg px-1 py-1.5 text-[15px] font-semibold tracking-tight text-bone/80 hover:bg-bone/10 hover:text-bone xl:text-base" href="events.html" data-active-when="events">
          <i data-feather="calendar" class="h-[18px] w-[18px] shrink-0 text-bronze xl:h-5 xl:w-5"></i>
          Events
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-1.5 rounded-lg px-1 py-1.5 text-[15px] font-semibold tracking-tight text-bone/80 hover:bg-bone/10 hover:text-bone xl:text-base" href="apply.html" data-active-when="apply">
          <i data-feather="mic" class="h-[18px] w-[18px] shrink-0 text-bronze xl:h-5 xl:w-5"></i>
          Apply
        </a>
        <div class="group/nav-abt relative">
          <a href="about.html" class="motion-safe:transition inline-flex items-center gap-1.5 rounded-lg px-1 py-1.5 text-[15px] font-semibold tracking-tight text-bone/80 hover:bg-bone/10 hover:text-bone xl:text-base" data-active-when="about launch-a-city framework access how-it-works the-room">
            <i data-feather="info" class="h-[18px] w-[18px] shrink-0 text-bronze xl:h-5 xl:w-5"></i>
            <span class="inline-flex items-center gap-0.5">
              About
              <i data-feather="chevron-down" class="pointer-events-none h-4 w-4 opacity-55" aria-hidden="true"></i>
            </span>
          </a>
          <div class="pointer-events-none invisible absolute left-0 top-full z-[60] pt-2 opacity-0 transition duration-150 group-hover/nav-abt:pointer-events-auto group-hover/nav-abt:visible group-hover/nav-abt:opacity-100 group-focus-within/nav-abt:pointer-events-auto group-focus-within/nav-abt:visible group-focus-within/nav-abt:opacity-100" role="group" aria-label="About submenu">
            <div class="pointer-events-auto min-w-[13.5rem] rounded-xl border border-bone/15 bg-carbon py-2 shadow-xl shadow-carbon/10 ring-1 ring-gunmetal/10 backdrop-blur-md">
              <a href="launch-a-city.html" class="motion-safe:transition flex items-center gap-2.5 px-3 py-2.5 text-[14px] font-semibold tracking-tight text-bone/80 hover:bg-bone/10 hover:text-bone xl:text-[15px]" data-active-when="launch-a-city">
                <i data-feather="map" class="h-[17px] w-[17px] shrink-0 text-bronze"></i>
                Launch a city
              </a>
              <a href="framework.html" class="motion-safe:transition flex items-center gap-2.5 border-t border-bone/15 px-3 py-2.5 text-[14px] font-semibold tracking-tight text-bone/80 hover:bg-bone/10 hover:text-bone xl:text-[15px]" data-active-when="framework">
                <i data-feather="book-open" class="h-[17px] w-[17px] shrink-0 text-bronze"></i>
                Framework
              </a>
              <a href="access.html" class="motion-safe:transition flex items-center gap-2.5 border-t border-bone/15 px-3 py-2.5 text-[14px] font-semibold tracking-tight text-bone/80 hover:bg-bone/10 hover:text-bone xl:text-[15px]" data-active-when="access">
                <i data-feather="key" class="h-[17px] w-[17px] shrink-0 text-bronze"></i>
                Access
              </a>
              <a href="how-it-works.html" class="motion-safe:transition flex items-center gap-2.5 border-t border-bone/15 px-3 py-2.5 text-[14px] font-semibold tracking-tight text-bone/80 hover:bg-bone/10 hover:text-bone xl:text-[15px]" data-active-when="how-it-works">
                <i data-feather="git-branch" class="h-[17px] w-[17px] shrink-0 text-bronze"></i>
                How it works
              </a>
              <a href="the-room.html" class="motion-safe:transition flex items-center gap-2.5 border-t border-bone/15 px-3 py-2.5 text-[14px] font-semibold tracking-tight text-bone/80 hover:bg-bone/10 hover:text-bone xl:text-[15px]" data-active-when="the-room">
                <i data-feather="layers" class="h-[17px] w-[17px] shrink-0 text-bronze"></i>
                The room
              </a>
            </div>
          </div>
        </div>
        <a class="motion-safe:transition shrink-0 rounded-full bg-bronze px-5 py-2.5 font-heading text-[12px] font-semibold uppercase tracking-[0.05em] text-carbon shadow-md shadow-bronze/20 hover:bg-bronze/90 xl:px-6" href="#" data-book-call>Book a Call</a>
      </nav>`;

const mobileNav = `    <div id="mobile-nav" class="hidden border-t border-bone/15 bg-green px-5 py-4 lg:hidden">
      <div class="flex flex-col gap-0.5">
        <a class="motion-safe:transition inline-flex items-center gap-2.5 py-2.5 text-[17px] font-semibold tracking-tight text-bone/80 hover:text-bone" href="index.html#hero" data-active-when="index">
          <i data-feather="home" class="h-6 w-6 shrink-0 text-bronze"></i>
          Home
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-2.5 py-2.5 text-[17px] font-semibold tracking-tight text-bone/80 hover:text-bone" href="membership.html" data-active-when="membership">
          <i data-feather="credit-card" class="h-6 w-6 shrink-0 text-bronze"></i>
          Membership
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-2.5 py-2.5 text-[17px] font-semibold tracking-tight text-bone/80 hover:text-bone" href="sponsorship.html" data-active-when="sponsorship">
          <i data-feather="award" class="h-6 w-6 shrink-0 text-bronze"></i>
          Sponsorship
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-2.5 py-2.5 text-[17px] font-semibold tracking-tight text-bone/80 hover:text-bone" href="events.html" data-active-when="events">
          <i data-feather="calendar" class="h-6 w-6 shrink-0 text-bronze"></i>
          Events
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-2.5 py-2.5 text-[17px] font-semibold tracking-tight text-bone/80 hover:text-bone" href="apply.html" data-active-when="apply">
          <i data-feather="mic" class="h-6 w-6 shrink-0 text-bronze"></i>
          Apply
        </a>
        <p class="pt-2 text-[11px] font-semibold uppercase tracking-[0.2em] text-bone/50">About</p>
        <a class="motion-safe:transition inline-flex items-center gap-3 border-l-2 border-bone/25 py-2 pl-3 text-[16px] font-semibold tracking-tight text-bone/80 hover:text-bone" href="about.html" data-active-when="about">
          <i data-feather="info" class="h-5 w-5 shrink-0 text-bronze"></i>
          About overview
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-3 border-l-2 border-bone/25 py-2 pl-3 text-[16px] font-semibold tracking-tight text-bone/80 hover:text-bone" href="launch-a-city.html" data-active-when="launch-a-city">
          <i data-feather="map" class="h-5 w-5 shrink-0 text-bronze"></i>
          Launch a city
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-3 border-l-2 border-bone/25 py-2 pl-3 text-[16px] font-semibold tracking-tight text-bone/80 hover:text-bone" href="framework.html" data-active-when="framework">
          <i data-feather="book-open" class="h-5 w-5 shrink-0 text-bronze"></i>
          Framework
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-3 border-l-2 border-bone/25 py-2 pl-3 text-[16px] font-semibold tracking-tight text-bone/80 hover:text-bone" href="access.html" data-active-when="access">
          <i data-feather="key" class="h-5 w-5 shrink-0 text-bronze"></i>
          Access
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-3 border-l-2 border-bone/25 py-2 pl-3 text-[16px] font-semibold tracking-tight text-bone/80 hover:text-bone" href="how-it-works.html" data-active-when="how-it-works">
          <i data-feather="git-branch" class="h-5 w-5 shrink-0 text-bronze"></i>
          How it works
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-3 border-l-2 border-bone/25 py-2 pl-3 text-[16px] font-semibold tracking-tight text-bone/80 hover:text-bone" href="the-room.html" data-active-when="the-room">
          <i data-feather="layers" class="h-5 w-5 shrink-0 text-bronze"></i>
          The room
        </a>
        <a class="mt-3 block rounded-full bg-bronze px-6 py-3.5 text-center font-heading text-[11px] font-semibold uppercase tracking-[0.05em] text-carbon shadow-lg shadow-bronze/25" href="#" data-book-call>Book a Call</a>
        <a href="access.html#request-access" class="mt-2 block text-center text-[13px] font-semibold text-bone/70 hover:text-bone motion-safe:transition">Request access</a>
      </div>
    </div>`;

const desktopRe = /      <nav class="hidden items-center gap-1[\s\S]*?      <\/nav>/;
const mobileRe = /    <div id="mobile-nav" class="hidden[\s\S]*?    <\/div>\n  <\/header>/;

files.forEach((file) => {
  const fp = path.join(root, file);
  let html = fs.readFileSync(fp, 'utf8');
  if (!desktopRe.test(html)) {
    console.warn('Skip desktop nav:', file);
    return;
  }
  html = html.replace(desktopRe, desktopNav);
  html = html.replace(mobileRe, mobileNav + '\n  </header>');
  fs.writeFileSync(fp, html);
  console.log('Patched', file);
});
