<div class="wdes-wrap-account-page">

  {assign var="showLogo" value=$Phox['pages']['global-settings']['show-logo']['value']}

  {if $showLogo != true}
    <header class="wdes-wrap-account-page_header">
      {include file="$template/packages/includes/logo.tpl"}
    </header>
  {/if}

  <footer class="wdes-wrap-account-page_footer">
    <div id="wdes-carousel-announcements" class="wdes-announcements-carousel carousel slide" data-ride="carousel">
      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        {assign var="counter" value=0}
        {foreach $announcements as $announcement}
          <div class="{if $counter == 0}active{/if} item wdes-account-page-announcement-single">
            <div class="wdes-account-page-announcement-single_date"><i class="far fa-calendar"></i> {$announcement.date}
            </div>
            <h2 class="wdes-account-page-announcement-single_title">{$announcement.title}</h2>
            <p class="wdes-account-page-announcement-single_description">{$announcement.excerpt}</p>
            <a href="{routePath('announcement-view', $announcement.id, $announcement.urlfriendlytitle)}"
              class="btn wdes-account-page-announcement-single_btn">{$LANG.learnmore}</a>
          </div>
          {assign var="counter" value=$counter+1}
        {/foreach}
      </div>
      <!-- Indicators -->
      <ol class="carousel-indicators">
        {assign var="counter" value=0}
        {foreach $announcements as $announcement}
          <li class="{if $counter == 0}active{/if}" data-target="#wdes-carousel-announcements" data-slide-to="{$counter}">
          </li>
          {assign var="counter" value=$counter+1}
        {/foreach}
      </ol>
    </div>
  </footer>

  <main class="wdes-wrap-account-page_main">
    <article class="wdes-wrap-account-page_main_article">
      {* Heading *}
      <div class="wdes-wrap-account-page_main-article_heading">
        {include file="$template/includes/pageheader.tpl" title=$LANG.clientareahomeloginbtn desc="{$LANG.restrictedpage}"}
      </div>

      {* Alert *}
      {include file="$template/includes/flashmessage.tpl"}

      {* Social *}
      <div class="wdes-wrap-account-page_main-article_social">
        <div class="providerLinkingFeedback"></div>
        <div class="{if !$linkableProviders} hidden{/if}">
          {include file="$template/includes/linkedaccounts.tpl" linkContext="login" customFeedback=true}
        </div>
      </div>

      {* Form *}
      <div class="wdes-wrap-account-page_main-article_form">
        <form method="post" action="{routePath('login-validate')}" class="login-form" role="form">
          <div class="form-group">
            <label for="inputEmail">{$LANG.clientareaemail}</label>
            <input type="email" name="username" class="form-control" id="inputEmail" placeholder="{$LANG.enteremail}"
              autofocus>
          </div>

          <div class="form-group">
            <label class="d-flex align-center" for="inputPassword">{$LANG.clientareapassword} <a
                href="{routePath('password-reset-begin')}" class="wdes-btn-forget">{$LANG.forgotpw}</a></label>
            <input type="password" name="password" class="form-control" id="inputPassword"
              placeholder="{$LANG.clientareapassword}" autocomplete="off">
          </div>

          <div class="checkbox">
            <label class="wdes-rememberme">
              <input type="checkbox" name="rememberme" /> {$LANG.loginrememberme}
            </label>
          </div>
          {if $captcha->isEnabled()}
            <div class="text-center margin-bottom">
              {include file="$template/includes/captcha.tpl"}
            </div>
          {/if}
          <input id="login" type="submit"
            class="wdes-wrap-account-page_main-article_form_action btn btn-primary{$captcha->getButtonClass($captchaForm)}"
            value="{$LANG.loginbutton}" />
        </form>
      </div>

      {* Quick Actions *}
      <div class="wdes-wrap-account-page_main-article_form_actions">
        <div class="d-flex align-center justify-space">
          {if !$phoxRegistrationDisabled}
            <a class="wdes-register d-flex align-center gap-5" href="{$WEB_ROOT}/register.php"><i
                class="far fa-user-plus"></i>
              {$LANG.orderForm.createAccount}</a>
          {/if}

          {* Languages *}
          {if $languagechangeenabled && count($locales) > 1}
            <div class="dropdown">
              <button class="wdes-wrap-account-page_main-article_form_actions_language" id="languageChooser" type="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="far fa-globe"></i>
                {$activeLocale.localisedName}
                <span class="far fa-chevron-down"></span>
              </button>
              <ul class="dropdown-menu wdes-wrap-account-page_main-article_form_actions_language_menu"
                aria-labelledby="languageChooser">
                {foreach $locales as $locale}
                  <li>
                    <a href="{$currentpagelinkback}language={$locale.language}">{$locale.localisedName}</a>
                  </li>
                {/foreach}
              </ul>
            </div>
          {/if}
        </div>
      </div>
    </article>
  </main>

</div>