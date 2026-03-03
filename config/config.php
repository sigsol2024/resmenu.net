<?php
/**
 * Application Configuration - resmenu.net (Marketing site)
 * Same DB as Resmenu (our-menu.online); BACKEND_URL for auth and API links.
 */

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
define('BACKEND_URL', 'https://our-menu.online');

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
define('MAIL_ENABLED', true);
define('MAIL_FROM_EMAIL', 'services@our-menu.online');
define('MAIL_FROM_NAME', 'Resmenu');
define('SMTP_HOST', 'server1.signaturewebhosting.space');
define('SMTP_PORT', 465);
define('SMTP_SECURE', 'ssl');
define('SMTP_USERNAME', '');
define('SMTP_PASSWORD', 'Sigsol1234!//@');

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', BASE_PATH . '/logs/php_errors.log');

// Database Configuration - same as Resmenu (shared DB)
define('DB_HOST', 'localhost');
define('DB_NAME', 'sigsolmenu_resmenu');
define('DB_USER', 'sigsolmenu_resmenu');
define('DB_PASS', 'Secretpass0931//');
define('DB_CHARSET', 'utf8mb4');

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
