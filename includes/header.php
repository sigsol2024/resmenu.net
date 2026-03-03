<?php
/**
 * Site Header Component - resmenu.net (Marketing)
 * Auth links point to BACKEND_URL (our-menu.online)
 */
if (!defined('BACKEND_URL')) {
    require_once __DIR__ . '/../config/config.php';
}
$authUrl = rtrim(BACKEND_URL, '/') . '/';
?>
<header class="site-header" id="siteHeader">
    <nav class="main-nav">
        <div class="nav-container">
            <a href="/" class="logo">
                <h1>SigSol Resmenu</h1>
            </a>
            <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
            <ul class="nav-menu" id="navMenu">
                <li><a href="/">Home</a></li>
                <li><a href="/restaurants-list.php">Restaurants</a></li>
                <li><a href="/templates.php">Templates</a></li>
                <li><a href="/faq.php">FAQ</a></li>
                <li><a href="/contact.php">Contact</a></li>
                <li><a href="<?php echo htmlspecialchars($authUrl); ?>" class="btn-nav">Get Started</a></li>
            </ul>
        </div>
    </nav>
</header>

<script>
// Mobile menu toggle
document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('mobileMenuToggle');
    const menu = document.getElementById('navMenu');
    const header = document.getElementById('siteHeader');

    if (toggle && menu) {
        toggle.addEventListener('click', function() {
            menu.classList.toggle('active');
            toggle.classList.toggle('active');
        });
    }

    if (header) {
        let lastScroll = 0;
        window.addEventListener('scroll', function() {
            const currentScroll = window.pageYOffset;
            if (currentScroll > 100) {
                header.classList.add('sticky');
            } else {
                header.classList.remove('sticky');
            }
            lastScroll = currentScroll;
        });
    }
});
</script>
