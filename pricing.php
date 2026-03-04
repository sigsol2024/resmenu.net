<?php
/**
 * Pricing - resmenu.net
 */
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';
$baseUrl = defined('SITE_URL') ? rtrim(SITE_URL, '/') : '';
$authUrl = defined('BACKEND_URL') ? rtrim(BACKEND_URL, '/') . '/' : 'https://our-menu.online/';
$siteSettings = getSiteSettings();
$siteName = htmlspecialchars($siteSettings['site_name'] ?? 'Resmenu');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Pricing - <?php echo $siteName; ?></title>
    <meta name="description" content="Pricing plans for <?php echo $siteName; ?> digital menu platform"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = { darkMode: "class", theme: { extend: { colors: { "primary": "#f97415", "background-light": "#f8f7f5", "background-dark": "#23170f", "dark-slate": "#111827" }, fontFamily: { "display": ["Inter", "sans-serif"] }, borderRadius: { "DEFAULT": "0.5rem", "lg": "1rem", "xl": "1.5rem", "full": "9999px" } } } }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-gradient { background: linear-gradient(90deg, rgba(35, 23, 15, 0.9) 0%, rgba(249, 116, 21, 0.4) 100%); }
    </style>
</head>
<body class="bg-background-light text-slate-900 font-display">
<div class="relative flex min-h-screen w-full flex-col">
    <?php include __DIR__ . '/includes/header.php'; ?>

    <!-- Hero -->
    <div class="relative w-full h-[320px] overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo htmlspecialchars($baseUrl); ?>/assets/images/kabab-template.jpg');"></div>
        <div class="absolute inset-0 hero-gradient"></div>
        <div class="relative h-full flex flex-col justify-center px-6 md:px-20 max-w-[1200px] mx-auto text-white">
            <nav class="flex items-center gap-2 text-primary/80 mb-6 uppercase tracking-widest text-xs font-bold">
                <a class="hover:text-white transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/">Home</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span class="text-white">Pricing</span>
            </nav>
            <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight">Simple, Transparent Pricing</h1>
            <p class="text-lg md:text-xl text-slate-200 max-w-2xl font-light leading-relaxed">Choose the plan that fits your restaurant. Start free, upgrade when you're ready.</p>
        </div>
    </div>

    <!-- Content -->
    <main class="bg-white py-12 md:py-20 px-6 md:px-20">
        <div class="max-w-6xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Starter -->
                <div class="border border-slate-200 rounded-2xl p-8 flex flex-col bg-white shadow-sm hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Starter</h3>
                    <p class="text-slate-600 text-sm mb-6">Perfect for small cafés and single-location restaurants.</p>
                    <div class="mb-6">
                        <span class="text-3xl font-black text-slate-900">₦9,999</span>
                        <span class="text-slate-500">/month</span>
                    </div>
                    <ul class="space-y-3 text-slate-600 text-sm mb-8 flex-grow">
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Up to 5 categories</li>
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Up to 50 menu items</li>
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> 1 template</li>
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> QR code</li>
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Email support</li>
                    </ul>
                    <a href="<?php echo htmlspecialchars($authUrl); ?>" class="block w-full text-center py-3 px-6 border-2 border-primary text-primary font-bold rounded-lg hover:bg-primary hover:text-white transition-all">Get Started</a>
                </div>
                <!-- Professional (featured) -->
                <div class="border-2 border-primary rounded-2xl p-8 flex flex-col bg-white shadow-lg relative">
                    <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-primary text-white text-xs font-bold px-3 py-1 rounded-full">Most Popular</span>
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Professional</h3>
                    <p class="text-slate-600 text-sm mb-6">For growing restaurants and multi-location brands.</p>
                    <div class="mb-6">
                        <span class="text-3xl font-black text-slate-900">₦24,999</span>
                        <span class="text-slate-500">/month</span>
                    </div>
                    <ul class="space-y-3 text-slate-600 text-sm mb-8 flex-grow">
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Up to 20 categories</li>
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Up to 300 menu items</li>
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> All templates</li>
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Food ordering</li>
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Priority support</li>
                    </ul>
                    <a href="<?php echo htmlspecialchars($authUrl); ?>" class="block w-full text-center py-3 px-6 bg-primary text-white font-bold rounded-lg hover:bg-primary/90 transition-all">Get Started</a>
                </div>
                <!-- Enterprise -->
                <div class="border border-slate-200 rounded-2xl p-8 flex flex-col bg-white shadow-sm hover:shadow-lg transition-shadow">
                    <h3 class="text-xl font-bold text-slate-900 mb-2">Enterprise</h3>
                    <p class="text-slate-600 text-sm mb-6">For large operations and custom needs.</p>
                    <div class="mb-6">
                        <span class="text-3xl font-black text-slate-900">Custom</span>
                    </div>
                    <ul class="space-y-3 text-slate-600 text-sm mb-8 flex-grow">
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Unlimited categories</li>
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Unlimited menu items</li>
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Custom domain</li>
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Dedicated support</li>
                        <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Custom features</li>
                    </ul>
                    <a href="<?php echo htmlspecialchars($baseUrl); ?>/contact.php" class="block w-full text-center py-3 px-6 border-2 border-slate-200 text-slate-700 font-bold rounded-lg hover:bg-slate-50 transition-all">Contact Sales</a>
                </div>
            </div>
            <p class="text-center text-slate-500 text-sm mt-10">All plans include a free trial. No credit card required. Annual billing saves 20%.</p>
        </div>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>
</div>
</body>
</html>
