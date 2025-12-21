<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="{$charset}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Schema.org JSON-LD Structured Data -->
    <script type="application/ld+json">
    {literal}
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
    {/literal}
    </script>
    
    {include file="$template/includes/head.tpl"} {include file="$template/includes/redcheap-seo.tpl"} {$headoutput}
  </head>
  <body data-phone-cc-input="{$phoneNumberInputStyle}">
    {if $captcha}{$captcha->getMarkup()}{/if}
   {$headeroutput} <div class="top-bar">
  
      <div class="container">
        <div class="row align-items-center">
          <div class="col-6">
            <p class="country-select" id="toggleButtoncountry">
              <i class="bi bi-translate"></i>Select Country
            </p>
          </div>
          <div class="col-6">
            <div class="d-flex justify-content-center justify-content-lg-end align-items-center gap-15">{if $loggedin} <div class="dropdown top-bar-dropdown nofication-dropdown-menu d-none d-sm-block">
                <button type="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false"> {$LANG.notifications} {if count($clientAlerts) > 0}{/if}</button>
                <ul class="dropdown-menu dropdown-menu-end"> {foreach $clientAlerts as $alert} <li>
                    <a href="{$alert->getLink()}">
                      <i class="fas fa-fw fa-{if $alert->getSeverity() == 'danger'}exclamation-circle{elseif $alert->getSeverity() == 'warning'}exclamation-triangle{elseif $alert->getSeverity() == 'info'}info-circle{else}check-circle{/if}"></i> {$alert->getMessage()} </a>
                  </li> {foreachelse} <li>
                    <a href="#">
                      <i class="ri-information-line"></i>{$LANG.notificationsnone} </a>
                  </li> {/foreach} </ul>
              </div> {/if} <div class="dropdown top-bar-dropdown">
                <button type="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false"> Account</button>
                <ul class="dropdown-menu dropdown-menu-end"> {if $loggedin} <li>
                    <a href="{$WEB_ROOT}/clientarea.php?action=details">Account Details</a>
                  </li>
                  <li>
                    <a href="{$WEB_ROOT}/account/users">User Management</a>
                  </li>
                  <li>
                    <a href="{$WEB_ROOT}/account/contacts">Contacts</a>
                  </li>
                  <li>
                    <a href="{$WEB_ROOT}/clientarea.php?action=emails">Email History</a>
                  </li>
                  <li>
                    <a href="{$WEB_ROOT}/user/profile">Your Profile</a>
                  </li>
                  <li>
                    <a href="{$WEB_ROOT}/user/password">Change Password</a>
                  </li>
                  <li>
                    <a href="{$WEB_ROOT}/user/security">Security Settings</a>
                  </li>
                  <li>
                    <a href="{$WEB_ROOT}/logout.php">{$LANG.clientareanavlogout}</a>
                  </li> {else} <li>
                    <a href="{$WEB_ROOT}/index.php?rp=/login">Login</a>
                  </li>
                  <li>
                    <a href="{$WEB_ROOT}/register.php">Register</a>
                  </li>
                  <li>
                    <a href="{$WEB_ROOT}/index.php?rp=/password/reset">Fotgot Password</a>
                  </li> {/if}
                </ul>
              </div> {if !$loggedin && count($multiCurrency) > 1} <div class="dropdown top-bar-dropdown"> {foreach $multiCurrency as $currency} {if $currency.id eq $selectedCurrency} <button type="button" data-toggle="dropdown" aria-haspopup="false" aria-expanded="false"> {$currency.code}</button> {/if} {/foreach} <ul class="dropdown-menu dropdown-menu-end"> {foreach $multiCurrency as $currency} {if $currency.id neq $selectedCurrency} {if $isQueryExist eq true} <li>
                    <a href="{$urlForCurrentcy}&currency={$currency.id}">{$currency.code}</a>
                  </li> {else} <li>
                    <a href="{$urlForCurrentcy}?currency={$currency.id}">{$currency.code}</a>
                  </li> {/if} {/if} {/foreach} </ul>
              </div> {/if} </div>
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
            <h4 class="title">Choose your Country/Region</h4> {if $languagechangeenabled && count($locales) > 1} <ul class="country-list"> {foreach $locales as $locale} <li>
                <a href="{$currentpagelinkback}language={$locale.language}">{$locale.localisedName}</a>
              </li> {/foreach} </ul> {/if}
          </div>
        </div>
      </div>
    </div>
    <div class="main-header d-none d-xl-block">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-6 col-md-4 col-lg-6">
            <a href="{$WEB_ROOT}/index.php" class="logo">
              <!-- logo -->
              <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/logo.png" alt="logo">
            </a>
          </div>
          <div class="col-6 col-md-8 col-lg-6">
            <div class="header-support">
              <ul class="support-item-web items d-none d-md-inline-block">
                <li class="call-no">Sales: <strong> | Sales@onlinehoster.nl</strong>
                </li>
                <li class="call-no">Support: <strong> | Support@onlinehoster.nl</strong>
                </li>
              </ul>
              <a class="call-mob items d-md-none" href="tel:+911234567890">
                <i class="fas fa-phone-alt"></i>
              </a>
              <a class="cart-icon items" href="{$WEB_ROOT}/cart.php?a=view">

                <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/cart.svg" alt="cart icon">
                <span class="count">{$cartitemcount}</span>
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
              <a href="{$WEB_ROOT}/index.php">
                <span>Home</span>
              </a>
            </li>
            <li>
              <a href="{$WEB_ROOT}/about-us.php">
                <span>About</span>
              </a>
            </li>
            <li class="dropdown">
              <a href="#">
                <span>Domain</span>
                <i class="bi bi-chevron-down dropdown-indicator"></i>
              </a>
              <ul class="menu-item"> {if $loggedin} <li>
                  <a href="{$WEB_ROOT}/clientarea.php?action=domains">
                    <i class="fal fa-coins"></i>
                    <span class="info">
                      <span class="heading">My Domains</span>
                      <span class="content">Manage, protect, and thrive with My Domains.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="{$WEB_ROOT}/cart/domain/renew">
                    <i class="fal fa-sign-in"></i>
                    <span class="info">
                      <span class="heading">Renew Domains</span>
                      <span class="content">Secure your online presence, renew domains today.</span>
                    </span>
                  </a>
                </li>{/if} <li>
                  <a href="{$WEB_ROOT}/domain-search.php">
                    <i class="fal fa-globe"></i>
                    <span class="info">
                      <span class="heading">Domain Search</span>
                      <span class="content">Book your domain here</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="{$WEB_ROOT}/transfer-domain.php">
                    <i class="fal fa-sign-in"></i>
                    <span class="info">
                      <span class="heading">Transfer your Domain</span>
                      <span class="content">Move in your existing Domains</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="{$WEB_ROOT}/domain-promos.php">
                    <i class="fal fa-sign-in"></i>
                    <span class="info">
                      <span class="heading">Domain Promos</span>
                      <span class="content">Check domain promos</span>
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
              <ul class="menu-item"> {if $loggedin} <li>
                  <a href="{$WEB_ROOT}/clientarea.php?action=services">
                    <i class="fal fa-badge-percent"></i>
                    <span class="info">
                      <span class="heading">My Services</span>
                      <span class="content">Tailored solutions to meet your needs.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="{$WEB_ROOT}/cart.php?gid=addons">
                    <i class="fas fa-gem"></i>
                    <span class="info">
                      <span class="heading">Available Addons</span>
                      <span class="content">Explore options for enhancing your experience.</span>
                    </span>
                  </a>
                </li> {/if} <li>
                  <a href="{$WEB_ROOT}/shared-hosting.php">
                    <i class="fal fa-server"></i>
                    <span class="info">
                      <span class="heading">Shared Hosting</span>
                      <span class="content">Low Cost Hosting</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="{$WEB_ROOT}/wordpress-hosting.php">
                    <i class="fab fa-wordpress"></i>
                    <span class="info">
                      <span class="heading">Wordpress Hosting</span>
                      <span class="content">Optimized hosting for WordPress sites.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="{$WEB_ROOT}/reseller-hosting.php">
                    <i class="fal fa-eye"></i>
                    <span class="info">
                      <span class="heading">Reseller Hosting</span>
                      <span class="content">Launch your hosting business today!</span>
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
                  <a href="{$WEB_ROOT}/vps-server.php">
                    <i class="fal fa-database"></i>
                    <span class="info">
                      <span class="heading">VPS Server</span>
                      <span class="content">Flexible VPS solutions for you.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="{$WEB_ROOT}/dedicated-server.php">
                    <i class="fal fa-server"></i>
                    <span class="info">
                      <span class="heading">Deicated Server</span>
                      <span class="content">Powerful servers for dedicated performance.</span>
                    </span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#">
                <span>Email</span>
                <i class="bi bi-chevron-down dropdown-indicator"></i>
              </a>
              <ul class="menu-item">
                <li>
                  <a href="{$WEB_ROOT}/business-email.php">
                    <i class="fal fa-mail-bulk"></i>
                    <span class="info">
                      <span class="heading">Business Email</span>
                      <span class="content">Professional email solutions for businesses.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="{$WEB_ROOT}/enterprise-email.php">
                    <i class="fas fa-envelope-open-text"></i>
                    <span class="info">
                      <span class="heading">Enterprices Email</span>
                      <span class="content">Enterprise-grade email solutions for businesses.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="{$WEB_ROOT}/google-workspace.php">
                    <i class="fab fa-google"></i>
                    <span class="info">
                      <span class="heading">Google Workspace</span>
                      <span class="content">Boost productivity with Google Workspace.</span>
                    </span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#">
                <span>Security</span>
                <i class="bi bi-chevron-down dropdown-indicator"></i>
              </a>
              <ul class="menu-item">
                <li>
                  <a href="{$WEB_ROOT}/ssl-certificates.php">
                    <i class="far fa-lock"></i>
                    <span class="info">
                      <span class="heading">SSL Certificate</span>
                      <span class="content">Secure your site with SSL.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="{$WEB_ROOT}/sitelock.php">
                    <i class="fal fa-shield-alt"></i>
                    <span class="info">
                      <span class="heading">Sitelock</span>
                      <span class="content">Protect your website with Sitelock.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="{$WEB_ROOT}/codeguard.php">
                    <i class="far fa-cloud-download"></i>
                    <span class="info">
                      <span class="heading">Codeguard</span>
                      <span class="content">Backup and secure your website.</span>
                    </span>
                  </a>
                </li>
              </ul>
            </li> {if $loggedin} <li class="dropdown">
              <a href="#">
                <span>Billing</span>
                <i class="bi bi-chevron-down dropdown-indicator"></i>
              </a>
              <ul class="menu-item">
                <li>
                  <a href="{$WEB_ROOT}/clientarea.php?action=invoices">
                    <i class="fal fa-server"></i>
                    <span class="info">
                      <span class="heading">My Invoices</span>
                      <span class="content">Track, manage, and pay invoices easily.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="{$WEB_ROOT}/clientarea.php?action=quotes">
                    <i class="fab fa-wordpress"></i>
                    <span class="info">
                      <span class="heading">My Quotes</span>
                      <span class="content">Request, review, and approve quotes conveniently.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="{$WEB_ROOT}/clientarea.php?action=masspay&amp;all=true">
                    <i class="fal fa-sun"></i>
                    <span class="info">
                      <span class="heading">Mass Payment</span>
                      <span class="content">Simplify payments with mass transactions.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="{$WEB_ROOT}/affiliates.php">
                    <i class="far fa-box"></i>
                    <span class="info">
                      <span class="heading">Affiliates</span>
                      <span class="content">Grow together with our affiliates program.</span>
                    </span>
                  </a>
                </li>
              </ul>
            </li>{/if} {if $loggedin} <li class="dropdown">
              <a href="#">
                <span>Support</span>
                <i class="bi bi-chevron-down dropdown-indicator"></i>
              </a>
              <ul class="menu-item">
                <li>
                  <a href="{$WEB_ROOT}/submitticket.php">
                    <i class="far fa-lock"></i>
                    <span class="info">
                      <span class="heading">Open Ticket</span>
                      <span class="content">Submit and track support tickets easily.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="{$WEB_ROOT}/supporttickets.php">
                    <i class="fal fa-shield-alt"></i>
                    <span class="info">
                      <span class="heading">Tickets</span>
                      <span class="content">Easily manage and track tickets.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="{$WEB_ROOT}/announcements">
                    <i class="far fa-cloud-download"></i>
                    <span class="info">
                      <span class="heading">Announcements</span>
                      <span class="content">Stay informed with our announcements.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="{$WEB_ROOT}/knowledgebase">
                    <i class="fal fa-boxes-alt"></i>
                    <span class="info">
                      <span class="heading">Knowledgebase</span>
                      <span class="content">View Our Knowledgebase.</span>
                    </span>
                  </a>
                </li>
                <li>
                  <a href="{$WEB_ROOT}/serverstatus.php">
                    <i class="far fa-globe-stand"></i>
                    <span class="info">
                      <span class="heading">Network Status</span>
                      <span class="content">Check real-time network status</span>
                    </span>
                  </a>
                </li>
              </ul>
            </li> {else} <li>
              <a href="{$WEB_ROOT}/contact.php">
                <span>Contact</span>
              </a>
            </li>{/if} {if $loggedin} <li>
              <a href="{$WEB_ROOT}/logout.php" class="menu-account-btn">
                <span>Log Out</span>
              </a>
            </li>{else} <li>
              <a href="{$WEB_ROOT}/index.php?rp=/login" class="menu-account-btn">
                <span>Login</span>
              </a>
            </li>{/if}
          </ul>
        </nav>
        <div class="d-flex align-items-center d-xl-none w-100">
          <a href="{$WEB_ROOT}/index.php" class="logo-mob">
            <!-- logo -->
            <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/logo.png" alt="logo">
          </a>
          <div class="header-support w-100">
            <ul class="support-item-web items d-none d-md-inline-block">
              <li class="call-no">Sales: <strong> | Sales@onlinehoster.nl</strong>
              </li>
              <li class="call-no">Support: <strong> | Support@onlinehoster.nl</strong>
              </li>
            </ul>
            <a class="cart-icon items" href="{$WEB_ROOT}/checkout.php">
              <img src="{$WEB_ROOT}/templates/{$template}/custom/assets/images/cart.svg" alt="cart icon">
              <span class="count">{$cartitemcount}</span>
            </a>
          </div>
        </div>
      </div>
    </header>
    <div class="mob-secreen-page-slider d-sm-none user-select-none">
      <div class="swiper swiper-hader-link">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <a href="{$WEB_ROOT}/shared-hosting.php" class="slide-item">
              <i class="fal fa-server"></i>
              <span>Shared Hosting</span>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="{$WEB_ROOT}/windows-hosting.php" class="slide-item">
              <i class="fab fa-wordpress-simple"></i>
              <span>Wordpress Hosting</span>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="{$WEB_ROOT}/reseller-hosting.php" class="slide-item">
              <i class="fal fa-cabinet-filing"></i>
              <span>Reseller Hosting</span>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="{$WEB_ROOT}/cloud-hosting.php" class="slide-item">
              <i class="fal fa-cloud"></i>
              <span>Cloud Hosting</span>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="{$WEB_ROOT}/dedicated-server.php" class="slide-item">
              <i class="fal fa-server"></i>
              <span>Dedicated Server</span>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="{$WEB_ROOT}/vps-server.php" class="slide-item">
              <i class="fal fa-database"></i>
              <span>VPS Hosting</span>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="{$WEB_ROOT}/ssl-certificates.php" class="slide-item">
              <i class="fal fa-lock-alt"></i>
              <span>SSl Certificate</span>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="{$WEB_ROOT}/codeguard.php" class="slide-item">
              <i class="fal fa-cloud-download"></i>
              <span>Coudguard Backup</span>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="{$WEB_ROOT}/business-email.php" class="slide-item">
              <i class="fal fa-envelope-open-text"></i>
              <span>Business Email</span>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="{$WEB_ROOT}/enterprise-email.php" class="slide-item">
              <i class="fal fa-envelope"></i>
              <span>Enterprices Email</span>
            </a>
          </div>
          <div class="swiper-slide">
            <a href="{$WEB_ROOT}/google-workspace.php" class="slide-item">
              <i class="fab fa-google"></i>
              <span>Google Workspace</span>
            </a>
          </div>
        </div>
      </div>
    </div> {if $filename != 'cloud-hosting' && $filename != 'dedicated-server' && $filename != 'domain-search' && $filename != 'legal-agreement' && $filename != 'privacy-policy' && $filename != 'reseller-hosting' && $filename != 'shared-hosting' && $filename != 'transfer-domain' && $filename != 'vps-server' && $filename != 'wordpress-hosting' && $filename != 'business-email' && $filename != 'codeguard' && $filename != 'domain-promos' && $filename != 'enterprise-email' && $filename != 'google-workspace' && $filename != 'sitelock' && $filename != 'about-us' && $filename != 'contact' && $filename != 'ssl-certificates'} {if $templatefile == 'homepage'} {else} {include file="$template/includes/redcheap-pageheader.tpl"} {include file="$template/includes/validateuser.tpl"} {include file="$template/includes/verifyemail.tpl"} <section id="main-body"> {if !in_array($templatefile, ['login', 'clientregister', 'password-reset-container', 'logout'])} <div class="container{if $skipMainBodyContainer}-fluid without-padding{/if}">
        <div class="row"> {if !$inShoppingCart && ($primarySidebar->hasChildren() || $secondarySidebar->hasChildren())} <div class="col-lg-4 col-xl-3">
            <div class="position-sticky top-2rem"> {include file="$template/includes/sidebar.tpl" sidebar=$primarySidebar} {include file="$template/includes/sidebar.tpl" sidebar=$secondarySidebar} </div>
          </div> {/if}
          <!-- Container for main page display content -->
          <div class="{if !$inShoppingCart && ($primarySidebar->hasChildren() || $secondarySidebar->hasChildren())}col-lg-8 col-xl-9{else}col-12{/if} primary-content"> {/if} {/if} {/if}