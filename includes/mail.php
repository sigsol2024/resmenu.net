<?php
/**
 * Mail helper for resmenu.net (marketing site).
 * Uses Resmenu's mail.php when available (same repo); otherwise sends via PHP mail() using config.
 * No dependency on Resmenu folder on production.
 */

if (!defined('MAIL_ENABLED')) {
    define('MAIL_ENABLED', false);
}
if (!defined('MAIL_FROM_EMAIL')) {
    define('MAIL_FROM_EMAIL', 'noreply@localhost');
}
if (!defined('MAIL_FROM_NAME')) {
    define('MAIL_FROM_NAME', 'Resmenu');
}

$resmenuMail = dirname(__DIR__) . '/Resmenu/includes/mail.php';
if (file_exists($resmenuMail)) {
    require_once $resmenuMail;
    return;
}

/**
 * Send an HTML email (fallback when Resmenu mail is not available).
 * Uses PHP mail() and config constants.
 *
 * @param string $to Recipient email address
 * @param string $toName Recipient name (optional)
 * @param string $subject Email subject
 * @param string $htmlBody HTML body
 * @param array $options Optional: from_email, from_name, reply_to, reply_to_name
 * @return bool True if sent, false otherwise
 */
function sendEmail($to, $toName, $subject, $htmlBody, $options = []) {
    if (empty($to) || !filter_var($to, FILTER_VALIDATE_EMAIL)) {
        error_log("sendEmail: Invalid recipient: " . (string)$to);
        return false;
    }

    $fromEmail = $options['from_email'] ?? MAIL_FROM_EMAIL;
    $fromName = $options['from_name'] ?? MAIL_FROM_NAME;

    $headers = [
        'MIME-Version: 1.0',
        'Content-type: text/html; charset=UTF-8',
        'From: ' . $fromName . ' <' . $fromEmail . '>',
        'X-Mailer: PHP/' . phpversion(),
    ];
    if (!empty($options['reply_to']) && filter_var($options['reply_to'], FILTER_VALIDATE_EMAIL)) {
        $replyName = $options['reply_to_name'] ?? '';
        $headers[] = 'Reply-To: ' . ($replyName ? $replyName . ' <' . $options['reply_to'] . '>' : $options['reply_to']);
    }

    $sent = @mail($to, $subject, $htmlBody, implode("\r\n", $headers));
    if (!$sent) {
        error_log("sendEmail mail() failed to {$to}: {$subject}");
    }
    return $sent;
}
