<?php
/**
 * FAQ - resmenu.net
 * Design matches Contact page: hero with gradient, Poppins headings, card layout.
 */
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';
$baseUrl = defined('SITE_URL') ? rtrim(SITE_URL, '/') : '';
$authUrl = defined('BACKEND_URL') ? rtrim(BACKEND_URL, '/') . '/' : 'https://our-menu.online/';
$siteSettings = getSiteSettings();
$siteName = htmlspecialchars($siteSettings['site_name'] ?? 'Resmenu');
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>FAQ - <?php echo $siteName; ?></title>
    <meta name="description" content="Frequently asked questions about <?php echo $siteName; ?> digital menu platform"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: { "primary": "#f97415", "background-light": "#f8f7f5", "background-dark": "#23170f" },
                    fontFamily: { "display": ["Inter", "sans-serif"], "poppins": ["Poppins", "sans-serif"] },
                    borderRadius: { "DEFAULT": "0.5rem", "lg": "1rem", "xl": "1.5rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3 { font-family: 'Poppins', sans-serif; }
        .faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.35s ease; }
        .faq-item.active .faq-answer { max-height: 600px; }
        .faq-item.active .faq-chevron { transform: rotate(180deg); }
    </style>
</head>
<body class="bg-background-light text-slate-900 dark:text-slate-100">
<div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
    <?php include __DIR__ . '/includes/header.php'; ?>

    <!-- Hero Breadcrumb Header -->
    <section class="relative w-full min-h-[400px] flex flex-col justify-center px-6 md:px-20 py-16 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-r from-background-dark via-background-dark/80 to-primary/40 z-10"></div>
            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo htmlspecialchars($baseUrl); ?>/assets/images/kabab-template.jpg');"></div>
        </div>
        <div class="relative z-20 max-w-2xl">
            <nav class="flex items-center gap-2 mb-4 text-primary/90 text-sm font-medium">
                <a class="hover:underline hover:text-white transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/">Home</a>
                <span class="material-symbols-outlined text-xs">chevron_right</span>
                <span class="text-white">FAQ</span>
            </nav>
            <h1 class="text-white text-5xl md:text-6xl font-bold mb-6 leading-tight">Frequently Asked Questions</h1>
            <p class="text-slate-200 text-lg md:text-xl leading-relaxed max-w-xl">Find answers to common questions about <?php echo $siteName; ?> and how we help restaurants go digital.</p>
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-[1200px] mx-auto px-6 py-16 md:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-1 gap-12">
            <div class="bg-white dark:bg-slate-900 p-8 md:p-10 rounded-xl shadow-xl border border-slate-100 dark:border-slate-800">
                <h3 class="text-2xl font-bold mb-8 text-slate-900 dark:text-white">Common Questions</h3>
                <div class="space-y-4">
                    <?php
                    $faqs = [
                        ['q' => 'What is ' . $siteName . '?', 'a' => $siteName . ' is a professional digital menu platform that helps restaurants, cafés, and hospitality businesses create beautiful, customizable online menus. Our platform is mobile-responsive, easy to manage, and designed to elevate your guests\' experience while reducing printing costs.'],
                        ['q' => 'Do I need technical skills to use ' . $siteName . '?', 'a' => 'No. Our platform is built to be intuitive. You can create and update your menu in minutes from any device. If you need help, our support team is available via email and we offer step-by-step guides for every feature.'],
                        ['q' => 'How do I get started?', 'a' => 'Click "Get Started" to create your account. You\'ll choose a template, add your restaurant details, then build your menu with categories and items. Your digital menu and QR code are ready to share as soon as you publish.'],
                        ['q' => 'Is there a free trial?', 'a' => 'Yes. You can start with a free trial to explore all features—no credit card required. When you\'re ready, choose a plan that fits your size and needs.'],
                        ['q' => 'Can I customize my menu design?', 'a' => 'Yes. You can customize colors, fonts, images, and layout. Choose from our professional templates, then adjust to match your brand. Each template is optimized for readability and conversion.'],
                        ['q' => 'Is my menu mobile-friendly?', 'a' => 'All menus created with ' . $siteName . ' are fully responsive. They look and work great on phones, tablets, and desktops, so customers can browse and order from any device.'],
                        ['q' => 'How many menu items and categories can I add?', 'a' => 'It depends on your plan. Starter plans include generous limits; Professional and Enterprise plans support more categories and items. Check our Pricing page for exact limits per plan.'],
                        ['q' => 'Can I update my menu anytime?', 'a' => 'Yes. You can update your menu anytime from the dashboard. Changes go live immediately—update prices, add or remove items, change descriptions, or reorder categories with a few clicks.'],
                        ['q' => 'How much does it cost?', 'a' => 'We offer Starter, Professional, and Enterprise plans. Pricing is on a monthly or annual basis; annual billing saves 20%. Visit our Pricing page for full details and to compare features.'],
                        ['q' => 'What payment methods do you accept?', 'a' => 'We accept major credit and debit cards, and support local payment options where available. Invoices are sent by email; Enterprise customers can arrange custom billing.'],
                        ['q' => 'Can I cancel or change my plan later?', 'a' => 'Yes. You can upgrade or downgrade your plan from your account. If you cancel, you keep access until the end of your billing period. We do not lock you into long-term contracts on standard plans.'],
                        ['q' => 'What are QR code menus and how do they work?', 'a' => 'We generate a unique QR code for your restaurant. Customers scan it with their phone camera to open your digital menu—no app download. You can print the QR on table tents, posters, or business cards.'],
                        ['q' => 'Can my customers order food through the menu?', 'a' => 'Yes, on supported templates. You can enable ordering so guests add items to a cart and submit orders (e.g. for table service or takeaway). Orders appear in your dashboard for fulfillment.'],
                        ['q' => 'Do you support table reservations?', 'a' => 'Yes. Our reservation feature (on selected plans) lets guests book tables. You can set availability, deposit rules, and manage bookings from one place.'],
                        ['q' => 'Is my data secure?', 'a' => 'We take security seriously. Data is transmitted over HTTPS and stored securely. We do not sell your data. You retain ownership of your menu content and customer data.'],
                        ['q' => 'Can I use my own domain?', 'a' => 'Higher-tier plans support custom domains (e.g. menu.yourrestaurant.com). Contact our team or check the Pricing page for availability and setup support.'],
                        ['q' => 'Do you offer customer support?', 'a' => 'Yes. All plans include email support. Professional and Enterprise plans get priority support. We also provide help articles and onboarding guidance so you can get the most out of the platform.'],
                        ['q' => 'Can I have multiple locations or menus?', 'a' => 'Depending on your plan, you can manage multiple locations or separate menus. Enterprise plans offer the most flexibility for chains and multi-venue brands.'],
                        ['q' => 'How do I get my menu in front of customers?', 'a' => 'Share your menu link and QR code on social media, your website, and in-house. Print the QR on table cards and posters. Many restaurants also add the link to email signatures and delivery platforms.'],
                        ['q' => 'Who do I contact for partnerships or enterprise needs?', 'a' => 'For partnerships, custom requirements, or enterprise pricing, use our Contact page or email sales@sigsolresmenu.com. We\'ll respond quickly to discuss your needs.'],
                    ];
                    foreach ($faqs as $i => $faq):
                    ?>
                    <div class="faq-item border border-slate-200 dark:border-slate-700 rounded-lg overflow-hidden <?php echo $i === 0 ? 'active' : ''; ?>">
                        <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-5 py-4 bg-slate-50/50 dark:bg-slate-800/50 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors font-semibold text-slate-900 dark:text-white text-sm md:text-base">
                            <span><?php echo htmlspecialchars($faq['q']); ?></span>
                            <span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span>
                        </button>
                        <div class="faq-answer">
                            <div class="px-5 pb-4 pt-0 text-slate-600 dark:text-slate-400 leading-relaxed text-sm border-t border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900"><?php echo htmlspecialchars($faq['a']); ?></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="mt-10 pt-8 border-t border-slate-200 dark:border-slate-700 text-center">
                    <p class="text-slate-600 dark:text-slate-400 text-sm mb-4">Still have questions?</p>
                    <a href="<?php echo htmlspecialchars($authUrl); ?>" class="inline-block py-4 px-8 bg-primary text-white font-bold rounded-lg shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all">Get Started</a>
                    <a href="<?php echo htmlspecialchars($baseUrl); ?>/contact.php" class="inline-block ml-4 py-4 px-8 border-2 border-slate-200 dark:border-slate-700 font-bold rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 transition-all">Contact Us</a>
                </div>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var items = document.querySelectorAll('.faq-item');
    items.forEach(function(item) {
        var btn = item.querySelector('.faq-question');
        if (!btn) return;
        btn.addEventListener('click', function() {
            var wasActive = item.classList.contains('active');
            items.forEach(function(i) { i.classList.remove('active'); });
            if (!wasActive) item.classList.add('active');
        });
    });
});
</script>
</body>
</html>
