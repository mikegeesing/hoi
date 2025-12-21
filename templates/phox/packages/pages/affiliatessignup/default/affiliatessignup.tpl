{if $affiliatesystemenabled}
    {* Banner *}
    <div class="page-banner">
        <div class="container">
            <div class="page-banner-wrapper">
                <div class="banner-content">
                    <h1 class="banner-title">{$LANG.affiliatesignuptitle}</h1>
                    <p class="banner-description">{$LANG.affiliatesignupintro}</p>
                    <div class="banner-actions">
                        <form method="post" action="affiliates.php">
                            <input type="hidden" name="activate" value="true" />
                            <input id="activateAffiliate" type="submit" value="{$LANG.affiliatesactivate}" class="btn btn-lg btn-primary" />
                        </form>
                    </div>
                </div>
                <div class="banner-thumb">
                    {include file="$template/wdes/img/affiliate.svg"}
                </div>
            </div>
        </div>     
    </div>
    
    {* Features *}
    <div class="features-boxes-list">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="feature-item">
                        <i class="fad fa-analytics"></i>
                        <h2 class="feature-title">{$LANG.affiliatesvisitorsreferred}</h2>
                        <p class="feature-desc">{$LANG.affiliatesignupinfo2}</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-item">
                        <i class="fad fa-sack-dollar"></i>
                        <h2 class="feature-title">{$LANG.affiliatescommission}</h2>
                        <p class="feature-desc">{$LANG.affiliatesignupinfo1}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
{else}
    {include file="$template/includes/alert.tpl" type="warning" msg=$LANG.affiliatesdisabled textcenter=true}
{/if}
