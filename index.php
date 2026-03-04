<?php
/**
 * Home Page - SigSol Resmenu Marketing
 */
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/subscription.php';

$siteSettings = getSiteSettings();
$siteName = htmlspecialchars($siteSettings['site_name'] ?? 'SigSol Resmenu');
$baseUrl = defined('SITE_URL') ? rtrim(SITE_URL, '/') : '';
$authUrl = defined('BACKEND_URL') ? rtrim(BACKEND_URL, '/') . '/' : 'https://our-menu.online/';

global $pdo;
$pdo = getDBConnection();

// Brand display: "SigSol Resmenu" with last word in orange
$brandParts = explode(' ', $siteName);
$brandLast = array_pop($brandParts);
$brandFirst = implode(' ', $brandParts) ?: '';

$plans = getSubscriptionPlans(true);
$restaurantCount = 0;
if ($pdo) {
    $stmt = $pdo->query("SELECT COUNT(*) FROM restaurants WHERE is_active = 1");
    $restaurantCount = (int)$stmt->fetchColumn();
}
$restaurantCountDisplay = $restaurantCount > 0 ? $restaurantCount : 500;

function formatPriceDisplay($amount) {
    return '₦' . number_format((float)$amount, 0);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title><?php echo htmlspecialchars($siteName); ?> | Modern Digital Menus</title>
<meta name="description" content="Create beautiful digital menus for your restaurant. Easy to use, customizable templates, and powerful features.">
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;700;900&amp;family=Inter:wght@400;500;600&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
                    fontFamily: {
                        "display": ["Inter", "sans-serif"],
                        "heading": ["Poppins", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.5rem",
                        "lg": "1rem",
                        "xl": "1.5rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
<style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4 { font-family: 'Poppins', sans-serif; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .hero-image-entrance {
            opacity: 0;
            transform: translateX(2.5rem);
            animation: heroImageIn 1s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }
        @keyframes heroImageIn {
            to { opacity: 1; transform: translateX(0); }
        }
    </style>
</head>
<body class="bg-background-light text-slate-900 selection:bg-primary/30">
<?php include __DIR__ . '/includes/header.php'; ?>
<!-- Hero Section -->
<section class="relative overflow-hidden pt-16 pb-24 lg:pt-32 lg:pb-40 bg-white">
<div class="absolute inset-0 pointer-events-none" style="background-image: url('https://our-menu.online/templates/template4/bg_black.png'); background-repeat: repeat; background-size: 280px 280px; opacity: 0.08;"></div>
<div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="flex flex-col lg:flex-row items-center gap-16">
<div class="w-full lg:w-1/2 space-y-8 order-2 lg:order-1">
<div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary/10 text-primary text-xs font-bold uppercase tracking-wider">
<span class="relative flex h-2 w-2">
<span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
<span class="relative inline-flex rounded-full h-2 w-2 bg-primary"></span>
</span>
                        New: Contactless Ordering 2.0
                    </div>
<h1 class="text-3xl lg:text-5xl font-black leading-tight text-dark-slate tracking-tight">
                        Beautiful Digital Menus That <span class="text-primary underline decoration-primary/20">Elevate</span> Your Restaurant
                    </h1>
<p class="text-xl text-slate-600 leading-relaxed max-w-xl">
                        Trusted by restaurants, cafés, and hospitality brands. Streamline your operations with our professional digital menu solution.
                    </p>
<div class="flex flex-wrap gap-4">
<a href="<?php echo htmlspecialchars($authUrl); ?>" class="bg-primary hover:bg-primary/90 text-white px-8 py-4 rounded-xl text-lg font-bold transition-all shadow-xl shadow-primary/20">
                            Get Started Free
                        </a>
<a href="<?php echo $baseUrl; ?>/templates.php" class="bg-slate-100 hover:bg-slate-200 text-dark-slate px-8 py-4 rounded-xl text-lg font-bold transition-all">
                            View Demo
                        </a>
</div>
<div class="pt-4 flex items-center gap-4 text-sm text-slate-500 font-medium border-t border-slate-100">
<div class="flex -space-x-2">
<div class="w-8 h-8 rounded-full border-2 border-white bg-primary overflow-hidden flex items-center justify-center">
<img src="https://our-menu.online/uploads/logos/698ee78360beb.jpg" alt="Restaurant logo 1" class="w-full h-full object-contain"/>
</div>
<div class="w-8 h-8 rounded-full border-2 border-white bg-primary overflow-hidden flex items-center justify-center">
<img src="https://our-menu.online/uploads/logos/69459eb555362.jpg" alt="Restaurant logo 2" class="w-full h-full object-contain"/>
</div>
<div class="w-8 h-8 rounded-full border-2 border-white bg-primary overflow-hidden flex items-center justify-center">
<img src="https://our-menu.online/uploads/logos/69a76f2ad31b1.png" alt="Restaurant logo 3" class="w-full h-full object-contain"/>
</div>
</div>
                        Join <?php echo $restaurantCountDisplay; ?>+ restaurants growing with <?php echo htmlspecialchars($brandLast); ?>
                    </div>
</div>
<div class="w-full lg:w-1/2 relative order-1 lg:order-2">
<img src="<?php echo $baseUrl; ?>/assets/images/3-devices-black.png" alt="Digital menu on multiple devices" class="w-full h-auto hero-image-entrance"/>
</div>
</div>
</div>
</section>
<!-- Product Overview -->
<section class="py-24 bg-background-light">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-16">
<h2 class="text-4xl font-bold text-dark-slate mb-4">Everything You Need to Run a Modern Menu</h2>
<p class="text-lg text-slate-600 max-w-2xl mx-auto">Our platform provides all the tools necessary to create and manage a high-end digital dining experience that delights customers.</p>
</div>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="grid md:grid-cols-3 gap-8">
<div class="bg-white p-10 rounded-2xl shadow-sm hover:shadow-xl transition-all border border-slate-100 group">
<div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
<span class="material-symbols-outlined text-3xl">palette</span>
</div>
<h3 class="text-xl font-bold text-dark-slate mb-4">Create Stunning Menus</h3>
<p class="text-slate-600 leading-relaxed">Choose from professional templates designed specifically for gastronomy. Customize to match your brand identity.</p>
</div>
<div class="bg-white p-10 rounded-2xl shadow-sm hover:shadow-xl transition-all border border-slate-100 group">
<div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
<span class="material-symbols-outlined text-3xl">sync</span>
</div>
<h3 class="text-xl font-bold text-dark-slate mb-4">Update Instantly</h3>
<p class="text-slate-600 leading-relaxed">Change prices, update daily specials, and mark items as "sold out" in real-time without costly reprints.</p>
</div>
<div class="bg-white p-10 rounded-2xl shadow-sm hover:shadow-xl transition-all border border-slate-100 group">
<div class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center text-primary mb-6 group-hover:bg-primary group-hover:text-white transition-colors">
<span class="material-symbols-outlined text-3xl">smartphone</span>
</div>
<h3 class="text-xl font-bold text-dark-slate mb-4">Mobile-First Experience</h3>
<p class="text-slate-600 leading-relaxed">Perfectly optimized for every smartphone screen. No app download required for your hungry guests.</p>
</div>
</div>
</div>
</section>
<!-- About Section -->
<section class="py-24 bg-slate-50 border-y border-slate-100">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center gap-16">
<div class="w-full lg:w-1/2 rounded-3xl overflow-hidden shadow-2xl aspect-video bg-slate-300">
<img src="<?php echo $baseUrl; ?>/assets/images/5zm3C5SMKk7sgdYHRUP5eAlb86fe9.jpg" alt="Restaurant staff using digital menu" class="w-full h-full object-cover"/>
</div>
<div class="w-full lg:w-1/2 space-y-6">
<h2 class="text-4xl font-black text-dark-slate leading-tight">Built for Restaurants. <br/><span class="text-primary">Designed for Growth.</span></h2>
<p class="text-lg text-slate-600">
                    We understand the fast-paced nature of the hospitality industry. <?php echo htmlspecialchars($siteName); ?> was built from the ground up to simplify your daily operations, letting you focus on what matters most: the food and the guests.
                </p>
<div class="space-y-4">
<div class="flex items-start gap-3">
<span class="material-symbols-outlined text-primary">check_circle</span>
<div>
<span class="font-bold text-dark-slate">Scalable Infrastructure</span>
<p class="text-sm text-slate-500">From a single food truck to a global franchise.</p>
</div>
</div>
<div class="flex items-start gap-3">
<span class="material-symbols-outlined text-primary">check_circle</span>
<div>
<span class="font-bold text-dark-slate">Simplified Workflow</span>
<p class="text-sm text-slate-500">Easy-to-use interface that requires zero technical knowledge.</p>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- Features Grid -->
<section class="py-24 bg-white">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-16">
<h2 class="text-4xl font-bold text-dark-slate mb-4">Powerful Features for Your Success</h2>
</div>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
<div class="p-8 rounded-2xl border border-slate-100 hover:border-primary/20 hover:bg-primary/5 transition-all group">
<span class="material-symbols-outlined text-primary text-4xl mb-4 block group-hover:scale-110 transition-transform">dashboard_customize</span>
<h3 class="font-bold text-dark-slate mb-2">Beautiful Templates</h3>
<p class="text-sm text-slate-600">Custom designs that fit your restaurant's unique vibe.</p>
</div>
<div class="p-8 rounded-2xl border border-slate-100 hover:border-primary/20 hover:bg-primary/5 transition-all group">
<span class="material-symbols-outlined text-primary text-4xl mb-4 block group-hover:scale-110 transition-transform">admin_panel_settings</span>
<h3 class="font-bold text-dark-slate mb-2">Easy Dashboard</h3>
<p class="text-sm text-slate-600">Centralized control for all your menu settings.</p>
</div>
<div class="p-8 rounded-2xl border border-slate-100 hover:border-primary/20 hover:bg-primary/5 transition-all group">
<span class="material-symbols-outlined text-primary text-4xl mb-4 block group-hover:scale-110 transition-transform">account_tree</span>
<h3 class="font-bold text-dark-slate mb-2">Multi-Branch Support</h3>
<p class="text-sm text-slate-600">Manage all your locations from a single account.</p>
</div>
<div class="p-8 rounded-2xl border border-slate-100 hover:border-primary/20 hover:bg-primary/5 transition-all group">
<span class="material-symbols-outlined text-primary text-4xl mb-4 block group-hover:scale-110 transition-transform">category</span>
<h3 class="font-bold text-dark-slate mb-2">Item Management</h3>
<p class="text-sm text-slate-600">Organize dishes into categories with ease.</p>
</div>
<div class="p-8 rounded-2xl border border-slate-100 hover:border-primary/20 hover:bg-primary/5 transition-all group">
<span class="material-symbols-outlined text-primary text-4xl mb-4 block group-hover:scale-110 transition-transform">image</span>
<h3 class="font-bold text-dark-slate mb-2">Image Support</h3>
<p class="text-sm text-slate-600">High-resolution visuals to make mouths water.</p>
</div>
<div class="p-8 rounded-2xl border border-slate-100 hover:border-primary/20 hover:bg-primary/5 transition-all group">
<span class="material-symbols-outlined text-primary text-4xl mb-4 block group-hover:scale-110 transition-transform">qr_code</span>
<h3 class="font-bold text-dark-slate mb-2">QR Code Integration</h3>
<p class="text-sm text-slate-600">Custom branded QR codes for your tables.</p>
</div>
<div class="p-8 rounded-2xl border border-slate-100 hover:border-primary/20 hover:bg-primary/5 transition-all group">
<span class="material-symbols-outlined text-primary text-4xl mb-4 block group-hover:scale-110 transition-transform">bolt</span>
<h3 class="font-bold text-dark-slate mb-2">Real-Time Updates</h3>
<p class="text-sm text-slate-600">Changes reflect instantly on your customers' devices.</p>
</div>
<div class="p-8 rounded-2xl border border-slate-100 hover:border-primary/20 hover:bg-primary/5 transition-all group">
<span class="material-symbols-outlined text-primary text-4xl mb-4 block group-hover:scale-110 transition-transform">security</span>
<h3 class="font-bold text-dark-slate mb-2">Secure &amp; Reliable</h3>
<p class="text-sm text-slate-600">Enterprise-grade security and 99.9% uptime.</p>
</div>
</div>
</div>
</section>
<!-- Why Choose Us -->
<section class="py-24 bg-background-light">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="bg-dark-slate rounded-[2rem] p-12 lg:p-20 flex flex-col lg:flex-row gap-12 items-center">
<div class="lg:w-1/2 text-white">
<h2 class="text-4xl font-bold mb-8">Why Restaurants Choose <br/>Our Platform</h2>
<div class="space-y-6">
<div class="flex items-center gap-4">
<div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center">
<span class="material-symbols-outlined text-white">check</span>
</div>
<span class="text-lg font-medium">Reduce menu printing costs by 90%</span>
</div>
<div class="flex items-center gap-4">
<div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center">
<span class="material-symbols-outlined text-white">check</span>
</div>
<span class="text-lg font-medium">Improve customer dining experience</span>
</div>
<div class="flex items-center gap-4">
<div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center">
<span class="material-symbols-outlined text-white">check</span>
</div>
<span class="text-lg font-medium">Faster menu updates and seasonal changes</span>
</div>
<div class="flex items-center gap-4">
<div class="w-10 h-10 rounded-full bg-primary flex items-center justify-center">
<span class="material-symbols-outlined text-white">check</span>
</div>
<span class="text-lg font-medium">Eco-friendly digital-first approach</span>
</div>
</div>
</div>
<div class="lg:w-1/2 grid grid-cols-2 gap-4">
<div class="bg-white/10 backdrop-blur-sm p-6 rounded-2xl border border-white/10 text-center">
<div class="text-4xl font-black text-primary mb-1">30%</div>
<div class="text-sm text-white/70 uppercase tracking-widest font-bold">Increase in Sales</div>
</div>
<div class="bg-white/10 backdrop-blur-sm p-6 rounded-2xl border border-white/10 text-center">
<div class="text-4xl font-black text-primary mb-1">15m</div>
<div class="text-sm text-white/70 uppercase tracking-widest font-bold">Setup Time</div>
</div>
<div class="bg-white/10 backdrop-blur-sm p-6 rounded-2xl border border-white/10 text-center col-span-2">
<div class="text-4xl font-black text-primary mb-1"><?php echo $restaurantCountDisplay; ?>+</div>
<div class="text-sm text-white/70 uppercase tracking-widest font-bold">Active Venues</div>
</div>
</div>
</div>
</div>
</section>
<!-- Pricing Section -->
<section id="pricing" class="py-24 bg-white">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center mb-16">
<h2 class="text-4xl font-bold text-dark-slate mb-4">Simple, Transparent Pricing</h2>
<p class="text-slate-600">No hidden fees. Choose the plan that fits your business needs.</p>
</div>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="grid lg:grid-cols-3 gap-8">
<?php
$planIndex = 0;
foreach ($plans as $plan):
    $planIndex++;
    $isFeatured = ($plan['slug'] ?? '') === 'professional';
    $monthlyPrice = (float)($plan['monthly_price'] ?? 0);
    $annualPrice = (float)($plan['annual_price'] ?? 0);
    $maxCategories = (int)($plan['max_categories'] ?? 0);
    $maxMenuItems = (int)($plan['max_menu_items'] ?? 0);
    $maxQrStyles = (int)($plan['max_qr_styles'] ?? 0);
    $maxTemplates = (int)($plan['max_templates'] ?? 0);
    $catDisplay = $maxCategories == -1 ? 'Unlimited' : $maxCategories;
    $itemsDisplay = $maxMenuItems == -1 ? 'Unlimited' : $maxMenuItems;
    $qrDisplay = $maxQrStyles == -1 ? 'Unlimited' : $maxQrStyles;
    $tplDisplay = $maxTemplates == -1 ? 'All' : $maxTemplates;
?>
<div class="p-10 rounded-3xl border <?php echo $isFeatured ? 'border-2 border-primary shadow-2xl scale-105 relative z-10' : 'border-slate-200'; ?> bg-white hover:shadow-xl transition-all">
<?php if ($isFeatured): ?>
<div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-primary text-white px-4 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Most Popular</div>
<?php endif; ?>
<div class="text-dark-slate font-bold uppercase tracking-widest text-sm mb-4"><?php echo htmlspecialchars($plan['name']); ?></div>
<div class="flex items-baseline gap-1 mb-6">
<span class="text-4xl font-black text-dark-slate"><?php echo formatPriceDisplay($monthlyPrice); ?></span>
<span class="text-slate-500">/mo</span>
</div>
<ul class="space-y-4 mb-8 text-slate-600">
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> <?php echo $catDisplay; ?> Categories</li>
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> <?php echo $itemsDisplay; ?> Menu Items</li>
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> <?php echo $qrDisplay; ?> QR Code Themes</li>
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> <?php echo $tplDisplay; ?> Templates</li>
<?php if ($isFeatured): ?>
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Priority Support</li>
<?php endif; ?>
<?php if (($plan['slug'] ?? '') === 'enterprise'): ?>
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Custom API Access</li>
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Dedicated Manager</li>
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Custom Branding</li>
<?php endif; ?>
</ul>
<?php if (($plan['slug'] ?? '') === 'enterprise'): ?>
<a href="<?php echo $baseUrl; ?>/contact.php" class="w-full py-4 px-6 rounded-xl border-2 border-slate-200 text-dark-slate font-bold hover:bg-slate-50 transition-colors block text-center">Contact Sales</a>
<?php else: ?>
<a href="<?php echo htmlspecialchars($authUrl); ?>" class="w-full py-4 px-6 rounded-xl <?php echo $isFeatured ? 'bg-primary text-white font-bold hover:bg-primary/90 transition-all shadow-lg shadow-primary/20' : 'border-2 border-slate-200 text-dark-slate font-bold hover:bg-slate-50 transition-colors'; ?> block text-center">Choose <?php echo htmlspecialchars($plan['name']); ?></a>
<?php endif; ?>
</div>
<?php endforeach; ?>
<?php if (empty($plans)): ?>
<!-- Fallback when no plans in DB -->
<div class="p-10 rounded-3xl border border-slate-200 bg-white hover:shadow-xl transition-all">
<div class="text-dark-slate font-bold uppercase tracking-widest text-sm mb-4">Starter</div>
<div class="flex items-baseline gap-1 mb-6">
<span class="text-4xl font-black text-dark-slate">₦9,999</span>
<span class="text-slate-500">/mo</span>
</div>
<ul class="space-y-4 mb-8 text-slate-600">
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> 1 Branch</li>
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> 50 Menu Items</li>
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> 2 QR Code Themes</li>
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Basic Analytics</li>
</ul>
<a href="<?php echo htmlspecialchars($authUrl); ?>" class="w-full py-4 px-6 rounded-xl border-2 border-slate-200 text-dark-slate font-bold hover:bg-slate-50 transition-colors block text-center">Choose Starter</a>
</div>
<div class="p-10 rounded-3xl border-2 border-primary bg-white shadow-2xl scale-105 relative z-10">
<div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-primary text-white px-4 py-1 rounded-full text-xs font-bold uppercase tracking-wider">Most Popular</div>
<div class="text-dark-slate font-bold uppercase tracking-widest text-sm mb-4">Professional</div>
<div class="flex items-baseline gap-1 mb-6">
<span class="text-4xl font-black text-dark-slate">₦19,999</span>
<span class="text-slate-500">/mo</span>
</div>
<ul class="space-y-4 mb-8 text-slate-600">
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Up to 5 Branches</li>
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Unlimited Items</li>
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> All Pro Templates</li>
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Advanced Analytics</li>
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Priority Support</li>
</ul>
<a href="<?php echo htmlspecialchars($authUrl); ?>" class="w-full py-4 px-6 rounded-xl bg-primary text-white font-bold hover:bg-primary/90 transition-all shadow-lg shadow-primary/20 block text-center">Choose Professional</a>
</div>
<div class="p-10 rounded-3xl border border-slate-200 bg-white hover:shadow-xl transition-all">
<div class="text-dark-slate font-bold uppercase tracking-widest text-sm mb-4">Enterprise</div>
<div class="flex items-baseline gap-1 mb-6">
<span class="text-4xl font-black text-dark-slate">₦49,999</span>
<span class="text-slate-500">/mo</span>
</div>
<ul class="space-y-4 mb-8 text-slate-600">
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Unlimited Branches</li>
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Custom API Access</li>
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Dedicated Manager</li>
<li class="flex items-center gap-3"><span class="material-symbols-outlined text-primary text-sm">check_circle</span> Custom Branding</li>
</ul>
<a href="<?php echo $baseUrl; ?>/contact.php" class="w-full py-4 px-6 rounded-xl border-2 border-slate-200 text-dark-slate font-bold hover:bg-slate-50 transition-colors block text-center">Contact Sales</a>
</div>
<?php endif; ?>
</div>
</div>
</section>
<!-- Testimonials -->
<section class="py-24 bg-background-light">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="grid md:grid-cols-2 gap-12">
<div class="bg-white p-12 rounded-[2rem] shadow-sm relative border border-slate-100">
<span class="material-symbols-outlined text-primary/20 text-8xl absolute top-8 right-8">format_quote</span>
<div class="relative z-10">
<div class="flex items-center gap-4 mb-8">
<div class="w-16 h-16 rounded-full bg-slate-200 overflow-hidden"></div>
<div>
<div class="font-bold text-dark-slate text-xl">Tunde Bakare</div>
<div class="text-slate-500">Owner, The Lagos Grill</div>
</div>
</div>
<p class="text-xl text-slate-600 italic leading-relaxed">
                            "<?php echo htmlspecialchars($siteName); ?> completely transformed how we handle our rush hours. Updating prices takes seconds, and our customers love the beautiful photos on their phones."
                        </p>
</div>
</div>
<div class="bg-white p-12 rounded-[2rem] shadow-sm relative border border-slate-100">
<span class="material-symbols-outlined text-primary/20 text-8xl absolute top-8 right-8">format_quote</span>
<div class="relative z-10">
<div class="flex items-center gap-4 mb-8">
<div class="w-16 h-16 rounded-full bg-slate-200 overflow-hidden"></div>
<div>
<div class="font-bold text-dark-slate text-xl">Chidimma Okafor</div>
<div class="text-slate-500">Manager, Garden View Cafe</div>
</div>
</div>
<p class="text-xl text-slate-600 italic leading-relaxed">
                            "The multi-branch feature is a lifesaver. I can manage all three of our locations from my home office. It's the most professional tool we've used."
                        </p>
</div>
</div>
</div>
</div>
</section>
<!-- Final CTA -->
<section class="py-24 bg-primary">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
<h2 class="text-4xl lg:text-5xl font-black text-white mb-8 leading-tight">Ready to Transform Your <br/>Restaurant Menu?</h2>
<div class="flex flex-wrap justify-center gap-4">
<a href="<?php echo htmlspecialchars($authUrl); ?>" class="bg-dark-slate text-white px-10 py-5 rounded-xl text-lg font-bold hover:bg-dark-slate/90 transition-all shadow-2xl">
                    Get Started Now
                </a>
<a href="<?php echo $baseUrl; ?>/contact.php" class="bg-white/10 text-white border border-white/30 px-10 py-5 rounded-xl text-lg font-bold hover:bg-white/20 transition-all">
                    Request a Demo
                </a>
</div>
<p class="mt-8 text-white/80 font-medium">No credit card required. Cancel anytime.</p>
</div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
