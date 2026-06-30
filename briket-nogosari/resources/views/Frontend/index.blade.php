<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile->nama_usaha ?? 'Briket Nogosari' }} — Briket Premium Ramah Lingkungan</title>
    <meta name="description" content="{{ Str::limit($profile->deskripsi_usaha ?? 'Produsen briket kelapa premium berkualitas ekspor dari Nogosari.', 160) }}">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- FontAwesome 6 --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    {{-- AOS (Animate on Scroll) --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">

    {{-- SweetAlert2 --}}
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

<style>
/* ============================================================
   DESIGN TOKENS — BRIKET NOGOSARI PREMIUM THEME
   ============================================================ */
:root {
    /* Charcoal Palette */
    --c-bg-base:        #0D0D0D;
    --c-bg-surface:     #161616;
    --c-bg-card:        #1C1C1C;
    --c-bg-elevated:    #242424;
    --c-border:         rgba(255,255,255,0.07);
    --c-border-hover:   rgba(255,255,255,0.14);

    /* Accent — Eco Green */
    --c-green:          #2E7D32;
    --c-green-light:    #43A047;
    --c-green-glow:     rgba(46,125,50,0.18);
    --c-green-muted:    rgba(46,125,50,0.10);

    /* Accent — Premium Gold */
    --c-gold:           #D4AF37;
    --c-gold-light:     #E8C84B;
    --c-gold-glow:      rgba(212,175,55,0.15);
    --c-gold-muted:     rgba(212,175,55,0.08);

    /* Text */
    --c-text-primary:   #F5F5F0;
    --c-text-secondary: #A0A09A;
    --c-text-muted:     #606058;

    /* Sidebar */
    --sidebar-w:        260px;
    --sidebar-bg:       #101010;

    /* Transitions */
    --ease:             cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

/* ============================================================
   RESET & BASE
   ============================================================ */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

html { scroll-behavior: smooth; }

body {
    font-family: 'Plus Jakarta Sans', system-ui, sans-serif;
    background: var(--c-bg-base);
    color: var(--c-text-primary);
    line-height: 1.65;
    overflow-x: hidden;
}

/* Scrollbar */
::-webkit-scrollbar { width: 5px; }
::-webkit-scrollbar-track { background: var(--c-bg-surface); }
::-webkit-scrollbar-thumb { background: var(--c-green); border-radius: 3px; }

/* Selection */
::selection { background: var(--c-green); color: #fff; }

/* ============================================================
   LAYOUT — SIDEBAR + MAIN CONTENT
   ============================================================ */
#app-wrapper {
    display: flex;
    min-height: 100vh;
}

/* ============================================================
   SIDEBAR
   ============================================================ */
#sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: var(--sidebar-w);
    height: 100vh;
    background: var(--sidebar-bg);
    border-right: 1px solid var(--c-border);
    display: flex;
    flex-direction: column;
    z-index: 1050;
    transition: transform 0.35s var(--ease);
    overflow: hidden;
}

/* Sidebar background texture */
#sidebar::before {
    content: '';
    position: absolute;
    inset: 0;
    background: radial-gradient(ellipse at 20% 10%, rgba(46,125,50,0.06) 0%, transparent 60%),
                radial-gradient(ellipse at 80% 90%, rgba(212,175,55,0.04) 0%, transparent 50%);
    pointer-events: none;
}

/* Brand area */
.sidebar-brand {
    padding: 28px 24px 20px;
    border-bottom: 1px solid var(--c-border);
    flex-shrink: 0;
    position: relative;
}

.sidebar-logo-icon {
    width: 46px;
    height: 46px;
    background: linear-gradient(135deg, var(--c-green) 0%, #1B5E20 100%);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 12px;
    box-shadow: 0 4px 16px rgba(46,125,50,0.35);
    position: relative;
}

.sidebar-logo-icon::after {
    content: '';
    position: absolute;
    inset: -1px;
    border-radius: 13px;
    border: 1px solid rgba(212,175,55,0.3);
}

.sidebar-logo-icon i {
    font-size: 22px;
    color: #fff;
}

.sidebar-brand-name {
    font-size: 16px;
    font-weight: 700;
    color: var(--c-text-primary);
    letter-spacing: -0.01em;
    line-height: 1.2;
}

.sidebar-brand-tagline {
    font-size: 11px;
    font-weight: 400;
    color: var(--c-text-muted);
    letter-spacing: 0.06em;
    text-transform: uppercase;
    margin-top: 3px;
}

/* Nav */
.sidebar-nav {
    flex: 1;
    padding: 20px 14px;
    overflow-y: auto;
    overflow-x: hidden;
}

.sidebar-nav-label {
    font-size: 10px;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--c-text-muted);
    padding: 0 10px;
    margin-bottom: 8px;
    margin-top: 4px;
}

.nav-link-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 11px 14px;
    border-radius: 10px;
    color: var(--c-text-secondary);
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: background 0.2s, color 0.2s, transform 0.15s;
    margin-bottom: 3px;
    position: relative;
    overflow: hidden;
}

.nav-link-item::before {
    content: '';
    position: absolute;
    left: 0; top: 0; bottom: 0;
    width: 3px;
    border-radius: 0 3px 3px 0;
    background: var(--c-green);
    transform: scaleY(0);
    transition: transform 0.2s var(--ease);
}

.nav-link-item:hover,
.nav-link-item.active {
    background: var(--c-green-muted);
    color: var(--c-text-primary);
    transform: translateX(2px);
}

.nav-link-item:hover::before,
.nav-link-item.active::before {
    transform: scaleY(1);
}

.nav-link-item.active {
    color: #fff;
}

.nav-link-item i {
    font-size: 15px;
    width: 18px;
    text-align: center;
    flex-shrink: 0;
    color: inherit;
}

.nav-link-item:hover i,
.nav-link-item.active i {
    color: var(--c-green-light);
}

/* Sidebar footer */
.sidebar-footer {
    padding: 16px 24px;
    border-top: 1px solid var(--c-border);
    flex-shrink: 0;
}

.sidebar-footer-cta {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 14px;
    background: var(--c-green-muted);
    border: 1px solid rgba(46,125,50,0.2);
    border-radius: 10px;
    color: var(--c-green-light);
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: background 0.2s, border-color 0.2s;
}

.sidebar-footer-cta:hover {
    background: rgba(46,125,50,0.18);
    border-color: rgba(46,125,50,0.35);
    color: #fff;
}

.sidebar-footer-cta i {
    font-size: 15px;
}

/* ============================================================
   MAIN CONTENT
   ============================================================ */
#main-content {
    margin-left: var(--sidebar-w);
    flex: 1;
    min-width: 0;
}

/* ============================================================
   MOBILE TOPBAR
   ============================================================ */
#mobile-topbar {
    display: none;
    position: sticky;
    top: 0;
    z-index: 1040;
    background: rgba(13,13,13,0.92);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-bottom: 1px solid var(--c-border);
    padding: 12px 20px;
    align-items: center;
    justify-content: space-between;
}

.mobile-brand {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
}

.mobile-brand-icon {
    width: 34px;
    height: 34px;
    background: linear-gradient(135deg, var(--c-green), #1B5E20);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.mobile-brand-icon i { font-size: 16px; color: #fff; }

.mobile-brand-text {
    font-size: 15px;
    font-weight: 700;
    color: var(--c-text-primary);
}

#sidebar-toggle {
    background: var(--c-bg-card);
    border: 1px solid var(--c-border);
    border-radius: 8px;
    width: 38px;
    height: 38px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.2s, border-color 0.2s;
    color: var(--c-text-primary);
    font-size: 16px;
}

#sidebar-toggle:hover {
    background: var(--c-bg-elevated);
    border-color: var(--c-border-hover);
}

/* Overlay for mobile sidebar */
#sidebar-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.6);
    z-index: 1049;
    backdrop-filter: blur(4px);
}

#sidebar-overlay.active { display: block; }

/* ============================================================
   SECTIONS — SHARED
   ============================================================ */
section {
    padding: 96px 60px;
}

.section-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--c-green-light);
    margin-bottom: 16px;
}

.section-eyebrow::before {
    content: '';
    display: block;
    width: 20px;
    height: 2px;
    background: var(--c-green);
    border-radius: 1px;
}

.section-title {
    font-size: clamp(32px, 4vw, 52px);
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.025em;
    color: var(--c-text-primary);
}

.section-title .accent-green { color: var(--c-green-light); }
.section-title .accent-gold  { color: var(--c-gold); }

.section-subtitle {
    font-size: 16px;
    color: var(--c-text-secondary);
    line-height: 1.75;
    max-width: 520px;
    margin-top: 12px;
}

/* Divider line */
.section-divider {
    width: 48px;
    height: 3px;
    background: linear-gradient(90deg, var(--c-green), var(--c-gold));
    border-radius: 2px;
    margin: 20px 0;
}

/* ============================================================
   HERO SECTION
   ============================================================ */
#hero {
    min-height: 100vh;
    display: flex;
    align-items: center;
    padding: 80px 60px;
    position: relative;
    overflow: hidden;
}

/* Hero background layers */
.hero-bg-glow {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    pointer-events: none;
}

.hero-bg-glow-1 {
    width: 500px;
    height: 500px;
    top: -100px;
    right: -100px;
    background: radial-gradient(circle, rgba(46,125,50,0.12) 0%, transparent 70%);
}

.hero-bg-glow-2 {
    width: 400px;
    height: 400px;
    bottom: -80px;
    left: 10%;
    background: radial-gradient(circle, rgba(212,175,55,0.06) 0%, transparent 70%);
}

.hero-grid-pattern {
    position: absolute;
    inset: 0;
    background-image:
        linear-gradient(rgba(255,255,255,0.015) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.015) 1px, transparent 1px);
    background-size: 48px 48px;
    pointer-events: none;
}

.hero-content {
    position: relative;
    z-index: 2;
    max-width: 680px;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 7px 14px;
    background: var(--c-green-muted);
    border: 1px solid rgba(46,125,50,0.25);
    border-radius: 100px;
    font-size: 12px;
    font-weight: 600;
    color: var(--c-green-light);
    letter-spacing: 0.04em;
    margin-bottom: 28px;
}

.hero-badge-dot {
    width: 7px;
    height: 7px;
    background: var(--c-green-light);
    border-radius: 50%;
    animation: pulse-dot 2s infinite;
}

@keyframes pulse-dot {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(0.8); }
}

.hero-title {
    font-size: clamp(40px, 6vw, 72px);
    font-weight: 800;
    line-height: 1.07;
    letter-spacing: -0.03em;
    margin-bottom: 24px;
}

.hero-title .line-muted {
    color: var(--c-text-muted);
    font-weight: 300;
    font-style: italic;
}

.hero-title .line-green {
    color: var(--c-green-light);
}

.hero-title .line-gold {
    color: var(--c-gold);
    font-size: 0.85em;
}

.hero-desc {
    font-size: 17px;
    color: var(--c-text-secondary);
    line-height: 1.75;
    margin-bottom: 40px;
    max-width: 520px;
}

.hero-actions {
    display: flex;
    gap: 14px;
    flex-wrap: wrap;
    margin-bottom: 56px;
}

/* Stat strip */
.hero-stats {
    display: flex;
    gap: 0;
    border: 1px solid var(--c-border);
    border-radius: 16px;
    background: var(--c-bg-card);
    overflow: hidden;
    max-width: 500px;
}

.hero-stat {
    flex: 1;
    padding: 18px 20px;
    text-align: center;
    border-right: 1px solid var(--c-border);
}

.hero-stat:last-child { border-right: none; }

.hero-stat-number {
    font-size: 28px;
    font-weight: 800;
    line-height: 1;
    letter-spacing: -0.02em;
    margin-bottom: 4px;
}

.hero-stat-number.green { color: var(--c-green-light); }
.hero-stat-number.gold  { color: var(--c-gold); }
.hero-stat-number.white { color: var(--c-text-primary); }

.hero-stat-label {
    font-size: 11px;
    color: var(--c-text-muted);
    font-weight: 500;
    letter-spacing: 0.04em;
}

/* ============================================================
   BUTTONS
   ============================================================ */
.btn-primary-custom {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    padding: 14px 28px;
    background: var(--c-green);
    color: #fff;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 0.02em;
    text-decoration: none;
    border: 1px solid transparent;
    transition: background 0.2s, transform 0.15s, box-shadow 0.2s;
    cursor: pointer;
}

.btn-primary-custom:hover {
    background: var(--c-green-light);
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(46,125,50,0.35);
    color: #fff;
}

.btn-secondary-custom {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    padding: 14px 28px;
    background: transparent;
    color: var(--c-text-primary);
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    border: 1px solid var(--c-border-hover);
    transition: background 0.2s, border-color 0.2s, transform 0.15s;
    cursor: pointer;
}

.btn-secondary-custom:hover {
    background: var(--c-bg-card);
    border-color: var(--c-text-muted);
    color: var(--c-text-primary);
    transform: translateY(-2px);
}

.btn-gold {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    padding: 14px 28px;
    background: var(--c-gold-muted);
    color: var(--c-gold);
    border-radius: 10px;
    font-size: 14px;
    font-weight: 700;
    text-decoration: none;
    border: 1px solid rgba(212,175,55,0.25);
    transition: background 0.2s, border-color 0.2s, transform 0.15s, box-shadow 0.2s;
    cursor: pointer;
}

.btn-gold:hover {
    background: rgba(212,175,55,0.15);
    border-color: rgba(212,175,55,0.4);
    color: var(--c-gold-light);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(212,175,55,0.2);
}

/* ============================================================
   ABOUT SECTION
   ============================================================ */
#about {
    background: var(--c-bg-surface);
    border-top: 1px solid var(--c-border);
    border-bottom: 1px solid var(--c-border);
}

.about-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 64px;
    align-items: center;
}

.about-image-frame {
    position: relative;
}

.about-image-main {
    width: 100%;
    aspect-ratio: 4/3;
    object-fit: cover;
    border-radius: 18px;
    filter: brightness(0.88) saturate(0.9);
}

.about-image-placeholder {
    width: 100%;
    aspect-ratio: 4/3;
    border-radius: 18px;
    background: var(--c-bg-card);
    border: 1px solid var(--c-border);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 12px;
    color: var(--c-text-muted);
}

.about-image-placeholder i { font-size: 40px; }
.about-image-placeholder span { font-size: 13px; }

/* Gold accent corner */
.about-image-frame::after {
    content: '';
    position: absolute;
    bottom: -10px;
    right: -10px;
    width: 80px;
    height: 80px;
    border-right: 3px solid var(--c-gold);
    border-bottom: 3px solid var(--c-gold);
    border-radius: 0 0 14px 0;
    pointer-events: none;
}

.about-image-badge {
    position: absolute;
    top: 20px;
    left: -20px;
    background: var(--c-bg-card);
    border: 1px solid var(--c-border);
    border-radius: 12px;
    padding: 12px 18px;
    display: flex;
    align-items: center;
    gap: 10px;
    backdrop-filter: blur(8px);
}

.about-image-badge-icon {
    width: 36px;
    height: 36px;
    background: var(--c-green-muted);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.about-image-badge-icon i { font-size: 16px; color: var(--c-green-light); }

.about-image-badge-text p {
    font-size: 16px;
    font-weight: 800;
    color: var(--c-text-primary);
    line-height: 1;
}

.about-image-badge-text span {
    font-size: 11px;
    color: var(--c-text-muted);
}

.visi-misi-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
    margin-top: 28px;
}

.vm-card {
    padding: 18px;
    background: var(--c-bg-card);
    border: 1px solid var(--c-border);
    border-radius: 12px;
    transition: border-color 0.2s;
}

.vm-card:hover { border-color: var(--c-border-hover); }

.vm-card-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
    font-size: 14px;
}

.vm-card-icon.green { background: var(--c-green-muted); color: var(--c-green-light); }
.vm-card-icon.gold  { background: var(--c-gold-muted);  color: var(--c-gold); }

.vm-card-label {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin-bottom: 6px;
}

.vm-card-label.green { color: var(--c-green-light); }
.vm-card-label.gold  { color: var(--c-gold); }

.vm-card-text {
    font-size: 13px;
    color: var(--c-text-secondary);
    line-height: 1.65;
}

/* ============================================================
   KEUNGGULAN SECTION
   ============================================================ */
#keunggulan {
    background: var(--c-bg-base);
}

.keunggulan-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    margin-top: 48px;
}

.keunggulan-card {
    padding: 30px 26px;
    background: var(--c-bg-card);
    border: 1px solid var(--c-border);
    border-radius: 16px;
    transition: transform 0.25s var(--ease), border-color 0.25s, box-shadow 0.25s;
    position: relative;
    overflow: hidden;
}

.keunggulan-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--c-green), var(--c-gold));
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.35s var(--ease);
}

.keunggulan-card:hover {
    transform: translateY(-6px);
    border-color: var(--c-border-hover);
    box-shadow: 0 20px 50px rgba(0,0,0,0.35);
}

.keunggulan-card:hover::before { transform: scaleX(1); }

.keunggulan-icon {
    width: 52px;
    height: 52px;
    border-radius: 14px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    margin-bottom: 20px;
}

.keunggulan-icon.green {
    background: var(--c-green-muted);
    color: var(--c-green-light);
}

.keunggulan-icon.gold {
    background: var(--c-gold-muted);
    color: var(--c-gold);
}

.keunggulan-title {
    font-size: 17px;
    font-weight: 700;
    color: var(--c-text-primary);
    margin-bottom: 10px;
}

.keunggulan-desc {
    font-size: 14px;
    color: var(--c-text-secondary);
    line-height: 1.7;
}

/* ============================================================
   PRODUK SECTION
   ============================================================ */
#produk {
    background: var(--c-bg-surface);
    border-top: 1px solid var(--c-border);
    border-bottom: 1px solid var(--c-border);
}

.produk-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 22px;
    margin-top: 48px;
}

.produk-card {
    background: var(--c-bg-card);
    border: 1px solid var(--c-border);
    border-radius: 18px;
    overflow: hidden;
    transition: transform 0.3s var(--ease), border-color 0.3s, box-shadow 0.3s;
    position: relative;
}

.produk-card:hover {
    transform: translateY(-8px);
    border-color: rgba(46,125,50,0.3);
    box-shadow: 0 24px 56px rgba(0,0,0,0.4), 0 0 0 1px rgba(46,125,50,0.1);
}

.produk-img-wrap {
    position: relative;
    overflow: hidden;
    aspect-ratio: 16/10;
}

.produk-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s var(--ease), filter 0.3s;
    filter: brightness(0.85) saturate(0.9);
}

.produk-card:hover .produk-img {
    transform: scale(1.06);
    filter: brightness(0.95) saturate(1);
}

.produk-img-placeholder {
    width: 100%;
    height: 100%;
    background: var(--c-bg-elevated);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--c-text-muted);
    font-size: 32px;
}

.produk-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.6) 0%, transparent 60%);
    opacity: 0;
    transition: opacity 0.3s;
}

.produk-card:hover .produk-overlay { opacity: 1; }

.produk-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    padding: 4px 10px;
    background: rgba(46,125,50,0.85);
    backdrop-filter: blur(6px);
    border-radius: 6px;
    font-size: 10px;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: #fff;
}

.produk-body {
    padding: 20px 22px;
}

.produk-name {
    font-size: 16px;
    font-weight: 700;
    color: var(--c-text-primary);
    margin-bottom: 7px;
    line-height: 1.35;
}

.produk-desc {
    font-size: 13px;
    color: var(--c-text-secondary);
    line-height: 1.65;
    margin-bottom: 16px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.produk-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 14px;
    border-top: 1px solid var(--c-border);
}

.produk-price {
    font-size: 20px;
    font-weight: 800;
    color: var(--c-gold);
    letter-spacing: -0.01em;
}

.produk-price span {
    font-size: 12px;
    font-weight: 400;
    color: var(--c-text-muted);
}

.produk-wa-btn {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 9px 16px;
    background: var(--c-green-muted);
    border: 1px solid rgba(46,125,50,0.2);
    border-radius: 8px;
    color: var(--c-green-light);
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
    transition: background 0.2s, border-color 0.2s, transform 0.15s;
}

.produk-wa-btn:hover {
    background: var(--c-green);
    border-color: var(--c-green);
    color: #fff;
    transform: scale(1.03);
}

.produk-empty {
    grid-column: 1/-1;
    padding: 60px 30px;
    text-align: center;
    color: var(--c-text-muted);
}

.produk-empty i { font-size: 48px; margin-bottom: 16px; display: block; }

/* ============================================================
   GALERI SECTION
   ============================================================ */
#galeri {
    background: var(--c-bg-base);
}

.galeri-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    grid-auto-rows: 200px;
    gap: 12px;
    margin-top: 48px;
}

/* Variasi ukuran grid */
.galeri-item:nth-child(1),
.galeri-item:nth-child(6) {
    grid-column: span 2;
    grid-row: span 2;
}

.galeri-item {
    position: relative;
    overflow: hidden;
    border-radius: 12px;
    background: var(--c-bg-card);
    cursor: pointer;
}

.galeri-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s var(--ease), filter 0.3s;
    filter: brightness(0.8) saturate(0.85);
}

.galeri-item:hover .galeri-img {
    transform: scale(1.08);
    filter: brightness(0.65) saturate(1);
}

.galeri-img-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: var(--c-text-muted);
    gap: 8px;
    font-size: 24px;
}

.galeri-img-placeholder span { font-size: 12px; }

.galeri-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.5);
    opacity: 0;
    transition: opacity 0.3s;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 6px;
}

.galeri-item:hover .galeri-overlay { opacity: 1; }

.galeri-overlay-icon {
    width: 44px;
    height: 44px;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.25);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 16px;
    backdrop-filter: blur(4px);
    transform: scale(0.7);
    transition: transform 0.25s var(--ease);
}

.galeri-item:hover .galeri-overlay-icon { transform: scale(1); }

.galeri-overlay-label {
    font-size: 12px;
    font-weight: 600;
    color: rgba(255,255,255,0.85);
    letter-spacing: 0.04em;
}

.galeri-empty {
    grid-column: 1/-1;
    padding: 60px;
    text-align: center;
    color: var(--c-text-muted);
}

.galeri-empty i { font-size: 48px; margin-bottom: 16px; display: block; }

/* ============================================================
   KONTAK SECTION
   ============================================================ */
#kontak {
    background: var(--c-bg-surface);
    border-top: 1px solid var(--c-border);
}

.kontak-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    margin-top: 48px;
}

.kontak-info-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
    margin-bottom: 32px;
}

.kontak-info-item {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    padding: 18px 20px;
    background: var(--c-bg-card);
    border: 1px solid var(--c-border);
    border-radius: 12px;
    transition: border-color 0.2s;
    text-decoration: none;
    color: inherit;
}

.kontak-info-item:hover {
    border-color: var(--c-border-hover);
    color: inherit;
}

.kontak-info-item.green:hover { border-color: rgba(46,125,50,0.3); }
.kontak-info-item.gold:hover  { border-color: rgba(212,175,55,0.25); }

.kontak-info-icon {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    flex-shrink: 0;
}

.kontak-info-icon.green { background: var(--c-green-muted); color: var(--c-green-light); }
.kontak-info-icon.gold  { background: var(--c-gold-muted);  color: var(--c-gold); }
.kontak-info-icon.pink  { background: rgba(220,20,60,0.08); color: #e91e63; }
.kontak-info-icon.blue  { background: rgba(30,120,220,0.08); color: #1e88e5; }
.kontak-info-icon.gray  { background: var(--c-bg-elevated); color: var(--c-text-secondary); }

.kontak-info-label {
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--c-text-muted);
    margin-bottom: 3px;
}

.kontak-info-value {
    font-size: 14px;
    font-weight: 500;
    color: var(--c-text-primary);
    line-height: 1.5;
}

.kontak-cta-buttons {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.kontak-cta-btn {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 16px 20px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 700;
    font-size: 14px;
    transition: transform 0.2s, box-shadow 0.2s, background 0.2s;
}

.kontak-cta-btn:hover {
    transform: translateX(4px);
}

.kontak-cta-btn.whatsapp {
    background: linear-gradient(135deg, #075E54, #128C7E);
    color: #fff;
    box-shadow: 0 4px 16px rgba(7,94,84,0.35);
}

.kontak-cta-btn.whatsapp:hover {
    box-shadow: 0 8px 24px rgba(7,94,84,0.5);
    color: #fff;
}

.kontak-cta-btn.instagram {
    background: linear-gradient(135deg, #405DE6, #5851DB, #833AB4, #C13584, #E1306C, #FD1D1D);
    color: #fff;
    box-shadow: 0 4px 16px rgba(193,53,132,0.3);
}

.kontak-cta-btn.instagram:hover {
    box-shadow: 0 8px 24px rgba(193,53,132,0.45);
    color: #fff;
}

.kontak-cta-btn .cta-icon {
    width: 38px;
    height: 38px;
    background: rgba(255,255,255,0.15);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}

.kontak-cta-btn .cta-text-main {
    font-size: 14px;
    font-weight: 700;
    line-height: 1.2;
}

.kontak-cta-btn .cta-text-sub {
    font-size: 11px;
    opacity: 0.75;
    font-weight: 400;
}

.kontak-map-wrapper {
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid var(--c-border);
    height: 100%;
    min-height: 420px;
    background: var(--c-bg-card);
}

.kontak-map-wrapper iframe {
    width: 100%;
    height: 100%;
    min-height: 420px;
    border: none;
    filter: grayscale(60%) invert(92%) hue-rotate(180deg) brightness(0.85) saturate(0.9);
}

.kontak-map-empty {
    width: 100%;
    height: 100%;
    min-height: 420px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: var(--c-text-muted);
    gap: 12px;
}

.kontak-map-empty i { font-size: 40px; }
.kontak-map-empty p { font-size: 14px; }

/* ============================================================
   FOOTER
   ============================================================ */
#footer {
    background: var(--c-bg-base);
    border-top: 1px solid var(--c-border);
    padding: 48px 60px;
}

.footer-inner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 20px;
}

.footer-brand {
    display: flex;
    align-items: center;
    gap: 12px;
}

.footer-brand-icon {
    width: 38px;
    height: 38px;
    background: linear-gradient(135deg, var(--c-green), #1B5E20);
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.footer-brand-icon i { font-size: 16px; color: #fff; }

.footer-brand-name {
    font-size: 15px;
    font-weight: 700;
    color: var(--c-text-primary);
}

.footer-brand-tagline {
    font-size: 11px;
    color: var(--c-text-muted);
    margin-top: 1px;
}

.footer-copy {
    font-size: 12px;
    color: var(--c-text-muted);
    text-align: right;
}

.footer-copy a {
    color: var(--c-green-light);
    text-decoration: none;
}

/* ============================================================
   GLASSMORPHIC CARD (utility)
   ============================================================ */
.glass-card {
    background: rgba(255,255,255,0.03);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 16px;
}

/* ============================================================
   BACK TO TOP
   ============================================================ */
#back-to-top {
    position: fixed;
    bottom: 28px;
    right: 28px;
    width: 44px;
    height: 44px;
    background: var(--c-green);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 18px;
    text-decoration: none;
    opacity: 0;
    transform: translateY(12px);
    transition: opacity 0.3s, transform 0.3s, background 0.2s;
    z-index: 999;
    box-shadow: 0 4px 16px rgba(46,125,50,0.4);
}

#back-to-top.visible {
    opacity: 1;
    transform: translateY(0);
}

#back-to-top:hover {
    background: var(--c-green-light);
}

/* ============================================================
   RESPONSIVE — TABLET
   ============================================================ */
@media (max-width: 1100px) {
    section { padding: 72px 40px; }
    #hero   { padding: 80px 40px; }
    #footer { padding: 40px; }

    .about-grid        { grid-template-columns: 1fr; gap: 40px; }
    .about-image-badge { left: 16px; }
    .keunggulan-grid   { grid-template-columns: repeat(2, 1fr); }
    .kontak-grid       { grid-template-columns: 1fr; }
}

/* ============================================================
   RESPONSIVE — MOBILE
   ============================================================ */
@media (max-width: 768px) {
    /* Sidebar hides off-canvas */
    #sidebar {
        transform: translateX(-100%);
    }
    #sidebar.open {
        transform: translateX(0);
    }

    /* Topbar shows */
    #mobile-topbar { display: flex; }

    /* Main no longer pushed right */
    #main-content { margin-left: 0; }

    section { padding: 60px 20px; }
    #hero   { padding: 60px 20px; min-height: auto; padding-top: 100px; }
    #footer { padding: 36px 20px; }

    .hero-title { font-size: 36px; }
    .hero-stats { flex-direction: column; border-radius: 12px; }
    .hero-stat  { border-right: none; border-bottom: 1px solid var(--c-border); }
    .hero-stat:last-child { border-bottom: none; }
    .hero-actions { flex-direction: column; }

    .visi-misi-grid    { grid-template-columns: 1fr; }
    .keunggulan-grid   { grid-template-columns: 1fr; }
    .galeri-grid       { grid-template-columns: repeat(2, 1fr); grid-auto-rows: 140px; }
    .galeri-item:nth-child(1),
    .galeri-item:nth-child(6) { grid-column: span 1; grid-row: span 1; }

    .footer-inner { flex-direction: column; text-align: center; }
    .footer-copy  { text-align: center; }

    .about-image-badge { position: static; margin-top: 14px; }
    .about-image-frame::after { display: none; }

    .kontak-cta-btn { padding: 14px 16px; }
}

@media (max-width: 480px) {
    .produk-grid  { grid-template-columns: 1fr; }
    .galeri-grid  { grid-template-columns: 1fr; }
    .galeri-item:nth-child(n) { grid-column: span 1; grid-row: span 1; }
}
</style>
</head>

<body>

{{-- ============================================================
     SIDEBAR
     ============================================================ --}}
<nav id="sidebar" aria-label="Navigasi Utama">
    {{-- Brand --}}
    <div class="sidebar-brand">
        <div class="sidebar-logo-icon">
            <i class="fas fa-fire-flame-curved"></i>
        </div>
        <div class="sidebar-brand-name">{{ $profile->nama_usaha ?? 'Briket Nogosari' }}</div>
        <div class="sidebar-brand-tagline">Briket Premium Ramah Lingkungan</div>
    </div>

    {{-- Navigation --}}
    <div class="sidebar-nav">
        <div class="sidebar-nav-label">Menu Utama</div>

        <a href="#hero" class="nav-link-item active" data-section="hero">
            <i class="fas fa-house"></i>
            <span>Beranda</span>
        </a>
        <a href="#about" class="nav-link-item" data-section="about">
            <i class="fas fa-leaf"></i>
            <span>Tentang Kami</span>
        </a>
        <a href="#keunggulan" class="nav-link-item" data-section="keunggulan">
            <i class="fas fa-star"></i>
            <span>Keunggulan</span>
        </a>
        <a href="#produk" class="nav-link-item" data-section="produk">
            <i class="fas fa-box-archive"></i>
            <span>Produk</span>
        </a>
        <a href="#galeri" class="nav-link-item" data-section="galeri">
            <i class="fas fa-images"></i>
            <span>Galeri</span>
        </a>
        <a href="#kontak" class="nav-link-item" data-section="kontak">
            <i class="fas fa-paper-plane"></i>
            <span>Kontak</span>
        </a>
    </div>

    {{-- Footer CTA --}}
    <div class="sidebar-footer">
        @if($contact && $contact->whatsapp)
        <a href="https://wa.me/{{ $contact->whatsapp }}?text=Halo,%20saya%20ingin%20mengetahui%20lebih%20lanjut%20tentang%20produk%20briket%20Anda."
           target="_blank" rel="noopener" class="sidebar-footer-cta">
            <i class="fab fa-whatsapp"></i>
            <span>Hubungi via WhatsApp</span>
        </a>
        @else
        <a href="#kontak" class="sidebar-footer-cta">
            <i class="fas fa-envelope"></i>
            <span>Hubungi Kami</span>
        </a>
        @endif
    </div>
</nav>

{{-- Overlay (mobile) --}}
<div id="sidebar-overlay" role="presentation" aria-hidden="true"></div>

{{-- ============================================================
     MAIN CONTENT
     ============================================================ --}}
<div id="app-wrapper">
    <main id="main-content">

        {{-- ---- MOBILE TOPBAR ---- --}}
        <header id="mobile-topbar" aria-label="Header Mobile">
            <a href="#hero" class="mobile-brand">
                <div class="mobile-brand-icon">
                    <i class="fas fa-fire-flame-curved"></i>
                </div>
                <span class="mobile-brand-text">{{ $profile->nama_usaha ?? 'Briket Nogosari' }}</span>
            </a>
            <button id="sidebar-toggle" aria-label="Buka menu navigasi" aria-expanded="false" aria-controls="sidebar">
                <i class="fas fa-bars" id="toggle-icon"></i>
            </button>
        </header>

        {{-- ================================================================
             HERO
             ================================================================ --}}
        <section id="hero" aria-labelledby="hero-title">
            <div class="hero-bg-glow hero-bg-glow-1" aria-hidden="true"></div>
            <div class="hero-bg-glow hero-bg-glow-2" aria-hidden="true"></div>
            <div class="hero-grid-pattern" aria-hidden="true"></div>

            <div class="hero-content" data-aos="fade-up" data-aos-duration="700">
                <div class="hero-badge" aria-label="Status: Tersedia untuk ekspor">
                    <span class="hero-badge-dot" aria-hidden="true"></span>
                    Tersedia untuk Ekspor & Lokal
                </div>

                <h1 class="hero-title" id="hero-title">
                    <span class="line-muted">Energi Lebih.</span><br>
                    <span class="line-green">Lebih Bersih.</span><br>
                    <span class="line-gold">Lebih Kuat.</span>
                </h1>

                <p class="hero-desc">
                    {{ $profile->deskripsi_usaha ?? 'Kami memproduksi briket arang kelapa premium dengan kalori tinggi, asap minimal, dan ramah lingkungan — pilihan tepat untuk keperluan industri, rumah tangga, dan ekspor global.' }}
                </p>

                <div class="hero-actions">
                    <a href="#produk" class="btn-primary-custom">
                        <i class="fas fa-box-archive"></i>
                        Lihat Produk Kami
                    </a>
                    @if($contact && $contact->whatsapp)
                    <a href="https://wa.me/{{ $contact->whatsapp }}?text=Halo,%20saya%20tertarik%20dengan%20produk%20briket%20Anda."
                       target="_blank" rel="noopener" class="btn-secondary-custom">
                        <i class="fab fa-whatsapp"></i>
                        WhatsApp Kami
                    </a>
                    @endif
                </div>

                <div class="hero-stats" data-aos="fade-up" data-aos-delay="200">
                    <div class="hero-stat">
                        <div class="hero-stat-number green">{{ $products->count() ?? '0' }}+</div>
                        <div class="hero-stat-label">Jenis Produk</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-number gold">Ekspor</div>
                        <div class="hero-stat-label">Kualitas</div>
                    </div>
                    <div class="hero-stat">
                        <div class="hero-stat-number white">100%</div>
                        <div class="hero-stat-label">Alami</div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ================================================================
             TENTANG KAMI
             ================================================================ --}}
        <section id="about" aria-labelledby="about-title">
            <div class="about-grid">
                {{-- Image --}}
                <div class="about-image-frame" data-aos="fade-right" data-aos-duration="700">
                    @if($profile && $profile->foto_usaha)
                        <img src="{{ Storage::url($profile->foto_usaha) }}"
                             alt="Foto usaha {{ $profile->nama_usaha ?? 'Briket Nogosari' }}"
                             class="about-image-main"
                             loading="lazy">
                    @else
                        <div class="about-image-placeholder">
                            <i class="fas fa-industry" aria-hidden="true"></i>
                            <span>Foto Usaha</span>
                        </div>
                    @endif

                    <div class="about-image-badge" aria-label="Produk ramah lingkungan bersertifikat">
                        <div class="about-image-badge-icon">
                            <i class="fas fa-seedling" aria-hidden="true"></i>
                        </div>
                        <div class="about-image-badge-text">
                            <p>Eco-Friendly</p>
                            <span>Produk Bersertifikat</span>
                        </div>
                    </div>
                </div>

                {{-- Content --}}
                <div data-aos="fade-left" data-aos-duration="700" data-aos-delay="100">
                    <div class="section-eyebrow">Tentang Kami</div>
                    <h2 class="section-title" id="about-title">
                        Dari Nogosari, <span class="accent-green">untuk Dunia</span>
                    </h2>
                    <div class="section-divider" aria-hidden="true"></div>
                    <p class="section-subtitle">
                        {{ $profile->deskripsi_usaha ?? 'Briket Nogosari berdiri dengan komitmen menghadirkan bahan bakar alternatif berkualitas tinggi yang ramah lingkungan. Setiap briket kami diproduksi dari bahan baku pilihan dengan standar kualitas ekspor.' }}
                    </p>

                    {{-- Visi & Misi --}}
                    <div class="visi-misi-grid">
                        <div class="vm-card">
                            <div class="vm-card-icon green"><i class="fas fa-eye" aria-hidden="true"></i></div>
                            <div class="vm-card-label green">Visi</div>
                            <div class="vm-card-text">
                                {{ $profile->visi ?? 'Menjadi produsen briket premium terpercaya dan berkelanjutan di tingkat nasional maupun internasional.' }}
                            </div>
                        </div>
                        <div class="vm-card">
                            <div class="vm-card-icon gold"><i class="fas fa-bullseye" aria-hidden="true"></i></div>
                            <div class="vm-card-label gold">Misi</div>
                            <div class="vm-card-text">
                                {{ $profile->misi ?? 'Menghasilkan produk berkualitas, ramah lingkungan, dan menjaga kepuasan pelanggan di atas segalanya.' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ================================================================
             KEUNGGULAN
             ================================================================ --}}
        <section id="keunggulan" aria-labelledby="keunggulan-title">
            <div data-aos="fade-up">
                <div class="section-eyebrow">Mengapa Kami</div>
                <h2 class="section-title" id="keunggulan-title">
                    Keunggulan <span class="accent-gold">Briket Nogosari</span>
                </h2>
                <div class="section-divider" aria-hidden="true"></div>
                <p class="section-subtitle">
                    Diproses dengan teknologi modern dari bahan baku terpilih, setiap briket kami menghadirkan performa terbaik.
                </p>
            </div>

            <div class="keunggulan-grid">
                @php
                $keunggulan = [
                    ['icon' => 'fas fa-fire', 'color' => 'green', 'title' => 'Kalori Tinggi', 'desc' => 'Nilai kalori mencapai 7.000+ kcal/kg, memberikan panas lebih lama dan stabil untuk berbagai kebutuhan industri maupun rumah tangga.'],
                    ['icon' => 'fas fa-wind', 'color' => 'green', 'title' => 'Asap Minimal', 'desc' => 'Diproses dengan karbonisasi optimal sehingga menghasilkan sedikit asap, nyaman digunakan di dalam maupun luar ruangan.'],
                    ['icon' => 'fas fa-seedling', 'color' => 'green', 'title' => 'Ramah Lingkungan', 'desc' => 'Terbuat dari bahan baku terbarukan — tempurung kelapa — sehingga membantu mengurangi limbah dan jejak karbon.'],
                    ['icon' => 'fas fa-medal', 'color' => 'gold', 'title' => 'Kualitas Ekspor', 'desc' => 'Standar produksi memenuhi persyaratan pasar internasional dengan konsistensi ukuran, berat, dan kadar air terkontrol.'],
                    ['icon' => 'fas fa-clock', 'color' => 'gold', 'title' => 'Tahan Lama', 'desc' => 'Briket kami terbakar lebih lama dibandingkan arang biasa, menghemat biaya bahan bakar secara signifikan.'],
                    ['icon' => 'fas fa-truck-fast', 'color' => 'green', 'title' => 'Pengiriman Cepat', 'desc' => 'Siap kirim ke seluruh wilayah Indonesia maupun mancanegara dengan sistem pengemasan yang aman dan efisien.'],
                ];
                @endphp

                @foreach($keunggulan as $index => $item)
                <div class="keunggulan-card" data-aos="fade-up" data-aos-delay="{{ $index * 80 }}">
                    <div class="keunggulan-icon {{ $item['color'] }}">
                        <i class="{{ $item['icon'] }}" aria-hidden="true"></i>
                    </div>
                    <h3 class="keunggulan-title">{{ $item['title'] }}</h3>
                    <p class="keunggulan-desc">{{ $item['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </section>

        {{-- ================================================================
             PRODUK
             ================================================================ --}}
        <section id="produk" aria-labelledby="produk-title">
            <div data-aos="fade-up">
                <div class="section-eyebrow">Produk Kami</div>
                <h2 class="section-title" id="produk-title">
                    Pilihan <span class="accent-green">Briket Premium</span>
                </h2>
                <div class="section-divider" aria-hidden="true"></div>
                <p class="section-subtitle">
                    Tersedia dalam berbagai ukuran dan kemasan, disesuaikan kebutuhan rumah tangga hingga industri skala besar.
                </p>
            </div>

            <div class="produk-grid">
                @forelse($products as $index => $product)
                <article class="produk-card" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 80 }}">
                    <div class="produk-img-wrap">
                        @if($product->foto_produk)
                            <img src="{{ Storage::url($product->foto_produk) }}"
                                 alt="{{ $product->nama_produk }}"
                                 class="produk-img"
                                 loading="lazy">
                        @else
                            <div class="produk-img-placeholder" aria-label="Tidak ada foto produk">
                                <i class="fas fa-box-archive" aria-hidden="true"></i>
                            </div>
                        @endif
                        <div class="produk-overlay" aria-hidden="true"></div>
                        <div class="produk-badge">Premium</div>
                    </div>
                    <div class="produk-body">
                        <h3 class="produk-name">{{ $product->nama_produk }}</h3>
                        <p class="produk-desc">{{ $product->deskripsi ?? '-' }}</p>
                        <div class="produk-footer">
                            <div>
                                <div class="produk-price">
                                    Rp {{ number_format($product->harga, 0, ',', '.') }}
                                    <span>/ unit</span>
                                </div>
                            </div>
                            @if($contact && $contact->whatsapp)
                            <a href="https://wa.me/{{ $contact->whatsapp }}?text=Halo,%20saya%20tertarik%20dengan%20produk%20*{{ urlencode($product->nama_produk) }}*."
                               target="_blank" rel="noopener" class="produk-wa-btn"
                               aria-label="Pesan {{ $product->nama_produk }} via WhatsApp">
                                <i class="fab fa-whatsapp" aria-hidden="true"></i>
                                Pesan
                            </a>
                            @else
                            <a href="#kontak" class="produk-wa-btn"
                               aria-label="Tanya tentang {{ $product->nama_produk }}">
                                <i class="fas fa-comment" aria-hidden="true"></i>
                                Tanya
                            </a>
                            @endif
                        </div>
                    </div>
                </article>
                @empty
                <div class="produk-empty">
                    <i class="fas fa-box-open" aria-hidden="true"></i>
                    <p>Produk belum tersedia. Hubungi kami untuk informasi lebih lanjut.</p>
                </div>
                @endforelse
            </div>
        </section>

        {{-- ================================================================
             GALERI
             ================================================================ --}}
        <section id="galeri" aria-labelledby="galeri-title">
            <div data-aos="fade-up">
                <div class="section-eyebrow">Galeri Usaha</div>
                <h2 class="section-title" id="galeri-title">
                    Intip <span class="accent-gold">Proses Kami</span>
                </h2>
                <div class="section-divider" aria-hidden="true"></div>
                <p class="section-subtitle">
                    Setiap foto merekam dedikasi kami dalam menghasilkan briket berkualitas terbaik.
                </p>
            </div>

            <div class="galeri-grid" role="list" aria-label="Galeri foto usaha">
                @forelse($galleries as $index => $gallery)
                <figure class="galeri-item"
                        role="listitem"
                        data-aos="fade-up"
                        data-aos-delay="{{ ($index % 4) * 60 }}"
                        tabindex="0"
                        aria-label="{{ $gallery->judul }}"
                        onclick="openLightbox('{{ Storage::url($gallery->foto) }}', '{{ addslashes($gallery->judul) }}')">
                    <img src="{{ Storage::url($gallery->foto) }}"
                         alt="{{ $gallery->judul }}"
                         class="galeri-img"
                         loading="lazy">
                    <div class="galeri-overlay" aria-hidden="true">
                        <div class="galeri-overlay-icon">
                            <i class="fas fa-expand" aria-hidden="true"></i>
                        </div>
                        <div class="galeri-overlay-label">{{ Str::limit($gallery->judul, 28) }}</div>
                    </div>
                </figure>
                @empty
                <div class="galeri-empty">
                    <i class="fas fa-images" aria-hidden="true"></i>
                    <p>Galeri belum tersedia.</p>
                </div>
                @endforelse
            </div>
        </section>

        {{-- ================================================================
             KONTAK
             ================================================================ --}}
        <section id="kontak" aria-labelledby="kontak-title">
            <div data-aos="fade-up">
                <div class="section-eyebrow">Kontak</div>
                <h2 class="section-title" id="kontak-title">
                    Mari <span class="accent-green">Terhubung</span>
                </h2>
                <div class="section-divider" aria-hidden="true"></div>
                <p class="section-subtitle">
                    Kami siap membantu kebutuhan Anda. Hubungi kami melalui salah satu kanal berikut.
                </p>
            </div>

            <div class="kontak-grid">
                {{-- Kolom kiri: info + CTA --}}
                <div data-aos="fade-right" data-aos-duration="700">
                    <div class="kontak-info-list">
                        @if($contact && $contact->whatsapp)
                        <a href="https://wa.me/{{ $contact->whatsapp }}" target="_blank" rel="noopener"
                           class="kontak-info-item green">
                            <div class="kontak-info-icon green"><i class="fab fa-whatsapp" aria-hidden="true"></i></div>
                            <div>
                                <div class="kontak-info-label">WhatsApp</div>
                                <div class="kontak-info-value">+{{ $contact->whatsapp }}</div>
                            </div>
                        </a>
                        @endif

                        @if($contact && $contact->instagram)
                        <a href="https://instagram.com/{{ $contact->instagram }}" target="_blank" rel="noopener"
                           class="kontak-info-item pink">
                            <div class="kontak-info-icon pink"><i class="fab fa-instagram" aria-hidden="true"></i></div>
                            <div>
                                <div class="kontak-info-label">Instagram</div>
                                <div class="kontak-info-value">@{{ $contact->instagram }}</div>
                            </div>
                        </a>
                        @endif

                        @if($contact && $contact->email)
                        <a href="mailto:{{ $contact->email }}" class="kontak-info-item blue">
                            <div class="kontak-info-icon blue"><i class="fas fa-envelope" aria-hidden="true"></i></div>
                            <div>
                                <div class="kontak-info-label">Email</div>
                                <div class="kontak-info-value">{{ $contact->email }}</div>
                            </div>
                        </a>
                        @endif

                        @if($contact && $contact->alamat)
                        <div class="kontak-info-item gray">
                            <div class="kontak-info-icon gray"><i class="fas fa-location-dot" aria-hidden="true"></i></div>
                            <div>
                                <div class="kontak-info-label">Alamat</div>
                                <div class="kontak-info-value">{{ $contact->alamat }}</div>
                            </div>
                        </div>
                        @endif

                        @if(!$contact || (!$contact->whatsapp && !$contact->instagram && !$contact->email && !$contact->alamat))
                        <p class="text-muted fst-italic" style="font-size:14px;">Informasi kontak belum tersedia. Silakan isi melalui panel admin.</p>
                        @endif
                    </div>

                    <div class="kontak-cta-buttons">
                        @if($contact && $contact->whatsapp)
                        <a href="https://wa.me/{{ $contact->whatsapp }}?text=Halo,%20saya%20ingin%20bertanya%20tentang%20produk%20briket%20Anda."
                           target="_blank" rel="noopener" class="kontak-cta-btn whatsapp">
                            <div class="cta-icon"><i class="fab fa-whatsapp" aria-hidden="true"></i></div>
                            <div>
                                <div class="cta-text-main">Chat via WhatsApp</div>
                                <div class="cta-text-sub">Respon cepat, tersedia setiap hari</div>
                            </div>
                            <i class="fas fa-arrow-right ms-auto" style="font-size:12px; opacity:0.6;" aria-hidden="true"></i>
                        </a>
                        @endif

                        @if($contact && $contact->instagram)
                        <a href="https://instagram.com/{{ $contact->instagram }}" target="_blank" rel="noopener"
                           class="kontak-cta-btn instagram">
                            <div class="cta-icon"><i class="fab fa-instagram" aria-hidden="true"></i></div>
                            <div>
                                <div class="cta-text-main">Ikuti di Instagram</div>
                                <div class="cta-text-sub">Lihat update produk terbaru</div>
                            </div>
                            <i class="fas fa-arrow-right ms-auto" style="font-size:12px; opacity:0.6;" aria-hidden="true"></i>
                        </a>
                        @endif
                    </div>
                </div>

                {{-- Kolom kanan: peta --}}
                <div data-aos="fade-left" data-aos-duration="700" data-aos-delay="100">
                    <div class="kontak-map-wrapper" role="region" aria-label="Peta lokasi usaha">
                        @if($contact && $contact->google_maps)
                            {!! $contact->google_maps !!}
                        @else
                            <div class="kontak-map-empty">
                                <i class="fas fa-map-marked-alt" aria-hidden="true"></i>
                                <p>Peta lokasi belum tersedia.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>

        {{-- ================================================================
             FOOTER
             ================================================================ --}}
        <footer id="footer" role="contentinfo">
            <div class="footer-inner">
                <div class="footer-brand">
                    <div class="footer-brand-icon">
                        <i class="fas fa-fire-flame-curved" aria-hidden="true"></i>
                    </div>
                    <div>
                        <div class="footer-brand-name">{{ $profile->nama_usaha ?? 'Briket Nogosari' }}</div>
                        <div class="footer-brand-tagline">Briket Premium · Ramah Lingkungan · Kualitas Ekspor</div>
                    </div>
                </div>
                <div class="footer-copy">
                    <p>&copy; {{ date('Y') }} {{ $profile->nama_usaha ?? 'Briket Nogosari' }}. Hak cipta dilindungi.</p>
                    @if($contact && $contact->email)
                    <p><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
                    @endif
                </div>
            </div>
        </footer>

    </main>
</div>

{{-- Back to top --}}
<a href="#hero" id="back-to-top" aria-label="Kembali ke atas">
    <i class="fas fa-arrow-up" aria-hidden="true"></i>
</a>

{{-- ================================================================
     LIGHTBOX MODAL
     ================================================================ --}}
<div class="modal fade" id="lightboxModal" tabindex="-1" aria-labelledby="lightboxCaption" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content border-0" style="background: rgba(10,10,10,0.97); backdrop-filter: blur(20px);">
            <div class="modal-header border-0 pb-0" style="padding: 16px 20px;">
                <h5 class="modal-title" id="lightboxCaption"
                    style="color: var(--c-text-primary); font-size: 15px; font-weight: 600;"></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Tutup lightbox"></button>
            </div>
            <div class="modal-body text-center" style="padding: 16px 20px 24px;">
                <img id="lightboxImg" src="" alt=""
                     style="max-height: 75vh; max-width: 100%; border-radius: 12px; object-fit: contain;">
            </div>
        </div>
    </div>
</div>

{{-- ================================================================
     SCRIPTS
     ================================================================ --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// ---- AOS Init ----
AOS.init({
    once: true,
    offset: 60,
    easing: 'ease-out-cubic',
    duration: 650
});

// ---- Sidebar Toggle (Mobile) ----
const sidebar        = document.getElementById('sidebar');
const overlay        = document.getElementById('sidebar-overlay');
const toggleBtn      = document.getElementById('sidebar-toggle');
const toggleIcon     = document.getElementById('toggle-icon');

function openSidebar() {
    sidebar.classList.add('open');
    overlay.classList.add('active');
    toggleBtn.setAttribute('aria-expanded', 'true');
    toggleIcon.classList.replace('fa-bars', 'fa-xmark');
    document.body.style.overflow = 'hidden';
}

function closeSidebar() {
    sidebar.classList.remove('open');
    overlay.classList.remove('active');
    toggleBtn.setAttribute('aria-expanded', 'false');
    toggleIcon.classList.replace('fa-xmark', 'fa-bars');
    document.body.style.overflow = '';
}

toggleBtn.addEventListener('click', function () {
    sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
});

overlay.addEventListener('click', closeSidebar);

// Tutup sidebar saat menu item diklik (mobile)
document.querySelectorAll('#sidebar .nav-link-item').forEach(function (link) {
    link.addEventListener('click', function () {
        if (window.innerWidth < 769) closeSidebar();
    });
});

// ---- Active nav link on scroll (Intersection Observer) ----
const sections = document.querySelectorAll('section[id], footer[id]');
const navLinks  = document.querySelectorAll('.nav-link-item[data-section]');

const sectionObserver = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
        if (entry.isIntersecting) {
            const id = entry.target.id;
            navLinks.forEach(function (link) {
                if (link.dataset.section === id) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        }
    });
}, { rootMargin: '-30% 0px -60% 0px', threshold: 0 });

sections.forEach(function (s) { sectionObserver.observe(s); });

// ---- Back to top button ----
const backBtn = document.getElementById('back-to-top');

window.addEventListener('scroll', function () {
    if (window.scrollY > 400) {
        backBtn.classList.add('visible');
    } else {
        backBtn.classList.remove('visible');
    }
}, { passive: true });

// ---- Lightbox ----
function openLightbox(src, caption) {
    document.getElementById('lightboxImg').src            = src;
    document.getElementById('lightboxImg').alt            = caption;
    document.getElementById('lightboxCaption').textContent = caption;
    new bootstrap.Modal(document.getElementById('lightboxModal')).show();
}

// Keyboard support untuk galeri item
document.querySelectorAll('.galeri-item').forEach(function (item) {
    item.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            item.click();
        }
    });
});

// ---- Smooth scroll untuk semua anchor #hash ----
document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
    anchor.addEventListener('click', function (e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});
</script>

</body>
</html>