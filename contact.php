<?php
/**
 * Contact Us - resmenu.net
 */
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/mail.php';

$baseUrl = defined('SITE_URL') ? rtrim(SITE_URL, '/') : '';
$authUrl = defined('BACKEND_URL') ? rtrim(BACKEND_URL, '/') . '/' : 'https://our-menu.online/';
$siteSettings = getSiteSettings();
$siteName = htmlspecialchars($siteSettings['site_name'] ?? 'Resmenu');

$contactSalesEmail = $siteSettings['contact_sales_email'] ?? 'sales@sigsolresmenu.com';
$contactSalesPhone = $siteSettings['contact_sales_phone'] ?? '+234 (0) 812 345 6789';
$contactSupportEmail = $siteSettings['contact_support_email'] ?? 'support@sigsolresmenu.com';
$contactSupportPhone = $siteSettings['contact_support_phone'] ?? '+234 (0) 701 987 6543';
$contactPartnersEmail = $siteSettings['contact_partners_email'] ?? 'partners@sigsolresmenu.com';
$contactFormRecipient = $siteSettings['contact_form_recipient'] ?? ($contactSupportEmail ?: $contactSalesEmail);
$contactHqTitle = $siteSettings['contact_hq_title'] ?? 'Lagos HQ';
$contactHqAddress = $siteSettings['contact_hq_address'] ?? "12 Adeola Odeku Street, Victoria Island,\nLagos 101241, Nigeria";
$contactMapEmbed = $siteSettings['contact_map_embed'] ?? '';
$contactFacebook = $siteSettings['contact_social_facebook'] ?? '#';
$contactTwitter = $siteSettings['contact_social_twitter'] ?? '#';
$contactInstagram = $siteSettings['contact_social_instagram'] ?? '#';

$formStatus = ['type' => null, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $restaurantName = trim($_POST['restaurant_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $subject = trim($_POST['subject'] ?? 'General Inquiry');
    $messageBody = trim($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($messageBody)) {
        $formStatus = ['type' => 'error', 'message' => 'Please fill in your name, email, and message.'];
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $formStatus = ['type' => 'error', 'message' => 'Please enter a valid email address.'];
    } elseif (empty($contactFormRecipient) || !filter_var($contactFormRecipient, FILTER_VALIDATE_EMAIL)) {
        $formStatus = ['type' => 'error', 'message' => 'Contact form recipient email is not configured.'];
    } else {
        $plainSubject = $siteSettings['site_name'] ?? 'Resmenu';
        $emailSubject = 'New Contact Message - ' . $plainSubject;
        $body = '<p style="margin:0 0 8px;"><strong>Name:</strong> ' . htmlspecialchars($name) . '</p>';
        if ($restaurantName !== '') {
            $body .= '<p style="margin:0 0 8px;"><strong>Restaurant:</strong> ' . htmlspecialchars($restaurantName) . '</p>';
        }
        $body .= '<p style="margin:0 0 8px;"><strong>Email:</strong> ' . htmlspecialchars($email) . '</p>';
        if ($phone !== '') {
            $body .= '<p style="margin:0 0 8px;"><strong>Phone:</strong> ' . htmlspecialchars($phone) . '</p>';
        }
        $body .= '<p style="margin:0 0 8px;"><strong>Subject:</strong> ' . htmlspecialchars($subject) . '</p>';
        $body .= '<p style="margin:12px 0 0;"><strong>Message:</strong></p>';
        $body .= '<p style="white-space:pre-line;margin:4px 0 0;">' . nl2br(htmlspecialchars($messageBody)) . '</p>';

        $html = getSiteEmailTemplate('New Contact Message', $body, $siteSettings);
        $options = [
            'reply_to' => $email,
            'reply_to_name' => $name,
        ];

        if (sendEmail($contactFormRecipient, '', $emailSubject, $html, $options)) {
            $formStatus = ['type' => 'success', 'message' => "Thank you for your message! We'll get back to you soon."];
        } else {
            $formStatus = ['type' => 'error', 'message' => 'Failed to send your message. Please try again later.'];
        }
    }
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Contact Us - <?php echo $siteName; ?></title>
    <meta name="description" content="Get in touch with <?php echo $siteName; ?> support team"/>
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
            <h1 class="text-white text-5xl md:text-6xl font-bold mb-6 leading-tight">Get in Touch</h1>
            <p class="text-slate-200 text-lg md:text-xl leading-relaxed max-w-xl">
                Have questions about our digital menu platform? Our team is here to help you modernize your restaurant experience.
            </p>
        </div>
    </section>

    <main class="max-w-[1400px] mx-auto px-6 py-16 md:py-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
            <!-- Structured Support -->
            <div class="lg:col-span-3 space-y-8">
                <div>
                    <h3 class="text-xl font-bold mb-6 text-slate-900 dark:text-white">Structured Support</h3>
                    <div class="space-y-6">
                        <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-100 dark:border-slate-800 shadow-sm">
                            <div class="size-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary mb-4">
                                <span class="material-symbols-outlined">payments</span>
                            </div>
                            <h4 class="font-bold text-slate-900 dark:text-white mb-2">Sales Inquiries</h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mb-3 uppercase tracking-wider font-semibold">New business &amp; pricing</p>
                            <a class="block text-sm text-primary font-medium hover:underline mb-1" href="mailto:<?php echo htmlspecialchars($contactSalesEmail); ?>"><?php echo htmlspecialchars($contactSalesEmail); ?></a>
                            <?php if (!empty($contactSalesPhone)): ?>
                            <p class="text-sm text-slate-600 dark:text-slate-400"><?php echo htmlspecialchars($contactSalesPhone); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-100 dark:border-slate-800 shadow-sm">
                            <div class="size-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary mb-4">
                                <span class="material-symbols-outlined">handyman</span>
                            </div>
                            <h4 class="font-bold text-slate-900 dark:text-white mb-2">Technical Support</h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mb-3 uppercase tracking-wider font-semibold">Platform assistance</p>
                            <a class="block text-sm text-primary font-medium hover:underline mb-1" href="mailto:<?php echo htmlspecialchars($contactSupportEmail); ?>"><?php echo htmlspecialchars($contactSupportEmail); ?></a>
                            <?php if (!empty($contactSupportPhone)): ?>
                            <p class="text-sm text-slate-600 dark:text-slate-400"><?php echo htmlspecialchars($contactSupportPhone); ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-100 dark:border-slate-800 shadow-sm">
                            <div class="size-10 rounded-lg bg-primary/10 flex items-center justify-center text-primary mb-4">
                                <span class="material-symbols-outlined">hub</span>
                            </div>
                            <h4 class="font-bold text-slate-900 dark:text-white mb-2">Partnerships</h4>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mb-3 uppercase tracking-wider font-semibold">Collaborations</p>
                            <a class="block text-sm text-primary font-medium hover:underline mb-1" href="mailto:<?php echo htmlspecialchars($contactPartnersEmail); ?>"><?php echo htmlspecialchars($contactPartnersEmail); ?></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Send us a Message -->
            <div class="lg:col-span-5">
                <div class="bg-white dark:bg-slate-900 p-8 md:p-10 rounded-xl shadow-xl border border-slate-100 dark:border-slate-800">
                    <h3 class="text-2xl font-bold mb-8 text-slate-900 dark:text-white">Send us a Message</h3>
                    <form id="contactForm" method="POST" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col gap-1.5">
                                <label for="name" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Full Name</label>
                                <input id="name" name="name" type="text" required class="w-full px-4 py-3 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none text-sm" placeholder="John Doe"/>
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label for="restaurant_name" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Restaurant Name</label>
                                <input id="restaurant_name" name="restaurant_name" type="text" class="w-full px-4 py-3 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none text-sm" placeholder="The Tasty Grill"/>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="flex flex-col gap-1.5">
                                <label for="email" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Email Address</label>
                                <input id="email" name="email" type="email" required class="w-full px-4 py-3 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none text-sm" placeholder="john@example.com"/>
                            </div>
                            <div class="flex flex-col gap-1.5">
                                <label for="phone" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Phone Number</label>
                                <input id="phone" name="phone" type="tel" class="w-full px-4 py-3 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none text-sm" placeholder="+234 800 000 0000"/>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="subject" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Subject</label>
                            <select id="subject" name="subject" class="w-full px-4 py-3 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none appearance-none text-sm">
                                <option value="General Inquiry">General Inquiry</option>
                                <option value="Sales & Pricing">Sales &amp; Pricing</option>
                                <option value="Technical Support">Technical Support</option>
                                <option value="Partnership">Partnership</option>
                            </select>
                        </div>
                        <div class="flex flex-col gap-1.5">
                            <label for="message" class="text-sm font-semibold text-slate-700 dark:text-slate-300">Message</label>
                            <textarea id="message" name="message" rows="4" required class="w-full px-4 py-3 rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 focus:ring-2 focus:ring-primary focus:border-transparent transition-all outline-none resize-none text-sm" placeholder="How can we help you today?"></textarea>
                        </div>
                        <?php if ($formStatus['type']): ?>
                        <div id="formMessage" class="p-4 rounded-lg text-sm <?php echo $formStatus['type'] === 'success' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900/40 dark:text-red-200'; ?>">
                            <?php echo htmlspecialchars($formStatus['message']); ?>
                        </div>
                        <?php else: ?>
                        <div id="formMessage" class="hidden p-4 rounded-lg text-sm"></div>
                        <?php endif; ?>
                        <button type="submit" class="w-full py-4 bg-primary text-white font-bold rounded-lg shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all transform hover:-translate-y-0.5 active:translate-y-0">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>

            <!-- Global Presence & Follow -->
            <div class="lg:col-span-4 space-y-10">
                <div class="space-y-8">
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">Global Presence</h3>
                    <div class="flex items-start gap-4">
                        <div class="size-12 rounded-lg bg-primary/10 flex items-center justify-center text-primary flex-shrink-0">
                            <span class="material-symbols-outlined">location_on</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 dark:text-white mb-1"><?php echo htmlspecialchars($contactHqTitle); ?></h4>
                            <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                                <?php echo nl2br(htmlspecialchars($contactHqAddress)); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="relative w-full rounded-2xl overflow-hidden border border-slate-200 dark:border-slate-700 shadow-lg">
                    <div class="bg-slate-100 dark:bg-slate-800 aspect-[4/5] relative">
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
                        <img alt="World map with office locations" class="w-full h-full object-cover opacity-80 mix-blend-multiply dark:mix-blend-overlay" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBCbvpqapYLxS_Cb2s2cqOETY64XRb9rP6UrEMGmtSOslOTrjJLrUeirvGXXuarByDtEfYW_Io8529PwRnejTeoGxZeC2ncwvo1Nn4_9YrlawDJmlM0k8xmN4ktk6kP3jmXz0eFsKcV2ggVNwImSm9y1ts2_ETLLH1963DCTMPsf-Xajt1XBtjXg2zeJqRmHtCnH4tTfjDwFvuVpJDEnpeHxTU91KZxrWkcr83yz8ltQLXCo5pnWXuNB-dTDZmD4yI261yesTXawkhv"/>
                        <div class="absolute top-1/2 left-1/3 group cursor-pointer">
                            <div class="size-3 bg-primary rounded-full animate-ping absolute inset-0"></div>
                            <div class="size-3 bg-primary rounded-full relative"></div>
                            <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 bg-white dark:bg-slate-900 text-[10px] font-bold px-2 py-1 rounded shadow-lg whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity">London Office</div>
                        </div>
                        <div class="absolute top-[65%] left-[51%] group cursor-pointer">
                            <div class="size-4 bg-primary border-2 border-white rounded-full relative"></div>
                            <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 bg-white dark:bg-slate-900 text-[10px] font-bold px-2 py-1 rounded shadow-lg whitespace-nowrap">Lagos HQ</div>
                        </div>
                        <div class="absolute top-[45%] left-[75%] group cursor-pointer">
                            <div class="size-3 bg-primary/60 rounded-full relative"></div>
                            <div class="absolute bottom-full left-1/2 -translate-x-1/2 mb-2 bg-white dark:bg-slate-900 text-[10px] font-bold px-2 py-1 rounded shadow-lg whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity">Dubai Partner</div>
                        </div>
                        <div class="absolute bottom-6 left-6 right-6 bg-white/95 dark:bg-slate-900/95 backdrop-blur-sm p-5 rounded-xl shadow-2xl border border-primary/20">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-[10px] font-bold text-primary uppercase tracking-widest">Our Network</span>
                                <div class="flex gap-1">
                                    <span class="size-1.5 rounded-full bg-primary"></span>
                                    <span class="size-1.5 rounded-full bg-slate-300"></span>
                                    <span class="size-1.5 rounded-full bg-slate-300"></span>
                                </div>
                            </div>
                            <p class="text-sm font-bold text-slate-900 dark:text-white mb-1">Modernizing Hospitality Worldwide</p>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mb-0">Serving over 500+ restaurants across 3 continents.</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="space-y-4 pt-4">
                    <h4 class="font-bold text-slate-900 dark:text-white">Follow Us</h4>
                    <div class="flex gap-4">
                        <a class="size-10 rounded-full border border-slate-200 dark:border-slate-700 flex items-center justify-center hover:bg-primary hover:text-white hover:border-primary transition-all" href="<?php echo htmlspecialchars($contactFacebook ?: '#'); ?>" aria-label="Facebook">
                            <svg class="size-5 fill-current" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path></svg>
                        </a>
                        <a class="size-10 rounded-full border border-slate-200 dark:border-slate-700 flex items-center justify-center hover:bg-primary hover:text-white hover:border-primary transition-all" href="<?php echo htmlspecialchars($contactTwitter ?: '#'); ?>" aria-label="Twitter">
                            <svg class="size-5 fill-current" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.84 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"></path></svg>
                        </a>
                        <a class="size-10 rounded-full border border-slate-200 dark:border-slate-700 flex items-center justify-center hover:bg-primary hover:text-white hover:border-primary transition-all" href="<?php echo htmlspecialchars($contactInstagram ?: '#'); ?>" aria-label="Instagram">
                            <svg class="size-5 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.668-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"></path></svg>
                        </a>
                    </div>
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
    if (!form || !msg) return;
    if (msg.classList.contains('hidden')) {
        form.addEventListener('submit', function() {
            // Server handles submission; this is just a small UX guard.
            form.querySelector('button[type=\"submit\"]').disabled = true;
        });
    }
});
</script>
</body>
</html>
