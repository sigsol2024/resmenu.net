<?php
/**
 * Site Header Component - resmenu.net (Marketing)
 * Same header as home page: Tailwind, logo, nav, mobile modal.
 * Auth links point to BACKEND_URL (our-menu.online)
 */
if (!defined('BACKEND_URL')) {
    require_once __DIR__ . '/../config/config.php';
}
if (!function_exists('getSiteSettings')) {
    require_once __DIR__ . '/functions.php';
}
$authUrl = rtrim(BACKEND_URL, '/') . '/';
$baseUrl = defined('SITE_URL') ? rtrim(SITE_URL, '/') : '';
$siteSettings = getSiteSettings();
$siteName = htmlspecialchars($siteSettings['site_name'] ?? 'SigSol Resmenu');
?>
<style>
.mobile-menu-overlay {
    opacity: 0;
    visibility: hidden;
    pointer-events: none;
    transition: opacity 0.3s ease, visibility 0.3s ease;
}
.mobile-menu-overlay.open {
    opacity: 1;
    visibility: visible;
    pointer-events: auto;
}
.mobile-menu-modal {
    opacity: 0;
    transform: scale(0.92) translateY(-1rem);
    transition: opacity 0.3s cubic-bezier(0.22, 1, 0.36, 1), transform 0.3s cubic-bezier(0.22, 1, 0.36, 1);
}
.mobile-menu-overlay.open .mobile-menu-modal {
    opacity: 1;
    transform: scale(1) translateY(0);
}
</style>
<!-- Header (same as home page) -->
<header class="sticky top-0 z-50 w-full bg-white/80 backdrop-blur-md border-b border-slate-200">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="flex justify-between items-center h-20">
<div class="flex items-center gap-2">
<a href="<?php echo htmlspecialchars($baseUrl); ?>/" class="flex items-center gap-2">
<img src="<?php echo htmlspecialchars($baseUrl); ?>/assets/images/resmen_logo.png" alt="<?php echo $siteName; ?> logo" class="h-10 w-auto object-contain"/>
</a>
</div>
<nav class="hidden md:flex items-center gap-8">
<a class="text-sm font-medium text-slate-600 hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/">Home</a>
<a class="text-sm font-medium text-slate-600 hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/features.php">Features</a>
<a class="text-sm font-medium text-slate-600 hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/restaurants-list.php">Restaurants</a>
<a class="text-sm font-medium text-slate-600 hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/templates.php">Templates</a>
<a class="text-sm font-medium text-slate-600 hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/pricing.php">Pricing</a>
<a class="text-sm font-medium text-slate-600 hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/faq.php">FAQ</a>
<a class="text-sm font-medium text-slate-600 hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/contact.php">Contact</a>
</nav>
<div class="flex items-center gap-4">
<button type="button" id="mobileMenuBtn" class="md:hidden p-2.5 rounded-xl text-dark-slate hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-primary/30" aria-label="Open menu">
<span class="material-symbols-outlined text-3xl">menu</span>
</button>
<a href="<?php echo htmlspecialchars($authUrl); ?>" class="hidden md:inline-block bg-primary hover:bg-primary/90 text-white px-6 py-2.5 rounded-lg text-sm font-bold transition-all shadow-lg shadow-primary/20">
Get Started
</a>
</div>
</div>
</div>
</header>
<!-- Mobile menu modal -->
<div id="mobileMenuOverlay" class="mobile-menu-overlay fixed inset-0 z-[60] bg-black/50 backdrop-blur-sm flex items-center justify-center p-4" aria-hidden="true">
<div id="mobileMenuModal" class="mobile-menu-modal w-full max-w-sm bg-white rounded-2xl shadow-2xl border border-slate-100 overflow-hidden">
<div class="flex items-center justify-between px-6 py-5 border-b border-slate-100">
<a href="<?php echo htmlspecialchars($baseUrl); ?>/" class="flex items-center gap-2">
<img src="<?php echo htmlspecialchars($baseUrl); ?>/assets/images/resmen_logo.png" alt="<?php echo $siteName; ?> logo" class="h-8 w-auto object-contain"/>
</a>
<button type="button" id="mobileMenuClose" class="p-2 rounded-xl text-slate-500 hover:bg-slate-100 hover:text-dark-slate focus:outline-none focus:ring-2 focus:ring-primary/30" aria-label="Close menu">
<span class="material-symbols-outlined text-2xl">close</span>
</button>
</div>
<nav class="flex flex-col p-4 gap-1">
<a class="mobile-menu-link px-4 py-3.5 rounded-xl text-slate-700 font-medium hover:bg-primary/10 hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/">Home</a>
<a class="mobile-menu-link px-4 py-3.5 rounded-xl text-slate-700 font-medium hover:bg-primary/10 hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/features.php">Features</a>
<a class="mobile-menu-link px-4 py-3.5 rounded-xl text-slate-700 font-medium hover:bg-primary/10 hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/restaurants-list.php">Restaurants</a>
<a class="mobile-menu-link px-4 py-3.5 rounded-xl text-slate-700 font-medium hover:bg-primary/10 hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/templates.php">Templates</a>
<a class="mobile-menu-link px-4 py-3.5 rounded-xl text-slate-700 font-medium hover:bg-primary/10 hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/pricing.php">Pricing</a>
<a class="mobile-menu-link px-4 py-3.5 rounded-xl text-slate-700 font-medium hover:bg-primary/10 hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/faq.php">FAQ</a>
<a class="mobile-menu-link px-4 py-3.5 rounded-xl text-slate-700 font-medium hover:bg-primary/10 hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/contact.php">Contact</a>
<a class="mobile-menu-link mt-2 px-4 py-3.5 rounded-xl bg-primary text-white font-bold text-center hover:bg-primary/90 transition-colors" href="<?php echo htmlspecialchars($authUrl); ?>">Get Started</a>
</nav>
</div>
</div>
<script>
(function() {
    var overlay = document.getElementById('mobileMenuOverlay');
    var openBtn = document.getElementById('mobileMenuBtn');
    var closeBtn = document.getElementById('mobileMenuClose');
    function openMenu() {
        if (overlay) {
            overlay.classList.add('open');
            overlay.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }
    }
    function closeMenu() {
        if (overlay) {
            overlay.classList.remove('open');
            overlay.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }
    }
    if (openBtn) openBtn.addEventListener('click', openMenu);
    if (closeBtn) closeBtn.addEventListener('click', closeMenu);
    if (overlay) overlay.addEventListener('click', function(e) {
        if (e.target === overlay) closeMenu();
    });
    var links = document.querySelectorAll('.mobile-menu-link');
    for (var i = 0; i < links.length; i++) links[i].addEventListener('click', closeMenu);
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && overlay && overlay.classList.contains('open')) closeMenu();
    });
})();
</script>
