<?php
/**
 * FAQ / Knowledge Base - resmenu.net
 * Merchant Help Center layout: shared header/footer, hero, sidebar nav, card grid sections.
 * FAQ content is aligned with actual site features: templates, QR, ordering (Professional+),
 * reservations, multi-branch, plan limits (Starter/Professional/Enterprise), dashboard at our-menu.online.
 */
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';
$baseUrl = defined('SITE_URL') ? rtrim(SITE_URL, '/') : '';
$authUrl = defined('BACKEND_URL') ? rtrim(BACKEND_URL, '/') . '/' : 'https://our-menu.online/';
$siteSettings = getSiteSettings();
$siteName = htmlspecialchars($siteSettings['site_name'] ?? 'SigSol Resmenu');
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo $siteName; ?> - Knowledge Base</title>
    <meta name="description" content="Merchant help center and frequently asked questions for <?php echo $siteName; ?> digital menu platform"/>
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
                        "background-dark": "#111827",
                        "dark-slate": "#111827",
                    },
                    fontFamily: {
                        "display": ["Inter", "sans-serif"],
                        "heading": ["Poppins", "sans-serif"]
                    },
                    borderRadius: { "DEFAULT": "0.5rem", "lg": "1rem", "xl": "1.5rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .no-scrollbar::-webkit-scrollbar { display: none; }
            .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        }
        .knowledge-sidebar-link.active {
            @apply bg-primary/10 text-primary border-r-4 border-primary;
        }
    </style>
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3 { font-family: 'Poppins', sans-serif; }
        .faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.3s ease; }
        .faq-accordion-item.active .faq-answer { max-height: 400px; }
        .faq-accordion-item.active .faq-chevron { transform: rotate(180deg); }
    </style>
</head>
<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100">
<div class="relative flex min-h-screen w-full flex-col">
    <?php include __DIR__ . '/includes/header.php'; ?>

    <!-- Hero -->
    <section class="relative w-full h-[320px] flex flex-col justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img alt="Restaurant Interior" class="w-full h-full object-cover" src="<?php echo htmlspecialchars($baseUrl); ?>/assets/images/kabab-template.jpg"/>
            <div class="absolute inset-0 bg-gradient-to-r from-[#111827] via-[#111827]/85 to-[#f97316]/40"></div>
        </div>
        <div class="relative z-10 px-6 md:px-20">
            <nav class="flex items-center gap-2 mb-4">
                <a class="text-slate-300 text-sm hover:text-white" href="<?php echo htmlspecialchars($baseUrl); ?>/">Home</a>
                <span class="text-slate-400 text-sm">/</span>
                <span class="text-primary text-sm font-medium uppercase tracking-wider">Knowledge Base</span>
            </nav>
            <h1 class="text-white text-4xl md:text-5xl font-heading font-bold mb-4">Merchant Help Center</h1>
            <p class="text-slate-200 text-lg max-w-2xl leading-relaxed">
                A comprehensive resource for detail-oriented restaurant owners looking to master their digital dining experience.
            </p>
        </div>
    </section>

    <div class="w-full max-w-[1440px] mx-auto flex flex-col md:flex-row min-h-screen">
        <aside class="w-full md:w-72 lg:w-80 shrink-0 md:self-start border-r border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-950 p-6 pb-24 md:sticky md:top-20 md:h-[calc(100vh-80px)] md:max-h-[calc(100vh-80px)] md:overflow-y-auto no-scrollbar">
            <div class="space-y-8 pb-8">
                <div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Getting Started</h3>
                    <nav class="flex flex-col gap-1">
                        <a class="knowledge-sidebar-link active flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-semibold transition-all hover:text-primary hover:bg-primary/5" href="#general">
                            <span class="material-symbols-outlined text-xl">rocket_launch</span> General Setup
                        </a>
                        <a class="knowledge-sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-primary hover:bg-primary/5 transition-all" href="#account">
                            <span class="material-symbols-outlined text-xl">manage_accounts</span> Account Management
                        </a>
                    </nav>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Menu Engineering</h3>
                    <nav class="flex flex-col gap-1">
                        <a class="knowledge-sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-primary hover:bg-primary/5 transition-all" href="#design">
                            <span class="material-symbols-outlined text-xl">palette</span> Design &amp; Branding
                        </a>
                        <a class="knowledge-sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-primary hover:bg-primary/5 transition-all" href="#items">
                            <span class="material-symbols-outlined text-xl">fastfood</span> Items &amp; Categories
                        </a>
                        <a class="knowledge-sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-primary hover:bg-primary/5 transition-all" href="#modifiers">
                            <span class="material-symbols-outlined text-xl">tune</span> Add-ons &amp; Modifiers
                        </a>
                    </nav>
                </div>
                <div>
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Technical Operations</h3>
                    <nav class="flex flex-col gap-1">
                        <a class="knowledge-sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-primary hover:bg-primary/5 transition-all" href="#hardware">
                            <span class="material-symbols-outlined text-xl">print</span> QR &amp; Hardware
                        </a>
                        <a class="knowledge-sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-primary hover:bg-primary/5 transition-all" href="#integrations">
                            <span class="material-symbols-outlined text-xl">hub</span> Integrations &amp; Extras
                        </a>
                        <a class="knowledge-sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 dark:text-slate-400 hover:text-primary hover:bg-primary/5 transition-all" href="#payments">
                            <span class="material-symbols-outlined text-xl">payments</span> Billing &amp; Payments
                        </a>
                    </nav>
                </div>
            </div>
        </aside>

        <main class="flex-1 bg-white dark:bg-background-dark p-6 md:p-12">
            <div class="scroll-mt-40 mb-16" id="general">
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
                    <div class="p-6 md:p-8">
                        <div class="flex items-center gap-3 mb-8 group">
                            <span class="material-symbols-outlined text-primary text-4xl block group-hover:scale-110 transition-transform">rocket_launch</span>
                            <h2 class="text-3xl font-heading font-bold text-slate-900 dark:text-white">General Setup</h2>
                        </div>
                        <div class="space-y-2">
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">How do I create my first digital menu?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Choose a template from our library, add your categories and menu items with descriptions and high-res photos, then hit publish to generate your unique QR code.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">Can I update prices in real-time?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Yes, any changes you make in the dashboard reflect instantly. During peak hours, you can update availability or pricing without reprinting QR codes.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">How do customers access the menu?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Customers simply scan a unique QR code placed at their table using their phone camera. No app download is required; it opens in their mobile browser.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">Do you support multiple locations?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Yes. Our platform includes multi-branch support so you can manage more than one location from a single account. Enterprise plans offer the most flexibility for chains.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">Can I have a menu in another language?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">You can add your menu content in any language—item names, descriptions, and categories. The menu opens in the customer's browser, so they view it in the language you enter.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">Is my data secure?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">We use industry-standard SSL encryption and AWS cloud infrastructure to ensure your restaurant data and customer analytics are protected.</div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="scroll-mt-40 mb-16" id="account">
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
                    <div class="p-6 md:p-8">
                        <div class="flex items-center gap-3 mb-8 group">
                            <span class="material-symbols-outlined text-primary text-4xl block group-hover:scale-110 transition-transform">manage_accounts</span>
                            <h2 class="text-3xl font-heading font-bold text-slate-900 dark:text-white">Account Management</h2>
                        </div>
                        <div class="space-y-2">
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">How do I sign up?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Click Get Started, enter your email and restaurant details, then choose a template. You can publish your first menu within minutes.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">Can I change my plan later?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Yes. You can upgrade or downgrade from your account dashboard. Changes take effect at the next billing cycle; prorated credits apply where applicable.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">How do I reset my password?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Use the “Forgot password” link on the login page. You'll receive an email with a secure link to set a new password.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">Can I invite team members?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Multi-user and role-based access are available on select plans. Contact us or check your plan details in the dashboard to see if your account supports inviting staff.</div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="scroll-mt-40 mb-16" id="design">
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
                    <div class="p-6 md:p-8">
                        <div class="flex items-center gap-3 mb-8 group">
                            <span class="material-symbols-outlined text-primary text-4xl block group-hover:scale-110 transition-transform">palette</span>
                            <h2 class="text-3xl font-heading font-bold text-slate-900 dark:text-white">Design &amp; Branding</h2>
                        </div>
                        <div class="space-y-2">
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">Can I use my own logo and colors?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Yes. Upload your logo and set primary and accent colors in the theme settings. All templates adapt to your brand for a consistent look.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">Are templates mobile-friendly?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Every template is built to be fully responsive. Menus look and perform great on phones, tablets, and desktops with no extra setup.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">Can I switch templates after publishing?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">You can change templates at any time. Your content (categories, items, and media) is preserved; only the layout and styling update.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">What image formats and sizes work best?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">We support JPG, PNG, and WebP. For best quality, use at least 800px on the longest side. The dashboard can crop and resize for you.</div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="scroll-mt-40 mb-16" id="items">
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
                    <div class="p-6 md:p-8">
                        <div class="flex items-center gap-3 mb-8 group">
                            <span class="material-symbols-outlined text-primary text-4xl block group-hover:scale-110 transition-transform">fastfood</span>
                            <h2 class="text-3xl font-heading font-bold text-slate-900 dark:text-white">Items &amp; Categories</h2>
                        </div>
                        <div class="space-y-2">
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">Is there a limit to menu items and categories?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Limits depend on your plan: Starter includes up to 5 categories and 50 items; Professional offers more categories and items; Enterprise supports unlimited. You can organize items into categories in your dashboard.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">Can I add dietary or allergen info?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Yes. Use the item description to note dietary info (e.g. Vegan, Gluten-Free) or allergens. This helps guests choose safely and matches how many restaurants display this on digital menus.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">How do I add item descriptions and photos?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">In the dashboard, each menu item has fields for name, description, and image. Upload high-resolution photos and clear descriptions so customers know exactly what they are ordering.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">Can I reorder categories and items?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Yes. From your dashboard you can drag-and-drop or reorder categories and items so the menu appears exactly as you want to customers.</div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="scroll-mt-40 mb-16" id="modifiers">
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
                    <div class="p-6 md:p-8">
                        <div class="flex items-center gap-3 mb-8 group">
                            <span class="material-symbols-outlined text-primary text-4xl block group-hover:scale-110 transition-transform">tune</span>
                            <h2 class="text-3xl font-heading font-bold text-slate-900 dark:text-white">Add-ons &amp; Modifiers</h2>
                        </div>
                        <div class="space-y-2">
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">Can customers customize orders (e.g. size, extras)?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">On plans that include food ordering, you can set up options like size or add-ons so guests customize their order. Configure these in your dashboard under menu items.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">How do I add optional extras or special instructions?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Where ordering is available, you can add modifier options and prices. Customers see them when adding an item to the cart and can leave special instructions if the template supports it.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">Does the platform support contactless ordering?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Yes. Our food ordering feature lets guests order directly from your digital menu—ideal for table service and contactless dining. Available on Professional and higher plans.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">Do I get notified when someone places an order?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Yes. The platform sends real-time email notifications for new orders and reservations so you can respond quickly. You can also view orders in your dashboard.</div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="scroll-mt-40 mb-16" id="hardware">
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
                    <div class="p-6 md:p-8">
                        <div class="flex items-center gap-3 mb-8 group">
                            <span class="material-symbols-outlined text-primary text-4xl block group-hover:scale-110 transition-transform">print</span>
                            <h2 class="text-3xl font-heading font-bold text-slate-900 dark:text-white">QR &amp; Hardware</h2>
                        </div>
                        <div class="space-y-2">
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">Do I need special hardware?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">No special hardware needed. The dashboard works on any browser, and you can print QR codes using any standard inkjet or laser printer.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">How long do QR codes last?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Our QR codes are static and never expire. You can change your entire menu content without ever having to replace the printed QR code stickers.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">Can I download the QR as an image?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Yes. From the dashboard you can download your QR code in PNG or SVG for table tents, posters, or signage at any size.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">What if a table doesn't have a QR code?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">You can share your menu link directly (e.g. via SMS or verbally). Customers can also search for your restaurant name if you're listed in our directory.</div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="scroll-mt-40 mb-16" id="integrations">
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
                    <div class="p-6 md:p-8">
                        <div class="flex items-center gap-3 mb-8 group">
                            <span class="material-symbols-outlined text-primary text-4xl block group-hover:scale-110 transition-transform">hub</span>
                            <h2 class="text-3xl font-heading font-bold text-slate-900 dark:text-white">Integrations &amp; Extras</h2>
                        </div>
                        <div class="space-y-2">
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">Do you integrate with POS or other systems?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Custom integrations and API access are available for Enterprise or specific setups. Contact us to discuss POS sync, APIs, or other technical requirements.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">Can I take table reservations?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Yes. Our platform includes a reservation system so guests can book tables online. You can manage availability and reduce no-shows from your dashboard.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">Can I use my own domain for my menu?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Custom domain (e.g. menu.yourrestaurant.com) is available on Enterprise plans. Contact us for setup and we'll guide you through linking your domain.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">Where do I manage my menu and orders?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">After signing up, you'll use the dashboard (our-menu.online) to manage your restaurant, menu items, orders, reservations, and QR code. Everything is in one place.</div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="scroll-mt-40 mb-16" id="payments">
                <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-2xl shadow-sm overflow-hidden">
                    <div class="p-6 md:p-8">
                        <div class="flex items-center gap-3 mb-8 group">
                            <span class="material-symbols-outlined text-primary text-4xl block group-hover:scale-110 transition-transform">payments</span>
                            <h2 class="text-3xl font-heading font-bold text-slate-900 dark:text-white">Billing &amp; Payments</h2>
                        </div>
                        <div class="space-y-2">
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">What payment methods do you accept?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">We accept major credit and debit cards. Pricing is in Naira (₦); see the Pricing page for current plan amounts. Enterprise customers can arrange custom billing.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">What plans are available?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Starter (single location, limited categories/items, one template), Professional (more items, all templates, food ordering), and Enterprise (unlimited, custom domain). Details are on our Pricing page.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">When am I charged?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Subscriptions are charged at the start of each billing period (monthly or annually). You'll receive an email receipt and can view invoices in your dashboard.</div></div>
                            </div>
                            <div class="faq-accordion-item border border-slate-200 dark:border-slate-700 rounded-xl overflow-hidden">
                                <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 font-semibold text-slate-900 dark:text-white text-sm md:text-base">How do I update my plan or billing?<span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span></button>
                                <div class="faq-answer"><div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 text-sm leading-relaxed border-t border-slate-200 dark:border-slate-700">Log in at our-menu.online and go to your account or billing settings. You can update your card, change plan, or contact support for refunds (see Terms of Service).</div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- CTA (full-width like homepage: section.py-24.bg-primary) -->
    <section class="py-24 bg-primary relative overflow-hidden">
        <div class="pointer-events-none absolute inset-0 opacity-10" style="background-image: url('https://our-menu.online/templates/template4/bg_black.png'); background-repeat: repeat; background-size: 280px 280px;"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl lg:text-5xl font-black text-white mb-8 leading-tight">Can't find what you're looking for?</h2>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="<?php echo htmlspecialchars($baseUrl); ?>/contact.php" class="bg-[#111827] text-white px-10 py-5 rounded-xl text-lg font-bold hover:bg-[#111827]/90 transition-all shadow-2xl flex items-center justify-center gap-3">
                    <span class="material-symbols-outlined">mail</span> Contact Support
                </a>
                <button type="button" class="bg-white/10 text-white border border-white/30 px-10 py-5 rounded-xl text-lg font-bold hover:bg-white/20 transition-all flex items-center justify-center gap-3">
                    <span class="material-symbols-outlined">chat</span> Live Chat
                </button>
            </div>
            <p class="mt-8 text-white/80 font-medium">Our dedicated success team is available to help you optimize your digital experience.</p>
        </div>
    </section>

    <?php include __DIR__ . '/includes/footer.php'; ?>
</div>
<script>
(function() {
    var sidebarLinks = document.querySelectorAll('.knowledge-sidebar-link');
    var sectionIds = ['general','account','design','items','modifiers','hardware','integrations','payments'];
    function updateActiveLink() {
        var trigger = window.scrollY + 120;
        var current = '';
        sectionIds.forEach(function(id) {
            var el = document.getElementById(id);
            if (!el) return;
            var rect = el.getBoundingClientRect();
            var sectionTop = rect.top + window.scrollY;
            if (sectionTop <= trigger) current = id;
        });
        sidebarLinks.forEach(function(link) {
            var href = link.getAttribute('href');
            var id = href ? href.replace('#', '') : '';
            link.classList.toggle('active', id === current);
            link.classList.toggle('font-semibold', id === current);
            link.classList.toggle('font-medium', id !== current);
        });
    }
    window.addEventListener('scroll', updateActiveLink);
    window.addEventListener('load', updateActiveLink);
    window.addEventListener('hashchange', updateActiveLink);

    document.querySelectorAll('.faq-accordion-item').forEach(function(item) {
        var btn = item.querySelector('.faq-question');
        if (!btn) return;
        btn.addEventListener('click', function() {
            var wasActive = item.classList.contains('active');
            item.parentElement.querySelectorAll('.faq-accordion-item').forEach(function(i) { i.classList.remove('active'); });
            if (!wasActive) item.classList.add('active');
        });
    });
})();
</script>
</body>
</html>
