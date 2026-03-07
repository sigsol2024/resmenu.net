<?php
/**
 * Pricing - resmenu.net
 * Plans from database; comparison table; billing and FAQ content.
 */
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/subscription.php';

$baseUrl = defined('SITE_URL') ? rtrim(SITE_URL, '/') : '';
$authUrl = defined('BACKEND_URL') ? rtrim(BACKEND_URL, '/') . '/' : 'https://our-menu.online/';
$registerBaseUrl = defined('BACKEND_URL') ? rtrim(BACKEND_URL, '/') . '/register.php' : 'https://our-menu.online/register.php';
$siteSettings = getSiteSettings();
$siteName = htmlspecialchars($siteSettings['site_name'] ?? 'Resmenu');

global $pdo;
$pdo = getDBConnection();
$plans = getSubscriptionPlans(true);

function formatPriceDisplayPricing($amount) {
    return '₦' . number_format((float)$amount, 0);
}

function buildPricingPlanSignupUrl($registerBaseUrl, $planSlug, $cycle = 'monthly') {
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Pricing - <?php echo $siteName; ?></title>
    <meta name="description" content="Pricing plans for <?php echo $siteName; ?> digital menu platform"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = { darkMode: "class", theme: { extend: { colors: { "primary": "#f97415", "background-light": "#f8f7f5", "background-dark": "#111827", "dark-slate": "#111827" }, fontFamily: { "display": ["Inter", "sans-serif"], "heading": ["Poppins", "sans-serif"] }, borderRadius: { "DEFAULT": "0.5rem", "lg": "1rem", "xl": "1.5rem", "full": "9999px" } } } }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3 { font-family: 'Poppins', sans-serif; }
        .hero-gradient { background: linear-gradient(90deg, rgba(17, 24, 39, 0.92) 0%, rgba(249, 116, 21, 0.35) 100%); }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 font-display">
<div class="relative flex min-h-screen w-full flex-col">
    <?php include __DIR__ . '/includes/header.php'; ?>

    <!-- Hero -->
    <section class="relative w-full h-[280px] md:h-[320px] flex flex-col justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img alt="Restaurant" class="w-full h-full object-cover" src="<?php echo htmlspecialchars($baseUrl); ?>/assets/images/kabab-template.jpg"/>
            <div class="absolute inset-0 hero-gradient"></div>
        </div>
        <div class="relative z-10 px-6 md:px-20">
            <nav class="flex items-center gap-2 mb-4">
                <a class="text-slate-300 text-sm hover:text-white transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/">Home</a>
                <span class="text-slate-400 text-sm">/</span>
                <span class="text-primary text-sm font-medium uppercase tracking-wider">Pricing</span>
            </nav>
            <h1 class="text-white text-4xl md:text-5xl font-heading font-bold mb-3">Simple, Transparent Pricing</h1>
            <p class="text-slate-200 text-lg max-w-2xl">Choose the plan that fits your restaurant. Start free, upgrade when you're ready. All prices in Naira (₦).</p>
        </div>
    </section>

    <!-- Plan cards (from DB) -->
    <main class="flex-1">
        <section class="py-16 md:py-20 px-4 sm:px-6 lg:px-8 bg-white dark:bg-slate-900/30">
            <div class="max-w-7xl mx-auto">
                <div class="mb-10 flex justify-center">
                    <div class="inline-flex items-center rounded-xl bg-slate-100 p-1 shadow-sm" id="pricingCycleToggle">
                        <button type="button" class="pricing-toggle-btn rounded-lg bg-white px-5 py-2 text-sm font-bold text-slate-900 shadow-sm" data-cycle="monthly">Monthly</button>
                        <button type="button" class="pricing-toggle-btn rounded-lg px-5 py-2 text-sm font-bold text-slate-600" data-cycle="annual">Yearly</button>
                    </div>
                </div>
                <?php if (!empty($plans)): ?>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <?php foreach ($plans as $plan):
                        $slug = $plan['slug'] ?? '';
                        $isFeatured = $slug === 'professional';
                        $isEnterprise = $slug === 'enterprise';
                        $monthlyPrice = (float)($plan['monthly_price'] ?? 0);
                        $annualPrice = (float)($plan['annual_price'] ?? 0);
                        $maxCat = (int)($plan['max_categories'] ?? 0);
                        $maxItems = (int)($plan['max_menu_items'] ?? 0);
                        $maxQr = (int)($plan['max_qr_styles'] ?? 0);
                        $maxTpl = (int)($plan['max_templates'] ?? 0);
                        $catD = $maxCat === -1 ? 'Unlimited' : $maxCat;
                        $itemsD = $maxItems === -1 ? 'Unlimited' : number_format($maxItems);
                        $qrD = $maxQr === -1 ? 'Unlimited' : $maxQr;
                        $tplD = $maxTpl === -1 ? 'All' : $maxTpl;
                        $desc = $plan['description'] ?? ($isEnterprise ? 'For large operations and custom needs.' : ($isFeatured ? 'For growing restaurants and multi-location brands.' : 'Perfect for small cafés and single-location restaurants.'));
                        $monthlySignupUrl = buildPricingPlanSignupUrl($registerBaseUrl, $slug, 'monthly');
                        $annualSignupUrl = buildPricingPlanSignupUrl($registerBaseUrl, $slug, 'annual');
                    ?>
                    <div class="border rounded-2xl p-8 flex flex-col bg-white dark:bg-slate-900 border-slate-200 dark:border-slate-800 shadow-sm hover:shadow-lg transition-all <?php echo $isFeatured ? 'border-2 border-primary shadow-xl relative md:-mt-2 md:mb-2' : ''; ?>">
                        <?php if ($isFeatured): ?><span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-primary text-white text-xs font-bold px-3 py-1 rounded-full">Most Popular</span><?php endif; ?>
                        <h3 class="text-xl font-heading font-bold text-slate-900 dark:text-white mb-2"><?php echo htmlspecialchars($plan['name']); ?></h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm mb-6"><?php echo htmlspecialchars($desc); ?></p>
                        <div class="mb-6">
                            <?php if ($monthlyPrice <= 0 && $annualPrice <= 0): ?>
                            <span class="text-3xl font-black text-slate-900 dark:text-white">Custom</span>
                            <?php else: ?>
                            <span class="text-3xl font-black text-slate-900 dark:text-white pricing-amount" data-monthly="<?php echo htmlspecialchars(formatPriceDisplayPricing($monthlyPrice)); ?>" data-annual="<?php echo htmlspecialchars(formatPriceDisplayPricing($annualPrice)); ?>"><?php echo formatPriceDisplayPricing($monthlyPrice); ?></span>
                            <span class="text-slate-500 dark:text-slate-400 pricing-period">/month</span>
                            <?php if ($annualPrice > 0): ?><p class="text-slate-500 dark:text-slate-400 text-sm mt-1">Billed annually available</p><?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <ul class="space-y-3 text-slate-600 dark:text-slate-400 text-sm mb-8 flex-grow">
                            <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> <?php echo $catD; ?> categories</li>
                            <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> <?php echo $itemsD; ?> menu items</li>
                            <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> <?php echo $qrD; ?> QR theme<?php echo (int)$maxQr !== 1 ? 's' : ''; ?></li>
                            <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> <?php echo $tplD; ?> template<?php echo (int)$maxTpl !== 1 ? 's' : ''; ?></li>
                            <?php if ($isFeatured || $isEnterprise): ?><li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Food ordering</li><li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Priority support</li><?php else: ?><li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Email support</li><?php endif; ?>
                            <?php if ($isEnterprise): ?><li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Custom domain</li><li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Dedicated support</li><?php endif; ?>
                        </ul>
                        <a href="<?php echo htmlspecialchars($monthlySignupUrl); ?>" data-monthly-url="<?php echo htmlspecialchars($monthlySignupUrl); ?>" data-annual-url="<?php echo htmlspecialchars($annualSignupUrl); ?>" class="pricing-plan-link block w-full text-center py-3 px-6 rounded-xl font-bold transition-all <?php echo $isFeatured ? 'bg-primary text-white hover:bg-primary/90' : 'border-2 border-primary text-primary hover:bg-primary hover:text-white'; ?>">Choose <?php echo htmlspecialchars($plan['name']); ?></a>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="border border-slate-200 dark:border-slate-800 rounded-2xl p-8 flex flex-col bg-white dark:bg-slate-900 shadow-sm">
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Starter</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm mb-6">Perfect for small cafés and single-location restaurants.</p>
                        <div class="mb-6"><span class="text-3xl font-black text-slate-900 dark:text-white pricing-amount" data-monthly="₦9,999" data-annual="₦95,990">₦9,999</span><span class="text-slate-500 pricing-period">/month</span></div>
                        <ul class="space-y-3 text-slate-600 dark:text-slate-400 text-sm mb-8 flex-grow">
                            <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Up to 5 categories</li>
                            <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Up to 50 menu items</li>
                            <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> 1 template</li>
                            <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> QR code &amp; Email support</li>
                        </ul>
                        <a href="<?php echo htmlspecialchars(buildPricingPlanSignupUrl($registerBaseUrl, 'starter', 'monthly')); ?>" data-monthly-url="<?php echo htmlspecialchars(buildPricingPlanSignupUrl($registerBaseUrl, 'starter', 'monthly')); ?>" data-annual-url="<?php echo htmlspecialchars(buildPricingPlanSignupUrl($registerBaseUrl, 'starter', 'annual')); ?>" class="pricing-plan-link block w-full text-center py-3 px-6 border-2 border-primary text-primary font-bold rounded-xl hover:bg-primary hover:text-white transition-all">Choose Starter</a>
                    </div>
                    <div class="border-2 border-primary rounded-2xl p-8 flex flex-col bg-white dark:bg-slate-900 shadow-xl relative md:-mt-2 md:mb-2">
                        <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-primary text-white text-xs font-bold px-3 py-1 rounded-full">Most Popular</span>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Professional</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm mb-6">For growing restaurants and multi-location brands.</p>
                        <div class="mb-6"><span class="text-3xl font-black text-slate-900 dark:text-white pricing-amount" data-monthly="₦24,999" data-annual="₦239,990">₦24,999</span><span class="text-slate-500 pricing-period">/month</span></div>
                        <ul class="space-y-3 text-slate-600 dark:text-slate-400 text-sm mb-8 flex-grow">
                            <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Up to 20 categories</li>
                            <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Up to 300 menu items</li>
                            <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> All templates</li>
                            <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Food ordering &amp; Priority support</li>
                        </ul>
                        <a href="<?php echo htmlspecialchars(buildPricingPlanSignupUrl($registerBaseUrl, 'professional', 'monthly')); ?>" data-monthly-url="<?php echo htmlspecialchars(buildPricingPlanSignupUrl($registerBaseUrl, 'professional', 'monthly')); ?>" data-annual-url="<?php echo htmlspecialchars(buildPricingPlanSignupUrl($registerBaseUrl, 'professional', 'annual')); ?>" class="pricing-plan-link block w-full text-center py-3 px-6 bg-primary text-white font-bold rounded-xl hover:bg-primary/90 transition-all">Choose Professional</a>
                    </div>
                    <div class="border border-slate-200 dark:border-slate-800 rounded-2xl p-8 flex flex-col bg-white dark:bg-slate-900 shadow-sm">
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2">Enterprise</h3>
                        <p class="text-slate-600 dark:text-slate-400 text-sm mb-6">For large operations and custom needs.</p>
                        <div class="mb-6"><span class="text-3xl font-black text-slate-900 dark:text-white pricing-amount" data-monthly="Custom" data-annual="Custom">Custom</span><span class="text-slate-500 pricing-period"></span></div>
                        <ul class="space-y-3 text-slate-600 dark:text-slate-400 text-sm mb-8 flex-grow">
                            <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Unlimited categories &amp; items</li>
                            <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Custom domain</li>
                            <li class="flex items-center gap-2"><span class="material-symbols-outlined text-primary text-lg">check_circle</span> Dedicated support</li>
                        </ul>
                        <a href="<?php echo htmlspecialchars(buildPricingPlanSignupUrl($registerBaseUrl, 'enterprise', 'monthly')); ?>" data-monthly-url="<?php echo htmlspecialchars(buildPricingPlanSignupUrl($registerBaseUrl, 'enterprise', 'monthly')); ?>" data-annual-url="<?php echo htmlspecialchars(buildPricingPlanSignupUrl($registerBaseUrl, 'enterprise', 'annual')); ?>" class="pricing-plan-link block w-full text-center py-3 px-6 border-2 border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300 font-bold rounded-xl hover:bg-slate-50 dark:hover:bg-slate-800 transition-all">Choose Enterprise</a>
                    </div>
                </div>
                <?php endif; ?>
                <p class="text-center text-slate-500 dark:text-slate-400 text-sm mt-10">All plans include a free trial. No credit card required. Annual billing saves 20%.</p>
            </div>
        </section>

        <!-- Comparison table -->
        <section class="py-16 md:py-20 px-4 sm:px-6 lg:px-8 border-t border-slate-200 dark:border-slate-800">
            <div class="max-w-7xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-heading font-bold text-slate-900 dark:text-white text-center mb-4">Compare Plans</h2>
                <p class="text-slate-600 dark:text-slate-400 text-center max-w-2xl mx-auto mb-12">See exactly what each plan includes so you can choose with confidence.</p>
                <div class="overflow-x-auto rounded-2xl border border-slate-200 dark:border-slate-800 shadow-sm">
                    <table class="w-full min-w-[640px] text-left">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-800/80 border-b border-slate-200 dark:border-slate-700">
                                <th class="py-4 px-4 md:px-6 font-heading font-bold text-slate-900 dark:text-white">Feature</th>
                                <?php foreach ($plans as $p): ?>
                                <th class="py-4 px-4 md:px-6 font-heading font-bold text-slate-900 dark:text-white"><?php echo htmlspecialchars($p['name']); ?></th>
                                <?php endforeach; ?>
                                <?php if (empty($plans)): ?>
                                <th class="py-4 px-4 md:px-6 font-heading font-bold text-slate-900 dark:text-white">Starter</th>
                                <th class="py-4 px-4 md:px-6 font-heading font-bold text-slate-900 dark:text-white">Professional</th>
                                <th class="py-4 px-4 md:px-6 font-heading font-bold text-slate-900 dark:text-white">Enterprise</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-slate-700 bg-white dark:bg-slate-900">
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                                <td class="py-3 px-4 md:px-6 font-medium text-slate-900 dark:text-white">Price</td>
                                <?php if (!empty($plans)): foreach ($plans as $p): ?>
                                <td class="py-3 px-4 md:px-6 text-slate-600 dark:text-slate-400 compare-price" data-monthly="<?php echo htmlspecialchars(((float)($p['monthly_price'] ?? 0)) > 0 ? formatPriceDisplayPricing($p['monthly_price']) . '/mo' : 'Custom'); ?>" data-annual="<?php echo htmlspecialchars(((float)($p['annual_price'] ?? 0)) > 0 ? formatPriceDisplayPricing($p['annual_price']) . '/yr' : 'Custom'); ?>"><?php echo ((float)($p['monthly_price'] ?? 0)) > 0 ? formatPriceDisplayPricing($p['monthly_price']) . '/mo' : 'Custom'; ?></td>
                                <?php endforeach; else: ?>
                                <td class="py-3 px-4 md:px-6 text-slate-600 dark:text-slate-400 compare-price" data-monthly="₦9,999/mo" data-annual="₦95,990/yr">₦9,999/mo</td>
                                <td class="py-3 px-4 md:px-6 text-slate-600 dark:text-slate-400 compare-price" data-monthly="₦24,999/mo" data-annual="₦239,990/yr">₦24,999/mo</td>
                                <td class="py-3 px-4 md:px-6 text-slate-600 dark:text-slate-400 compare-price" data-monthly="Custom" data-annual="Custom">Custom</td>
                                <?php endif; ?>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                                <td class="py-3 px-4 md:px-6 font-medium text-slate-900 dark:text-white">Categories</td>
                                <?php if (!empty($plans)): foreach ($plans as $p): $v = (int)($p['max_categories'] ?? 0); ?>
                                <td class="py-3 px-4 md:px-6"><?php echo $v === -1 ? 'Unlimited' : $v; ?></td>
                                <?php endforeach; else: ?>
                                <td class="py-3 px-4 md:px-6">5</td><td class="py-3 px-4 md:px-6">20</td><td class="py-3 px-4 md:px-6">Unlimited</td>
                                <?php endif; ?>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                                <td class="py-3 px-4 md:px-6 font-medium text-slate-900 dark:text-white">Menu items</td>
                                <?php if (!empty($plans)): foreach ($plans as $p): $v = (int)($p['max_menu_items'] ?? 0); ?>
                                <td class="py-3 px-4 md:px-6"><?php echo $v === -1 ? 'Unlimited' : number_format($v); ?></td>
                                <?php endforeach; else: ?>
                                <td class="py-3 px-4 md:px-6">50</td><td class="py-3 px-4 md:px-6">300</td><td class="py-3 px-4 md:px-6">Unlimited</td>
                                <?php endif; ?>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                                <td class="py-3 px-4 md:px-6 font-medium text-slate-900 dark:text-white">QR code themes</td>
                                <?php if (!empty($plans)): foreach ($plans as $p): $v = (int)($p['max_qr_styles'] ?? 0); ?>
                                <td class="py-3 px-4 md:px-6"><?php echo $v === -1 ? 'Unlimited' : $v; ?></td>
                                <?php endforeach; else: ?>
                                <td class="py-3 px-4 md:px-6">1</td><td class="py-3 px-4 md:px-6">All</td><td class="py-3 px-4 md:px-6">Unlimited</td>
                                <?php endif; ?>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                                <td class="py-3 px-4 md:px-6 font-medium text-slate-900 dark:text-white">Menu templates</td>
                                <?php if (!empty($plans)): foreach ($plans as $p): $v = (int)($p['max_templates'] ?? 0); ?>
                                <td class="py-3 px-4 md:px-6"><?php echo $v === -1 ? 'All' : $v; ?></td>
                                <?php endforeach; else: ?>
                                <td class="py-3 px-4 md:px-6">1</td><td class="py-3 px-4 md:px-6">All</td><td class="py-3 px-4 md:px-6">All</td>
                                <?php endif; ?>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                                <td class="py-3 px-4 md:px-6 font-medium text-slate-900 dark:text-white">Food ordering</td>
                                <?php if (!empty($plans)): foreach ($plans as $p): $s = $p['slug'] ?? ''; ?>
                                <td class="py-3 px-4 md:px-6"><?php echo ($s === 'professional' || $s === 'enterprise') ? '<span class="material-symbols-outlined text-primary align-middle">check_circle</span>' : '<span class="text-slate-400">—</span>'; ?></td>
                                <?php endforeach; else: ?>
                                <td class="py-3 px-4 md:px-6"><span class="text-slate-400">—</span></td>
                                <td class="py-3 px-4 md:px-6"><span class="material-symbols-outlined text-primary align-middle">check_circle</span></td>
                                <td class="py-3 px-4 md:px-6"><span class="material-symbols-outlined text-primary align-middle">check_circle</span></td>
                                <?php endif; ?>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                                <td class="py-3 px-4 md:px-6 font-medium text-slate-900 dark:text-white">Table reservations</td>
                                <?php if (!empty($plans)): foreach ($plans as $p): $s = $p['slug'] ?? ''; ?>
                                <td class="py-3 px-4 md:px-6"><?php echo ($s === 'professional' || $s === 'enterprise') ? '<span class="material-symbols-outlined text-primary align-middle">check_circle</span>' : '<span class="material-symbols-outlined text-primary align-middle text-slate-300 dark:text-slate-600">check_circle</span>'; ?></td>
                                <?php endforeach; else: ?>
                                <td class="py-3 px-4 md:px-6"><span class="material-symbols-outlined text-primary text-slate-300 align-middle">check_circle</span></td>
                                <td class="py-3 px-4 md:px-6"><span class="material-symbols-outlined text-primary align-middle">check_circle</span></td>
                                <td class="py-3 px-4 md:px-6"><span class="material-symbols-outlined text-primary align-middle">check_circle</span></td>
                                <?php endif; ?>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                                <td class="py-3 px-4 md:px-6 font-medium text-slate-900 dark:text-white">Custom domain</td>
                                <?php if (!empty($plans)): foreach ($plans as $p): $s = $p['slug'] ?? ''; ?>
                                <td class="py-3 px-4 md:px-6"><?php echo $s === 'enterprise' ? '<span class="material-symbols-outlined text-primary align-middle">check_circle</span>' : '<span class="text-slate-400">—</span>'; ?></td>
                                <?php endforeach; else: ?>
                                <td class="py-3 px-4 md:px-6"><span class="text-slate-400">—</span></td>
                                <td class="py-3 px-4 md:px-6"><span class="text-slate-400">—</span></td>
                                <td class="py-3 px-4 md:px-6"><span class="material-symbols-outlined text-primary align-middle">check_circle</span></td>
                                <?php endif; ?>
                            </tr>
                            <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30">
                                <td class="py-3 px-4 md:px-6 font-medium text-slate-900 dark:text-white">Support</td>
                                <?php if (!empty($plans)): foreach ($plans as $p): $s = $p['slug'] ?? ''; ?>
                                <td class="py-3 px-4 md:px-6"><?php echo $s === 'enterprise' ? 'Dedicated' : ($s === 'professional' ? 'Priority' : 'Email'); ?></td>
                                <?php endforeach; else: ?>
                                <td class="py-3 px-4 md:px-6">Email</td>
                                <td class="py-3 px-4 md:px-6">Priority</td>
                                <td class="py-3 px-4 md:px-6">Dedicated</td>
                                <?php endif; ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Billing & important info -->
        <section class="py-16 md:py-20 px-4 sm:px-6 lg:px-8 bg-slate-50/50 dark:bg-slate-800/20 border-t border-slate-200 dark:border-slate-800">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-2xl md:text-3xl font-heading font-bold text-slate-900 dark:text-white text-center mb-10">Billing &amp; FAQs</h2>
                <div class="grid md:grid-cols-2 gap-8 text-slate-600 dark:text-slate-400">
                    <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 md:p-8 border border-slate-200 dark:border-slate-700">
                        <h3 class="font-heading font-bold text-slate-900 dark:text-white mb-3 flex items-center gap-2"><span class="material-symbols-outlined text-primary">payments</span> Payment &amp; billing</h3>
                        <ul class="space-y-2 text-sm">
                            <li>• Prices are in Nigerian Naira (₦). We accept major credit and debit cards.</li>
                            <li>• You are charged at the start of each billing period (monthly or annually).</li>
                            <li>• Choose annual billing to save 20% compared to monthly.</li>
                            <li>• Invoices and receipts are available in your dashboard at our-menu.online.</li>
                        </ul>
                    </div>
                    <div class="bg-white dark:bg-slate-900 rounded-2xl p-6 md:p-8 border border-slate-200 dark:border-slate-700">
                        <h3 class="font-heading font-bold text-slate-900 dark:text-white mb-3 flex items-center gap-2"><span class="material-symbols-outlined text-primary">help</span> Trial &amp; cancellation</h3>
                        <ul class="space-y-2 text-sm">
                            <li>• Start with a free trial—no credit card required.</li>
                            <li>• You can upgrade, downgrade, or cancel from your account settings.</li>
                            <li>• Cancel anytime; no long-term commitment.</li>
                            <li>• Questions? <a href="<?php echo htmlspecialchars($baseUrl); ?>/contact.php" class="text-primary font-medium hover:underline">Contact us</a> or see the <a href="<?php echo htmlspecialchars($baseUrl); ?>/faq.php" class="text-primary font-medium hover:underline">FAQ</a>.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA -->
        <section class="py-24 bg-primary relative overflow-hidden">
            <div class="pointer-events-none absolute inset-0 opacity-10" style="background-image: url('<?php echo htmlspecialchars($baseUrl); ?>/assets/images/bg_black.png'); background-repeat: repeat; background-size: 280px 280px;"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-4xl lg:text-5xl font-heading font-black text-white mb-6">Ready to get started?</h2>
                <p class="text-white/90 text-lg mb-8 max-w-2xl mx-auto">Join restaurants already using <?php echo htmlspecialchars($siteName); ?> to power their digital menus. No credit card required.</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="<?php echo htmlspecialchars($authUrl); ?>" class="bg-dark-slate text-white px-10 py-5 rounded-xl text-lg font-bold hover:bg-dark-slate/90 transition-all shadow-2xl inline-flex items-center gap-3">
                        <span class="material-symbols-outlined">rocket_launch</span> Start free trial
                    </a>
                    <a href="<?php echo htmlspecialchars($baseUrl); ?>/contact.php" class="bg-white/10 text-white border border-white/30 px-10 py-5 rounded-xl text-lg font-bold hover:bg-white/20 transition-all inline-flex items-center gap-3">
                        <span class="material-symbols-outlined">mail</span> Contact sales
                    </a>
                </div>
            </div>
        </section>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>
</div>
<script>
(function() {
    var root = document.getElementById('pricingCycleToggle');
    if (!root) return;

    var buttons = root.querySelectorAll('.pricing-toggle-btn');
    var currentCycle = 'monthly';

    function render(cycle) {
        currentCycle = cycle === 'annual' ? 'annual' : 'monthly';

        var amounts = document.querySelectorAll('.pricing-amount');
        var periods = document.querySelectorAll('.pricing-period');
        var links = document.querySelectorAll('.pricing-plan-link');
        var compareCells = document.querySelectorAll('.compare-price');

        for (var i = 0; i < amounts.length; i++) {
            var value = amounts[i].getAttribute('data-' + currentCycle);
            if (value) amounts[i].textContent = value;
        }

        for (var j = 0; j < periods.length; j++) {
            if (periods[j].textContent.trim() !== '') {
                periods[j].textContent = currentCycle === 'annual' ? '/year' : '/month';
            }
        }

        for (var k = 0; k < links.length; k++) {
            var href = links[k].getAttribute('data-' + currentCycle + '-url');
            if (href) links[k].setAttribute('href', href);
        }

        for (var m = 0; m < compareCells.length; m++) {
            var compareValue = compareCells[m].getAttribute('data-' + currentCycle);
            if (compareValue) compareCells[m].textContent = compareValue;
        }

        for (var n = 0; n < buttons.length; n++) {
            var active = buttons[n].getAttribute('data-cycle') === currentCycle;
            buttons[n].classList.toggle('bg-white', active);
            buttons[n].classList.toggle('text-slate-900', active);
            buttons[n].classList.toggle('shadow-sm', active);
            buttons[n].classList.toggle('text-slate-600', !active);
        }
    }

    for (var b = 0; b < buttons.length; b++) {
        buttons[b].addEventListener('click', function() {
            render(this.getAttribute('data-cycle') || 'monthly');
        });
    }

    render('monthly');
})();
</script>
</body>
</html>
