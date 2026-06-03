/**
 * Add background images to subpage hero sections.
 * Run: node scripts/patch-page-heroes.js
 */
const fs = require('fs');
const path = require('path');

const root = path.join(__dirname, '..');

const carbonHeroOld =
  `  <section class="relative overflow-hidden bg-carbon text-bone noise-carbon">
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_55%_45%_at_20%_0%,rgba(197,163,125,0.14),transparent)]" aria-hidden="true"></div>
    <div class="relative z-10 mx-auto max-w-7xl px-5 pb-16 pt-28 md:px-8 md:pb-20 md:pt-32">`;

function carbonHero(img, objectPos = 'object-center') {
  return `  <section class="page-hero">
    <div class="page-hero__bg" aria-hidden="true">
      <img src="${img}" alt="" class="${objectPos} opacity-45" width="1600" height="1067" loading="eager" fetchpriority="high" />
      <div class="page-hero__scrim"></div>
      <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_55%_45%_at_20%_0%,rgba(197,163,125,0.14),transparent)]"></div>
    </div>
    <div class="relative z-10 mx-auto max-w-7xl px-5 pb-16 pt-28 md:px-8 md:pb-20 md:pt-32">`;
}

const pages = {
  'membership.html': {
    img: 'images/Dealmakers_0057.jpg',
    pos: 'object-[center_35%]',
    w: 1920,
    h: 1280,
  },
  'events.html': {
    img: 'images/Dealmakers_0040.jpg',
    pos: 'object-[center_40%]',
    w: 1920,
    h: 1280,
  },
  'apply.html': {
    img: 'images/Dealmakers_0125.jpg',
    pos: 'object-[center_45%]',
    w: 1920,
    h: 1280,
  },
  'about.html': {
    img: 'images/Violet%20Crowned%20Media_Deal%20Makers-58_websize.jpg',
    pos: 'object-center',
  },
  'how-it-works.html': {
    img: 'images/Violet%20Crowned%20Media_Deal%20Makers-26_websize.jpg',
    pos: 'object-[65%_center]',
  },
  'the-room.html': {
    img: 'images/Violet%20Crowned%20Media_Deal%20Makers-65_websize.jpg',
    pos: 'object-center',
  },
  'launch-a-city.html': {
    img: 'images/DealmakersNovember_0003.jpg',
    pos: 'object-center',
    w: 1920,
    h: 1280,
  },
  'contact.html': {
    img: 'images/Violet%20Crowned%20Media_Deal%20Makers-4_websize.jpg',
    pos: 'object-center',
  },
};

Object.entries(pages).forEach(([file, cfg]) => {
  const fp = path.join(root, file);
  if (!fs.existsSync(fp)) return;
  let html = fs.readFileSync(fp, 'utf8');
  if (!html.includes(carbonHeroOld)) {
    console.warn('Skip (already patched or layout differs):', file);
    return;
  }
  const w = cfg.w || 1600;
  const h = cfg.h || 1067;
  const replacement = `  <section class="page-hero">
    <div class="page-hero__bg" aria-hidden="true">
      <img src="${cfg.img}" alt="" class="${cfg.pos} opacity-45" width="${w}" height="${h}" loading="eager" fetchpriority="high" />
      <div class="page-hero__scrim"></div>
      <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_55%_45%_at_20%_0%,rgba(197,163,125,0.14),transparent)]"></div>
    </div>
    <div class="relative z-10 mx-auto max-w-7xl px-5 pb-16 pt-28 md:px-8 md:pb-20 md:pt-32">`;
  html = html.replace(carbonHeroOld, replacement);
  fs.writeFileSync(fp, html);
  console.log('Patched hero:', file);
});

// Framework — light hero
const frameworkOld = `  <section class="relative overflow-hidden bg-bone pb-14 pt-12 md:pb-20 md:pt-16">
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_65%_50%_at_90%_-10%,rgba(197,163,125,0.14),transparent)]" aria-hidden="true"></div>
    <div class="relative mx-auto grid max-w-7xl gap-12 px-5 md:grid-cols-2 md:gap-14 md:px-8 lg:items-center">`;
const frameworkNew = `  <section class="page-hero page-hero--light pb-14 pt-12 md:pb-20 md:pt-16">
    <div class="page-hero__bg" aria-hidden="true">
      <img src="images/Dealmakers_0040.jpg" alt="" class="object-[center_40%] opacity-35" width="1920" height="1280" loading="eager" />
      <div class="page-hero__scrim"></div>
      <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_65%_50%_at_90%_-10%,rgba(197,163,125,0.14),transparent)]"></div>
    </div>
    <div class="relative z-10 mx-auto grid max-w-7xl gap-12 px-5 md:grid-cols-2 md:gap-14 md:px-8 lg:items-center">`;

const frameworkPath = path.join(root, 'framework.html');
if (fs.existsSync(frameworkPath)) {
  let html = fs.readFileSync(frameworkPath, 'utf8');
  if (html.includes(frameworkOld)) {
    html = html.replace(frameworkOld, frameworkNew);
    fs.writeFileSync(frameworkPath, html);
    console.log('Patched hero: framework.html');
  }
}

// Sponsorship — light hero at start
const sponsorshipOld = `  <!-- Hero -->
  <section class="relative overflow-hidden bg-bone">
    <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_80%_50%_at_100%_0%,rgba(31,61,43,0.09),transparent),radial-gradient(ellipse_50%_40%_at_0%_100%,rgba(197,163,125,0.12),transparent)]" aria-hidden="true"></div>
    <div class="relative mx-auto grid max-w-7xl gap-10 px-5 pb-16 pt-12 md:grid-cols-2 md:items-start md:gap-14 md:px-8 md:pb-24 md:pt-16 lg:gap-20">`;
const sponsorshipNew = `  <!-- Hero -->
  <section class="page-hero page-hero--light">
    <div class="page-hero__bg" aria-hidden="true">
      <img src="images/Violet%20Crowned%20Media_Deal%20Makers-58_websize.jpg" alt="" class="object-center opacity-30" width="1600" height="1067" loading="eager" />
      <div class="page-hero__scrim"></div>
      <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(ellipse_80%_50%_at_100%_0%,rgba(31,61,43,0.09),transparent),radial-gradient(ellipse_50%_40%_at_0%_100%,rgba(197,163,125,0.12),transparent)]"></div>
    </div>
    <div class="relative z-10 mx-auto grid max-w-7xl gap-10 px-5 pb-16 pt-12 md:grid-cols-2 md:items-start md:gap-14 md:px-8 md:pb-24 md:pt-16 lg:gap-20">`;

const sponsorshipPath = path.join(root, 'sponsorship.html');
if (fs.existsSync(sponsorshipPath)) {
  let html = fs.readFileSync(sponsorshipPath, 'utf8');
  if (html.includes(sponsorshipOld)) {
    html = html.replace(sponsorshipOld, sponsorshipNew);
    fs.writeFileSync(sponsorshipPath, html);
    console.log('Patched hero: sponsorship.html');
  }
}
