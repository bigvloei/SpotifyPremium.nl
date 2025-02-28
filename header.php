<?php
declare(strict_types=1);
require_once __DIR__ . '/includes/config.php';

// Security headers
header('X-Frame-Options: DENY');
header('X-XSS-Protection: 1; mode=block');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: strict-origin-when-cross-origin');
header('Permissions-Policy: geolocation=(), microphone=(), camera=()');

// Verbeterde sessie beveiliging
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_lifetime', '86400');
    ini_set('session.gc_maxlifetime', '86400');
    
    session_set_cookie_params([
        'lifetime' => 86400,
        'path' => '/',
        'domain' => '.spotifypremium.nl',
        'secure' => true,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}

// CSRF Protection
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Taal configuratie
$availableLanguages = [
    'nl' => [
        'name' => 'Nederlands',
        'icon' => '🇳🇱',
        'locale' => 'nl_NL'
    ],
    'en' => [
        'name' => 'English',
        'icon' => '🇬🇧',
        'locale' => 'en_GB'
    ]
];

// Definieer beschikbare talen
$available_languages = ['NL', 'EN'];

// Controleer of er een taal is geselecteerd via GET parameter
if (isset($_GET['lang']) && in_array($_GET['lang'], $available_languages)) {
    $_SESSION['lang'] = $_GET['lang'];
} 
// Als er geen sessie is, gebruik standaard Nederlands
elseif (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'NL';
}

// Stel de huidige taal in
$currentLang = $_SESSION['lang'] === 'EN' ? 'en' : 'nl';

// Initialiseer $lang array om fouten te voorkomen als het taalbestand niet bestaat
$lang = [];

// Standaard taalvariabelen (fallback)
$defaultLang = [
    // Navigatie
    'nav_home' => 'Home',
    'nav_premium_upgrade' => 'Premium Upgrade',
    'nav_renew_key' => 'Verleng Sleutel',
    'nav_key_status' => 'Sleutel Status',
    'nav_buy_key' => 'Koop Sleutel',
    
    // Meta tags
    'default_title' => 'Spotify Premium Upgrade Service | SpotifyPremium.nl',
    'default_description' => 'Upgrade je Spotify account naar Premium voor slechts €20 eenmalig. Geniet van onbeperkt offline luisteren, geen reclame en premium geluidskwaliteit.',
    'meta_keywords' => 'Spotify Premium, Spotify upgrade, Premium muziek, muziek streaming, Spotify Nederland',
    
    // Gebruikersinterface
    'skip_to_content' => 'Ga naar inhoud',
    'loading' => 'Laden',
    'please_wait' => 'Even geduld a.u.b.',
    'toggle_navigation' => 'Navigatie aan/uit',
    'my_account' => 'Mijn Account',
    'dashboard' => 'Dashboard',
    'settings' => 'Instellingen',
    'logout' => 'Uitloggen',
    'login' => 'Inloggen',
    'register' => 'Registreren',
    
    // Algemene teksten
    'home' => 'Home',
    'payments' => 'Betalingen',
    'contact' => 'Contact',
    'what_customers_say' => 'Wat Onze Klanten Zeggen',
    'write_review' => 'Schrijf een recensie',
    'submit_review' => 'Plaats recensie'
];

// Probeer het juiste taalbestand te laden
$langFile = ROOT_PATH . '/languages/' . $_SESSION['lang'] . '.php';
$loadedLangFile = false;

if (file_exists($langFile)) {
    require_once $langFile;
    $loadedLangFile = true;
} else {
    // Fallback naar Nederlands als het taalbestand niet bestaat
    $fallbackLangFile = ROOT_PATH . '/languages/NL.php';
    if (file_exists($fallbackLangFile)) {
        require_once $fallbackLangFile;
        $loadedLangFile = true;
    }
}

// Als geen taalbestand geladen kon worden, gebruik de standaard taalvariabelen
if (!$loadedLangFile || empty($lang)) {
    $lang = $defaultLang;
    // Log een waarschuwing voor de ontwikkelaar
    error_log("Waarschuwing: Geen taalbestand geladen voor '{$_SESSION['lang']}'. Standaardtaal gebruikt.");
}

// URL en pagina informatie
$currentURL = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
$currentPath = parse_url($currentURL, PHP_URL_PATH);
$currentPage = basename($currentPath, '.php');

// User authenticatie status
$isLoggedIn = isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? null;

// Gebruik vertaalde SEO informatie
$pageTitle = $pageTitle ?? $lang['default_title'] ?? 'Spotify Premium';
$metaDescription = $metaDescription ?? $lang['default_description'] ?? 'Spotify Premium upgrade service';
$metaKeywords = $lang['meta_keywords'] ?? 'Spotify Premium';
?>
<!DOCTYPE html>
<html lang="<?= htmlspecialchars($currentLang) ?>" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    
    <!-- Primary Meta Tags -->
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <meta name="description" content="<?= htmlspecialchars($metaDescription) ?>">
    <meta name="keywords" content="<?= htmlspecialchars($lang['meta_keywords'] ?? '') ?>">
    <meta name="author" content="SpotifyPremium.nl">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://spotifypremium.nl<?= htmlspecialchars($currentPath) ?>">
    <meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($metaDescription) ?>">
    <meta property="og:image" content="https://spotifypremium.nl/img/og-image.jpg">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($pageTitle) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($metaDescription) ?>">
    
    <!-- Preload belangrijke assets -->
    <link rel="preload" href="fonts/spotify-circular.woff2" as="font" type="font/woff2" crossorigin>
    <link rel="preload" href="css/critical.css" as="style">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    
    <!-- CSS -->
    <link rel="stylesheet" href="css/critical.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="css/style.css">
    
    <!-- Favicons -->
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/icon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    <link rel="manifest" href="/site.webmanifest">

    <!-- Schema.org markup -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "SpotifyPremium.nl",
        "url": "https://spotifypremium.nl/",
        "description": "<?= htmlspecialchars($metaDescription) ?>",
        "potentialAction": {
            "@type": "SearchAction",
            "target": "https://spotifypremium.nl/zoeken?q={search_term_string}",
            "query-input": "required name=search_term_string"
        }
    }
    </script>
</head>
<body class="d-flex flex-column min-vh-100">
    <!-- Accessibility Skip Link -->
    <a href="#main-content" class="visually-hidden-focusable bg-primary text-white p-3 position-absolute start-0 top-0">
        <?= $lang['skip_to_content'] ?? 'Ga naar inhoud' ?>
    </a>

    <!-- Loading Overlay -->
    <div id="loadingOverlay" class="position-fixed w-100 h-100 bg-dark bg-opacity-75 d-none" style="z-index: 9999;">
        <div class="position-absolute top-50 start-50 translate-middle text-center">
            <div class="spinner-border text-success" role="status">
                <span class="visually-hidden"><?= $lang['loading'] ?? 'Laden' ?></span>
            </div>
            <p class="text-white mt-2 mb-0" id="loadingText"><?= $lang['please_wait'] ?? 'Even geduld a.u.b.' ?></p>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2 border-bottom border-success sticky-top">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="/" aria-label="SpotifyPremium.nl Home">
                <img src="img/icons/banner-logo.png"
                     alt=""
                     class="img-fluid"
                     width="180"
                     height="40"
                     loading="eager"
                     decoding="async">
            </a>

            <!-- Mobile Toggle -->
            <button class="navbar-toggler border-0"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarNav"
                    aria-controls="navbarNav"
                    aria-expanded="false"
                    aria-label="<?= $lang['toggle_navigation'] ?? 'Navigatie aan/uit' ?>">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Items -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <?php
                    $navItems = [
                    'index' => ['icon' => 'home', 'text' => $lang['nav_home'] ?? 'Home'],
                    'upgrade' => ['icon' => 'arrow-up', 'text' => $lang['nav_premium_upgrade'] ?? 'Premium Upgrade'],
                    'renew' => ['icon' => 'refresh-cw', 'text' => $lang['nav_renew_key'] ?? 'Verleng Sleutel'],
                    'info' => ['icon' => 'info', 'text' => $lang['nav_key_status'] ?? 'Sleutel Status'],
                    'betalingen' => ['icon' => 'shopping-cart', 'text' => $lang['nav_buy_key'] ?? 'Koop Sleutel']
                    ];

                    foreach ($navItems as $page => $item): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= $currentPage === $page ? 'active' : '' ?> px-3 py-2"
                               href="/<?= $page ?>.php"
                               <?= $currentPage === $page ? 'aria-current="page"' : '' ?>>
                                <i class="fas fa-<?= $item['icon'] ?> me-2" aria-hidden="true"></i>
                                <span><?= $item['text'] ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <!-- User Menu -->
                <div class="navbar-nav ms-auto">
                    <!-- Language Selector -->
                    <div class="nav-item dropdown">
                        <button class="nav-link dropdown-toggle btn btn-link" 
                                data-bs-toggle="dropdown" 
                                aria-expanded="false">
                            <i class="fas fa-globe me-2"></i>
                            <?= $availableLanguages[$currentLang]['icon'] ?> 
                            <?= $availableLanguages[$currentLang]['name'] ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php foreach ($availableLanguages as $code => $lang_item): ?>
                                <li>
                                    <a href="?lang=<?= strtoupper($code) ?>" class="dropdown-item <?= $currentLang === $code ? 'active' : '' ?>">
                                        <?= $lang_item['icon'] ?> <?= $lang_item['name'] ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Account Menu -->
                    <?php if ($isLoggedIn): ?>
                        <div class="nav-item dropdown ms-3">
                            <button class="nav-link dropdown-toggle btn btn-link d-flex align-items-center" 
                                    data-bs-toggle="dropdown" 
                                    aria-expanded="false">
                                <div class="avatar-circle me-2">
                                    <?= htmlspecialchars(strtoupper(substr($userName ?? '', 0, 1))) ?>
                                </div>
                                <span><?= $lang['my_account'] ?? 'Mijn Account' ?></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="/dashboard.php">
                                        <i class="fas fa-tachometer-alt me-2"></i><?= $lang['dashboard'] ?? 'Dashboard' ?>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="/instellingen.php">
                                        <i class="fas fa-cog me-2"></i><?= $lang['settings'] ?? 'Instellingen' ?>
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="/uitloggen.php" method="POST" class="dropdown-item">
                                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                        <button type="submit" class="btn btn-link text-danger p-0">
                                            <i class="fas fa-sign-out-alt me-2"></i><?= $lang['logout'] ?? 'Uitloggen' ?>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <div class="nav-item ms-3">
                            <a href="/inloggen.php" class="btn btn-outline-light btn-sm me-2">
                                <?= $lang['login'] ?? 'Inloggen' ?>
                            </a>
                            <a href="/registreren.php" class="btn btn-success btn-sm">
                                <?= $lang['register'] ?? 'Registreren' ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- JavaScript voor taalwisseling -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Taalwisseling via links in plaats van form submit
        const languageLinks = document.querySelectorAll('.dropdown-menu a[href^="?lang="]');
        languageLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                const loadingOverlay = document.getElementById('loadingOverlay');
                if (loadingOverlay) {
                    loadingOverlay.classList.remove('d-none');
                    setTimeout(() => {
                        // Laat de browser de link volgen na een korte vertraging
                        // om de laad-overlay te tonen
                    }, 100);
                }
            });
        });
    });
    </script>
