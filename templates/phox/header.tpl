{if file_exists("templates/$template/packages/overwrites/header.tpl")}
  {include file="{$template}/packages/overwrites/header.tpl"}
{else}
  <!DOCTYPE html>
  <html lang="en" dir="{if $language == 'arabic' || $language == 'hebrew' || $language == 'farsi'}rtl{else}ltr{/if}">

  <head>
    <meta charset="{$charset}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {include file="$template/includes/head.tpl"}
    {include file="$template/packages/includes/seo.tpl"}
    {$headoutput}

  </head>
  <body
    class="wdes-page-{$pagetitle} {if $templatefile == 'login'}wdes-account-page wdes-page-login{/if} {if $inShoppingCart} wdes-page-order{/if} {if $templatefile == 'clientregister'}wdes-account-page wdes-page-register{/if} {if $templatefile == 'password-reset-container'}wdes-account-page wdes-page-pwreset{/if} wdes-layout-{$Phox['layout']['active']} wdes-style-{$wdes_phox_theme_settings['theme']}"
    data-phone-cc-input="{$phoneNumberInputStyle}">
    {if $captcha}{$captcha->getMarkup()}{/if}
    {$headeroutput}

    {assign var="showHeader" value=$Phox['pages']['global-settings']['show-header']['value']}
    {assign var="showFooter" value=$Phox['pages']['global-settings']['show-footer']['value']}

    {if $showHeader == true}
      <div
        class="wdes-wrap-theme {if $showHeader == true}has-header{/if} {if $showFooter == true}has-footer{/if} {if $showHeader == true && $showFooter == true}has-header-footer{/if}">
        <section id="header">
          <div class="container">
            <div class="wdes-header">

              {* Logo *}
              {if $Phox['pages']['global-settings']['show-logo']['value'] == true}
                {include file="$template/packages/includes/logo.tpl"}
              {/if}

              {* Menu *}
              <section id="main-menu">
                <nav id="nav" class="navbar navbar-default navbar-main" role="navigation">
                  <!-- Brand and toggle get grouped for better mobile display -->
                  <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#primary-nav">
                      <span class="sr-only">{lang key='toggleNav'}</span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                    </button>
                  </div>

                  <!-- Collect the nav links, forms, and other content for toggling -->
                  <div class="collapse navbar-collapse" id="primary-nav">
                    <ul class="nav navbar-nav">
                      {include file="$template/includes/navbar.tpl" navbar=$primaryNavbar}
                      {include file="$template/includes/navbar.tpl" navbar=$secondaryNavbar}
                    </ul>
                  </div><!-- /.navbar-collapse -->
                </nav>
              </section>
            </div>
          </div>
        </section>
      {/if}
      {include file="$template/includes/validateuser.tpl"}
      {include file="$template/includes/verifyemail.tpl"}

      <div class="wdes-wrap-content">
        <section id="main-body">
          <div class="container{if $skipMainBodyContainer}-fluid without-padding{/if}">
            <div class="row wdes-flex-mob">

              {if !$inShoppingCart && $templatefile != "clientregister" && ($primarySidebar->hasChildren() || $secondarySidebar->hasChildren())}
                {if $primarySidebar->hasChildren() && !$skipMainBodyContainer}
                  <div class="col-md-12">
                    {include file="$template/includes/pageheader.tpl" title=$displayTitle desc=$tagline showbreadcrumb=true}
                  </div>
                {/if}
                <div class="col-md-3 pull-md-left sidebar">
                  {include file="$template/includes/sidebar.tpl" sidebar=$primarySidebar}
                  {if $secondarySidebar->hasChildren()}
                    <div class="sidebar-secondary">
                      {include file="$template/includes/sidebar.tpl" sidebar=$secondarySidebar}
                    </div>
                  {/if}
                </div>
              {/if}
              <!-- Container for main page display content -->
              <div
                class="{if !$inShoppingCart && $templatefile != "clientregister" && ($primarySidebar->hasChildren() || $secondarySidebar->hasChildren())}col-md-9 pull-md-right{else}col-xs-12{/if} main-content">
                {if !$primarySidebar->hasChildren() && !$showingLoginPage && !$inShoppingCart && $templatefile != 'homepage' && !$skipMainBodyContainer}
                  {include file="$template/includes/pageheader.tpl" title=$displayTitle desc=$tagline showbreadcrumb=true}
                {/if}
{/if}