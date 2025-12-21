{include file="{$Phox['pages']['orderformPath']}/common.tpl"}

{include file="$template/includes/tablelist.tpl" tableName="DomainPricing"}
<script type="text/javascript">
    jQuery(document).ready(function() {
        var table = jQuery('#tableDomainPricing').removeClass('hidden').DataTable();
        table.draw();
        jQuery('#tableLoading').addClass('hidden');
    });
</script>

<div id="order-phox">

    {* Banner *}
    <div class="page-banner">
        <div class="container">
            <div class="page-banner-wrapper">
                <div class="banner-content">
                    <h1 class="banner-title">{$LANG.registerdomain}</h1>
                    <p class="banner-description">{$LANG.orderForm.findNewDomain}</p>
                    <div class="banner-actions">
                        <form method="post" action="{$WEB_ROOT}/cart.php" id="frmDomainChecker">
                            <input type="hidden" name="a" value="checkDomain">

                            <div class="domain-register-box">
                                <input type="text" name="domain" class="form-control"
                                    placeholder="{$LANG.findyourdomain}" value="{$lookupTerm}" id="inputDomain"
                                    data-toggle="tooltip" data-placement="top" data-trigger="manual"
                                    title="{lang key='orderForm.domainOrKeyword'}" />

                                <button type="submit" id="btnCheckAvailability"
                                    class="btn btn-primary domain-check-availability{$captcha->getButtonClass($captchaForm)}">{$LANG.search}</button>
                            </div>

                            {if $captcha->isEnabled() && $captcha->isEnabledForForm($captchaForm) && !$captcha->recaptcha->isInvisible()}
                                <div class="captcha-container" id="captchaContainer">
                                    {if $captcha->recaptcha->isEnabled()}
                                        <br>
                                        <div class="text-center">
                                            <div class="form-group recaptcha-container"></div>
                                        </div>
                                    {else}
                                        <div class="default-captcha default-captcha-register-margin">
                                            <p>{lang key="cartSimpleCaptcha"}</p>
                                            <div>
                                                <img id="inputCaptchaImage" src="{$systemurl}includes/verifyimage.php"
                                                    align="middle" />
                                                <input id="inputCaptcha" type="text" name="code" maxlength="6"
                                                    class="form-control input-sm" data-toggle="tooltip"
                                                    data-placement="right" data-trigger="manual"
                                                    title="{lang key='orderForm.required'}" />
                                            </div>
                                        </div>
                                    {/if}
                                </div>
                            {/if}

                        </form>
                    </div>
                </div>
                <div class="banner-thumb">
                    {include file="$template/wdes/img/domain-search.svg"}
                </div>
            </div>
        </div>     
    </div>

    <div class="row">
        <div class="cart-body cart-body--full-width">

            {* Domain Search Result *}
            <div class="wdes-phox-domain-result">
                <div id="DomainSearchResults" class="w-hidden">

                    {* Search Domain Info *}
                    <div class="domain-search-result-wrapper">
                        {* Search Info *}
                        <div id="searchDomainInfo">
                            {* Loader Placeholder *}
                            <p id="primaryLookupSearching" class="domain-lookup-loader domain-lookup-primary-loader domain-searching domain-checker-result-headline">
                                <i class="fad fa-spinner fa-spin"></i>
                                {lang key='orderForm.searching'}...
                            </p>

                            {* Lookup result *}
                            <div id="primaryLookupResult" class="domain-lookup-result domain-lookup-primary-results w-hidden">
                                {* Available *}
                                <div class="domain-available domain-checker-available domain-checker-result-headline">
                                    <i class="fad fa-check-circle"></i>
                                    <span class="domain-checker-result-headline-content">
                                        {* Domain *}
                                        <span>{$LANG.domainavailablemessage}</span>
                                        {* Price *}
                                        <div class="domain-price"><span class="price"></span>
                                            <button class="btn btn-primary btn-lg btn-add-to-cart btn-add-to-cart--inbox" data-whois="0" data-domain="">
                                                <span class="to-add">{$LANG.addtocart}</span>
                                                <span class="loading">
                                                    <i class="fas fa-spinner fa-spin"></i> {lang key='loading'}
                                                </span>
                                                <span class="added"><i class="far fa-shopping-cart"></i> {lang key='checkout'}</span>
                                                <span class="unavailable">{$LANG.domaincheckertaken}</span>
                                            </button>
                                        </div>
                                    </span>
                                </div>

                                {* Unavailable *}
                                <div class="domain-unavailable domain-checker-unavailable domain-checker-result-headline">
                                    <i class="fad fa-times-circle"></i>
                                    <span class="domain-checker-result-headline-content">
                                        {* Message *}
                                        <span>{lang key='orderForm.domainIsUnavailable'}</span>
                                    </span>
                                </div>

                                {* Invalid Domain *}
                                <div class="domain-invalid domain-checker-invalid domain-checker-result-headline">
                                    <i class="fad fa-times-circle"></i>
                                    <span class="domain-checker-result-headline-content">
                                        {* Message *}
                                        <span>{lang key='orderForm.domainInvalid'}</span>
                                        <span class="text-left">
                                            <p class="domain-msg-content">
                                                {lang key='orderForm.domainLetterOrNumber'}
                                                <span class="domain-length-restrictions">{lang key='orderForm.domainLengthRequirements'}</span>
                                            </p>
                                            <p class="domain-msg-content">{lang key='orderForm.domainInvalidCheckEntry'}</p>
                                        </span>
                                    </span>
                                </div>
                                
                                {* Invalid Domain *}
                                <div class="domain-invalid domain-checker-unavailable domain-checker-result-headline">
                                    <i class="fad fa-times-circle"></i>
                                    <span class="domain-checker-result-headline-content">
                                        {* Message *}
                                        <span>{lang key='orderForm.domainInvalid'}</span>
                                        <span class="text-left">
                                            <p class="domain-msg-content">
                                                {lang key='orderForm.domainLetterOrNumber'}
                                                <span class="domain-length-restrictions">{lang key='orderForm.domainLengthRequirements'}</span>
                                            </p>
                                            <p class="domain-msg-content">{lang key='orderForm.domainInvalidCheckEntry'}</p>
                                        </span>
                                    </span>
                                </div>

                                {* Invalid TLD *}
                                <div class="domain-tld-unavailable domain-checker-unavailable domain-checker-result-headline">
                                    <i class="fad fa-times-circle"></i>
                                    <span class="domain-checker-result-headline-content">
                                        {* Message *}
                                        <span>{lang key='orderForm.domainHasUnavailableTld'}</span>
                                    </span>
                                </div>

                                {* Error Domain *}
                                <p class="domain-error domain-checker-unavailable domain-checker-result-headline"></p>

                                {* Contact Us Price *}
                                <div class="btn btn-primary domain-contact-support">{$LANG.domainContactUs}</div>

                                {* International *}
                                <div id="idnLanguageSelector" class="idn-language-selector idn-language w-hidden mt-spacer-4x">
                                    {lang key='cart.idnLanguageDescription'} <br />
                                    <div class="form-group">
                                        <select name="idnlanguage" class="form-control">
                                            <option value="">{lang key='cart.idnLanguage'}</option>
                                            {foreach $idnLanguages as $idnLanguageKey => $idnLanguage}
                                                <option value="{$idnLanguageKey}">
                                                    {lang key='idnLanguage.'|cat:$idnLanguageKey}</option>
                                            {/foreach}
                                        </select>
                                        <div class="field-error-msg">
                                            {lang key='cart.selectIdnLanguageForRegister'}
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>

                    {if $spotlightTlds}
                        <div class="section mt-spacer-6x">
                            <div class="section-header">
                                <h2 class="section-title">{$LANG.featuredProduct}</h2>
                            </div>
                            <div class="section-body">
                                <div id="spotlightTlds" class="spotlight-tlds clearfix">
                                    <div class="spotlight-tlds-container">
                                        {foreach $spotlightTlds as $key => $data}
                                            <div class="spotlight-tld-container spotlight-tld-container-{$spotlightTlds|count}">
                                                <div id="spotlight{$data.tldNoDots}" class="spotlight-tld">
                                                    {if $data.group}
                                                        <div class="spotlight-tld-{$data.group}">{$data.groupDisplayName}</div>
                                                    {/if}
                                                    <div class="wdes-phox-tld-name">{$data.tld}</div>
                                                    <span class="domain-lookup-loader domain-lookup-spotlight-loader">
                                                        <i class="fas fa-spinner fa-spin"></i>
                                                    </span>
                                                    <div class="domain-lookup-result">
                                                        <button type="button" class="btn unavailable w-hidden" disabled="disabled">
                                                            {lang key='domainunavailable'}
                                                        </button>
                                                        <button type="button" class="btn invalid w-hidden" disabled="disabled">
                                                            {lang key='domainunavailable'}
                                                        </button>
                                                        <span class="available price w-hidden">{$data.register}</span>
                                                        <button type="button" class="btn btn-add-to-cart w-hidden" data-whois="0"
                                                            data-domain="">
                                                            <span class="to-add">{lang key='orderForm.add'}</span>
                                                            <span class="loading">
                                                                <i class="fas fa-spinner fa-spin"></i> {lang key='loading'}
                                                            </span>
                                                            <span class="added"><i class="far fa-shopping-cart"></i>
                                                                {lang key='checkout'}</span>
                                                            <span class="unavailable">{$LANG.domaincheckertaken}</span>
                                                        </button>
                                                        <button type="button" class="btn btn-primary domain-contact-support w-hidden">
                                                            {lang key='domainChecker.contactSupport'}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        {/foreach}
                                    </div>
                                </div>
                            </div>
                        </div>
                    {/if}

                    <div class="section section--suggested-domains suggested-domains {if !$showSuggestionsContainer} w-hidden{/if}">
                        <div class="section-header">
                            <h2 class="section-title">{lang key='orderForm.suggestedDomains'}</h2>
                            <p class="section-description">{lang key='domainssuggestionswarnings'}</p>
                        </div>

                        <div class="section-body">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="suggested-domains">
                                        <div id="suggestionsLoader"
                                            class="card-body panel-body domain-lookup-loader domain-lookup-suggestions-loader">
                                            <i class="fas fa-spinner fa-spin"></i> {lang key='orderForm.generatingSuggestions'}
                                        </div>
                                        <div id="domainSuggestions" class="domain-lookup-result list-group w-hidden">
                                            <div class="domain-suggestion list-group-item w-hidden">
                                                <section class="domain-suggestion-content">
                                                    <span class="domain"></span>
                                                    <span class="extension"></span>
                                                    <span class="promo w-hidden">
                                                        <span class="sales-group-hot w-hidden">{lang key='domainCheckerSalesGroup.hot'}</span>
                                                        <span class="sales-group-new w-hidden">{lang key='domainCheckerSalesGroup.new'}</span>
                                                        <span class="sales-group-sale w-hidden">{lang key='domainCheckerSalesGroup.sale'}</span>
                                                    </span>
                                                    <div class="actions">
                                                        <button type="button" class="btn btn-add-to-cart product-domain" data-whois="1"
                                                            data-domain="">
                                                            <span class="to-add">{$LANG.addtocart}</span>
                                                            <span class="loading">
                                                                <i class="fas fa-spinner fa-spin"></i> {lang key='loading'}
                                                            </span>
                                                            <span class="added">{lang key='domaincheckeradded'}</span>
                                                            <span class="unavailable">{$LANG.domaincheckertaken}</span>
                                                        </button>
                                                        <button type="button" class="btn btn-primary domain-contact-support w-hidden">{lang key='domainChecker.contactSupport'}</button>
                                                        <span class="price"></span>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                        <div class="panel-footer card-footer more-suggestions text-center w-hidden">
                                            <a id="moreSuggestions" href="#"
                                                onclick="loadMoreSuggestions();return false;">{lang key='domainsmoresuggestions'}</a>
                                            <span id="noMoreSuggestions"
                                                class="no-more small w-hidden">{lang key='domaincheckernomoresuggestions'}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="domain-pricing">

                {* Featured TLDS *}
                {if $featuredTlds}
                    <div class="section">
                        <div class="featured-tlds-container">
                            <div class="row">
                                {foreach $featuredTlds as $num => $tldinfo}
                                    {if $num % 3 == 0 && (count($featuredTlds) - $num < 3)}
                                        {if count($featuredTlds) - $num == 2}
                                            <div class="col-sm-2"></div>
                                        {else}
                                            <div class="col-sm-4"></div>
                                        {/if}
                                    {/if}
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="featured-tld">
                                            <div class="img-container">
                                                <img src="{$BASE_PATH_IMG}/tld_logos/{$tldinfo.tldNoDots}.png">
                                            </div>
                                            <div class="price {$tldinfo.tldNoDots}">
                                                {if is_object($tldinfo.register)}
                                                    {$tldinfo.register->toPrefixed()}{if $tldinfo.period > 1}{lang key="orderForm.shortPerYears" years={$tldinfo.period}}{else}{lang key="orderForm.shortPerYear" years=''}{/if}
                                                {else}
                                                    {lang key="domainregnotavailable"}
                                                {/if}
                                            </div>
                                        </div>
                                    </div>
                                {/foreach}
                            </div>
                        </div>
                    </div>
                {/if}

                {* TLD Pricing *}
                <div class="section">
                    <div class="section-header">
                        <h4 class="section-title">{lang key='pricing.browseExtByCategory'}</h4>
                    </div>

                    <div class="section-body">
                        {* Filters *}
                        <div class="tld-filters">
                            {foreach $categoriesWithCounts as $category => $count}
                                <a href="#" data-category="{$category}"
                                    class="badge badge-secondary">{lang key="domainTldCategory.$category" defaultValue=$category}
                                    ({$count})</a>
                            {/foreach}
                        </div>

                        {* Table *}
                        <div class="table-container clearfix">
                            <table id="tableDomainPricing" class="table table-list display responsive nowrap tld-table">
                                <thead>
                                    <tr>
                                        <th>{lang key='orderdomain'}</th>                       
                                        <th>{lang key='pricing.register'}</th>
                                        <th>{lang key='pricing.transfer'}</th>
                                        <th>{lang key='pricing.renewal'}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    {foreach $pricing['pricing'] as $tld => $price}
                                        <tr class="tld-row" data-category="{foreach $price.categories as $category}|{$category}|{/foreach}">
                                            <td>
                                                <strong class="tld-name"><span>.</span>{$tld}</strong>
                                                {if $price.group}
                                                    {if $price.group == "hot"}
                                                        {assign var="grouplabel" value="danger"}
                                                        {assign var="grouptext" value=$LANG['domainCheckerSalesGroup']['hot']}
                                                    {elseif $price.group == "new"}
                                                        {assign var="grouplabel" value="success"}
                                                        {assign var="grouptext" value=$LANG['domainCheckerSalesGroup']['new']}
                                                    {elseif $price.group == "sale"}
                                                        {assign var="grouplabel" value="purple"}
                                                        {assign var="grouptext" value=$LANG['domainCheckerSalesGroup']['sale']}
                                                    {/if}
                                                    <span class="label label-{$grouplabel}">{$grouptext}!</span>
                                                {/if}
                                            </td>

                                            <td>
                                                {if isset($price.register) && current($price.register) > 0}
                                                    {current($price.register)}<br>
                                                    <small>{key($price.register)} {if key($price.register) > 1}{lang key="orderForm.years"}{else}{lang key="orderForm.year"}{/if}</small>
                                                {elseif isset($price.register) && current($price.register) == 0}
                                                    <small>{lang key='orderfree'}</small>
                                                {else}
                                                    <small>{lang key='na'}</small>
                                                {/if}
                                            </td>

                                            <td>
                                                {if isset($price.transfer) && current($price.transfer) > 0}
                                                    {current($price.transfer)}<br>
                                                    <small>{key($price.transfer)} {if key($price.register) > 1}{lang key="orderForm.years"}{else}{lang key="orderForm.year"}{/if}</small>
                                                {elseif isset($price.transfer) && current($price.transfer) == 0}
                                                    <small>{lang key='orderfree'}</small>
                                                {else}
                                                    <small>{lang key='na'}</small>
                                                {/if}
                                            </td>

                                            <td>
                                                {if isset($price.renew) && current($price.renew) > 0}
                                                    {current($price.renew)}<br>
                                                    <small>{key($price.renew)} {if key($price.register) > 1}{lang key="orderForm.years"}{else}{lang key="orderForm.year"}{/if}</small>
                                                {elseif isset($price.renew) && current($price.renew) == 0}
                                                    <small>{lang key='orderfree'}</small>
                                                {else}
                                                    <small>{lang key='na'}</small>
                                                {/if}
                                            </td>
                                        </tr>
                                    {/foreach}
                                </tbody>
                            </table>
                        </div>

                        <div class="bg-white">


                            <div class="row tld-row no-tlds">
                                <div class="col-xs-12 col-12 text-center">
                                    <br>
                                    {lang key='pricing.selectExtCategory'}
                                    <br><br>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>


        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function() {
        jQuery('.tld-filters a:first-child').click();
        {if $lookupTerm && !$captchaError && !$invalid}
            jQuery('#btnCheckAvailability').click();
        {/if}
        {if $invalid}
            jQuery('#primaryLookupSearching').toggle();
            jQuery('#primaryLookupResult').children().toggle();
            jQuery('#primaryLookupResult').toggle();
            jQuery('#DomainSearchResults').toggle();
            jQuery('.domain-invalid').toggle();
        {/if}
    });
</script>