<?php
/* Smarty version 3.1.48, created on 2025-12-21 15:40:09
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_694814d9074222_79210373',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a748127b7cd58e3d29ba3ed384632ac08fdfe54c' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/header.tpl',
      1 => 1766331570,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_694814d9074222_79210373 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="<?php echo $_smarty_tpl->tpl_vars['charset']->value;?>
">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Schema.org JSON-LD Structured Data -->
    <?php echo '<script'; ?>
 type="application/ld+json">
    
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "Online Hoster",
      "url": "https://onlinehoster.nl",
      "logo": "https://onlinehoster.nl/templates/closterv2/custom/assets/images/logo.png",
      "description": "Professional web hosting solutions in the Netherlands",
      "contactPoint": {
        "@type": "ContactPoint",
        "contactType": "Sales",
        "email": "Sales@onlinehoster.nl"
      },
      "sameAs": [
        "https://www.facebook.com/onlinehoster",
        "https://twitter.com/onlinehoster",
        "https://www.linkedin.com/company/online-hoster"
      ]
    }
    
    <?php echo '</script'; ?>
>
    
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?> <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/redcheap-seo.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?> <?php echo $_smarty_tpl->tpl_vars['headoutput']->value;?>

  </head>
  <body data-phone-cc-input="<?php echo $_smarty_tpl->tpl_vars['phoneNumberInputStyle']->value;?>
">
    <?php if ($_smarty_tpl->tpl_vars['captcha']->value) {
echo $_smarty_tpl->tpl_vars['captcha']->value->getMarkup();
}?>
   <?php echo $_smarty_tpl->tpl_vars['headeroutput']->value;?>
 <div class="top-bar">
  
      <div class="container">
        <div class="row align-items-center">
          <div class="col-6">
            <p class="country-select" id="toggleButtoncountry">
              <i class="bi bi-translate"></i>Kies taal
            </p>
          </div>
          <div class="col-6">
            <div class="d-flex justify-content-center justify-content-lg-end align-items-center gap-15"><?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> <div class="dropdown top-bar-dropdown nofication-dropdown-menu d-none d-sm-block">
                <button type="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false"> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['notifications'];?>
 <?php if (count($_smarty_tpl->tpl_vars['clientAlerts']->value) > 0) {
}?></button>
                <ul class="dropdown-menu dropdown-menu-end"> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['clientAlerts']->value, 'alert');
$_smarty_tpl->tpl_vars['alert']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['alert']->value) {
$_smarty_tpl->tpl_vars['alert']->do_else = false;
?> <li>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['alert']->value->getLink();?>
">
                      <i class="fas fa-fw fa-<?php if ($_smarty_tpl->tpl_vars['alert']->value->getSeverity() == 'danger') {?>exclamation-circle<?php } elseif ($_smarty_tpl->tpl_vars['alert']->value->getSeverity() == 'warning') {?>exclamation-triangle<?php } elseif ($_smarty_tpl->tpl_vars['alert']->value->getSeverity() == 'info') {?>info-circle<?php } else { ?>check-circle<?php }?>"></i> <?php echo $_smarty_tpl->tpl_vars['alert']->value->getMessage();?>
 </a>
                  </li> <?php
}
if ($_smarty_tpl->tpl_vars['alert']->do_else) {
?> <li>
                    <a href="#">
                      <i class="ri-information-line"></i><?php echo $_smarty_tpl->tpl_vars['LANG']->value['notificationsnone'];?>
 </a>
                  </li> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> </ul>
              </div> <?php }?> <div class="dropdown top-bar-dropdown">
                <button type="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false"> Account</button>
                <ul class="dropdown-menu dropdown-menu-end"> <?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> <li>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/clientarea.php?action=details">Account Details</a>
                  </li>
                  <li>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/account/users">User Management</a>
                  </li>
                  <li>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/account/contacts">Contacts</a>
                  </li>
                  <li>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/clientarea.php?action=emails">Email History</a>
                  </li>
                  <li>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/user/profile">Your Profile</a>
                  </li>
                  <li>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/user/password">Change Password</a>
                  </li>
                  <li>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/user/security">Security Settings</a>
                  </li>
                  <li>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/logout.php"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareanavlogout'];?>
</a>
                  </li> <?php } else { ?> <li>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/index.php?rp=/login">Login</a>
                  </li>
                  <li>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/register.php">Register</a>
                  </li>
                  <li>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/index.php?rp=/password/reset">Fotgot Password</a>
                  </li> <?php }?>
                </ul>
              </div> <?php if (!$_smarty_tpl->tpl_vars['loggedin']->value && count($_smarty_tpl->tpl_vars['multiCurrency']->value) > 1) {?> <div class="dropdown top-bar-dropdown"> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['multiCurrency']->value, 'currency');
$_smarty_tpl->tpl_vars['currency']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['currency']->value) {
$_smarty_tpl->tpl_vars['currency']->do_else = false;
?> <?php if ($_smarty_tpl->tpl_vars['currency']->value['id'] == $_smarty_tpl->tpl_vars['selectedCurrency']->value) {?> <button type="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false"> <?php echo $_smarty_tpl->tpl_vars['currency']->value['code'];?>
</button> <?php }?> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> <ul class="dropdown-menu dropdown-menu-end"> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['multiCurrency']->value, 'currency');
$_smarty_tpl->tpl_vars['currency']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['currency']->value) {
$_smarty_tpl->tpl_vars['currency']->do_else = false;
?> <?php if ($_smarty_tpl->tpl_vars['currency']->value['id'] != $_smarty_tpl->tpl_vars['selectedCurrency']->value) {?> <?php if ($_smarty_tpl->tpl_vars['isQueryExist']->value == true) {?> <li>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['urlForCurrentcy']->value;?>
&currency=<?php echo $_smarty_tpl->tpl_vars['currency']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['currency']->value['code'];?>
</a>
                  </li> <?php } else { ?> <li>
                    <a href="<?php echo $_smarty_tpl->tpl_vars['urlForCurrentcy']->value;?>
?currency=<?php echo $_smarty_tpl->tpl_vars['currency']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['currency']->value['code'];?>
</a>
                  </li> <?php }?> <?php }?> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> </ul>
              </div> <?php }?> </div>
          </div>
        </div>
      </div>
    </div>
    <div id="languagePopup" class="theme-language-popup">
      <div class="content-wrap">
        <div class="inner container">
          <div class="inner-content position-relative">
            <span id="closeButtoncountry">
              <i class="ri-close-line"></i>
            </span>
            <h4 class="title">Kies je taal/regio</h4> <?php if ($_smarty_tpl->tpl_vars['languagechangeenabled']->value && count($_smarty_tpl->tpl_vars['locales']->value) > 1) {?> <ul class="country-list"> <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['locales']->value, 'locale');
$_smarty_tpl->tpl_vars['locale']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['locale']->value) {
$_smarty_tpl->tpl_vars['locale']->do_else = false;
?> <li>
                <a href="<?php echo $_smarty_tpl->tpl_vars['currentpagelinkback']->value;?>
language=<?php echo $_smarty_tpl->tpl_vars['locale']->value['language'];?>
"><?php echo $_smarty_tpl->tpl_vars['locale']->value['localisedName'];?>
</a>
              </li> <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?> </ul> <?php }?>
          </div>
        </div>
      </div>
    </div>
    <div class="main-header d-none d-xl-block">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-6 col-md-4 col-lg-6">
            <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/index.php" class="logo">
              <!-- logo -->
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/logo.png" alt="logo">
            </a>
          </div>
          <div class="col-6 col-md-8 col-lg-6">
            <div class="header-support">
              <ul class="support-item-web items d-none d-md-inline-block">
                <li class="call-no">Sales: <strong><a href="mailto:Sales@onlinehoster.nl">Sales@onlinehoster.nl</a></strong>
                </li>
                <li class="call-no">Support: <strong><a href="mailto:Support@onlinehoster.nl">Support@onlinehoster.nl</a></strong>
                </li>
              </ul>
              <a class="call-mob items d-md-none" href="tel:+911234567890">
                <i class="fas fa-phone-alt"></i>
              </a>
              <a class="cart-icon items" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart.php?a=view">

                <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/cart.svg" alt="cart icon">
                <span class="count"><?php echo $_smarty_tpl->tpl_vars['cartitemcount']->value;?>
</span>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <header class="header">
      <div class="container d-flex align-items-center justify-content-between position-relative">
        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
        <nav class="navbar mb-0">
          <ul>
            <li>
              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/index.php">
                <span>Home</span>
              </a>
            </li>
            <li>
              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/about-us.php">
                <span>Over ons</span>
              </a>
            </li>
            <li class="dropdown">
              <a href="#">
                <span>Domein</span>
                <i class="bi bi-chevron-down dropdown-indicator"></i>
              </a>
              <ul class="menu-item"> <?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/clientarea.php?action=domains">
                    <i class="fal fa-coins"></i>
                    <span class="info">
                      <span class="heading">Mijn domeinen</span>
                      <span class="content">Beheer, bescherm en groei met jouw domeinen.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart/domain/renew">
                    <i class="fal fa-sign-in"></i>
                    <span class="info">
                      <span class="heading">Domeinen verlengen</span>
                      <span class="content">Beveilig je online aanwezigheid, verleng vandaag je domeinen.</span>
                    </span>
                  </a>
                </li><?php }?> <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/domain-search.php">
                    <i class="fal fa-globe"></i>
                    <span class="info">
                      <span class="heading">Domein zoeken</span>
                      <span class="content">Registreer je domein hier</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/transfer-domain.php">
                    <i class="fal fa-sign-in"></i>
                    <span class="info">
                      <span class="heading">Domein verhuizen</span>
                      <span class="content">Verhuis je bestaande domeinen</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/domain-promos.php">
                    <i class="fal fa-sign-in"></i>
                    <span class="info">
                      <span class="heading">Domeinacties</span>
                      <span class="content">Bekijk domeinacties</span>
                    </span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#">
                <span>Hosting</span>
                <i class="bi bi-chevron-down dropdown-indicator"></i>
              </a>
              <ul class="menu-item"> <?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/clientarea.php?action=services">
                    <i class="fal fa-badge-percent"></i>
                    <span class="info">
                      <span class="heading">My Services</span>
                      <span class="content">Tailored solutions to meet your needs.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cart.php?gid=addons">
                    <i class="fas fa-gem"></i>
                    <span class="info">
                      <span class="heading">Beschikbare add-ons</span>
                      <span class="content">Ontdek opties om je ervaring uit te breiden.</span>
                    </span>
                  </a>
                </li> <?php }?> <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/shared-hosting.php">
                    <i class="fal fa-server"></i>
                    <span class="info">
                      <span class="heading">Webhosting</span>
                      <span class="content">Goedkope hostingoplossingen</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/wordpress-hosting.php">
                    <i class="fab fa-wordpress"></i>
                    <span class="info">
                      <span class="heading">WordPress hosting</span>
                      <span class="content">Geoptimaliseerde hosting voor WordPress-sites.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/reseller-hosting.php">
                    <i class="fal fa-eye"></i>
                    <span class="info">
                      <span class="heading">Reseller hosting</span>
                      <span class="content">Start vandaag je hostingbedrijf!</span>
                    </span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#">
                <span>Server</span>
                <i class="bi bi-chevron-down dropdown-indicator"></i>
              </a>
              <ul class="menu-item">
                <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/vps-server.php">
                    <i class="fal fa-database"></i>
                    <span class="info">
                      <span class="heading">VPS-server</span>
                      <span class="content">Flexibele VPS-oplossingen voor jou.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/dedicated-server.php">
                    <i class="fal fa-server"></i>
                    <span class="info">
                      <span class="heading">Dedicated server</span>
                      <span class="content">Krachtige servers voor toegewijde prestaties.</span>
                    </span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#">
                <span>E-mail</span>
                <i class="bi bi-chevron-down dropdown-indicator"></i>
              </a>
              <ul class="menu-item">
                <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/business-email.php">
                    <i class="fal fa-mail-bulk"></i>
                    <span class="info">
                      <span class="heading">Zakelijke e-mail</span>
                      <span class="content">Professionele e-mailoplossingen voor bedrijven.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/enterprise-email.php">
                    <i class="fas fa-envelope-open-text"></i>
                    <span class="info">
                      <span class="heading">Enterprise e-mail</span>
                      <span class="content">E-mailoplossingen op ondernemingsniveau voor bedrijven.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/google-workspace.php">
                    <i class="fab fa-google"></i>
                    <span class="info">
                      <span class="heading">Google Workspace</span>
                      <span class="content">Verhoog de productiviteit met Google Workspace.</span>
                    </span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#">
                <span>Beveiliging</span>
                <i class="bi bi-chevron-down dropdown-indicator"></i>
              </a>
              <ul class="menu-item">
                <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/ssl-certificates.php">
                    <i class="far fa-lock"></i>
                    <span class="info">
                      <span class="heading">SSL-certificaat</span>
                      <span class="content">Beveilig je site met SSL.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/sitelock.php">
                    <i class="fal fa-shield-alt"></i>
                    <span class="info">
                      <span class="heading">Sitelock</span>
                      <span class="content">Bescherm je website met Sitelock.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/codeguard.php">
                    <i class="far fa-cloud-download"></i>
                    <span class="info">
                      <span class="heading">CodeGuard</span>
                      <span class="content">Back-up en beveilig je website.</span>
                    </span>
                  </a>
                </li>
              </ul>
            </li> <?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> <li class="dropdown">
              <a href="#">
                <span>Facturering</span>
                <i class="bi bi-chevron-down dropdown-indicator"></i>
              </a>
              <ul class="menu-item">
                <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/clientarea.php?action=invoices">
                    <i class="fal fa-server"></i>
                    <span class="info">
                      <span class="heading">Mijn facturen</span>
                      <span class="content">Volg, beheer en betaal facturen eenvoudig.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/clientarea.php?action=quotes">
                    <i class="fab fa-wordpress"></i>
                    <span class="info">
                      <span class="heading">Mijn offertes</span>
                      <span class="content">Vraag aan, bekijk en keur offertes gemakkelijk goed.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/clientarea.php?action=masspay&amp;all=true">
                    <i class="fal fa-sun"></i>
                    <span class="info">
                      <span class="heading">Massale betaling</span>
                      <span class="content">Vereenvoudig betalingen met groepstransacties.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/affiliates.php">
                    <i class="far fa-box"></i>
                    <span class="info">
                      <span class="heading">Affiliates</span>
                      <span class="content">Groeien samen met ons affiliateprogramma.</span>
                    </span>
                  </a>
                </li>
              </ul>
            </li><?php }?> <?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> <li class="dropdown">
              <a href="#">
                <span>Ondersteuning</span>
                <i class="bi bi-chevron-down dropdown-indicator"></i>
              </a>
              <ul class="menu-item">
                <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/submitticket.php">
                    <i class="far fa-lock"></i>
                    <span class="info">
                      <span class="heading">Ticket openen</span>
                      <span class="content">Dien ondersteuningstickets eenvoudig in en volg deze.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/supporttickets.php">
                    <i class="fal fa-shield-alt"></i>
                    <span class="info">
                      <span class="heading">Tickets</span>
                      <span class="content">Beheer en volg tickets eenvoudig.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/announcements">
                    <i class="far fa-cloud-download"></i>
                    <span class="info">
                      <span class="heading">Aankondigingen</span>
                      <span class="content">Blijf op de hoogte met onze aankondigingen.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/knowledgebase">
                    <i class="fal fa-boxes-alt"></i>
                    <span class="info">
                      <span class="heading">Kennisbank</span>
                      <span class="content">Bekijk onze kennisbank.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/serverstatus.php">
                    <i class="far fa-globe-stand"></i>
                    <span class="info">
                      <span class="heading">Netwerkstatus</span>
                      <span class="content">Controleer realtime netwerkstatus</span>
                    </span>
                  </a>
                </li>
              </ul>
            </li> <?php } else { ?> <li>
              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/contact.php">
                <span>Contact</span>
              </a>
            </li><?php }?> <?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?> <li>
              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/logout.php" class="menu-account-btn">
                <span>Uitloggen</span>
              </a>
            </li><?php } else { ?> <li>
              <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/index.php?rp=/login" class="menu-account-btn">
                <span>Inloggen</span>
              </a>
            </li><?php }?>
          </ul>
        </nav>
        <div class="d-flex align-items-center d-xl-none w-100">
          <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/index.php" class="logo-mob">
            <!-- logo -->
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/logo.png" alt="logo">
          </a>
          <div class="header-support w-100">
            <ul class="support-item-web items d-none d-md-inline-block">
              <li class="call-no">Sales: <strong><a href="mailto:Sales@onlinehoster.nl">Sales@onlinehoster.nl</a></strong>
              </li>
              <li class="call-no">Support: <strong><a href="mailto:Support@onlinehoster.nl">Support@onlinehoster.nl</a></strong>
              </li>
            </ul>
            <a class="cart-icon items" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/checkout.php">
              <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/cart.svg" alt="cart icon">
              <span class="count"><?php echo $_smarty_tpl->tpl_vars['cartitemcount']->value;?>
</span>
            </a>
          </div>
        </div>
      </div>
    </header>
    <div class="mob-secreen-page-slider d-sm-none user-select-none">
      <div class="swiper swiper-hader-link">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/shared-hosting.php" class="slide-item">
              <i class="fal fa-server"></i>
              <span>Webhosting</span>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/windows-hosting.php" class="slide-item">
              <i class="fab fa-wordpress-simple"></i>
              <span>WordPress Hosting</span>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/reseller-hosting.php" class="slide-item">
              <i class="fal fa-cabinet-filing"></i>
              <span>Reseller hosting</span>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/cloud-hosting.php" class="slide-item">
              <i class="fal fa-cloud"></i>
              <span>Cloud hosting</span>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/dedicated-server.php" class="slide-item">
              <i class="fal fa-server"></i>
              <span>Dedicated server</span>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/vps-server.php" class="slide-item">
              <i class="fal fa-database"></i>
              <span>VPS hosting</span>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/ssl-certificates.php" class="slide-item">
              <i class="fal fa-lock-alt"></i>
              <span>SSL-certificaat</span>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/codeguard.php" class="slide-item">
              <i class="fal fa-cloud-download"></i>
              <span>CodeGuard back-up</span>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/business-email.php" class="slide-item">
              <i class="fal fa-envelope-open-text"></i>
              <span>Zakelijke e-mail</span>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/enterprise-email.php" class="slide-item">
              <i class="fal fa-envelope"></i>
              <span>Enterprise e-mail</span>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/google-workspace.php" class="slide-item">
              <i class="fab fa-google"></i>
              <span>Google Workspace</span>
            </a>
          </div>
        </div>
      </div>
    </div> <?php if ($_smarty_tpl->tpl_vars['filename']->value != 'cloud-hosting' && $_smarty_tpl->tpl_vars['filename']->value != 'dedicated-server' && $_smarty_tpl->tpl_vars['filename']->value != 'domain-search' && $_smarty_tpl->tpl_vars['filename']->value != 'legal-agreement' && $_smarty_tpl->tpl_vars['filename']->value != 'privacy-policy' && $_smarty_tpl->tpl_vars['filename']->value != 'reseller-hosting' && $_smarty_tpl->tpl_vars['filename']->value != 'shared-hosting' && $_smarty_tpl->tpl_vars['filename']->value != 'transfer-domain' && $_smarty_tpl->tpl_vars['filename']->value != 'vps-server' && $_smarty_tpl->tpl_vars['filename']->value != 'wordpress-hosting' && $_smarty_tpl->tpl_vars['filename']->value != 'business-email' && $_smarty_tpl->tpl_vars['filename']->value != 'codeguard' && $_smarty_tpl->tpl_vars['filename']->value != 'domain-promos' && $_smarty_tpl->tpl_vars['filename']->value != 'enterprise-email' && $_smarty_tpl->tpl_vars['filename']->value != 'google-workspace' && $_smarty_tpl->tpl_vars['filename']->value != 'sitelock' && $_smarty_tpl->tpl_vars['filename']->value != 'about-us' && $_smarty_tpl->tpl_vars['filename']->value != 'contact' && $_smarty_tpl->tpl_vars['filename']->value != 'ssl-certificates') {?> <?php if ($_smarty_tpl->tpl_vars['templatefile']->value == 'homepage') {?> <?php } else { ?> <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/redcheap-pageheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?> <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/validateuser.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?> <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/verifyemail.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?> <section id="main-body"> <?php if (!in_array($_smarty_tpl->tpl_vars['templatefile']->value,array('login','clientregister','password-reset-container','logout'))) {?> <div class="container<?php if ($_smarty_tpl->tpl_vars['skipMainBodyContainer']->value) {?>-fluid without-padding<?php }?>">
        <div class="row"> <?php if (!$_smarty_tpl->tpl_vars['inShoppingCart']->value && ($_smarty_tpl->tpl_vars['primarySidebar']->value->hasChildren() || $_smarty_tpl->tpl_vars['secondarySidebar']->value->hasChildren())) {?> <div class="col-lg-4 col-xl-3">
            <div class="position-sticky top-2rem"> <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('sidebar'=>$_smarty_tpl->tpl_vars['primarySidebar']->value), 0, true);
?> <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/sidebar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('sidebar'=>$_smarty_tpl->tpl_vars['secondarySidebar']->value), 0, true);
?> </div>
          </div> <?php }?>
          <!-- Container for main page display content -->
          <div class="<?php if (!$_smarty_tpl->tpl_vars['inShoppingCart']->value && ($_smarty_tpl->tpl_vars['primarySidebar']->value->hasChildren() || $_smarty_tpl->tpl_vars['secondarySidebar']->value->hasChildren())) {?>col-lg-8 col-xl-9<?php } else { ?>col-12<?php }?> primary-content"> <?php }?> <?php }?> <?php }
}
}
