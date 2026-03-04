<?php
/**
 * Terms and Conditions - resmenu.net
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
    <title>Terms and Conditions - <?php echo $siteName; ?></title>
    <meta name="description" content="Terms and conditions for using <?php echo $siteName; ?> digital menu platform"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
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
                    },
                    fontFamily: { "display": ["Inter", "sans-serif"] },
                    borderRadius: { "DEFAULT": "0.5rem", "lg": "1rem", "xl": "1.5rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .hero-gradient {
            background: linear-gradient(90deg, rgba(35, 23, 15, 0.9) 0%, rgba(249, 116, 21, 0.4) 100%);
        }
        @media print {
            header, footer, #termsModalOverlay, .terms-actions { display: none !important; }
            main { padding: 0 !important; }
            body { background: #fff; }
        }
    </style>
</head>
<body class="bg-background-light text-slate-900 font-display">
<div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
    <?php include __DIR__ . '/includes/header.php'; ?>

    <!-- Hero Section -->
    <div class="relative w-full h-[320px] overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo htmlspecialchars($baseUrl); ?>/assets/images/kabab-template.jpg');"></div>
        <div class="absolute inset-0 hero-gradient"></div>
        <div class="relative h-full flex flex-col justify-center px-6 md:px-20 max-w-[1200px] mx-auto text-white">
            <nav class="flex items-center gap-2 text-primary/80 mb-6 uppercase tracking-widest text-xs font-bold">
                <a class="hover:text-white transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/">Home</a>
                <span class="material-symbols-outlined text-[14px]">chevron_right</span>
                <span class="text-white">Terms and Conditions</span>
            </nav>
            <h1 class="text-4xl md:text-5xl font-black mb-4 tracking-tight">Terms and Conditions</h1>
            <p class="text-lg md:text-xl text-slate-200 max-w-2xl font-light leading-relaxed">
                Please read these terms carefully before using our digital menu platform. Your agreement to these terms is required to access <?php echo $siteName; ?> services.
            </p>
        </div>
    </div>

    <!-- Content Area -->
    <main class="bg-white py-12 md:py-20 px-6 md:px-20">
        <div class="max-w-[800px] mx-auto">
            <div class="prose prose-slate max-w-none">
                <section class="mb-12">
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-6 flex items-center gap-3">
                        <span class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center text-lg font-bold">1</span>
                        Introduction
                    </h2>
                    <p class="text-slate-600 leading-relaxed mb-4">
                        Welcome to <?php echo $siteName; ?>. These Terms and Conditions govern your use of our website and services. By accessing or using our platform, you agree to be bound by these terms. If you do not agree with any part of these terms, you may not use our services.
                    </p>
                    <p class="text-slate-600 leading-relaxed">
                        Our platform provides digital menu solutions for restaurants and hospitality businesses. These terms apply to all visitors, users, and others who access or use the Service.
                    </p>
                </section>

                <section class="mb-12">
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-6 flex items-center gap-3">
                        <span class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center text-lg font-bold">2</span>
                        Use of License
                    </h2>
                    <p class="text-slate-600 leading-relaxed mb-4">
                        Permission is granted to temporarily download one copy of the materials on <?php echo $siteName; ?>'s website for personal, non-commercial transitory viewing only. This is the grant of a license, not a transfer of title, and under this license you may not:
                    </p>
                    <ul class="list-disc pl-6 space-y-2 text-slate-600">
                        <li>Modify or copy the materials;</li>
                        <li>Use the materials for any commercial purpose, or for any public display;</li>
                        <li>Attempt to decompile or reverse engineer any software contained on the website;</li>
                        <li>Remove any copyright or other proprietary notations from the materials.</li>
                    </ul>
                </section>

                <section class="mb-12">
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-6 flex items-center gap-3">
                        <span class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center text-lg font-bold">3</span>
                        User Obligations
                    </h2>
                    <p class="text-slate-600 leading-relaxed">
                        You are responsible for maintaining the confidentiality of your account and password. You agree to accept responsibility for all activities that occur under your account. You must notify us immediately upon becoming aware of any breach of security or unauthorized use of your account.
                    </p>
                </section>

                <section class="mb-12">
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-6 flex items-center gap-3">
                        <span class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center text-lg font-bold">4</span>
                        Fees and Payments
                    </h2>
                    <p class="text-slate-600 leading-relaxed">
                        Some parts of the Service are billed on a subscription basis. You will be billed in advance on a recurring and periodic basis. Subscription periods are set either on a monthly or annual basis, depending on the type of subscription plan you select when purchasing a Subscription.
                    </p>
                </section>

                <section class="mb-12">
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-6 flex items-center gap-3">
                        <span class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center text-lg font-bold">5</span>
                        Intellectual Property
                    </h2>
                    <p class="text-slate-600 leading-relaxed">
                        The Service and its original content, features, and functionality are and will remain the exclusive property of <?php echo $siteName; ?> and its licensors. The Service is protected by copyright, trademark, and other laws of both the country and foreign countries.
                    </p>
                </section>

                <section class="mb-12">
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-6 flex items-center gap-3">
                        <span class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center text-lg font-bold">6</span>
                        Termination
                    </h2>
                    <p class="text-slate-600 leading-relaxed">
                        We may terminate or suspend your account and bar access to the Service immediately, without prior notice or liability, under our sole discretion, for any reason whatsoever and without limitation, including but not limited to a breach of the Terms.
                    </p>
                </section>

                <section class="mb-12">
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-6 flex items-center gap-3">
                        <span class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center text-lg font-bold">7</span>
                        Limitation of Liability
                    </h2>
                    <p class="text-slate-600 leading-relaxed">
                        In no event shall <?php echo $siteName; ?>, nor its directors, employees, partners, agents, suppliers, or affiliates, be liable for any indirect, incidental, special, consequential or punitive damages, including without limitation, loss of profits, data, use, goodwill, or other intangible losses.
                    </p>
                </section>

                <section class="mb-12">
                    <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-6 flex items-center gap-3">
                        <span class="size-8 rounded-lg bg-primary/10 text-primary flex items-center justify-center text-lg font-bold">8</span>
                        Governing Law
                    </h2>
                    <p class="text-slate-600 leading-relaxed">
                        These Terms shall be governed and construed in accordance with the laws of the jurisdiction in which <?php echo $siteName; ?> operates, without regard to its conflict of law provisions.
                    </p>
                </section>

                <div class="mt-20 pt-10 border-t border-slate-200 text-center">
                    <p class="text-sm text-slate-500 italic">Last Updated: <?php echo date('F j, Y'); ?></p>
                    <div class="terms-actions mt-8 flex flex-wrap justify-center gap-4">
                        <button type="button" id="acceptTermsBtn" class="px-8 py-3 bg-primary text-white font-bold rounded-lg hover:opacity-90 transition-all cursor-pointer">Accept Terms</button>
                        <button type="button" id="downloadPdfBtn" class="px-8 py-3 border border-slate-200 font-bold rounded-lg hover:bg-slate-50 transition-all cursor-pointer">Download PDF</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>
</div>

<!-- Accept Terms confirmation modal -->
<div id="termsModalOverlay" class="fixed inset-0 bg-black/50 z-[100] hidden items-center justify-center p-4" aria-hidden="true">
    <div id="termsModal" class="bg-white rounded-2xl shadow-xl max-w-md w-full p-8 relative" role="dialog" aria-labelledby="termsModalTitle" aria-modal="true">
        <h3 id="termsModalTitle" class="text-xl font-bold text-slate-900 mb-4">Confirm acceptance</h3>
        <p class="text-slate-600 mb-6">I have read and accept the Terms and Conditions of <?php echo $siteName; ?>.</p>
        <div class="flex gap-4 justify-end">
            <button type="button" id="termsModalCancel" class="px-6 py-2.5 border border-slate-200 font-semibold rounded-lg hover:bg-slate-50 transition-all">Cancel</button>
            <button type="button" id="termsModalAccept" class="px-6 py-2.5 bg-primary text-white font-semibold rounded-lg hover:opacity-90 transition-all">I Accept</button>
        </div>
    </div>
</div>

<script>
(function() {
    var authUrl = <?php echo json_encode($authUrl); ?>;
    var storageKey = 'terms_accepted_at';

    var overlay = document.getElementById('termsModalOverlay');
    var acceptBtn = document.getElementById('acceptTermsBtn');
    var cancelBtn = document.getElementById('termsModalCancel');
    var modalAcceptBtn = document.getElementById('termsModalAccept');
    var downloadPdfBtn = document.getElementById('downloadPdfBtn');

    function showModal() {
        overlay.classList.remove('hidden');
        overlay.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    function hideModal() {
        overlay.classList.add('hidden');
        overlay.classList.remove('flex');
        document.body.style.overflow = '';
    }
    function acceptTerms() {
        try {
            localStorage.setItem(storageKey, new Date().toISOString());
        } catch (e) {}
        hideModal();
        window.location.href = authUrl;
    }

    if (acceptBtn) acceptBtn.addEventListener('click', showModal);
    if (cancelBtn) cancelBtn.addEventListener('click', hideModal);
    if (modalAcceptBtn) modalAcceptBtn.addEventListener('click', acceptTerms);
    overlay.addEventListener('click', function(e) { if (e.target === overlay) hideModal(); });
    document.addEventListener('keydown', function(e) { if (e.key === 'Escape') hideModal(); });

    if (downloadPdfBtn) {
        downloadPdfBtn.addEventListener('click', function() {
            window.print();
        });
    }
})();
</script>
</body>
</html>
