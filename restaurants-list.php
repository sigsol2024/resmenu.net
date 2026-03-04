<?php
/**
 * Restaurants Listing Page - resmenu.net
 * Fetches restaurants from backend API (our-menu.online); View Menu links to backend.
 */
require_once __DIR__ . '/config/config.php';
$baseUrl = defined('SITE_URL') ? rtrim(SITE_URL, '/') : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Partner Restaurants - SigSol Resmenu</title>
    <meta name="description" content="Browse all restaurants using SigSol Resmenu platform">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    
    <!-- Stylesheet -->
    <link rel="stylesheet" href="/assets/css/marketing.css">
    <!-- Tailwind for shared header/footer (same as home page) -->
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
                    fontFamily: {
                        "display": ["Inter", "sans-serif"],
                        "heading": ["Poppins", "sans-serif"]
                    },
                    borderRadius: { "DEFAULT": "0.5rem", "lg": "1rem", "xl": "1.5rem", "full": "9999px" },
                },
            },
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
</head>
<body class="bg-background-light text-slate-900">
    <?php include __DIR__ . '/includes/header.php'; ?>
    
    <!-- Hero Header -->
    <section class="relative w-full h-[360px] sm:h-[400px] flex items-center overflow-hidden">
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('<?php echo htmlspecialchars($baseUrl); ?>/assets/images/restaurant-interior.jpg');"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-black via-black/60 to-transparent"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white w-full">
            <nav class="flex items-center gap-2 text-sm font-medium text-slate-300 mb-6">
                <a class="hover:text-primary transition-colors" href="<?php echo htmlspecialchars($baseUrl); ?>/">Home</a>
                <span class="material-symbols-outlined text-xs">chevron_right</span>
                <span class="text-white">Our Partner Restaurants</span>
            </nav>
            <h1 class="text-4xl sm:text-5xl font-heading font-extrabold mb-4 max-w-2xl leading-tight text-white">Our Partner Restaurants</h1>
            <p class="text-lg text-slate-200 max-w-xl leading-relaxed">
                Powering forward-thinking businesses with digital menu solutions that enhance guest experience and streamline operations.
            </p>
        </div>
    </section>
    
    <!-- Partner Grid -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="mb-12">
            <h2 class="text-3xl font-heading font-bold text-slate-900">Trusted Hospitality Brands</h2>
            <div class="h-1.5 w-20 bg-primary mt-4 rounded-full"></div>
        </div>
        <div id="restaurantsGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <div class="col-span-full flex items-center justify-center py-16 text-slate-500 text-sm">
                <span class="material-symbols-outlined mr-2 text-primary">hourglass_empty</span>
                <span>Loading restaurants...</span>
            </div>
        </div>
    </section>
    
    <!-- Why Our Partners Trust Us -->
    <section class="bg-white py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-heading font-extrabold mb-6 text-slate-900">Why Our Partners Trust Us</h2>
            <p class="text-slate-600 max-w-2xl mx-auto mb-16 text-lg">
                We provide the digital foundation that allows restaurants to focus on what they do best: creating incredible food and memories.
            </p>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-12 gap-x-8 text-left">
                <div class="flex gap-4">
                    <div class="flex-shrink-0 w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">update</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg mb-2">Instant Updates</h4>
                        <p class="text-sm text-slate-600">Change prices or items in real-time across all your digital touchpoints instantly.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex-shrink-0 w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">qr_code_2</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg mb-2">QR Access</h4>
                        <p class="text-sm text-slate-600">Seamless table-side scanning for immediate menu viewing without app downloads.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex-shrink-0 w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">devices</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg mb-2">Mobile-Optimized</h4>
                        <p class="text-sm text-slate-600">Perfectly responsive layouts that make your dishes look delicious on any screen size.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex-shrink-0 w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">analytics</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg mb-2">Smart Analytics</h4>
                        <p class="text-sm text-slate-600">Understand which dishes are trending and optimize your menu for maximum profit.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex-shrink-0 w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">language</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg mb-2">Multi-Language</h4>
                        <p class="text-sm text-slate-600">Automatically translate your menu for international guests with high precision.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex-shrink-0 w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
                        <span class="material-symbols-outlined">support_agent</span>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg mb-2">24/7 Support</h4>
                        <p class="text-sm text-slate-600">Our dedicated hospitality team is always available to help your operations run smoothly.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Final CTA -->
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="bg-slate-900 rounded-[2rem] p-8 md:p-16 text-center relative overflow-hidden">
            <div class="absolute inset-0 opacity-10" style="background-image: url('<?php echo htmlspecialchars($baseUrl); ?>/assets/images/bh_pattern-orange.png'); background-repeat: repeat; background-size: 280px 280px;"></div>
            <div class="relative z-10">
                <h2 class="text-3xl md:text-5xl font-heading font-extrabold text-white mb-6">Join Our Growing Network of Restaurants</h2>
                <p class="text-slate-300 max-w-2xl mx-auto mb-10 text-lg">
                    Transform your guest experience today. Join hundreds of restaurants already using SigSol Resmenu to grow their business.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                    <a href="<?php echo htmlspecialchars($authUrl ?? (defined('BACKEND_URL') ? rtrim(BACKEND_URL, '/') . '/' : 'https://our-menu.online/')); ?>" class="w-full sm:w-auto px-10 py-4 bg-primary text-white rounded-xl font-bold text-lg hover:shadow-lg hover:shadow-primary/30 transition-all text-center">
                        Become a Partner
                    </a>
                    <a href="<?php echo htmlspecialchars($baseUrl); ?>/contact.php" class="w-full sm:w-auto px-10 py-4 border-2 border-white text-white rounded-xl font-bold text-lg hover:bg-white hover:text-slate-900 transition-all text-center">
                        Request a Demo
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    <?php include __DIR__ . '/includes/footer.php'; ?>
    
    <script>
        var backendUrl = <?php echo json_encode(rtrim(BACKEND_URL, '/')); ?>;
        document.addEventListener('DOMContentLoaded', function() {
            var grid = document.getElementById('restaurantsGrid');
            if (!grid) return;

            var escapeHtml = function(text) {
                var div = document.createElement('div');
                div.textContent = text == null ? '' : String(text);
                return div.innerHTML;
            };

            fetch(backendUrl + '/api/restaurants.php')
                .then(function(response) {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(function(data) {
                    grid.innerHTML = '';

                    if (data.success && data.data && data.data.length > 0) {
                        data.data.forEach(function(restaurant) {
                            var name = escapeHtml(restaurant.name);
                            var description = restaurant.description ? escapeHtml(restaurant.description) : '';
                            var slug = escapeHtml(restaurant.slug);
                            var logo = restaurant.logo ? escapeHtml(restaurant.logo) : '';

                            var card = document.createElement('div');
                            card.className = 'bg-white p-6 rounded-xl border border-slate-100 shadow-sm hover:shadow-xl transition-all group flex flex-col h-full';

                            var logoWrapper = document.createElement('div');
                            logoWrapper.className = 'h-20 w-20 bg-slate-50 rounded-lg flex items-center justify-center mb-6 overflow-hidden border border-slate-100';

                            if (logo) {
                                var img = document.createElement('img');
                                img.src = logo;
                                img.alt = name;
                                img.className = 'w-full h-full object-contain';
                                logoWrapper.appendChild(img);
                            } else {
                                var icon = document.createElement('span');
                                icon.className = 'material-symbols-outlined text-4xl text-primary/40 group-hover:scale-110 transition-transform';
                                icon.textContent = 'restaurant';
                                logoWrapper.appendChild(icon);
                            }

                            var title = document.createElement('h3');
                            title.className = 'text-xl font-bold mb-3 group-hover:text-primary transition-colors';
                            title.textContent = name;

                            card.appendChild(logoWrapper);
                            card.appendChild(title);

                            if (description) {
                                var p = document.createElement('p');
                                p.className = 'text-slate-600 text-sm mb-2 line-clamp-3';
                                var shortDesc = description.length > 160 ? description.substring(0, 160) + '…' : description;
                                p.textContent = shortDesc;
                                card.appendChild(p);
                            } else {
                                var spacer = document.createElement('div');
                                spacer.className = 'h-6';
                                card.appendChild(spacer);
                            }
                            grid.appendChild(card);
                        });
                    } else {
                        grid.innerHTML = '<div class="col-span-full text-center py-16 text-slate-500"><div class="mb-3 text-3xl">🍽️</div><h3 class="text-lg font-semibold mb-1">No restaurants found</h3><p class="text-sm text-slate-500">Check back soon for new partners.</p></div>';
                    }
                })
                .catch(function(error) {
                    console.error('Error fetching restaurants:', error);
                    grid.innerHTML = '<div class="col-span-full text-center py-16 text-slate-500"><div class="mb-3 text-3xl">⚠️</div><h3 class="text-lg font-semibold mb-1">Error loading restaurants</h3><p class="text-sm text-slate-500 mb-4">Please try again later.</p><button onclick="location.reload()" class="inline-flex items-center justify-center px-6 py-2 rounded-lg bg-primary text-white font-semibold text-sm hover:bg-primary/90 transition-colors">Retry</button></div>';
                });
        });
    </script>
</body>
</html>

