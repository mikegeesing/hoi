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
        {include file="$template/includes/pageheader.tpl" title=$LANG.pwreset}
      </div>

      {* Alert *}
      {if $loggedin && $innerTemplate}
        {include file="$template/includes/alert.tpl" type="error" msg=$LANG.noPasswordResetWhenLoggedIn textcenter=true}
      {else}
        {if $successMessage}
          {include file="$template/includes/alert.tpl" type="success" msg=$successTitle textcenter=true}
          <p>{$successMessage}</p>
        {else}
          {if $errorMessage}
            {include file="$template/includes/alert.tpl" type="error" msg=$errorMessage textcenter=true}
          {/if}
        {/if}
      {/if}

      {* Form *}
      <div class="wdes-wrap-account-page_main-article_form">
        {if !$successMessage}
          {if $innerTemplate}
            {include file="$template/password-reset-$innerTemplate.tpl"}
          {/if}
        {/if}
      </div>

      {* Quick Actions *}
      <div class="wdes-wrap-account-page_main-article_form_actions">
        <div class="d-flex align-center justify-space">
          <div class="d-flex align-center gap-5 wdes-register">
            <a href="{$WEB_ROOT}/clientarea.php"><i class="far fa-user"></i> {$LANG.store.login}</a>
          </div>

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