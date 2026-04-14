<?php
/**
 * Contact Us - resmenu.net
 */
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';

$baseUrl = defined('SITE_URL') ? rtrim(SITE_URL, '/') : '';
$authUrl = defined('BACKEND_URL') ? rtrim(BACKEND_URL, '/') . '/' : 'https://our-menu.online/';
$siteSettings = getSiteSettings();
$siteName = htmlspecialchars($siteSettings['site_name'] ?? 'Resmenu');

$contactSalesEmail = $siteSettings['contact_sales_email'] ?? 'sales@sigsolresmenu.com';
$contactSalesPhone = $siteSettings['contact_sales_phone'] ?? '+234 (0) 812 345 6789';
$contactSupportEmail = $siteSettings['contact_support_email'] ?? 'support@sigsolresmenu.com';
$contactSupportPhone = $siteSettings['contact_support_phone'] ?? '+234 (0) 701 987 6543';
$contactPartnersEmail = $siteSettings['contact_partners_email'] ?? 'partners@sigsolresmenu.com';
$contactHqTitle = $siteSettings['contact_hq_title'] ?? 'Lagos HQ';
$contactHqAddress = $siteSettings['contact_hq_address'] ?? "12 Adeola Odeku Street, Victoria Island,\nLagos 101241, Nigeria";
$contactMapEmbed = $siteSettings['contact_map_embed'] ?? '';
$contactFacebook = $siteSettings['contact_social_facebook'] ?? '#';
$contactTwitter = $siteSettings['contact_social_twitter'] ?? '#';
$contactInstagram = $siteSettings['contact_social_instagram'] ?? '#';
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Contact Us - <?php echo $siteName; ?></title>
    <meta name="description" content="Contact <?php echo $siteName; ?>: support inboxes, quick FAQ answers, policies, and office location."/>
    <?php
        $favicon = (string)($siteSettings['favicon'] ?? '');
        $faviconUrl = $favicon !== '' ? ($baseUrl . '/uploads/site/' . rawurlencode($favicon)) : ($baseUrl . '/favicon.ico');
        $fallbackIcon = $baseUrl . '/assets/images/resmen_logo.png';
        $iconHref = $faviconUrl ?: $fallbackIcon;
    ?>
    <link rel="icon" href="<?php echo htmlspecialchars($iconHref); ?>">
    <link rel="apple-touch-icon" href="<?php echo htmlspecialchars($iconHref ?: $fallbackIcon); ?>">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#f97415",
                        "background-light": "#f8f7f5",
                        "background-dark": "#23170f",
                        "dark-slate": "#111827"
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
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5 { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100">
<div class="relative flex min-h-screen w-full flex-col">
    <?php include __DIR__ . '/includes/header.php'; ?>

    <section class="relative w-full min-h-[400px] flex flex-col justify-center px-6 md:px-20 py-16 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-background-dark via-background-dark/80 to-primary/40 z-10"></div>
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=1470&auto=format&fit=crop');" aria-hidden="true"></div>
        </div>
        <div class="relative z-20 max-w-2xl">
            <nav class="flex items-center gap-2 mb-4 text-primary/90 text-sm font-medium">
                <a class="hover:underline" href="<?php echo htmlspecialchars($baseUrl); ?>/">Home</a>
                <span class="material-symbols-outlined text-xs">chevron_right</span>
                <span class="text-white">Contact Us</span>
            </nav>
            <h1 class="text-white text-5xl md:text-6xl font-bold mb-6 leading-tight">Help &amp; Contact</h1>
            <p class="text-slate-200 text-lg md:text-xl leading-relaxed max-w-xl">
                Reach the right team fast, skim common answers, and jump to full documentation when you need more detail.
            </p>
        </div>
    </section>

    <main class="max-w-7xl mx-auto px-6 py-14 md:py-20">
        <div class="mb-10 flex flex-col sm:flex-row sm:flex-wrap gap-3 sm:items-center sm:justify-between">
            <p class="text-slate-600 dark:text-slate-400 text-sm md:text-base max-w-2xl">
                Prefer self‑service? Start with the <strong class="text-slate-900 dark:text-white">Knowledge Base</strong> for step‑by‑step guides, then email the right inbox if you still need help.
            </p>
            <div class="flex flex-wrap gap-2">
                <a href="<?php echo htmlspecialchars($baseUrl); ?>/faq" class="inline-flex items-center gap-2 rounded-lg bg-primary px-4 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-primary/90 transition-colors">
                    <span class="material-symbols-outlined text-lg">menu_book</span> Knowledge Base
                </a>
                <a href="<?php echo htmlspecialchars($authUrl); ?>" class="inline-flex items-center gap-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-4 py-2.5 text-sm font-semibold text-slate-800 dark:text-slate-100 hover:border-primary/40 transition-colors">
                    <span class="material-symbols-outlined text-lg">login</span> Manager login
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">
            <!-- Left: contact + FAQ + policies -->
            <div class="lg:col-span-7 space-y-8">
                <section class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-sm overflow-hidden">
                    <div class="border-b border-slate-100 dark:border-slate-800 px-6 py-4 bg-slate-50/80 dark:bg-slate-800/40">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">support_agent</span>
                            Contact the right team
                        </h2>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Choose the channel that matches your request—we respond fastest when messages go to the right inbox.</p>
                    </div>
                    <div class="p-6 md:p-8 grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div class="rounded-xl border border-slate-100 dark:border-slate-800 p-5">
                            <div class="size-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary mb-3">
                                <span class="material-symbols-outlined">payments</span>
                            </div>
                            <h3 class="font-bold text-slate-900 dark:text-white text-sm mb-1">Sales</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mb-3">Plans, demos, onboarding</p>
                            <a class="text-sm font-semibold text-primary hover:underline break-all" href="mailto:<?php echo htmlspecialchars($contactSalesEmail); ?>"><?php echo htmlspecialchars($contactSalesEmail); ?></a>
                            <?php if (!empty($contactSalesPhone)): ?>
                            <p class="text-xs text-slate-600 dark:text-slate-400 mt-2"><?php echo htmlspecialchars($contactSalesPhone); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="rounded-xl border border-slate-100 dark:border-slate-800 p-5">
                            <div class="size-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary mb-3">
                                <span class="material-symbols-outlined">handyman</span>
                            </div>
                            <h3 class="font-bold text-slate-900 dark:text-white text-sm mb-1">Support</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mb-3">Technical help &amp; account issues</p>
                            <a class="text-sm font-semibold text-primary hover:underline break-all" href="mailto:<?php echo htmlspecialchars($contactSupportEmail); ?>"><?php echo htmlspecialchars($contactSupportEmail); ?></a>
                            <?php if (!empty($contactSupportPhone)): ?>
                            <p class="text-xs text-slate-600 dark:text-slate-400 mt-2"><?php echo htmlspecialchars($contactSupportPhone); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="rounded-xl border border-slate-100 dark:border-slate-800 p-5 sm:col-span-1">
                            <div class="size-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary mb-3">
                                <span class="material-symbols-outlined">hub</span>
                            </div>
                            <h3 class="font-bold text-slate-900 dark:text-white text-sm mb-1">Partnerships</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mb-3">Integrations &amp; collaborations</p>
                            <a class="text-sm font-semibold text-primary hover:underline break-all" href="mailto:<?php echo htmlspecialchars($contactPartnersEmail); ?>"><?php echo htmlspecialchars($contactPartnersEmail); ?></a>
                        </div>
                    </div>
                </section>

                <section class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-sm overflow-hidden">
                    <div class="border-b border-slate-100 dark:border-slate-800 px-6 py-4 flex items-start justify-between gap-4 flex-wrap">
                        <div>
                            <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">quiz</span>
                                Quick answers
                            </h2>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Short summaries—open the Knowledge Base for the full walkthroughs.</p>
                        </div>
                        <a href="<?php echo htmlspecialchars($baseUrl); ?>/faq" class="text-sm font-semibold text-primary hover:underline shrink-0">View all FAQs →</a>
                    </div>
                    <div class="divide-y divide-slate-100 dark:divide-slate-800">
                        <div class="px-6 py-5">
                            <h3 class="font-semibold text-slate-900 dark:text-white text-sm mb-1">How do guests open my menu?</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">Guests scan your table QR (or open your menu link). No app install—menus load in the phone browser and update instantly when you publish changes.</p>
                        </div>
                        <div class="px-6 py-5">
                            <h3 class="font-semibold text-slate-900 dark:text-white text-sm mb-1">Where do I manage everything?</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">Restaurant managers use the dashboard at <strong class="text-slate-800 dark:text-slate-200">our-menu.online</strong> for menus, categories, QR codes, billing, and (on supported plans) orders or reservations.</p>
                        </div>
                        <div class="px-6 py-5">
                            <h3 class="font-semibold text-slate-900 dark:text-white text-sm mb-1">Can I change templates later?</h3>
                            <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">Yes. Switching templates updates layout and styling while keeping your menu content—see the Knowledge Base for the recommended workflow.</p>
                        </div>
                    </div>
                </section>

                <section class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-sm overflow-hidden">
                    <div class="border-b border-slate-100 dark:border-slate-800 px-6 py-4">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">gavel</span>
                            Policies &amp; reference
                        </h2>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Official pages for legal terms, pricing, and product context.</p>
                    </div>
                    <ul class="divide-y divide-slate-100 dark:divide-slate-800">
                        <li>
                            <a href="<?php echo htmlspecialchars($baseUrl); ?>/terms" class="flex items-center justify-between gap-4 px-6 py-4 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                                <span class="font-semibold text-slate-900 dark:text-white text-sm">Terms of Service</span>
                                <span class="material-symbols-outlined text-slate-400 group-hover:text-primary text-xl">chevron_right</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo htmlspecialchars($baseUrl); ?>/pricing" class="flex items-center justify-between gap-4 px-6 py-4 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                                <span class="font-semibold text-slate-900 dark:text-white text-sm">Pricing &amp; plans</span>
                                <span class="material-symbols-outlined text-slate-400 group-hover:text-primary text-xl">chevron_right</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo htmlspecialchars($baseUrl); ?>/features" class="flex items-center justify-between gap-4 px-6 py-4 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                                <span class="font-semibold text-slate-900 dark:text-white text-sm">Platform features</span>
                                <span class="material-symbols-outlined text-slate-400 group-hover:text-primary text-xl">chevron_right</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo htmlspecialchars($baseUrl); ?>/templates" class="flex items-center justify-between gap-4 px-6 py-4 hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors group">
                                <span class="font-semibold text-slate-900 dark:text-white text-sm">Menu templates</span>
                                <span class="material-symbols-outlined text-slate-400 group-hover:text-primary text-xl">chevron_right</span>
                            </a>
                        </li>
                    </ul>
                </section>
            </div>

            <!-- Right: location + social -->
            <div class="lg:col-span-5 space-y-8">
                <section class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-sm overflow-hidden">
                    <div class="px-6 py-5 border-b border-slate-100 dark:border-slate-800">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">location_on</span>
                            Office &amp; map
                        </h2>
                        <p class="text-sm text-slate-600 dark:text-slate-400 mt-1"><?php echo htmlspecialchars($contactHqTitle); ?></p>
                    </div>
                    <div class="p-6 md:p-8">
                        <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed mb-6">
                            <?php echo nl2br(htmlspecialchars($contactHqAddress)); ?>
                        </p>
                        <div class="relative w-full overflow-hidden rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-100 dark:bg-slate-800" style="padding-top: 56.25%;">
                            <?php if (!empty($contactMapEmbed)): ?>
                            <div class="absolute inset-0">
                                <?php echo $contactMapEmbed; ?>
                            </div>
                            <?php elseif (!empty(trim($contactHqAddress))): ?>
                            <iframe
                                title="Location map"
                                class="absolute inset-0 w-full h-full border-0"
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                src="<?php echo 'https://www.google.com/maps?q=' . urlencode($contactHqAddress) . '&output=embed'; ?>">
                            </iframe>
                            <?php else: ?>
                            <div class="absolute inset-0 flex items-center justify-center p-6 text-center text-sm text-slate-500 dark:text-slate-400">
                                Add an HQ address or a custom map embed in your site settings to show a map here.
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </section>

                <section class="rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-sm p-6 md:p-8">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Follow us</h2>
                    <p class="text-sm text-slate-600 dark:text-slate-400 mb-6">Updates, product tips, and customer stories.</p>
                    <div class="flex gap-3">
                        <a class="size-11 rounded-full border border-slate-200 dark:border-slate-700 flex items-center justify-center hover:bg-primary hover:text-white hover:border-primary transition-all" href="<?php echo htmlspecialchars($contactFacebook ?: '#'); ?>" aria-label="Facebook">
                            <svg class="size-5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path></svg>
                        </a>
                        <a class="size-11 rounded-full border border-slate-200 dark:border-slate-700 flex items-center justify-center hover:bg-primary hover:text-white hover:border-primary transition-all" href="<?php echo htmlspecialchars($contactTwitter ?: '#'); ?>" aria-label="Twitter">
                            <svg class="size-5 fill-current" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"></path></svg>
                        </a>
                        <a class="size-11 rounded-full border border-slate-200 dark:border-slate-700 flex items-center justify-center hover:bg-primary hover:text-white hover:border-primary transition-all" href="<?php echo htmlspecialchars($contactInstagram ?: '#'); ?>" aria-label="Instagram">
                            <svg class="size-5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.668-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"></path></svg>
                        </a>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>
    <?php include __DIR__ . '/includes/livechat.php'; ?>
</div>
</body>
</html>
