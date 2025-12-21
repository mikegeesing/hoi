{include file="{$Phox['pages']['orderformPath']}/common.tpl"}

<div id="order-phox">

    <div class="header-lined">
        <h1 class="font-size-36">{$LANG.domaincheckerchoosedomain}</h1>
    </div>

    <div class="row">

        <div class="cart-body cart-body--full-width">

            {include file="{$Phox['pages']['orderformPath']}/sidebar-categories-collapsed.tpl"}
            <form id="frmProductDomain">
                <input type="hidden" id="frmProductDomainPid" value="{$pid}" />
                <div class="domain-selection-options">
                    {if $incartdomains}
                        <div class="option">
                            <label>
                                <input type="radio" name="domainoption" value="incart"
                                    id="selincart" checked />{$LANG.cartproductdomainuseincart}
                            </label>
                            <div class="domain-input-group clearfix" id="domainincart">
                                <div class="d-flex gap-10 flex-flow-column-mobile">
                                    <select id="incartsld" name="incartdomain"
                                        class="form-control domain-input-block_input domain-input-block_input--f-width">
                                        {foreach key=num item=incartdomain from=$incartdomains}
                                            <option value="{$incartdomain}">{$incartdomain}</option>
                                        {/foreach}
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-block domain-input-block_action">
                                        {$LANG.orderForm.use}
                                    </button>
                                </div>
                            </div>
                        </div>
                    {/if}

                    {if $registerdomainenabled}
                        <div class="option">
                            <label>
                                <input type="radio" name="domainoption" value="register" id="selregister"
                                    {if $domainoption eq "register"}
                                    checked{/if} />{$LANG.cartregisterdomainchoice|sprintf2:$companyname}
                            </label>
                            <div class="domain-input-group clearfix" id="domainregister">
                                <div class="d-flex gap-10 flex-flow-column-mobile">
                                    <div class="domain-input-block_input">
                                        <input type="text" id="registersld" value="{$sld}" class="form-control"
                                            autocapitalize="none" data-toggle="tooltip" data-placement="top"
                                            data-trigger="manual" title="{lang key='orderForm.enterDomain'}" placeholder="{$LANG.domainname}" />
                                    </div>
                                    <select id="registertld" class="form-control domain-input-block_tlds">
                                        {foreach from=$registertlds item=listtld}
                                            <option value="{$listtld}" {if $listtld eq $tld} selected="selected" {/if}>
                                                {$listtld}</option>
                                        {/foreach}
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-block domain-input-block_action">
                                        {$LANG.orderForm.check}
                                    </button>
                                </div>
                            </div>
                        </div>
                    {/if}

                    {if $transferdomainenabled}
                        <div class="option">
                            <label>
                                <input type="radio" name="domainoption" value="transfer" id="seltransfer"
                                    {if $domainoption eq "transfer"}
                                    checked{/if} />{$LANG.carttransferdomainchoice|sprintf2:$companyname}
                            </label>
                            <div class="domain-input-group clearfix" id="domaintransfer">
                                <div class="d-flex align-center gap-10 flex-flow-column-mobile">
                                    <div class="domain-input-block_input">
                                        <input type="text" id="transfersld" value="{$sld}" class="form-control"
                                            autocapitalize="none" data-toggle="tooltip" data-placement="top"
                                            data-trigger="manual" title="{lang key='orderForm.enterDomain'}" placeholder="{$LANG.domainname}" />
                                    </div>
                                    <select id="transfertld" class="form-control domain-input-block_tlds">
                                        {foreach from=$transfertlds item=listtld}
                                            <option value="{$listtld}" {if $listtld eq $tld} selected="selected" {/if}>
                                                {$listtld}</option>
                                        {/foreach}
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-block domain-input-block_action">
                                        {$LANG.orderForm.transfer}
                                    </button>
                                </div>
                            </div>
                        </div>
                    {/if}

                    {if $owndomainenabled}
                        <div class="option">
                            <label>
                                <input type="radio" name="domainoption" value="owndomain" id="selowndomain"
                                    {if $domainoption eq "owndomain"}
                                    checked{/if} />{$LANG.cartexistingdomainchoice|sprintf2:$companyname}
                            </label>
                            <div class="domain-input-group clearfix" id="domainowndomain">

                                <div class="d-flex align-center gap-10 flex-flow-column-mobile">
                                    <div class="domain-input-block_input">
                                        <input type="text" id="owndomainsld" value="{$sld}"
                                            placeholder="{lang key='yourdomainplaceholder'}" class="form-control"
                                            autocapitalize="none" data-toggle="tooltip" data-placement="top"
                                            data-trigger="manual" title="{lang key='orderForm.enterDomain'}" />
                                    </div>
                                    <input type="text" id="owndomaintld" value="{$tld|substr:1}"
                                        placeholder="{$LANG.yourtldplaceholder}"
                                        class="form-control domain-input-block_tlds" autocapitalize="none"
                                        data-toggle="tooltip" data-placement="top" data-trigger="manual"
                                        title="{lang key='orderForm.required'}" />

                                    <button type="submit" class="btn btn-primary btn-block domain-input-block_action"
                                        id="useOwnDomain">
                                        {$LANG.orderForm.use}
                                    </button>
                                </div>
                            </div>
                        </div>
                    {/if}

                    {if $subdomains}
                        <div class="option">
                            <label>
                                <input type="radio" name="domainoption" value="subdomain" id="selsubdomain"
                                    {if $domainoption eq "subdomain"}
                                    checked{/if} />{$LANG.cartsubdomainchoice|sprintf2:$companyname}
                            </label>
                            <div class="domain-input-group clearfix" id="domainsubdomain">
                                <div class="d-flex align-center gap-10 flex-flow-column-mobile">
                                    <div class="input-group domain-input-block_input">
                                        <div class="input-group-addon input-group-prepend">
                                            <span class="input-group-text">http://</span>
                                        </div>
                                        <input type="text" id="subdomainsld" value="{$sld}" placeholder="yourname"
                                            class="form-control" autocapitalize="none" data-toggle="tooltip"
                                            data-placement="top" data-trigger="manual"
                                            title="{lang key='orderForm.enterDomain'}" />
                                    </div>
                                    <select id="subdomaintld" class="form-control domain-input-block_tlds">
                                        {foreach $subdomains as $subid => $subdomain}
                                            <option value="{$subid}">{$subdomain}</option>
                                        {/foreach}
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-block domain-input-block_action">
                                        {$LANG.orderForm.check}
                                    </button>
                                </div>
                            </div>
                        </div>
                    {/if}
                </div>

                {if $freedomaintlds}
                    <p>* <em>{$LANG.orderfreedomainregistration} {$LANG.orderfreedomainappliesto}: {$freedomaintlds}</em>
                    </p>
                {/if}

            </form>

            <div class="clearfix"></div>
            <form method="post" action="{$WEB_ROOT}/cart.php?a=add&pid={$pid}&domainselect=1"
                id="frmProductDomainSelections" class="wdes-phox-domain-result">

                <div id="DomainSearchResults" class="w-hidden">

                    {* Domain Search Result *}
                    <div class="domain-search-result-wrapper">
                        {* Search Info *}
                        <div id="searchDomainInfo">
                            {* Loader Placeholder *}
                            <p id="primaryLookupSearching" class="domain-lookup-loader domain-lookup-primary-loader domain-searching domain-checker-result-headline">
                                <i class="fad fa-spinner fa-spin"></i>
                                <span class="domain-lookup-register-loader">{lang key='orderForm.checkingAvailability'}...</span>
                                <span class="domain-lookup-transfer-loader">{lang key='orderForm.verifyingTransferEligibility'}...</span>
                                <span class="domain-lookup-other-loader">{lang key='orderForm.verifyingDomain'}...</span>
                            </p>

                            {* Lookup result *}
                            <div id="primaryLookupResult" class="domain-lookup-result domain-lookup-primary-results w-hidden">
                                {* Available *}
                                <div class="domain-available domain-checker-available headline">
                                    <i class="fad fa-check-circle"></i>
                                    <span class="domain-checker-result-headline-content">
                                        {* Domain *}
                                        <span>{$LANG.domainavailablemessage}</span>
                                        {* Price *}
                                        <div class="domain-price"><span class="price"></span></div>
                                    </span>
                                </div>

                                {* Unavailable *}
                                <div class="domain-unavailable domain-checker-unavailable headline">
                                    <i class="fad fa-times-circle"></i>
                                    <span class="domain-checker-result-headline-content">
                                        {* Message *}
                                        <span>{lang key='orderForm.domainIsUnavailable'}</span>
                                    </span>
                                </div>

                                {* Transfer Eligibility *}
                                <div class="transfer-eligible domain-checker-available headline">
                                    <i class="fad fa-check-circle"></i>
                                    <span class="domain-checker-result-headline-content">
                                        {* Message *}
                                        <span>{lang key='orderForm.transferEligible'}</span>
                                        <p class="domain-msg-content">{lang key='orderForm.transferUnlockBeforeContinuing'}</p>
                                        {* Price *}
                                        <div class="domain-price">
                                            <span class="domain-msg-content transfer-price-label w-hidden">{lang key='orderForm.domainPriceTransferLabel'}</span><span class="price"></span>
                                        </div>
                                    </span>
                                </div>

                                {* Transfer Not Eligible *}
                                <div class="transfer-not-eligible domain-checker-unavailable headline">
                                    <i class="fad fa-times-circle"></i>
                                    <span class="domain-checker-result-headline-content">
                                        {* Message *}
                                        <span>{lang key='orderForm.transferNotEligible'}</span>
                                        <span class="text-left">
                                            <p class="domain-msg-content">{lang key='orderForm.transferNotRegistered'}</p>
                                            <p class="domain-msg-content">{lang key='orderForm.trasnferRecentlyRegistered'}</p>
                                            <p class="domain-msg-content">{lang key='orderForm.transferAlternativelyRegister'}</p>
                                        </span>
                                    </span>
                                </div>
                                

                                {* Invalid Domain *}
                                <div class="domain-invalid domain-checker-unavailable headline">
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
                                <div class="domain-invalid domain-checker-unavailable headline">
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

                                {* Error Domain *}
                                <p class="domain-error domain-checker-unavailable headline"></p>

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

                                <input type="hidden" id="resultDomainOption" name="domainoption" />
                                <input type="hidden" id="resultDomain" name="domains[]" />
                                <input type="hidden" id="resultDomainPricingTerm" />
                            </div>
                        </div>

                        {* Continue *}
                        <button id="btnDomainContinue" type="submit" class="btn btn-primary btn-lg w-hidden" disabled="disabled">{$LANG.continue}</button>
                    </div>

                    {if $registerdomainenabled}
                        {if $spotlightTlds}
                            <div class="section mt-spacer-6x">
                                <div class="section-header">
                                    <h2 class="section-title">{$LANG.featuredProduct}</h2>
                                </div>
                                <div class="section-body">
                                    <div id="spotlightTlds" class="spotlight-tlds clearfix w-hidden">
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
                                                            <button type="button" class="btn btn-add-to-cart product-domain w-hidden"
                                                                data-whois="0" data-domain="">
                                                                <span class="to-add">{lang key='orderForm.add'}</span>
                                                                <span class="loading">
                                                                    <i class="fas fa-spinner fa-spin"></i> {lang key='loading'}
                                                                </span>
                                                                <span class="added"><i class="far fa-shopping-cart"></i>
                                                                    {lang key='domaincheckeradded'}</span>
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

                        <div class="section section--suggested-domains suggested-domains w-hidden">
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
                                                        <span class="promo w-hidden"></span>
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
                                                            <button type="button" class="btn btn-primary domain-contact-support w-hidden">Contact
                                                                Support to
                                                                Purchase</button>
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
                    {/if}

                </div>

            </form>
        </div>
    </div>
</div>

{include file="{$Phox['pages']['orderformPath']}/recommendations-modal.tpl"}