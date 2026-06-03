/**
 * Normalize CTA buttons and image card frames across root HTML pages.
 * Run: node scripts/normalize-ui.js
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');
const files = fs.readdirSync(root).filter((f) => f.endsWith('.html'));

const buttonReplacements = [
  [
    /motion-safe:transition shrink-0 rounded-full bg-bronze px-5 py-2\.5 font-heading text-\[12px\] font-semibold uppercase tracking-\[0\.05em\] text-carbon shadow-md shadow-bronze\/20 hover:bg-bronze\/90 xl:px-6/g,
    'btn btn-sm btn-bronze motion-safe:transition shrink-0',
  ],
  [
    /mt-3 block rounded-full bg-bronze px-6 py-3\.5 text-center font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.05em\] text-carbon shadow-lg shadow-bronze\/25/g,
    'btn btn-bronze btn-block motion-safe:transition mt-3 shadow-lg shadow-bronze/25',
  ],
  [
    /motion-safe:transition inline-flex items-center gap-2 rounded-full bg-bronze px-8 py-4 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-carbon shadow-lg shadow-bronze\/25 hover:bg-bronze\/90/g,
    'btn btn-bronze motion-safe:transition shadow-lg shadow-bronze/25',
  ],
  [
    /motion-safe:transition inline-flex items-center gap-2 rounded-full bg-bronze px-8 py-4 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-carbon shadow-lg hover:bg-bronze\/90/g,
    'btn btn-bronze motion-safe:transition shadow-lg',
  ],
  [
    /motion-safe:transition inline-flex items-center gap-2 rounded-full bg-bronze px-8 py-4 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-carbon shadow-lg shadow-bronze\/20 hover:bg-bronze\/90/g,
    'btn btn-bronze motion-safe:transition shadow-lg shadow-bronze/20',
  ],
  [
    /motion-safe:transition inline-flex items-center gap-2 rounded-full bg-bronze px-7 py-3\.5 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-carbon shadow-lg shadow-bronze\/25 hover:bg-bronze\/90/g,
    'btn btn-bronze motion-safe:transition shadow-lg shadow-bronze/25',
  ],
  [
    /motion-safe:transition inline-flex items-center gap-2 rounded-full bg-bronze px-7 py-3\.5 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-carbon shadow-lg hover:bg-bronze\/90/g,
    'btn btn-bronze motion-safe:transition shadow-lg',
  ],
  [
    /motion-safe:transition group inline-flex items-center gap-2 rounded-full bg-green px-8 py-4 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-bone shadow-lg shadow-green\/25 hover:bg-green\/90/g,
    'btn btn-green motion-safe:transition group shadow-lg shadow-green/25',
  ],
  [
    /motion-safe:transition inline-flex items-center gap-2 rounded-full bg-green px-8 py-4 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-bone shadow-lg shadow-green\/25 hover:bg-green\/90/g,
    'btn btn-green motion-safe:transition shadow-lg shadow-green/25',
  ],
  [
    /motion-safe:transition inline-flex items-center gap-2 rounded-full bg-green px-7 py-3\.5 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-bone shadow-lg shadow-green\/25 hover:bg-green\/90/g,
    'btn btn-green motion-safe:transition shadow-lg shadow-green/25',
  ],
  [
    /motion-safe:transition inline-flex items-center gap-2 rounded-full border border-bone\/40 bg-bone\/10 px-8 py-4 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-bone backdrop-blur-sm hover:border-bronze hover:bg-bone\/15 hover:text-bronze/g,
    'btn btn-outline-light motion-safe:transition',
  ],
  [
    /motion-safe:transition inline-flex items-center gap-2 rounded-full border border-gunmetal\/20 bg-white\/80 px-6 py-2\.5 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.18em\] text-carbon shadow-sm backdrop-blur-sm hover:border-bronze hover:text-bronze/g,
    'btn btn-outline motion-safe:transition',
  ],
  [
    /motion-safe:transition inline-flex items-center gap-2 rounded-full border border-gunmetal\/25 bg-white\/80 px-6 py-3 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-carbon shadow-sm backdrop-blur-sm hover:border-bronze hover:text-bronze/g,
    'btn btn-outline motion-safe:transition',
  ],
  [
    /motion-safe:transition inline-flex items-center gap-2 rounded-full bg-green px-6 py-2\.5 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.18em\] text-bone shadow-md shadow-green\/20 hover:bg-green\/90/g,
    'btn btn-green motion-safe:transition shadow-md shadow-green/20',
  ],
  [
    /motion-safe:transition inline-flex items-center gap-2 rounded-full bg-green px-7 py-3\.5 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-bone shadow-lg shadow-green\/25 hover:bg-green\/90/g,
    'btn btn-green motion-safe:transition shadow-lg shadow-green/25',
  ],
  [
    /motion-safe:transition inline-flex items-center gap-2 rounded-full bg-green px-7 py-3\.5 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.18em\] text-bone shadow-lg shadow-green\/25 hover:bg-green\/90/g,
    'btn btn-green motion-safe:transition shadow-lg shadow-green/25',
  ],
  [
    /motion-safe:transition inline-flex items-center gap-2 rounded-full bg-green px-8 py-4 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.18em\] text-bone shadow-lg shadow-green\/25 hover:bg-green\/90/g,
    'btn btn-green motion-safe:transition shadow-lg shadow-green/25',
  ],
  [
    /inline-flex items-center gap-2 rounded-full bg-green px-7 py-3\.5 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-bone shadow-lg shadow-green\/25 hover:bg-green\/90 motion-safe:transition/g,
    'btn btn-green motion-safe:transition shadow-lg shadow-green/25',
  ],
  [
    /inline-flex items-center gap-2 rounded-full bg-bronze px-7 py-3\.5 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-carbon shadow-lg shadow-bronze\/25 hover:bg-bronze\/90 motion-safe:transition/g,
    'btn btn-bronze motion-safe:transition shadow-lg shadow-bronze/25',
  ],
  [
    /inline-flex items-center gap-2 rounded-full border border-gunmetal\/25 px-7 py-3\.5 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] hover:border-green hover:text-green motion-safe:transition/g,
    'btn btn-outline motion-safe:transition',
  ],
  [
    /inline-flex items-center gap-2 rounded-full bg-bronze px-7 py-3\.5 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-carbon shadow-md hover:bg-bronze\/90 motion-safe:transition/g,
    'btn btn-bronze motion-safe:transition shadow-md',
  ],
  [
    /motion-safe:transition mt-8 inline-flex w-fit items-center gap-2 rounded-full bg-bronze px-8 py-4 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-carbon shadow-lg shadow-bronze\/20 hover:bg-bronze\/90/g,
    'btn btn-bronze motion-safe:transition mt-8 shadow-lg shadow-bronze/20',
  ],
  [
    /motion-safe:transition mt-10 inline-flex w-full items-center justify-center rounded-full border border-gunmetal\/20 py-3\.5 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.18em\] text-carbon hover:border-bronze hover:text-bronze/g,
    'btn btn-outline btn-block motion-safe:transition mt-10',
  ],
  [
    /motion-safe:transition mt-10 inline-flex w-full items-center justify-center rounded-full bg-green py-3\.5 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.18em\] text-bone shadow-md shadow-green\/25 hover:bg-green\/90/g,
    'btn btn-green btn-block motion-safe:transition mt-10 shadow-md shadow-green/25',
  ],
  [
    /motion-safe:transition mt-10 inline-flex w-full items-center justify-center rounded-full bg-bronze py-3\.5 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.18em\] text-carbon hover:bg-bronze\/90/g,
    'btn btn-bronze btn-block motion-safe:transition mt-10',
  ],
  [
    /motion-safe:transition inline-flex items-center gap-2 rounded-full border border-bone\/35 bg-bone\/5 px-7 py-3\.5 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-bone hover:border-bronze hover:text-bronze/g,
    'btn btn-outline-dark motion-safe:transition',
  ],
  [
    /motion-safe:transition inline-flex items-center gap-2 rounded-full border border-bone\/35 px-8 py-4 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-bone hover:border-bronze hover:text-bronze/g,
    'btn btn-outline-dark motion-safe:transition',
  ],
  [
    /motion-safe:transition inline-flex items-center gap-2 rounded-full border border-gunmetal\/25 bg-white\/80 px-8 py-4 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-carbon hover:border-green hover:text-green/g,
    'btn btn-outline motion-safe:transition',
  ],
  [
    /motion-safe:transition inline-flex items-center gap-2 rounded-full border border-gunmetal\/25 bg-white\/80 px-7 py-3\.5 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-carbon shadow-sm backdrop-blur-sm hover:border-bronze hover:text-bronze/g,
    'btn btn-outline motion-safe:transition',
  ],
  [
    /fly-in motion-safe:transition mt-10 inline-flex items-center gap-2 rounded-full border border-gunmetal\/25 bg-white\/80 px-8 py-4 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-carbon shadow-sm backdrop-blur-sm hover:border-green hover:text-green/g,
    'btn btn-outline motion-safe:transition fly-in mt-10',
  ],
  [
    /motion-safe:transition inline-flex items-center gap-2 rounded-full bg-green px-8 py-4 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-bone shadow-lg shadow-green\/20 hover:bg-green\/90/g,
    'btn btn-green motion-safe:transition shadow-lg shadow-green/20',
  ],
  [
    /inline-flex items-center gap-2 rounded-full border border-gunmetal\/20 px-7 py-3\.5 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] hover:border-green hover:text-green motion-safe:transition/g,
    'btn btn-outline motion-safe:transition',
  ],
  [
    /fly-in fly-from-right motion-safe:transition inline-flex shrink-0 items-center gap-2 rounded-full border border-gunmetal\/25 bg-white\/80 px-6 py-3 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-carbon shadow-sm backdrop-blur-sm hover:border-bronze hover:text-bronze/g,
    'btn btn-outline motion-safe:transition fly-in fly-from-right shrink-0',
  ],
  [
    /motion-safe:transition inline-flex items-center gap-2 rounded-full bg-green px-7 py-3\.5 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-bone shadow-lg shadow-green\/25 hover:bg-green\/90/g,
    'btn btn-green motion-safe:transition shadow-lg shadow-green/25',
  ],
  [
    /motion-safe:transition inline-flex items-center gap-2 rounded-full bg-green px-7 py-3\.5 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.18em\] text-bone shadow-lg shadow-green\/25 hover:bg-green\/90/g,
    'btn btn-green motion-safe:transition shadow-lg shadow-green/25',
  ],
  [
    /motion-safe:transition inline-flex items-center gap-2 rounded-full bg-green px-7 py-3\.5 font-heading text-\[11px\] font-semibold uppercase tracking-\[0\.2em\] text-bone shadow-lg shadow-green\/25 hover:bg-green\/90">Apply to speak/g,
    'btn btn-green motion-safe:transition shadow-lg shadow-green/25">Apply to speak',
  ],
];

const rowReplacements = [
  ['reveal reveal-delay-3 mt-6 flex flex-wrap items-center gap-4 md:mt-7', 'reveal reveal-delay-3 btn-row mt-6 md:mt-7'],
  ['mt-8 flex flex-wrap gap-4', 'mt-8 btn-row'],
  ['mt-10 flex flex-wrap justify-center gap-4', 'mt-10 btn-row justify-center'],
  ['mt-14 flex flex-wrap justify-center gap-4', 'mt-14 btn-row justify-center'],
  ['fly-in fly-stagger-3 mt-7 flex flex-wrap justify-center gap-3', 'fly-in fly-stagger-3 btn-row mt-7 justify-center'],
  ['mt-8 flex flex-wrap gap-3', 'mt-8 btn-row'],
  ['mt-10 flex flex-wrap gap-4', 'mt-10 btn-row'],
  ['mt-6 flex flex-wrap gap-3', 'btn-row mt-6'],
  ['mt-10 flex flex-wrap gap-3', 'btn-row mt-10'],
  ['flex flex-wrap gap-3', 'btn-row'],
];

const imageReplacements = [
  [
    /<div class="relative aspect-\[16\/10\] overflow-hidden rounded-3xl shadow-lg shadow-carbon\/10 ring-1 ring-gunmetal\/10">\s*<img([^>]*?)class="absolute inset-0 h-full w-full object-cover object-center"/g,
    '<div class="img-frame-fill img-frame--16-10 img-frame--lg"><img$1class="',
  ],
  [
    /<div class="overflow-hidden rounded-2xl ring-1 ring-gunmetal\/10 shadow-md">\s*<img([^>]*?)class="aspect-\[4\/3\] w-full object-cover/g,
    '<div class="img-frame img-frame--4-3"><img$1class="',
  ],
  [
    /<div class="overflow-hidden rounded-2xl shadow-md ring-1 ring-gunmetal\/10 md:rounded-3xl">\s*<img([^>]*?)class="aspect-\[4\/3\] w-full object-cover/g,
    '<div class="img-frame img-frame--4-3 md:rounded-3xl"><img$1class="',
  ],
  [
    /<div class="col-span-2 overflow-hidden rounded-2xl ring-1 ring-gunmetal\/10 shadow-md md:col-span-1">\s*<img([^>]*?)class="aspect-\[4\/3\] w-full object-cover/g,
    '<div class="img-frame img-frame--4-3 col-span-2 md:col-span-1"><img$1class="',
  ],
  [
    /<div class="col-span-2 overflow-hidden rounded-2xl ring-1 ring-gunmetal\/10 shadow-md md:col-span-2 md:rounded-3xl">\s*<img([^>]*?)class="aspect-\[4\/3\] w-full object-cover/g,
    '<div class="img-frame img-frame--4-3 col-span-2 md:col-span-2 md:rounded-3xl"><img$1class="',
  ],
  [
    /class="aspect-\[4\/3\] w-full object-cover/g,
    'class="',
  ],
  [
    /class="aspect-\[16\/9\] w-full object-cover/g,
    'class="',
  ],
  [
    /class="aspect-\[16\/11\] w-full object-cover/g,
    'class="',
  ],
  [
    /<div class="overflow-hidden rounded-2xl ring-1 ring-gunmetal\/10 shadow-md md:rounded-3xl">\s*<img/g,
    '<div class="img-frame img-frame--4-3 md:rounded-3xl"><img',
  ],
  [
    /<div class="fly-in overflow-hidden rounded-3xl ring-1 ring-white\/10">\s*<img/g,
    '<div class="fly-in img-frame img-frame--16-11 img-frame--lg ring-white/10"><img',
  ],
  [
    /<div class="overflow-hidden rounded-3xl ring-1 ring-gunmetal\/10 shadow-xl">\s*<img/g,
    '<div class="img-frame img-frame--5-4 img-frame--lg shadow-xl"><img',
  ],
  [
    /<div class="fly-in fly-stagger-3 mt-12 overflow-hidden rounded-3xl ring-1 ring-gunmetal\/10">\s*<img/g,
    '<div class="fly-in fly-stagger-3 mt-12 img-frame img-frame--16-9 img-frame--lg"><img',
  ],
  [
    /<div class="relative min-h-\[220px\] lg:min-h-0">\s*<img([^>]*?)class="absolute inset-0 h-full w-full object-cover ([^"]*)"/g,
    '<div class="img-frame-fill img-frame--16-10 min-h-[220px] lg:min-h-[280px]"><img$1class="$2"',
  ],
  [
    /<div class="aspect-\[16\/9\] overflow-hidden">\s*<img([^>]*?)class="h-full w-full object-cover ([^"]*)"/g,
    '<div class="img-frame-fill img-frame--16-9"><img$1class="$2"',
  ],
];

files.forEach((file) => {
  const fp = path.join(root, file);
  let html = fs.readFileSync(fp, 'utf8');
  let changed = false;

  buttonReplacements.forEach(([re, replacement]) => {
    if (re.test(html)) {
      html = html.replace(re, replacement);
      changed = true;
    }
  });

  rowReplacements.forEach(([from, to]) => {
    if (html.includes(from)) {
      html = html.split(from).join(to);
      changed = true;
    }
  });

  imageReplacements.forEach(([re, replacement]) => {
    const next = html.replace(re, replacement);
    if (next !== html) {
      html = next;
      changed = true;
    }
  });

  if (changed) {
    fs.writeFileSync(fp, html);
    console.log('Normalized', file);
  }
});
