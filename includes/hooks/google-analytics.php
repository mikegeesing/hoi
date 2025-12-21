<?php
/**
 * Google Analytics 4 via hook (Client Area)
 * Plaats dit bestand in: /includes/hooks/google-analytics.php
 * Werkt op alle clientarea-pagina's en blijft template/update-proof.
 */

add_hook('ClientAreaFooterOutput', 1, function ($vars) {

    // (optioneel) simpele guard om dubbele injectie te voorkomen
    // als je dit script al via een theme of andere hook laadt.
    static $alreadyInjected = false;
    if ($alreadyInjected) {
        return '';
    }
    $alreadyInjected = true;

    return <<<HTML
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-MGSWWL5YV4"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  // (optioneel) Consent Mode default blokkeren tot akkoord (AVG/CMv2)
  // gtag('consent', 'default', {
  //   'ad_storage': 'denied',
  //   'analytics_storage': 'denied'
  // });

  gtag('config', 'G-MGSWWL5YV4');
</script>
HTML;
});
