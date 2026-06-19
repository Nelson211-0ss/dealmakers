<!-- Header -->
  <header class="sticky top-0 z-50 border-b border-bone/10 bg-green backdrop-blur-xl">
    <div class="mx-auto flex min-h-[4.5rem] max-w-7xl items-center justify-between gap-3 px-5 py-2 md:min-h-[4.75rem] md:gap-4 md:px-8 md:py-2.5">
      <a href="/#hero" class="motion-safe:transition group flex shrink-0 items-center hover:opacity-90" aria-label="Dealmakers home">
        <picture>
          <source srcset="images/logo/dealmakers-logo.avif" type="image/avif" />
          <img src="images/logo/dealmakers-logo.png" alt="Dealmakers" width="320" height="54" class="site-logo object-contain site-logo--header" />
        </picture>
      </a>
      <nav class="hidden items-center gap-1 xl:gap-1.5 2xl:gap-2 lg:flex" aria-label="Primary">
        <a class="motion-safe:transition inline-flex items-center gap-1.5 rounded-lg px-1 py-1.5 text-[15px] font-semibold tracking-tight text-bone/80 hover:bg-bone/10 hover:text-bone xl:text-base" href="/#hero" data-active-when="index">
          <i data-feather="home" class="h-[18px] w-[18px] shrink-0 text-bronze xl:h-5 xl:w-5"></i>
          Home
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-1.5 rounded-lg px-1 py-1.5 text-[15px] font-semibold tracking-tight text-bone/80 hover:bg-bone/10 hover:text-bone xl:text-base" href="/membership" data-active-when="membership">
          <i data-feather="credit-card" class="h-[18px] w-[18px] shrink-0 text-bronze xl:h-5 xl:w-5"></i>
          Membership
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-1.5 rounded-lg px-1 py-1.5 text-[15px] font-semibold tracking-tight text-bone/80 hover:bg-bone/10 hover:text-bone xl:text-base" href="/sponsorship" data-active-when="sponsorship">
          <i data-feather="award" class="h-[18px] w-[18px] shrink-0 text-bronze xl:h-5 xl:w-5"></i>
          Partnership
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-1.5 rounded-lg px-1 py-1.5 text-[15px] font-semibold tracking-tight text-bone/80 hover:bg-bone/10 hover:text-bone xl:text-base" href="/events" data-active-when="events">
          <i data-feather="calendar" class="h-[18px] w-[18px] shrink-0 text-bronze xl:h-5 xl:w-5"></i>
          Events
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-1.5 rounded-lg px-1 py-1.5 text-[15px] font-semibold tracking-tight text-bone/80 hover:bg-bone/10 hover:text-bone xl:text-base" href="/apply" data-active-when="apply">
          <i data-feather="mic" class="h-[18px] w-[18px] shrink-0 text-bronze xl:h-5 xl:w-5"></i>
          Apply
        </a>
        <div class="group/nav-abt relative">
          <a href="/about" class="motion-safe:transition inline-flex items-center gap-1.5 rounded-lg px-1 py-1.5 text-[15px] font-semibold tracking-tight text-bone/80 hover:bg-bone/10 hover:text-bone xl:text-base" data-active-when="about launch-a-city framework access how-it-works the-room">
            <i data-feather="info" class="h-[18px] w-[18px] shrink-0 text-bronze xl:h-5 xl:w-5"></i>
            <span class="inline-flex items-center gap-0.5">
              About
              <i data-feather="chevron-down" class="pointer-events-none h-4 w-4 opacity-55" aria-hidden="true"></i>
            </span>
          </a>
          <div class="pointer-events-none invisible absolute left-0 top-full z-[60] pt-2 opacity-0 transition duration-150 group-hover/nav-abt:pointer-events-auto group-hover/nav-abt:visible group-hover/nav-abt:opacity-100 group-focus-within/nav-abt:pointer-events-auto group-focus-within/nav-abt:visible group-focus-within/nav-abt:opacity-100" role="group" aria-label="About submenu">
            <div class="pointer-events-auto min-w-[13.5rem] rounded-xl border border-bone/15 bg-carbon py-2 shadow-xl shadow-carbon/10 ring-1 ring-gunmetal/10 backdrop-blur-md">
              <a href="/launch-a-city" class="motion-safe:transition flex items-center gap-2.5 px-3 py-2.5 text-[14px] font-semibold tracking-tight text-bone/80 hover:bg-bone/10 hover:text-bone xl:text-[15px]" data-active-when="launch-a-city">
                <i data-feather="map" class="h-[17px] w-[17px] shrink-0 text-bronze"></i>
                Launch a city
              </a>
              <a href="/framework" class="motion-safe:transition flex items-center gap-2.5 border-t border-bone/15 px-3 py-2.5 text-[14px] font-semibold tracking-tight text-bone/80 hover:bg-bone/10 hover:text-bone xl:text-[15px]" data-active-when="framework">
                <i data-feather="book-open" class="h-[17px] w-[17px] shrink-0 text-bronze"></i>
                Framework
              </a>
              <a href="/access" class="motion-safe:transition flex items-center gap-2.5 border-t border-bone/15 px-3 py-2.5 text-[14px] font-semibold tracking-tight text-bone/80 hover:bg-bone/10 hover:text-bone xl:text-[15px]" data-active-when="access">
                <i data-feather="key" class="h-[17px] w-[17px] shrink-0 text-bronze"></i>
                Access
              </a>
              <a href="/how-it-works" class="motion-safe:transition flex items-center gap-2.5 border-t border-bone/15 px-3 py-2.5 text-[14px] font-semibold tracking-tight text-bone/80 hover:bg-bone/10 hover:text-bone xl:text-[15px]" data-active-when="how-it-works">
                <i data-feather="git-branch" class="h-[17px] w-[17px] shrink-0 text-bronze"></i>
                How it works
              </a>
              <a href="/the-room" class="motion-safe:transition flex items-center gap-2.5 border-t border-bone/15 px-3 py-2.5 text-[14px] font-semibold tracking-tight text-bone/80 hover:bg-bone/10 hover:text-bone xl:text-[15px]" data-active-when="the-room">
                <i data-feather="layers" class="h-[17px] w-[17px] shrink-0 text-bronze"></i>
                The room
              </a>
            </div>
          </div>
        </div>
        <a class="btn btn-sm btn-bronze motion-safe:transition shrink-0" href="#" data-book-call>Book a Call</a>
      </nav>
      <button type="button" id="menu-toggle" class="motion-safe:transition inline-flex items-center gap-2 rounded-lg px-2 py-2 text-[15px] font-semibold text-bone hover:bg-bone/10 lg:hidden" aria-expanded="false" aria-controls="mobile-nav">
        <i data-feather="menu" class="h-6 w-6 shrink-0 text-bronze"></i>
        Menu
      </button>
    </div>
    <div id="mobile-nav" class="hidden border-t border-bone/15 bg-green px-5 py-4 lg:hidden">
      <div class="flex flex-col gap-0.5">
        <a class="motion-safe:transition inline-flex items-center gap-2.5 py-2.5 text-[17px] font-semibold tracking-tight text-bone/80 hover:text-bone" href="/#hero" data-active-when="index">
          <i data-feather="home" class="h-6 w-6 shrink-0 text-bronze"></i>
          Home
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-2.5 py-2.5 text-[17px] font-semibold tracking-tight text-bone/80 hover:text-bone" href="/membership" data-active-when="membership">
          <i data-feather="credit-card" class="h-6 w-6 shrink-0 text-bronze"></i>
          Membership
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-2.5 py-2.5 text-[17px] font-semibold tracking-tight text-bone/80 hover:text-bone" href="/sponsorship" data-active-when="sponsorship">
          <i data-feather="award" class="h-6 w-6 shrink-0 text-bronze"></i>
          Partnership
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-2.5 py-2.5 text-[17px] font-semibold tracking-tight text-bone/80 hover:text-bone" href="/events" data-active-when="events">
          <i data-feather="calendar" class="h-6 w-6 shrink-0 text-bronze"></i>
          Events
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-2.5 py-2.5 text-[17px] font-semibold tracking-tight text-bone/80 hover:text-bone" href="/apply" data-active-when="apply">
          <i data-feather="mic" class="h-6 w-6 shrink-0 text-bronze"></i>
          Apply
        </a>
        <p class="pt-2 section-kicker text-bone/50">About</p>
        <a class="motion-safe:transition inline-flex items-center gap-3 border-l-2 border-bone/25 py-2 pl-3 text-[16px] font-semibold tracking-tight text-bone/80 hover:text-bone" href="/about" data-active-when="about">
          <i data-feather="info" class="h-5 w-5 shrink-0 text-bronze"></i>
          About overview
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-3 border-l-2 border-bone/25 py-2 pl-3 text-[16px] font-semibold tracking-tight text-bone/80 hover:text-bone" href="/launch-a-city" data-active-when="launch-a-city">
          <i data-feather="map" class="h-5 w-5 shrink-0 text-bronze"></i>
          Launch a city
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-3 border-l-2 border-bone/25 py-2 pl-3 text-[16px] font-semibold tracking-tight text-bone/80 hover:text-bone" href="/framework" data-active-when="framework">
          <i data-feather="book-open" class="h-5 w-5 shrink-0 text-bronze"></i>
          Framework
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-3 border-l-2 border-bone/25 py-2 pl-3 text-[16px] font-semibold tracking-tight text-bone/80 hover:text-bone" href="/access" data-active-when="access">
          <i data-feather="key" class="h-5 w-5 shrink-0 text-bronze"></i>
          Access
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-3 border-l-2 border-bone/25 py-2 pl-3 text-[16px] font-semibold tracking-tight text-bone/80 hover:text-bone" href="/how-it-works" data-active-when="how-it-works">
          <i data-feather="git-branch" class="h-5 w-5 shrink-0 text-bronze"></i>
          How it works
        </a>
        <a class="motion-safe:transition inline-flex items-center gap-3 border-l-2 border-bone/25 py-2 pl-3 text-[16px] font-semibold tracking-tight text-bone/80 hover:text-bone" href="/the-room" data-active-when="the-room">
          <i data-feather="layers" class="h-5 w-5 shrink-0 text-bronze"></i>
          The room
        </a>
        <a class="btn btn-bronze btn-block motion-safe:transition mt-3 shadow-lg shadow-bronze/25" href="#" data-book-call>Book a Call</a>
        <a href="/access#request-access" class="mt-2 block text-center text-[13px] font-semibold text-bone/70 hover:text-bone motion-safe:transition">Request access</a>
      </div>
    </div>
  </header>
