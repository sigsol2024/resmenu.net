<?php
/**
 * Features Page - resmenu.net
 * Timeline layout similar to templates.php, using local assets images.
 */
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';

$baseUrl = defined('SITE_URL') ? rtrim(SITE_URL, '/') : '';
$authUrl = defined('BACKEND_URL') ? rtrim(BACKEND_URL, '/') . '/' : 'https://our-menu.online/';
$siteSettings = getSiteSettings();
$siteName = htmlspecialchars($siteSettings['site_name'] ?? 'SigSol Resmenu');

$features = [
    [
        'title' => 'QR Menu Templates',
        'desc' => "Pick from modern templates built for speed and readability.\nUpdate items instantly and keep your menu consistent across devices.",
        'image' => $baseUrl . '/assets/images/qr_template.png',
        'icon' => 'dashboard_customize',
        'bullets' => ['Mobile-first layouts', 'Template previews', 'Fast loading pages'],
    ],
    [
        'title' => 'Food Ordering System',
        'desc' => "Let guests order from their phone with a smooth checkout flow.\nReduce wait time and increase order accuracy.",
        'image' => $baseUrl . '/assets/images/food_odering_system.png',
        'icon' => 'shopping_cart',
        'bullets' => ['Contactless ordering', 'Clear item options', 'Better guest experience'],
    ],
    [
        'title' => 'Reservations System',
        'desc' => "Manage bookings in one place and keep your team organized.\nGuests can reserve quickly while you control availability.",
        'image' => $baseUrl . '/assets/images/Table-Reservation.png',
        'icon' => 'event_available',
        'bullets' => ['Booking management', 'Mobile-friendly views', 'Faster confirmations'],
    ],
    [
        'title' => 'QR Code Generation',
        'desc' => "Generate QR codes for tables, flyers, and social media.\nLink directly to your menu and keep it always up to date.",
        'image' => $baseUrl . '/assets/images/QR-Code-generation.png',
        'icon' => 'qr_code_2',
        'bullets' => ['Table QR codes', 'Marketing QR codes', 'Instant updates'],
    ],
    [
        'title' => 'Menu Branding & Customization',
        'desc' => "Match your brand across every menu page.\nSet colors, logo, socials, address, footer content, and more.",
        'image' => $baseUrl . '/assets/images/3d-mobile-phone-mockup.jpg',
        'icon' => 'palette',
        'bullets' => ['Colors & logo', 'Social links & address', 'Footer content'],
    ],
    [
        'title' => 'Currency Switcher',
        'desc' => "Serve guests from anywhere with multi-currency display.\nLet users switch currency while keeping pricing clear and consistent.",
        'image' => $baseUrl . '/assets/images/branding-custom.png',
        'icon' => 'currency_exchange',
        'bullets' => ['Multi-currency support', 'Clear symbols', 'Better clarity for guests'],
    ],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Features - <?php echo $siteName; ?></title>
    <meta name="description" content="Explore SigSol Resmenu features: QR menu templates, food ordering, reservations, QR generation, branding, and currency switcher.">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#f97415",
                        "background-light": "#f8f7f5",
                        "background-dark": "#23170f",
                        "dark-slate": "#111827",
                    },
                    fontFamily: { "display": ["Inter", "sans-serif"], "heading": ["Poppins", "sans-serif"] },
                    borderRadius: { "DEFAULT": "0.5rem", "lg": "1rem", "xl": "1.5rem", "full": "9999px" },
                },
            },
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4 { font-family: 'Poppins', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .hero-gradient { background: linear-gradient(90deg, rgba(35, 23, 15, 0.92) 0%, rgba(249, 116, 21, 0.35) 100%); }
    </style>
</head>
<body class="bg-background-light text-slate-900">
<?php include __DIR__ . '/includes/header.php'; ?>

<!-- Hero -->
<section class="relative w-full min-h-[320px] md:min-h-[340px] flex items-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo htmlspecialchars($baseUrl); ?>/assets/images/features_heros.jpg');"></div>
        <div class="absolute inset-0 hero-gradient"></div>
    </div>
    <div class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-10">
        <nav class="flex items-center gap-2 mb-3 text-sm font-medium">
            <a class="text-slate-300 hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/">Home</a>
            <span class="text-slate-400 text-sm">/</span>
            <span class="text-white text-sm">Features</span>
        </nav>
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white mb-3 leading-tight max-w-3xl">Everything You Need To Power A Modern Digital Menu</h1>
        <p class="text-slate-200 text-base md:text-lg max-w-2xl leading-relaxed">
            From QR menus and branding to ordering and reservations — Resmenu gives restaurants a full suite of tools to serve guests faster.
        </p>
    </div>
</section>

<!-- Features timeline -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="flex items-end justify-between gap-6 flex-wrap mb-10">
        <div class="max-w-2xl">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900">Platform Features</h2>
            <p class="text-slate-600 mt-3">Explore the core features restaurants use daily to manage menus, improve guest experience, and increase efficiency.</p>
        </div>
        <a href="<?php echo htmlspecialchars($authUrl); ?>" class="inline-flex items-center justify-center gap-2 bg-primary hover:bg-primary/90 text-white py-3 px-6 rounded-lg font-bold transition-colors shadow-lg shadow-primary/20">
            Get Started
            <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
        </a>
    </div>

    <div class="space-y-12">
        <?php foreach ($features as $index => $f):
            $isEven = ($index % 2) === 0;
        ?>
        <div class="flex flex-col <?php echo $isEven ? 'lg:flex-row' : 'lg:flex-row-reverse'; ?> gap-0 items-stretch bg-white rounded-xl overflow-hidden shadow-sm border border-slate-200">
            <div class="w-full lg:w-[60%] flex-shrink-0">
                <div class="h-[250px] sm:h-[300px] lg:h-full lg:min-h-[320px] bg-slate-100 overflow-hidden p-4 md:p-6">
                    <img
                        src="<?php echo htmlspecialchars($f['image']); ?>"
                        alt="<?php echo htmlspecialchars($f['title']); ?>"
                        class="w-full h-full object-contain object-center"
                        loading="lazy"
                        decoding="async"
                    >
                </div>
            </div>
            <div class="w-full lg:w-[40%] flex-shrink-0 p-6 lg:p-10 flex flex-col justify-center bg-white/80 backdrop-blur-md border-slate-200 <?php echo $isEven ? 'lg:border-l' : 'lg:border-r'; ?>">
                <div class="flex items-center gap-3 mb-4">
                    <div class="bg-primary/10 text-primary w-11 h-11 rounded-xl flex items-center justify-center">
                        <span class="material-symbols-outlined"><?php echo htmlspecialchars($f['icon']); ?></span>
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900"><?php echo htmlspecialchars($f['title']); ?></h3>
                </div>
                <p class="text-slate-600 leading-relaxed mb-6"><?php echo nl2br(htmlspecialchars($f['desc'])); ?></p>

                <?php if (!empty($f['bullets'])): ?>
                <ul class="space-y-3 mb-8">
                    <?php foreach ($f['bullets'] as $b): ?>
                        <li class="flex items-start gap-2 text-slate-700">
                            <span class="material-symbols-outlined text-primary text-[20px]" aria-hidden="true">check_circle</span>
                            <span class="text-sm leading-relaxed"><?php echo htmlspecialchars($b); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

                <div class="flex flex-wrap gap-3">
                    <a href="<?php echo htmlspecialchars($baseUrl); ?>/templates.php" class="bg-primary hover:bg-primary/90 text-white py-3 px-6 rounded-lg font-bold transition-colors text-center">View Template</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- CTA -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
    <div class="bg-primary rounded-3xl p-10 md:p-20 relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 opacity-10" style="background-image: url('<?php echo htmlspecialchars($baseUrl); ?>/assets/images/bh_pattern-black.png'); background-repeat: repeat; background-size: 280px 280px;"></div>
        <h2 class="text-3xl md:text-5xl font-bold text-white mb-6 relative z-10">Launch Your Digital Menu In Minutes</h2>
        <p class="text-white/90 text-lg mb-10 max-w-2xl mx-auto relative z-10">
            Create a branded menu, generate QR codes, and start taking orders — all from one dashboard.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center relative z-10">
            <a href="<?php echo htmlspecialchars($authUrl); ?>" class="bg-white text-primary hover:bg-slate-50 px-8 py-4 rounded-xl font-bold text-lg transition-all shadow-lg text-center">Get Started Now</a>
            <a href="<?php echo htmlspecialchars($baseUrl); ?>/templates.php" class="bg-transparent border-2 border-white/40 text-white hover:bg-white/10 px-8 py-4 rounded-xl font-bold text-lg transition-all text-center">View Templates</a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>

