<?php
/**
 * Templates Page - resmenu.net
 * New design with shared header/footer. Preview links to backend templateN-preview.
 */
require_once __DIR__ . '/config/config.php';
$baseUrl = defined('SITE_URL') ? rtrim(SITE_URL, '/') : '';
$authUrl = defined('BACKEND_URL') ? rtrim(BACKEND_URL, '/') . '/' : 'https://our-menu.online/';
$backendUrl = defined('BACKEND_URL') ? rtrim(BACKEND_URL, '/') : 'https://our-menu.online';

$templates = [
    ['id' => 1, 'name' => 'Modern Classic', 'badge' => 'Popular', 'description' => 'Elegant and sophisticated fine dining style. Perfect for Signature Bistros featuring multi-course menus and wine pairings.', 'preview_bg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuCvTZ2osPuK4-ItcHMziSEg7d0NA_fHOMP0RWS_Y_YuBXuEf81qjpNGLUFJEWVJ9NnFDCndE9yTIGpZJm_tmGOTqYgOUVTMhkYlQWuZGC8qxD_MI6tUsRNye6NZzpHzlhHWWDHcfIEmyafCu9GSCfxD2_5af73rJpZRD1cxoYbYv-OaxbQM-aeJg118YLhqnatKAbWMewESdcaH5bkyPIPgO2d-HdvPsNWdNQ9IeomcHSpmVt2BXIyqk4QGjbe0vGpIwutZ_82nfMmY'],
    ['id' => 2, 'name' => 'Dark Luxury', 'badge' => null, 'description' => 'Premium lounge aesthetic with dark mode optimization. Ideal for Skyline Lounges, cocktail bars, and premium bottle service.', 'preview_bg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuA26eME1JcD-BKiAR84Q5IR5Z9VVcJCB_SlXzbjngaVsYSrdg5mj4xhiFoHWAo4FkwXDUbEey7d6eMeB_RBJ9n6it4ltaM7lM3xohv8Vh_2a6QaefMg3O6Dfx5rbOnDZgwKZXWMK48AG5ASPVm8pSTh4I9xa8yEjtm5q7CcH7mdIaYeVpzWPV8a7mZ7XOgH5F7s41zmhIlA3IA7PgVCbc5EyeKHuteWGVKXaOTcAUVOhZ-AsN3CRa7qrmB5fyPZbwBcO9da03_DcEFe'],
    ['id' => 3, 'name' => 'Café Minimal', 'badge' => null, 'description' => 'Clean, bright, and easy to navigate. Designed for coffee shops and bakeries looking for a fresh, modern aesthetic.', 'preview_bg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuB2LiAwGspMnndSVVl3vqjF-XIjR2BH4fZNRyocf_tjGj2JlcdaTPB3JDyQtNeCzjU0se84KgJ_Fh-dNMSQhxOyYSWHlVjhD1tATTTXTVNI765PHrg-bZ53Awk3J-FbYqdj2bV-V3gPLJnkvLLzW5WLtowh3VcTtFKiC0F-72xBdO8oqBO0qlBI8TvUQfP-_F2FpWkwVVgmvdCx0G3VHWRD9egdPwganzLBZDAE9nq1McdJmjZr72TPAkhsc2Uqw_j8n43eZn4anL3m'],
    ['id' => 4, 'name' => 'Rustic Charm', 'badge' => null, 'description' => 'Warm, wood-textured layout that evokes a cozy steakhouse or traditional pub atmosphere. Focuses on hearty meals.', 'preview_bg' => 'https://lh3.googleusercontent.com/aida-public/AB6AXuC-fyxHYs77-drzIkORSXRCxAiyqe0PcDujNLFjzD9VtKIL9ZGOkO2a9_hPcwou7onYD3HFLCSCNUhnoEWUslH0Gjhitkd7oCLNCT1RBwP7cF0PM2IWnTmln3ENoeZ7lRskFoxoWlFdBXcKAdKhN-BWoCtgPTOyEgapUrtBjFKSYsJkKij73r2mjDOLmVhWsjzPPk0GfbRVPf5N8ldCAanItWlj48rllL_tbTHx4gZSRp2P9bwunIPI_ioKsEYM39JrTnLgQ4rBzRSv'],
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Templates - SigSol Resmenu</title>
    <meta name="description" content="Choose your perfect digital menu template. Modern Classic, Dark Luxury, Café Minimal, Rustic Charm.">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo htmlspecialchars($baseUrl); ?>/assets/css/marketing.css">
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
</head>
<body class="bg-background-light text-slate-900">
<?php include __DIR__ . '/includes/header.php'; ?>

<!-- Hero -->
<section class="relative w-full h-[350px] flex items-center overflow-hidden">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo htmlspecialchars($baseUrl); ?>/assets/images/kabab-template.jpg');"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-background-dark via-background-dark/80 to-primary/20"></div>
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <nav class="flex mb-4 text-sm font-medium text-slate-300">
            <a class="hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/">Home</a>
            <span class="mx-2">/</span>
            <span class="text-white">Templates</span>
        </nav>
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 leading-tight max-w-2xl">Choose Your Perfect Template</h1>
        <p class="text-slate-300 text-lg max-w-xl leading-relaxed">
            Elevate your dining experience with our professionally designed layouts tailored for every culinary style, from fine dining to cozy cafes.
        </p>
    </div>
</section>

<!-- Template grid -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        <?php foreach ($templates as $t): ?>
        <div class="group flex flex-col bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all border border-slate-100">
            <div class="aspect-[16/10] overflow-hidden bg-slate-200 relative">
                <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-500" style="background-image: url('<?php echo htmlspecialchars($t['preview_bg']); ?>');"></div>
                <div class="absolute inset-0 bg-black/5"></div>
            </div>
            <div class="p-8 flex flex-col h-full">
                <div class="flex justify-between items-start mb-2">
                    <h3 class="text-2xl font-bold text-slate-900"><?php echo htmlspecialchars($t['name']); ?></h3>
                    <?php if (!empty($t['badge'])): ?>
                    <span class="bg-primary/10 text-primary text-xs font-bold px-2 py-1 rounded"><?php echo htmlspecialchars($t['badge']); ?></span>
                    <?php endif; ?>
                </div>
                <p class="text-slate-600 mb-8 flex-grow"><?php echo htmlspecialchars($t['description']); ?></p>
                <div class="flex flex-wrap gap-4">
                    <a href="<?php echo htmlspecialchars($authUrl); ?>" class="flex-1 bg-primary hover:bg-primary/90 text-white py-3 px-6 rounded-lg font-bold transition-colors text-center">Use This Template</a>
                    <a href="<?php echo htmlspecialchars($backendUrl); ?>/template<?php echo (int)$t['id']; ?>-preview" target="_blank" rel="noopener" class="flex-1 bg-slate-100 hover:bg-slate-200 text-slate-900 py-3 px-6 rounded-lg font-bold transition-colors text-center">Preview Demo</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- Why Our Templates Stand Out -->
<section class="bg-white py-20 border-y border-slate-100">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-6 text-slate-900">Why Our Templates Stand Out</h2>
        <p class="text-slate-600 text-lg mb-12">
            Designed by industry experts, our templates combine aesthetics with high conversion rates and effortless user experience.
        </p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
            <div class="flex items-start gap-4">
                <div class="bg-primary/10 p-2 rounded-lg text-primary"><span class="material-symbols-outlined">smartphone</span></div>
                <div>
                    <h4 class="font-bold text-lg mb-1">Mobile-First Design</h4>
                    <p class="text-slate-600">Optimized for every screen size to ensure a smooth ordering experience on any device.</p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <div class="bg-primary/10 p-2 rounded-lg text-primary"><span class="material-symbols-outlined">edit_note</span></div>
                <div>
                    <h4 class="font-bold text-lg mb-1">Easy Customization</h4>
                    <p class="text-slate-600">Modify colors, fonts, and layouts in seconds without needing any technical or design skills.</p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <div class="bg-primary/10 p-2 rounded-lg text-primary"><span class="material-symbols-outlined">bolt</span></div>
                <div>
                    <h4 class="font-bold text-lg mb-1">Blazing Fast Speed</h4>
                    <p class="text-slate-600">Lightweight code ensures your menu loads instantly, keeping your customers engaged.</p>
                </div>
            </div>
            <div class="flex items-start gap-4">
                <div class="bg-primary/10 p-2 rounded-lg text-primary"><span class="material-symbols-outlined">qr_code</span></div>
                <div>
                    <h4 class="font-bold text-lg mb-1">Auto-Generated QR</h4>
                    <p class="text-slate-600">Every template automatically generates unique QR codes for your tables and marketing.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
    <div class="bg-primary rounded-3xl p-10 md:p-20 relative overflow-hidden">
        <h2 class="text-3xl md:text-5xl font-bold text-white mb-6 relative z-10">Start Building Your Digital Menu Today</h2>
        <p class="text-white/90 text-lg mb-10 max-w-2xl mx-auto relative z-10">
            Join thousands of restaurants worldwide that are modernizing their guest experience with SigSol Resmenu.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center relative z-10">
            <a href="<?php echo htmlspecialchars($authUrl); ?>" class="bg-white text-primary hover:bg-slate-50 px-8 py-4 rounded-xl font-bold text-lg transition-all shadow-lg text-center">Get Started Now</a>
            <a href="<?php echo htmlspecialchars($baseUrl); ?>/contact.php" class="bg-transparent border-2 border-white/40 text-white hover:bg-white/10 px-8 py-4 rounded-xl font-bold text-lg transition-all text-center">Request a Demo</a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
</body>
</html>
