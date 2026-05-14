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
$registerUrl = rtrim(BACKEND_URL, '/') . '/register.php';
$loginUrl = rtrim(BACKEND_URL, '/') . '/';
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
<div class="max-w-7xl mx-auto px-3 sm:px-4 md:px-6 lg:px-8">
<div class="flex justify-between items-center h-14 sm:h-16 md:h-20 gap-2">
<div class="flex items-center gap-1.5 sm:gap-2 min-w-0">
<a href="<?php echo htmlspecialchars($baseUrl); ?>/" class="flex items-center gap-2 shrink-0">
<img src="<?php echo htmlspecialchars($baseUrl); ?>/assets/images/resmen_logo.png" alt="<?php echo $siteName; ?> logo" class="h-7 w-auto object-contain sm:h-8 md:h-10"/>
</a>
</div>
<nav class="hidden md:flex items-center gap-3 lg:gap-6 xl:gap-8 shrink min-w-0">
<a class="text-xs lg:text-sm font-medium text-slate-600 hover:text-primary transition-colors whitespace-nowrap" href="<?php echo htmlspecialchars($baseUrl); ?>/">Home</a>
<a class="text-xs lg:text-sm font-medium text-slate-600 hover:text-primary transition-colors whitespace-nowrap" href="<?php echo htmlspecialchars($baseUrl); ?>/features">Features</a>
<a class="text-xs lg:text-sm font-medium text-slate-600 hover:text-primary transition-colors whitespace-nowrap" href="<?php echo htmlspecialchars($baseUrl); ?>/restaurants-list">Restaurants</a>
<a class="text-xs lg:text-sm font-medium text-slate-600 hover:text-primary transition-colors whitespace-nowrap" href="<?php echo htmlspecialchars($baseUrl); ?>/templates">Templates</a>
<a class="text-xs lg:text-sm font-medium text-slate-600 hover:text-primary transition-colors whitespace-nowrap" href="<?php echo htmlspecialchars($baseUrl); ?>/pricing">Pricing</a>
<a class="text-xs lg:text-sm font-medium text-slate-600 hover:text-primary transition-colors whitespace-nowrap" href="<?php echo htmlspecialchars($baseUrl); ?>/faq">FAQ</a>
<a class="text-xs lg:text-sm font-medium text-slate-600 hover:text-primary transition-colors whitespace-nowrap" href="<?php echo htmlspecialchars($baseUrl); ?>/contact">Contact</a>
</nav>
<div class="flex items-center gap-1.5 sm:gap-2 md:gap-4 shrink-0">
<button type="button" id="mobileMenuBtn" class="md:hidden p-2 rounded-lg text-dark-slate hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-primary/30" aria-label="Open menu">
<span class="material-symbols-outlined text-2xl sm:text-3xl">menu</span>
</button>
<a href="<?php echo htmlspecialchars($loginUrl); ?>" class="hidden md:inline-flex items-center text-xs lg:text-sm font-semibold text-slate-600 hover:text-primary transition-colors">
Login
</a>
<a href="<?php echo htmlspecialchars($registerUrl); ?>" class="hidden md:inline-block bg-primary hover:bg-primary/90 text-white px-3 py-2 sm:px-5 sm:py-2.5 lg:px-6 rounded-md sm:rounded-lg text-xs sm:text-sm font-bold transition-all shadow-md sm:shadow-lg shadow-primary/20 whitespace-nowrap">
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
<a class="mobile-menu-link px-3 py-2.5 sm:px-4 sm:py-3 rounded-xl text-sm text-slate-700 font-medium hover:bg-primary/10 hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/">Home</a>
<a class="mobile-menu-link px-3 py-2.5 sm:px-4 sm:py-3 rounded-xl text-sm text-slate-700 font-medium hover:bg-primary/10 hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/features">Features</a>
<a class="mobile-menu-link px-3 py-2.5 sm:px-4 sm:py-3 rounded-xl text-sm text-slate-700 font-medium hover:bg-primary/10 hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/restaurants-list">Restaurants</a>
<a class="mobile-menu-link px-3 py-2.5 sm:px-4 sm:py-3 rounded-xl text-sm text-slate-700 font-medium hover:bg-primary/10 hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/templates">Templates</a>
<a class="mobile-menu-link px-3 py-2.5 sm:px-4 sm:py-3 rounded-xl text-sm text-slate-700 font-medium hover:bg-primary/10 hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/pricing">Pricing</a>
<a class="mobile-menu-link px-3 py-2.5 sm:px-4 sm:py-3 rounded-xl text-sm text-slate-700 font-medium hover:bg-primary/10 hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/faq">FAQ</a>
<a class="mobile-menu-link px-3 py-2.5 sm:px-4 sm:py-3 rounded-xl text-sm text-slate-700 font-medium hover:bg-primary/10 hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/contact">Contact</a>
<a class="mobile-menu-link mt-1 px-3 py-2.5 sm:px-4 sm:py-3 rounded-xl text-sm text-slate-700 font-bold text-center border border-slate-200 hover:bg-slate-50 transition-colors" href="<?php echo htmlspecialchars($loginUrl); ?>">Login</a>
<a class="mobile-menu-link mt-1 px-3 py-2.5 sm:px-4 sm:py-3 rounded-xl bg-primary text-white text-sm font-bold text-center hover:bg-primary/90 transition-colors" href="<?php echo htmlspecialchars($registerUrl); ?>">Get Started</a>
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
