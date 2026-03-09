<?php
/**
 * Home Page - SigSol Resmenu Marketing
 */
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/subscription.php';

$siteSettings = getSiteSettings();
$siteName = htmlspecialchars($siteSettings['site_name'] ?? 'SigSol Resmenu');
$baseUrl = defined('SITE_URL') ? rtrim(SITE_URL, '/') : '';
$registerBaseUrl = defined('BACKEND_URL') ? rtrim(BACKEND_URL, '/') . '/register.php' : 'https://our-menu.online/register.php';

global $pdo;
$pdo = getDBConnection();

// Brand display: "SigSol Resmenu" with last word in orange
$brandParts = explode(' ', $siteName);
$brandLast = array_pop($brandParts);
$brandFirst = implode(' ', $brandParts) ?: '';

$plans = getSubscriptionPlans(true);
// Feature keys and display labels (must match subscription_plans.features JSON)
$planFeatureLabels = [
    'priority_support' => 'Priority support',
    'custom_domain' => 'Custom domain',
    'analytics_advanced' => 'Advanced analytics',
    'food_ordering' => 'Food ordering',
    'table_reservations' => 'Table reservations',
];
$restaurantCount = 0;
if ($pdo) {
    $stmt = $pdo->query("SELECT COUNT(*) FROM restaurants WHERE is_active = 1");
    $restaurantCount = (int)$stmt->fetchColumn();
}
$restaurantCountDisplay = $restaurantCount > 0 ? $restaurantCount : 500;

function formatPriceDisplay($amount) {
    return '₦' . number_format((float)$amount, 0);
}

function buildPlanSignupUrl($registerBaseUrl, $planSlug, $cycle = 'monthly') {
    $checkoutPath = '/manager/checkout.php?' . http_build_query([
        'plan' => (string)$planSlug,
        'cycle' => $cycle === 'annual' ? 'annual' : 'monthly',
    ]);
    return $registerBaseUrl . '?' . http_build_query([
        'plan' => (string)$planSlug,
        'cycle' => $cycle === 'annual' ? 'annual' : 'monthly',
        'next' => $checkoutPath,
    ]);
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
            transform: translateX(2.75rem);
            transition: opacity 2s cubic-bezier(0.22, 1, 0.36, 1), transform 2s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .hero-image-entrance.is-visible {
            opacity: 1;
            transform: translateX(0);
        }
        .product-card-entrance {
            opacity: 0;
            transform: translateY(28px);
            transition: opacity 1.5s cubic-bezier(0.22, 1, 0.36, 1), transform 1.5s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .product-card-entrance:nth-child(1) { transition-delay: 0.2s; }
        .product-card-entrance:nth-child(2) { transition-delay: 0.5s; }
        .product-card-entrance:nth-child(3) { transition-delay: 0.8s; }
        .product-card-entrance.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
        .about-image-entrance {
            opacity: 0;
            transform: translateX(-2.75rem);
            transition: opacity 1.8s cubic-bezier(0.22, 1, 0.36, 1), transform 1.8s cubic-bezier(0.22, 1, 0.36, 1);
        }
        .about-image-entrance.is-visible {
            opacity: 1;
            transform: translateX(0);
        }
    </style>
</head>
<body class="bg-background-light text-slate-900 selection:bg-primary/30">
<?php include __DIR__ . '/includes/header.php'; ?>
<!-- Hero Section -->
<section class="relative overflow-hidden pt-16 pb-24 lg:pt-32 lg:pb-40 bg-white">
<div class="absolute inset-0 pointer-events-none" style="background-image: url('<?php echo htmlspecialchars($baseUrl); ?>/assets/images/bg_black.png'); background-repeat: repeat; background-size: 280px 280px; opacity: 0.08;"></div>
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
<a href="<?php echo htmlspecialchars($registerBaseUrl); ?>" class="bg-primary hover:bg-primary/90 text-white px-8 py-4 rounded-xl text-lg font-bold transition-all shadow-xl shadow-primary/20">
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
<div class="product-card-entrance bg-white p-10 rounded-2xl shadow-sm hover:shadow-xl transition-all border border-slate-100 group">
<span class="material-symbols-outlined text-primary text-4xl mb-4 block group-hover:scale-110 transition-transform">palette</span>
<h3 class="text-xl font-bold text-dark-slate mb-4">Create Stunning Menus</h3>
<p class="text-slate-600 leading-relaxed">Choose from professional templates designed specifically for gastronomy. Customize to match your brand identity.</p>
</div>
<div class="product-card-entrance bg-white p-10 rounded-2xl shadow-sm hover:shadow-xl transition-all border border-slate-100 group">
<span class="material-symbols-outlined text-primary text-4xl mb-4 block group-hover:scale-110 transition-transform">sync</span>
<h3 class="text-xl font-bold text-dark-slate mb-4">Update Instantly</h3>
<p class="text-slate-600 leading-relaxed">Change prices, update daily specials, and mark items as "sold out" in real-time without costly reprints.</p>
</div>
<div class="product-card-entrance bg-white p-10 rounded-2xl shadow-sm hover:shadow-xl transition-all border border-slate-100 group">
<span class="material-symbols-outlined text-primary text-4xl mb-4 block group-hover:scale-110 transition-transform">smartphone</span>
<h3 class="text-xl font-bold text-dark-slate mb-4">Mobile-First Experience</h3>
<p class="text-slate-600 leading-relaxed">Perfectly optimized for every smartphone screen. No app download required for your hungry guests.</p>
</div>
</div>
</div>
</section>
<!-- About Section -->
<section class="py-24 bg-slate-50 border-y border-slate-100">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col lg:flex-row items-center gap-16">
<div class="w-full lg:w-1/2">
            <img src="<?php echo $baseUrl; ?>/assets/images/tablet_mockup.png" alt="Dashboard on tablet" class="w-full h-auto max-w-xl lg:max-w-2xl mx-auto about-image-entrance"/>
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
<span class="material-symbols-outlined text-primary text-4xl mb-4 block group-hover:scale-110 transition-transform">shopping_bag</span>
<h3 class="font-bold text-dark-slate mb-2">Food Ordering System</h3>
<p class="text-sm text-slate-600">Let guests order directly from your digital menu. Streamlined ordering and kitchen flow.</p>
</div>
<div class="p-8 rounded-2xl border border-slate-100 hover:border-primary/20 hover:bg-primary/5 transition-all group">
<span class="material-symbols-outlined text-primary text-4xl mb-4 block group-hover:scale-110 transition-transform">event_available</span>
<h3 class="font-bold text-dark-slate mb-2">Reservation System</h3>
<p class="text-sm text-slate-600">Accept table reservations online. Reduce no-shows and manage your floor with ease.</p>
</div>
<div class="p-8 rounded-2xl border border-slate-100 hover:border-primary/20 hover:bg-primary/5 transition-all group">
<span class="material-symbols-outlined text-primary text-4xl mb-4 block group-hover:scale-110 transition-transform">mail</span>
<h3 class="font-bold text-dark-slate mb-2">Real-Time Email Notification</h3>
<p class="text-sm text-slate-600">Get instant email alerts for new orders, reservations, and important updates.</p>
</div>
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
<div class="relative bg-dark-slate rounded-[2rem] p-12 lg:p-20 flex flex-col lg:flex-row gap-12 items-center overflow-hidden">
<div class="pointer-events-none absolute inset-0 opacity-10" style="background-image: url('<?php echo $baseUrl; ?>/assets/images/bh_pattern-orange.png'); background-repeat: repeat; background-size: 280px 280px;"></div>
<div class="relative z-10 flex flex-col lg:flex-row gap-12 items-center w-full">
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
</div>
</section>
<!-- Pricing Section (same layout and design as pricing page) -->
<section id="pricing" class="py-16 md:py-20 px-4 sm:px-6 lg:px-8 bg-white">
<div class="max-w-7xl mx-auto">
<div class="text-center mb-10">
<h2 class="text-4xl font-heading font-bold text-dark-slate mb-4">Simple, Transparent Pricing</h2>
<p class="text-slate-600">No hidden fees. Choose the plan that fits your business needs.</p>
<div class="mt-8 flex justify-center">
<div class="inline-flex items-center rounded-xl bg-slate-100 p-1 shadow-sm" id="homePricingToggle">
<button type="button" class="pricing-cycle-toggle-btn rounded-lg bg-white px-5 py-2 text-sm font-bold text-dark-slate shadow-sm" data-cycle="monthly">Monthly</button>
<button type="button" class="pricing-cycle-toggle-btn rounded-lg px-5 py-2 text-sm font-bold text-slate-600" data-cycle="annual">Yearly</button>
</div>
</div>
</div>
<?php if (!empty($plans)): ?>
<div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
<?php foreach ($plans as $plan):
    $slug = $plan['slug'] ?? '';
    $isFeatured = $slug === 'professional';
    $isEnterprise = $slug === 'enterprise';
    $monthlyPrice = (float)($plan['monthly_price'] ?? 0);
    $annualPrice = (float)($plan['annual_price'] ?? 0);
    $yearlyDiscountPercent = (int)($plan['yearly_discount_percent'] ?? 20);
    $maxCat = (int)($plan['max_categories'] ?? 0);
    $maxItems = (int)($plan['max_menu_items'] ?? 0);
    $maxQr = (int)($plan['max_qr_styles'] ?? 0);
    $maxTpl = (int)($plan['max_templates'] ?? 0);
    $catD = $maxCat === -1 ? 'Unlimited' : $maxCat;
    $itemsD = $maxItems === -1 ? 'Unlimited' : number_format($maxItems);
    $qrD = $maxQr === -1 ? 'Unlimited' : $maxQr;
    $tplD = $maxTpl === -1 ? 'All' : $maxTpl;
    $desc = $plan['description'] ?? ($isEnterprise ? 'For large operations and custom needs.' : ($isFeatured ? 'For growing restaurants and multi-location brands.' : 'Perfect for small cafés and single-location restaurants.'));
    $monthlySignupUrl = buildPlanSignupUrl($registerBaseUrl, $slug, 'monthly');
    $annualSignupUrl = buildPlanSignupUrl($registerBaseUrl, $slug, 'annual');
?>
<div class="border rounded-2xl p-8 flex flex-col h-full bg-white border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-lg transition-all <?php echo $isFeatured ? 'border-2 border-primary shadow-xl relative md:-mt-2 md:mb-2' : ''; ?>">
<?php if ($isFeatured): ?><span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-primary text-white text-xs font-bold px-3 py-1 rounded-full">Most Popular</span><?php endif; ?>
<h3 class="text-xl font-heading font-bold text-dark-slate dark:text-white mb-2"><?php echo htmlspecialchars($plan['name']); ?></h3>
<p class="text-slate-600 dark:text-slate-400 text-sm mb-6"><?php echo htmlspecialchars($desc); ?></p>
<div class="mb-8">
<?php if ($monthlyPrice <= 0 && $annualPrice <= 0): ?>
<span class="text-3xl font-black text-dark-slate dark:text-white">Custom</span>
<?php else: ?>
<div class="flex items-baseline gap-1">
<span class="text-3xl font-black text-dark-slate dark:text-white plan-price-amount" data-monthly="<?php echo htmlspecialchars(formatPriceDisplay($monthlyPrice)); ?>" data-annual="<?php echo htmlspecialchars(formatPriceDisplay($annualPrice)); ?>"><?php echo formatPriceDisplay($monthlyPrice); ?></span>
<span class="text-slate-500 dark:text-slate-400 plan-price-period">/month</span>
</div>
<?php if ($annualPrice > 0 || $monthlyPrice > 0): ?>
<p class="text-sm mt-1 mb-0" style="min-height:1.25rem;">
<span class="hidden text-slate-500" data-cycle-hint="monthly">Billed monthly</span>
<span class="hidden text-green-600 font-medium plan-save-percent" data-cycle-hint="annual">Save <?php echo $yearlyDiscountPercent; ?>% off</span>
</p>
<?php endif; ?>
<?php endif; ?>
</div>
<ul class="space-y-3 text-slate-600 dark:text-slate-400 text-sm mb-8 flex-grow">
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> <?php echo $catD; ?> categories</li>
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> <?php echo $itemsD; ?> menu items</li>
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> <?php echo $qrD; ?> QR theme<?php echo (int)$maxQr !== 1 ? 's' : ''; ?></li>
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> <?php echo $tplD; ?> template<?php echo (int)$maxTpl !== 1 ? 's' : ''; ?></li>
<?php $feats = $plan['features'] ?? []; foreach ($planFeatureLabels as $key => $label): $enabled = !empty($feats[$key]); ?>
<li class="flex items-center gap-2"><?php if ($enabled): ?><span class="material-symbols-outlined text-primary text-lg">check_circle</span><?php else: ?><span class="material-symbols-outlined text-slate-300 dark:text-slate-600 text-lg">check_circle</span><?php endif; ?> <?php echo htmlspecialchars($label); ?></li>
<?php endforeach; ?>
<?php if (empty($feats['priority_support'])): ?><li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Email support</li><?php endif; ?>
</ul>
<a href="<?php echo htmlspecialchars($monthlySignupUrl); ?>" data-monthly-url="<?php echo htmlspecialchars($monthlySignupUrl); ?>" data-annual-url="<?php echo htmlspecialchars($annualSignupUrl); ?>" class="choose-plan-link block w-full text-center py-3 px-6 rounded-xl font-bold transition-all mt-auto <?php echo $isFeatured ? 'bg-primary text-white hover:bg-primary/90' : 'border-2 border-primary text-primary hover:bg-primary hover:text-white'; ?>">Choose <?php echo htmlspecialchars($plan['name']); ?></a>
</div>
<?php endforeach; ?>
</div>
<?php else: ?>
<!-- Fallback when no plans in DB -->
<div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
<div class="border border-slate-200 rounded-2xl p-8 flex flex-col h-full bg-white shadow-sm">
<h3 class="text-xl font-bold text-dark-slate mb-2">Starter</h3>
<p class="text-slate-600 text-sm mb-6">Perfect for small cafés and single-location restaurants.</p>
<div class="mb-6"><span class="text-3xl font-black text-dark-slate plan-price-amount" data-monthly="₦9,999" data-annual="₦95,990">₦9,999</span><span class="text-slate-500 plan-price-period">/month</span></div>
<ul class="space-y-3 text-slate-600 text-sm mb-8 flex-grow">
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> 5 categories</li>
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> 50 menu items</li>
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> 1 QR theme</li>
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> 3 templates</li>
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Email support</li>
</ul>
<a href="<?php echo htmlspecialchars(buildPlanSignupUrl($registerBaseUrl, 'starter', 'monthly')); ?>" data-monthly-url="<?php echo htmlspecialchars(buildPlanSignupUrl($registerBaseUrl, 'starter', 'monthly')); ?>" data-annual-url="<?php echo htmlspecialchars(buildPlanSignupUrl($registerBaseUrl, 'starter', 'annual')); ?>" class="choose-plan-link block w-full text-center py-3 px-6 border-2 border-primary text-primary font-bold rounded-xl hover:bg-primary hover:text-white transition-all mt-auto">Choose Starter</a>
</div>
<div class="border-2 border-primary rounded-2xl p-8 flex flex-col h-full bg-white shadow-xl relative md:-mt-2 md:mb-2">
<span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-primary text-white text-xs font-bold px-3 py-1 rounded-full">Most Popular</span>
<h3 class="text-xl font-bold text-dark-slate mb-2">Professional</h3>
<p class="text-slate-600 text-sm mb-6">For growing restaurants and multi-location brands.</p>
<div class="mb-6"><span class="text-3xl font-black text-dark-slate plan-price-amount" data-monthly="₦24,999" data-annual="₦239,990">₦24,999</span><span class="text-slate-500 plan-price-period">/month</span></div>
<ul class="space-y-3 text-slate-600 text-sm mb-8 flex-grow">
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> 20 categories</li>
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> 300 menu items</li>
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> All QR themes</li>
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> All templates</li>
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Food ordering</li>
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Priority support</li>
</ul>
<a href="<?php echo htmlspecialchars(buildPlanSignupUrl($registerBaseUrl, 'professional', 'monthly')); ?>" data-monthly-url="<?php echo htmlspecialchars(buildPlanSignupUrl($registerBaseUrl, 'professional', 'monthly')); ?>" data-annual-url="<?php echo htmlspecialchars(buildPlanSignupUrl($registerBaseUrl, 'professional', 'annual')); ?>" class="choose-plan-link block w-full text-center py-3 px-6 bg-primary text-white font-bold rounded-xl hover:bg-primary/90 transition-all mt-auto">Choose Professional</a>
</div>
<div class="border border-slate-200 rounded-2xl p-8 flex flex-col h-full bg-white shadow-sm">
<h3 class="text-xl font-bold text-dark-slate mb-2">Enterprise</h3>
<p class="text-slate-600 text-sm mb-6">For large operations and custom needs.</p>
<div class="mb-6"><span class="text-3xl font-black text-dark-slate plan-price-amount" data-monthly="Custom" data-annual="Custom">Custom</span><span class="text-slate-500 plan-price-period"></span></div>
<ul class="space-y-3 text-slate-600 text-sm mb-8 flex-grow">
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Unlimited categories</li>
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Unlimited menu items</li>
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Custom domain</li>
<li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Dedicated support</li>
</ul>
<a href="<?php echo htmlspecialchars(buildPlanSignupUrl($registerBaseUrl, 'enterprise', 'monthly')); ?>" data-monthly-url="<?php echo htmlspecialchars(buildPlanSignupUrl($registerBaseUrl, 'enterprise', 'monthly')); ?>" data-annual-url="<?php echo htmlspecialchars(buildPlanSignupUrl($registerBaseUrl, 'enterprise', 'annual')); ?>" class="choose-plan-link block w-full text-center py-3 px-6 border-2 border-slate-200 text-dark-slate font-bold rounded-xl hover:bg-slate-50 transition-all mt-auto">Choose Enterprise</a>
</div>
</div>
<?php endif; ?>
<p class="text-center text-slate-500 text-sm mt-10">All plans include a free trial. No credit card required. Annual billing saves up to 20%.</p>
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
<section class="py-24 bg-primary relative overflow-hidden">
<div class="pointer-events-none absolute inset-0 opacity-10" style="background-image: url('<?php echo htmlspecialchars($baseUrl); ?>/assets/images/bg_black.png'); background-repeat: repeat; background-size: 280px 280px;"></div>
<div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
<h2 class="text-4xl lg:text-5xl font-black text-white mb-8 leading-tight">Ready to Transform Your <br/>Restaurant Menu?</h2>
<div class="flex flex-wrap justify-center gap-4">
<a href="<?php echo htmlspecialchars($registerBaseUrl); ?>" class="bg-dark-slate text-white px-10 py-5 rounded-xl text-lg font-bold hover:bg-dark-slate/90 transition-all shadow-2xl">
                    Get Started Now
                </a>
                    <a href="<?php echo htmlspecialchars($registerBaseUrl); ?>" class="bg-white/10 text-white border border-white/30 px-10 py-5 rounded-xl text-lg font-bold hover:bg-white/20 transition-all">
                        Start Free Trial
                </a>
</div>
<p class="mt-8 text-white/80 font-medium">No credit card required. Cancel anytime.</p>
</div>
</div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
<script>
(function() {
    var animatedSelectors = '.hero-image-entrance, .product-card-entrance, .about-image-entrance';
    var elements = document.querySelectorAll(animatedSelectors);
    if (!elements.length) return;

    // Fallback for very old browsers
    if (!('IntersectionObserver' in window)) {
        elements.forEach(function(el) {
            el.classList.add('is-visible');
        });
        return;
    }

    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.25,
        rootMargin: '0px 0px -10% 0px'
    });

    elements.forEach(function(el) {
        observer.observe(el);
    });
})();

(function() {
    var toggleRoot = document.getElementById('homePricingToggle');
    if (!toggleRoot) return;
    var buttons = toggleRoot.querySelectorAll('.pricing-cycle-toggle-btn');
    var currentCycle = 'monthly';

    function renderCycle(cycle) {
        currentCycle = cycle === 'annual' ? 'annual' : 'monthly';
        var amounts = document.querySelectorAll('#pricing .plan-price-amount');
        var periods = document.querySelectorAll('#pricing .plan-price-period');
        var ctaLinks = document.querySelectorAll('#pricing .choose-plan-link');

        for (var i = 0; i < amounts.length; i++) {
            var amount = amounts[i].getAttribute('data-' + currentCycle);
            if (amount) amounts[i].textContent = amount;
        }
        for (var j = 0; j < periods.length; j++) {
            periods[j].textContent = currentCycle === 'annual' ? '/yr' : '/mo';
        }
        for (var k = 0; k < ctaLinks.length; k++) {
            var link = ctaLinks[k];
            var href = link.getAttribute('data-' + currentCycle + '-url');
            if (href) link.setAttribute('href', href);
        }
        for (var m = 0; m < buttons.length; m++) {
            var isActive = buttons[m].getAttribute('data-cycle') === currentCycle;
            buttons[m].classList.toggle('bg-white', isActive);
            buttons[m].classList.toggle('text-dark-slate', isActive);
            buttons[m].classList.toggle('shadow-sm', isActive);
            buttons[m].classList.toggle('text-slate-600', !isActive);
        }
        var savePercents = document.querySelectorAll('#pricing .plan-save-percent');
        for (var s = 0; s < savePercents.length; s++) {
            savePercents[s].style.display = currentCycle === 'annual' ? '' : 'none';
        }
        var hintsMonthly = document.querySelectorAll('#pricing [data-cycle-hint="monthly"]');
        var hintsAnnual = document.querySelectorAll('#pricing [data-cycle-hint="annual"]');
        for (var h1 = 0; h1 < hintsMonthly.length; h1++) hintsMonthly[h1].classList.toggle('hidden', currentCycle !== 'monthly');
        for (var h2 = 0; h2 < hintsAnnual.length; h2++) hintsAnnual[h2].classList.toggle('hidden', currentCycle !== 'annual');
    }

    for (var n = 0; n < buttons.length; n++) {
        buttons[n].addEventListener('click', function() {
            renderCycle(this.getAttribute('data-cycle') || 'monthly');
        });
    }
    renderCycle('monthly');
})();
</script>
</body>
</html>
