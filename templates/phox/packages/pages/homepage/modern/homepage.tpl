<link rel="stylesheet" href="{$Phox['pages']['fullURL']}/style.css" />

{if $Phox['pages']['settings']['show-domain-section']['value'] == true}
  <section id="home-banner">
    {if $clientsstats.numdomains || $registerdomainenabled || $transferdomainenabled}
      <div class="row">
        <div class="col-md-12">
          <div class="wdes-domain-info">
            <h2>{$LANG.homebegin}</h2>
            <form method="post" action="domainchecker.php" id="frmDomainHomepage">
              <input type="hidden" name="transfer" />
              <div class="wdes-input-group input-group">
                <input type="text" class="form-control" name="domain" placeholder="{$LANG.exampledomain}"
                  autocapitalize="none" data-toggle="tooltip" data-placement="left" data-trigger="manual"
                  title="{lang key='orderForm.required'}" />
                <span class="input-group-btn">
                  {if $registerdomainenabled}
                    <input type="submit" class="btn search{$captcha->getButtonClass($captchaForm)}" value="{$LANG.search}"
                      id="btnDomainSearch" />
                  {/if}
                  {if $transferdomainenabled}
                    <input type="submit" id="btnTransfer" class="btn transfer{$captcha->getButtonClass($captchaForm)}"
                      value="{$LANG.domainstransfer}" />
                  {/if}
                </span>
              </div>
              {include file="$template/includes/captcha.tpl"}
            </form>
          </div>
        </div>
      </div>
    {else}
      <h2>{$LANG.doToday}</h2>
    {/if}
  </section>
{/if}

{if !empty($productGroups) || $registerdomainenabled || $transferdomainenabled}
  <div class="wdes-modern-services">
    <h2 class="wdes-modern-services_heading">{lang key='clientHomePanels.productsAndServices'}</h2>

    <div class="wdes-modern-services_blocks">
      {foreach $productGroups as $productGroup}

        <div class="wdes-modern-services_block">
          <div class="wdes-modern-services_block_icon"><i class="fad fa-server"></i></div>
          <h3 class="wdes-modern-services_block_title">
            {$productGroup->name}
          </h3>
          <p class="wdes-modern-services_block_description">{$productGroup->tagline}</p>
          <a href="{$productGroup->getRoutePath()}" class="wdes-modern-services_block_action">
            {lang key='browseProducts'}
          </a>
        </div>

      {/foreach}

      {if $registerdomainenabled}
        <div class="wdes-modern-services_block">
          <div class="wdes-modern-services_block_icon"><i class="fad fa-globe"></i></div>
          <h3 class="wdes-modern-services_block_title">
            {lang key='orderregisterdomain'}
          </h3>
          <p class="wdes-modern-services_block_description">{lang key='secureYourDomain'}</p>
          <a href="{$WEB_ROOT}/cart.php?a=add&domain=register" class="wdes-modern-services_block_action">
            {lang key='navdomainsearch'}
          </a>
        </div>
      {/if}
    </div>
  </div>
{/if}

<div class="wdes-help-items-list">
  <h2 class="wdes-help-items-list_heading">{lang key='howCanWeHelp'}</h2>

  <div class="wdes-help-items-list_blocks">
    <div class="wdes-help-items-list_block">
      <a href="{routePath('announcement-index')}">
        <figure class="wdes-help-items-list_block_icon">
          <i class="fad fa-bullhorn"></i>
        </figure>
        <h4 class="wdes-help-items-list_block_title">{lang key='announcementstitle'}</h4>
      </a>
    </div>
    <div class="wdes-help-items-list_block">
      <a href="serverstatus.php" class="card-accent-pomegranate">
        <figure class="wdes-help-items-list_block_icon">
          <i class="fad fa-server"></i>
        </figure>
        <h4 class="wdes-help-items-list_block_title">{lang key='networkstatustitle'}</h4>
      </a>
    </div>
    <div class="wdes-help-items-list_block">
      <a href="{routePath('knowledgebase-index')}">
        <figure class="wdes-help-items-list_block_icon">
          <i class="fad fa-book"></i>
        </figure>
        <h4 class="wdes-help-items-list_block_title">{lang key='knowledgebasetitle'}</h4>
      </a>
    </div>
    <div class="wdes-help-items-list_block">
      <a href="{routePath('download-index')}">
        <figure class="wdes-help-items-list_block_icon">
          <i class="fad fa-download"></i>
        </figure>
        <h4 class="wdes-help-items-list_block_title">{lang key='downloadstitle'}</h4>
      </a>
    </div>
    <div class="wdes-help-items-list_block">
      <a href="submitticket.php">
        <figure class="wdes-help-items-list_block_icon">
          <i class="fad fa-life-ring"></i>
        </figure>
        <h4 class="wdes-help-items-list_block_title">{lang key='homepage.submitTicket'}</h4>
      </a>
    </div>
  </div>
</div>

{if $announcements}
  <div class="wdes-tweets-block">
    <h2>{$LANG.ourlatestnews}</h2>
    <p>{$LANG.announcementsdescription}</p>
    <div class="wdes-items-blocks">
      {foreach $announcements as $announcement}
        {if $announcement@index < 3} <div class="announcement-single">
            <span class="wdes-announcement-date">
              <i class="fad fa-calendar"></i>
              {$carbon->translatePassedToFormat($announcement.rawDate, 'M jS')}
            </span>
            <h3>
              <a
                href="{routePath('announcement-view', $announcement.id, $announcement.urlfriendlytitle)}">{$announcement.title}</a>
            </h3>
            {if $announcementsFbRecommend}
              <script>
                (function(d, s, id) {
                  var js, fjs = d.getElementsByTagName(s)[0];
                  if (d.getElementById(id)) {
                    return;
                  }
                  js = d.createElement(s);
                  js.id = id;
                  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                  fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));
              </script>
              <div class="fb-like" data-layout="standard"
                data-href="{fqdnRoutePath('announcement-view', $announcement.id, $announcement.urlfriendlytitle)}"
                data-send="true" data-width="450" data-show-faces="true" data-action="recommend"></div>
            {/if}
          </div>
        {/if}
      {/foreach}
    </div>
  </div>
{elseif $twitterusername}
  <h2>{$LANG.twitterlatesttweets}</h2>
  <div id="twitterFeedOutput">
    <p class="text-center"><img src="{$BASE_PATH_IMG}/loading.gif" /></p>
  </div>
  <script type="text/javascript" src="{assetPath file='twitter.js'}"></script>
{/if}