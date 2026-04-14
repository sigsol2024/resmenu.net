<?php
/**
 * SmartSupp Live Chat (resmenu.net marketing site)
 *
 * This file is intentionally isolated so you can change the key anytime.
 * It should only be included on pages you want the widget to appear on
 * (Home and Contact page).
 */

$smartsuppKey = '';
if (defined('SMARTSUPP_KEY') && trim((string)constant('SMARTSUPP_KEY')) !== '') {
    $smartsuppKey = (string)constant('SMARTSUPP_KEY');
}

$smartsuppKey = trim((string)$smartsuppKey);
if ($smartsuppKey === '') {
    // Not configured yet.
    return;
}
?>
<style>
  #smartsupp-widget-container,
  .smartsupp-widget-container,
  iframe[src*="smartsupp"] {
    z-index: 2147483647 !important;
  }
  @media (max-width: 768px) {
    #smartsupp-widget-container,
    .smartsupp-widget-container {
      bottom: 98px !important;
      right: 12px !important;
    }
  }
</style>
<script type="text/javascript">
  var _smartsupp = window._smartsupp || {};
  _smartsupp.key = <?php echo json_encode($smartsuppKey, JSON_UNESCAPED_SLASHES); ?>;
  window._smartsupp = _smartsupp;
  window.smartsupp || (function(d) {
    var s,c,o = smartsupp = function(){ o._.push(arguments); };
    o._ = [];
    s = d.getElementsByTagName('script')[0];
    c = d.createElement('script');
    c.type = 'text/javascript';
    c.charset = 'utf-8';
    c.async = true;
    c.src = 'https://www.smartsuppchat.com/loader.js?';
    s.parentNode.insertBefore(c, s);
  })(document);
</script>
<noscript>Powered by <a href="https://www.smartsupp.com" target="_blank" rel="noopener noreferrer">Smartsupp</a></noscript>

