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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Contact Us - <?php echo $siteName; ?></title>
    <meta name="description" content="Get in touch with <?php echo $siteName; ?> support team"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script id="tailwind-config">
        tailwind.config = { darkMode: "class", theme: { extend: { colors: { "primary": "#f97415", "background-light": "#f8f7f5", "background-dark": "#23170f" }, fontFamily: { "display": ["Inter", "sans-serif"] }, borderRadius: { "DEFAULT": "0.5rem", "lg": "1rem", "xl": "1.5rem", "full": "9999px" } } } }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-gradient { background: linear-gradient(90deg, rgba(35, 23, 15, 0.9) 0%, rgba(249, 116, 21, 0.4) 100%); }
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
                <span class="text-white">Contact</span>
            </nav>
            <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight">Get In Touch</h1>
            <p class="text-lg md:text-xl text-slate-200 max-w-2xl font-light leading-relaxed">Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
        </div>
    </div>

    <!-- Content -->
    <main class="bg-white py-12 md:py-20 px-6 md:px-20">
        <div class="max-w-[1000px] mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
            <!-- Form -->
            <div>
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Send us a Message</h2>
                <form id="contactForm" class="space-y-5">
                    <div>
                        <label for="name" class="block text-sm font-medium text-slate-700 mb-1.5">Your Name</label>
                        <input type="text" id="name" name="name" required class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary"/>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-1.5">Email Address</label>
                        <input type="email" id="email" name="email" required class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary"/>
                    </div>
                    <div>
                        <label for="subject" class="block text-sm font-medium text-slate-700 mb-1.5">Subject</label>
                        <input type="text" id="subject" name="subject" required class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary"/>
                    </div>
                    <div>
                        <label for="message" class="block text-sm font-medium text-slate-700 mb-1.5">Message</label>
                        <textarea id="message" name="message" rows="5" required class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:ring-2 focus:ring-primary/30 focus:border-primary"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-primary hover:bg-primary/90 text-white font-bold py-3 px-6 rounded-lg transition-all">Send Message</button>
                    <div id="formMessage" class="hidden p-4 rounded-lg text-sm"></div>
                </form>
            </div>
            <!-- Contact info -->
            <div>
                <h2 class="text-2xl font-bold text-slate-900 mb-6">Contact Information</h2>
                <div class="space-y-6 text-slate-600">
                    <div class="flex gap-4">
                        <span class="material-symbols-outlined text-primary text-2xl">mail</span>
                        <div>
                            <p class="font-medium text-slate-900">Email</p>
                            <p>support@sigsolresmenu.com</p>
                            <p>info@sigsolresmenu.com</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <span class="material-symbols-outlined text-primary text-2xl">phone</span>
                        <div>
                            <p class="font-medium text-slate-900">Phone</p>
                            <p>+234 (0) 123 456 7890</p>
                            <p class="text-sm">Monday – Friday, 9 AM – 6 PM</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <span class="material-symbols-outlined text-primary text-2xl">location_on</span>
                        <div>
                            <p class="font-medium text-slate-900">Address</p>
                            <p>123 Business Street<br/>Lagos, Nigeria<br/>100001</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <span class="material-symbols-outlined text-primary text-2xl">share</span>
                        <div>
                            <p class="font-medium text-slate-900 mb-2">Social Media</p>
                            <div class="flex gap-3">
                                <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center hover:bg-primary hover:text-white transition-colors" aria-label="Facebook"><span class="material-symbols-outlined text-xl">public</span></a>
                                <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center hover:bg-primary hover:text-white transition-colors" aria-label="Twitter"><span class="material-symbols-outlined text-xl">chat</span></a>
                                <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center hover:bg-primary hover:text-white transition-colors" aria-label="Instagram"><span class="material-symbols-outlined text-xl">photo_camera</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-10 h-[240px] bg-slate-100 rounded-xl flex items-center justify-center text-slate-400">
                    <span class="material-symbols-outlined text-5xl">map</span>
                    <span class="ml-2">Map</span>
                </div>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var form = document.getElementById('contactForm');
    var msg = document.getElementById('formMessage');
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            msg.classList.remove('hidden');
            msg.classList.remove('bg-red-100', 'text-red-800');
            msg.classList.add('bg-green-100', 'text-green-800');
            msg.textContent = "Thank you for your message! We'll get back to you soon.";
            form.reset();
            setTimeout(function() { msg.classList.add('hidden'); }, 5000);
        });
    }
});
</script>
</body>
</html>
