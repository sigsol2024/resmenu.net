<?php
/**
 * Templates Page - resmenu.net
 * Fetches template data from backend API. Preview links to backend templateN-preview.
 */
require_once __DIR__ . '/config/config.php';
$baseUrl = defined('SITE_URL') ? rtrim(SITE_URL, '/') : '';
$authUrl = defined('BACKEND_URL') ? rtrim(BACKEND_URL, '/') . '/' : 'https://our-menu.online/';
$backendUrl = defined('BACKEND_URL') ? rtrim(BACKEND_URL, '/') : 'https://our-menu.online';

$templates = [];
$apiUrl = $backendUrl . '/api/templates.php';
$ctx = stream_context_create(['http' => ['timeout' => 5]]);
$json = @file_get_contents($apiUrl, false, $ctx);
if ($json !== false) {
    $decoded = json_decode($json, true);
    if (!empty($decoded['success']) && !empty($decoded['data']) && is_array($decoded['data'])) {
        foreach ($decoded['data'] as $row) {
            $templates[] = [
                'id' => (int) ($row['id'] ?? 0),
                'name' => $row['name'] ?? 'Template ' . ($row['id'] ?? 0),
                'description' => $row['description'] ?? '',
                'preview_bg' => $row['preview_image'] ?? '',
                'listing_image' => $row['listing_image'] ?? '',
            ];
        }
    }
}
if (empty($templates)) {
    $templates = [
        ['id' => 4, 'name' => 'Template 4', 'description' => '', 'preview_bg' => '', 'listing_image' => ''],
        ['id' => 3, 'name' => 'Template 3', 'description' => '', 'preview_bg' => '', 'listing_image' => ''],
        ['id' => 2, 'name' => 'Template 2', 'description' => '', 'preview_bg' => '', 'listing_image' => ''],
        ['id' => 1, 'name' => 'Template 1', 'description' => '', 'preview_bg' => '', 'listing_image' => ''],
    ];
}
// Ensure most recent first and max 5
usort($templates, function ($a, $b) { return ($b['id'] - $a['id']); });
$templates = array_slice($templates, 0, 5);
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

<!-- Template timeline: most recent 5 + Custom Template (image + title + description) -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
    <div class="space-y-12">
        <?php foreach ($templates as $index => $t):
            $previewPageUrl = $backendUrl . '/template' . (int)$t['id'] . '-preview';
            $listingImg = !empty($t['listing_image']) ? $t['listing_image'] : (!empty($t['preview_bg']) ? $t['preview_bg'] : $baseUrl . '/assets/images/kabab-template.jpg');
            $isEven = ($index % 2) === 0;
        ?>
        <div class="flex flex-col <?php echo $isEven ? 'lg:flex-row' : 'lg:flex-row-reverse'; ?> gap-0 items-stretch bg-white rounded-xl overflow-hidden shadow-sm border border-slate-200">
            <div class="w-full lg:w-[60%] flex-shrink-0">
                <div class="aspect-[4/3] lg:aspect-auto lg:min-h-[280px] h-full bg-slate-100 rounded-t-xl lg:rounded-l-xl lg:rounded-tr-none overflow-hidden">
                    <img src="<?php echo htmlspecialchars($listingImg); ?>" alt="<?php echo htmlspecialchars($t['name']); ?>" class="w-full h-full object-cover">
                </div>
            </div>
            <div class="w-full lg:w-[40%] flex-shrink-0 p-6 lg:p-10 flex flex-col justify-center bg-white/80 backdrop-blur-md border-slate-200 <?php echo $isEven ? 'lg:border-l' : 'lg:border-r'; ?>">
                <h3 class="text-2xl font-bold text-slate-900 mb-3"><?php echo htmlspecialchars($t['name']); ?></h3>
                <p class="text-slate-600 leading-relaxed mb-6"><?php echo nl2br(htmlspecialchars($t['description'] ?: 'A professional digital menu template.')); ?></p>
                <div class="flex flex-wrap gap-4">
                    <a href="<?php echo htmlspecialchars($previewPageUrl); ?>" target="_blank" rel="noopener" class="bg-slate-100 hover:bg-slate-200 text-slate-900 py-3 px-6 rounded-lg font-bold transition-colors text-center">Preview Demo</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <!-- Custom Template (same timeline design, CTA Get Started Now) -->
        <?php
        $customIndex = count($templates);
        $isEvenCustom = ($customIndex % 2) === 0;
        $customImage = $baseUrl . '/assets/images/kabab-template.jpg';
        ?>
        <div class="flex flex-col <?php echo $isEvenCustom ? 'lg:flex-row' : 'lg:flex-row-reverse'; ?> gap-0 items-stretch bg-white rounded-xl overflow-hidden shadow-sm border border-slate-200">
            <div class="w-full lg:w-[60%] flex-shrink-0">
                <div class="aspect-[4/3] lg:aspect-auto lg:min-h-[280px] h-full bg-slate-100 rounded-t-xl lg:rounded-l-xl lg:rounded-tr-none overflow-hidden">
                    <img src="<?php echo htmlspecialchars($customImage); ?>" alt="Custom Template" class="w-full h-full object-cover">
                </div>
            </div>
            <div class="w-full lg:w-[40%] flex-shrink-0 p-6 lg:p-10 flex flex-col justify-center bg-white/80 backdrop-blur-md border-slate-200 <?php echo $isEvenCustom ? 'lg:border-l' : 'lg:border-r'; ?>">
                <h3 class="text-2xl font-bold text-slate-900 mb-3">Custom Template</h3>
                <p class="text-slate-600 leading-relaxed mb-6">Restaurants can provide their own design or speak with our sales team to have a custom template designed for their restaurant menu. We’ll match your brand and layout so your digital menu looks exactly how you want it.</p>
                <div class="flex flex-wrap gap-4">
                    <a href="<?php echo htmlspecialchars($authUrl); ?>" class="bg-primary hover:bg-primary/90 text-white py-3 px-6 rounded-lg font-bold transition-colors text-center">Get Started Now</a>
                </div>
            </div>
        </div>
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
        <div class="pointer-events-none absolute inset-0 opacity-10" style="background-image: url('<?php echo htmlspecialchars($baseUrl); ?>/assets/images/bh_pattern-black.png'); background-repeat: repeat; background-size: 280px 280px;"></div>
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
