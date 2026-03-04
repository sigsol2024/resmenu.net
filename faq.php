<?php
/**
 * FAQ - resmenu.net
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
    <title>FAQ - <?php echo $siteName; ?></title>
    <meta name="description" content="Frequently asked questions about <?php echo $siteName; ?> platform"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = { darkMode: "class", theme: { extend: { colors: { "primary": "#f97415", "background-light": "#f8f7f5", "background-dark": "#23170f" }, fontFamily: { "display": ["Inter", "sans-serif"] }, borderRadius: { "DEFAULT": "0.5rem", "lg": "1rem", "xl": "1.5rem", "full": "9999px" } } } }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-gradient { background: linear-gradient(90deg, rgba(35, 23, 15, 0.9) 0%, rgba(249, 116, 21, 0.4) 100%); }
        .faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.3s ease; }
        .faq-item.active .faq-answer { max-height: 500px; }
        .faq-item.active .faq-chevron { transform: rotate(180deg); }
    </style>
</head>
<body class="bg-background-light text-slate-900 font-display">
<div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
    <?php include __DIR__ . '/includes/header.php'; ?>

    <!-- Hero -->
    <div class="relative w-full h-[320px] overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo htmlspecialchars($baseUrl); ?>/assets/images/kabab-template.jpg');"></div>
        <div class="absolute inset-0 hero-gradient"></div>
        <div class="relative h-full flex flex-col justify-center px-6 md:px-20 max-w-[1200px] mx-auto text-white">
            <nav class="flex items-center gap-2 text-primary/80 mb-6 uppercase tracking-widest text-xs font-bold">
                <a class="hover:text-white transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/">Home</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span class="text-white">FAQ</span>
            </nav>
            <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight">Frequently Asked Questions</h1>
            <p class="text-lg md:text-xl text-slate-200 max-w-2xl font-light leading-relaxed">Find answers to common questions about <?php echo $siteName; ?>.</p>
        </div>
    </div>

    <!-- Content -->
    <main class="bg-white py-12 md:py-20 px-6 md:px-20">
        <div class="max-w-[800px] mx-auto">
            <div class="space-y-4">
                <?php
                $faqs = [
                    ['q' => 'What is ' . $siteName . '?', 'a' => $siteName . ' is a professional digital menu platform that helps restaurants create beautiful, customizable online menus. It\'s designed to be easy to use, mobile-responsive, and perfect for showcasing your restaurant\'s offerings to customers.'],
                    ['q' => 'Do I need technical skills to use ' . $siteName . '?', 'a' => 'No technical skills required! Our platform is designed to be intuitive and user-friendly. You can create and update your menu in minutes using our simple interface. If you need help, our support team is always available to assist you.'],
                    ['q' => 'Can I customize my menu design?', 'a' => 'Yes! You can fully customize your menu\'s appearance including colors, fonts, images, and layout. Choose from our professional templates or create your own unique design that matches your restaurant\'s brand.'],
                    ['q' => 'Is my menu mobile-friendly?', 'a' => 'Absolutely! All menus created with ' . $siteName . ' are fully responsive and look perfect on desktop, tablet, and mobile devices. Your customers can browse your menu from any device.'],
                    ['q' => 'How much does it cost?', 'a' => 'We offer flexible pricing plans. Choose between Starter, Professional, or Enterprise plans based on your needs. Annual plans save you 20% compared to monthly billing. Visit our Pricing page for details.'],
                    ['q' => 'Can I update my menu anytime?', 'a' => 'Yes! You can update your menu anytime, anywhere. Changes are reflected immediately on your live menu. Add new items, update prices, change descriptions, or modify categories with just a few clicks.'],
                    ['q' => 'How many menu items can I add?', 'a' => 'Our plans include generous limits on categories and menu items. Add as many as you need for your restaurant. Check the Pricing page for plan limits.'],
                    ['q' => 'Do you offer customer support?', 'a' => 'Yes! We offer email support for all plans, and priority support for higher tiers. Our support team is here to help you succeed with your digital menu.'],
                    ['q' => 'Can I use my own domain?', 'a' => 'Higher-tier plans can use a custom domain. Contact our team for more information about custom domain setup.'],
                    ['q' => 'Is there a free trial?', 'a' => 'Yes! You can start with a free trial to explore all features. No credit card required. Sign up today and see how easy it is to create your digital menu.'],
                    ['q' => 'How do I get started?', 'a' => 'Getting started is easy! Click "Get Started" to create your account. You\'ll be guided through the setup process step by step. You can have your menu live in minutes.'],
                ];
                foreach ($faqs as $i => $faq):
                ?>
                <div class="faq-item border border-slate-200 rounded-xl overflow-hidden <?php echo $i === 0 ? 'active' : ''; ?>">
                    <button type="button" class="faq-question w-full flex items-center justify-between gap-4 text-left px-6 py-5 bg-white hover:bg-slate-50 transition-colors font-semibold text-slate-900">
                        <span><?php echo htmlspecialchars($faq['q']); ?></span>
                        <span class="faq-chevron material-symbols-outlined text-primary shrink-0 transition-transform">expand_more</span>
                    </button>
                    <div class="faq-answer">
                        <div class="px-6 pb-5 pt-0 text-slate-600 leading-relaxed border-t border-slate-100 bg-slate-50/50"><?php echo htmlspecialchars($faq['a']); ?></div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="mt-12 text-center">
                <a href="<?php echo htmlspecialchars($authUrl); ?>" class="inline-flex items-center gap-2 bg-primary hover:bg-primary/90 text-white px-8 py-3 rounded-lg font-bold transition-all">Get Started</a>
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
