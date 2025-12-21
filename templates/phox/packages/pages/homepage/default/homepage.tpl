{if $Phox['pages']['settings']['show-domain-section']['value'] == true}
  <section id="home-banner">
    {if $clientsstats.numdomains || $registerdomainenabled || $transferdomainenabled}
      <div class="row">
        <div class="col-md-5">
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
        <div class="col-md-6 col-md-push-1">
          {include file="$template/wdes/img/domain.svg"}
        </div>
      </div>
    {else}
      <h2>{$LANG.doToday}</h2>
    {/if}
  </section>
{/if}

<ul class="home-shortcuts">
  {if $clientsstats.numdomains || $registerdomainenabled || $transferdomainenabled}
    <li>
      <a id="btnBuyADomain" href="domainchecker.php">
        <i class="fad fa-globe"></i>
        <p>
          {$LANG.buyadomain} <span>&raquo;</span>
        </p>
      </a>
    </li>
  {/if}
  <li>
    <a id="btnOrderHosting" href="{$WEB_ROOT}/cart.php">
      <i class="fad fa-hdd"></i>
      <p>
        {$LANG.orderhosting} <span>&raquo;</span>
      </p>
    </a>
  </li>
  <li>
    <a id="btnMakePayment" href="clientarea.php">
      <i class="fad fa-credit-card"></i>
      <p>
        {$LANG.makepayment} <span>&raquo;</span>
      </p>
    </a>
  </li>
  <li>
    <a id="btnGetSupport" href="submitticket.php">
      <i class="fad fa-envelope"></i>
      <p>
        {$LANG.getsupport} <span>&raquo;</span>
      </p>
    </a>
  </li>
</ul>

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