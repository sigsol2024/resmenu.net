<?php
/**
 * Application Configuration - resmenu.net (Marketing site)
 * Same DB as Resmenu (our-menu.online); BACKEND_URL for auth and API links.
 */

// Local overrides (gitignored): set DB/SMTP/keys here or via environment variables.
if (file_exists(__DIR__ . '/config.local.php')) {
    require __DIR__ . '/config.local.php';
}

// Site URL - Dynamically detect protocol and domain (marketing site)
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptPath = $_SERVER['SCRIPT_NAME'] ?? '/index.php';
$scriptDir = dirname($scriptPath);
if ($scriptDir === '/admin' || $scriptDir === '/manager' || $scriptDir === '/api' || $scriptDir === '/qr' ||
    strpos($scriptDir, '/admin/') === 0 || strpos($scriptDir, '/manager/') === 0 || strpos($scriptDir, '/api/') === 0 || strpos($scriptDir, '/qr/') === 0) {
    $basePath = dirname($scriptDir);
} else {
    $basePath = $scriptDir;
}
$basePath = ($basePath === '/' || $basePath === '\\' || $basePath === '.') ? '' : $basePath;
define('SITE_URL', $protocol . $host . $basePath);

// Backend (our-menu.online) - for Login, Register, API, restaurant menu links
if (!defined('BACKEND_URL')) define('BACKEND_URL', getenv('BACKEND_URL') ?: 'https://our-menu.online');

// Paths
define('BASE_PATH', dirname(__DIR__));
define('UPLOAD_PATH', BASE_PATH . '/uploads');
define('UPLOAD_URL', SITE_URL . '/uploads');

// Session configuration
define('SESSION_LIFETIME', 3600 * 24); // 24 hours

// Security
define('PASSWORD_MIN_LENGTH', 8);

// File upload settings
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);

// Timezone
date_default_timezone_set('UTC');

// Email (SMTP)
if (!defined('MAIL_ENABLED')) define('MAIL_ENABLED', true);
if (!defined('MAIL_FROM_EMAIL')) define('MAIL_FROM_EMAIL', getenv('MAIL_FROM_EMAIL') ?: 'noreply@resmenu.net');
if (!defined('MAIL_FROM_NAME')) define('MAIL_FROM_NAME', getenv('MAIL_FROM_NAME') ?: 'Resmenu');
if (!defined('SMTP_HOST')) define('SMTP_HOST', getenv('SMTP_HOST') ?: '');
if (!defined('SMTP_PORT')) define('SMTP_PORT', (int)(getenv('SMTP_PORT') ?: 465));
if (!defined('SMTP_SECURE')) define('SMTP_SECURE', getenv('SMTP_SECURE') ?: 'ssl');
if (!defined('SMTP_USERNAME')) define('SMTP_USERNAME', getenv('SMTP_USERNAME') ?: '');
if (!defined('SMTP_PASSWORD')) define('SMTP_PASSWORD', getenv('SMTP_PASSWORD') ?: '');

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', BASE_PATH . '/logs/php_errors.log');

// Database Configuration - same as Resmenu (shared DB)
if (!defined('DB_HOST')) define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
if (!defined('DB_NAME')) define('DB_NAME', getenv('DB_NAME') ?: 'sigsolmenu_resmenu');
if (!defined('DB_USER')) define('DB_USER', getenv('DB_USER') ?: '');
if (!defined('DB_PASS')) define('DB_PASS', getenv('DB_PASS') ?: '');
if (!defined('DB_CHARSET')) define('DB_CHARSET', getenv('DB_CHARSET') ?: 'utf8mb4');

// Marketing site extras
// SmartSupp key. Leave blank to disable the widget.
if (!defined('SMARTSUPP_KEY')) define('SMARTSUPP_KEY', getenv('SMARTSUPP_KEY') ?: '');
// Knowledge base Tutorials tab (YouTube URL; supports normal watch links with ?v=... and optional &t=...).
if (!defined('KB_TUTORIALS_YOUTUBE_URL')) define('KB_TUTORIALS_YOUTUBE_URL', getenv('KB_TUTORIALS_YOUTUBE_URL') ?: 'https://www.youtube.com/watch?v=WQjwnsXXirg&t=35s');

/**
 * Get database connection
 * @return PDO|null
 */
function getDBConnection() {
    static $pdo = null;

    if ($pdo === null) {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            error_log("Database connection failed: " . $e->getMessage());
            return null;
        }
    }

    return $pdo;
}
