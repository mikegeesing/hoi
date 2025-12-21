{if $checkout}

    {include file="orderforms/$carttpl/checkout.tpl"}

{else}

    <script>
        // Define state tab index value
        var statesTab = 10;
        var stateNotRequired = true;
    </script>
    {include file="{$Phox['pages']['orderformPath']}/common.tpl"}
    <script type="text/javascript" src="{$BASE_PATH_JS}/StatesDropdown.js"></script>

    <div id="order-phox">

        <div class="header-lined">
            <h1 class="font-size-36">{$LANG.cartreviewcheckout}</h1>
        </div>

        <div class="row">

            <div class="cart-body cart-body--full-width">


                {include file="{$Phox['pages']['orderformPath']}/sidebar-categories-collapsed.tpl"}

                <div class="row">
                    <div class="secondary-cart-body">

                        {if $promoerrormessage}
                            <div class="alert alert-warning text-center" role="alert">
                                {$promoerrormessage}
                            </div>
                        {elseif $errormessage}
                            <div class="alert alert-danger" role="alert">
                                <p>{$LANG.orderForm.correctErrors}:</p>
                                <ul>
                                    {$errormessage}
                                </ul>
                            </div>
                        {elseif $promotioncode && $rawdiscount eq "0.00"}
                            <div class="alert alert-info text-center" role="alert">
                                {$LANG.promoappliedbutnodiscount}
                            </div>
                        {elseif $promoaddedsuccess}
                            <div class="alert alert-success text-center" role="alert">
                                {$LANG.orderForm.promotionAccepted}
                            </div>
                        {/if}

                        {if $bundlewarnings}
                            <div class="alert alert-warning" role="alert">
                                <strong>{$LANG.bundlereqsnotmet}</strong><br />
                                <ul>
                                    {foreach from=$bundlewarnings item=warning}
                                        <li>{$warning}</li>
                                    {/foreach}
                                </ul>
                            </div>
                        {/if}

                        <div class="section section-cart-items-review">
                            <form method="post" action="{$smarty.server.PHP_SELF}?a=view">

                                <div class="view-cart-items-header">
                                    <div class="view-cart-items-header_head">
                                        {$LANG.orderForm.productOptions}
                                    </div>
                                    <div class="view-cart-items-header_cycle">
                                        {$LANG.orderForm.priceCycle}
                                    </div>
                                    <div class="view-cart-items-header_action">
                                    </div>
                                </div>

                                <div class="view-cart-items">

                                    {foreach $products as $num => $product}
                                        <div class="wdes-phox-view-cart_item">
                                            {* Title *}
                                            <div class="wdes-phox-view-cart_item_title">
                                                <div class="wdes-phox-view-cart_item_title_block">
                                                    <b>{$product.productinfo.name}</b> -
                                                    <span>{$product.productinfo.groupname}</span>
                                                </div>
                                                {if $product.domain}
                                                    <a href="{$product.domain}">{$product.domain}</a>
                                                {/if}
                                                <div class="wdes-phox-view-cart_item_list">
                                                    {if $product.configoptions}
                                                        <ul>
                                                            {foreach key=confnum item=configoption from=$product.configoptions}
                                                                <li>
                                                                    <b>{$configoption.name}:</b>
                                                                    {if $configoption.type eq 1 || $configoption.type eq 2}
                                                                        {$configoption.option}
                                                                    {elseif $configoption.type eq 3}
                                                                        {if $configoption.qty}
                                                                            {$configoption.option}
                                                                        {else}{$LANG.no}
                                                                        {/if}
                                                                    {elseif $configoption.type eq 4}
                                                                        {$configoption.qty} x {$configoption.option}
                                                                    {/if}
                                                                </li>
                                                            {/foreach}
                                                        </ul>
                                                    {/if}
                                                </div>
                                                <div class="wdes-phox-view-cart_item_qty">
                                                    {if $showqtyoptions}
                                                        <div class="item-qty">
                                                            {if $product.allowqty}
                                                                <span
                                                                    class="wdes-phox-view-cart_item_qty_heading">{$LANG.orderForm.qty}</span>
                                                                <input type="number" name="qty[{$num}]" value="{$product.qty}"
                                                                    class="form-control text-center" min="0" />
                                                                <button type="submit">
                                                                    {$LANG.orderForm.update}
                                                                </button>
                                                            {/if}
                                                        </div>
                                                    {/if}
                                                </div>
                                            </div>

                                            {* Pricing *}
                                            <div class="wdes-phox-view-cart_item_pricing">
                                                <span>{$product.pricing.totalTodayExcludingTaxSetup}</span>
                                                <span class="cycle">{$product.billingcyclefriendly}</span>
                                                {if $product.pricing.productonlysetup}
                                                    {$product.pricing.productonlysetup->toPrefixed()} {$LANG.ordersetupfee}
                                                {/if}
                                                {if $product.proratadate}<br />({$LANG.orderprorata}
                                                {$product.proratadate}){/if}
                                            </div>

                                            {* Actions *}
                                            <div class="wdes-phox-view-cart_item_actions">
                                                <a href="{$WEB_ROOT}/cart.php?a=confproduct&i={$num}">
                                                    <i class="fad fa-pencil-alt"></i>
                                                </a>
                                                <button type="button" class="btn-remove-from-cart"
                                                    onclick="removeItem('p','{$num}')">
                                                    <i class="fad fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>

                                        {foreach $product.addons as $addonnum => $addon}
                                            <div class="wdes-phox-view-cart_item">
                                                {* Title *}
                                                <div class="wdes-phox-view-cart_item_title">
                                                    <div class="wdes-phox-view-cart_item_title_block">
                                                        <b>{$addon.name}</b>
                                                        <span>{$LANG.orderaddon}</span>
                                                    </div>

                                                    {if $showAddonQtyOptions}
                                                        <div class="wdes-phox-view-cart_item_qty">
                                                            <div class="item-qty">
                                                                {if $addon.allowqty === 2}
                                                                    <input type="number" name="paddonqty[{$num}][{$addonnum}]"
                                                                        value="{$addon.qty}" class="form-control text-center" min="0" />
                                                                    <button type="submit">
                                                                        {$LANG.orderForm.update}
                                                                    </button>
                                                                {/if}
                                                            </div>
                                                        </div>
                                                    {/if}
                                                </div>

                                                {* Pricing *}
                                                <div class="wdes-phox-view-cart_item_pricing">
                                                    <span>{$addon.totaltoday}</span>
                                                    <span class="cycle">{$addon.billingcyclefriendly}</span>
                                                    {if $addon.setup}{$addon.setup->toPrefixed()} {$LANG.ordersetupfee}{/if}
                                                    {if $addon.isProrated}<br />({$LANG.orderprorata} {$addon.prorataDate}){/if}
                                                </div>

                                                {* Actions *}
                                                <div class="wdes-phox-view-cart_item_actions">
                                                </div>

                                            </div>
                                        {/foreach}
                                    {/foreach}

                                    {foreach $addons as $num => $addon}
                                        <div class="wdes-phox-view-cart_item">
                                            {* Title *}
                                            <div class="wdes-phox-view-cart_item_title">
                                                <div class="wdes-phox-view-cart_item_title_block">
                                                    <b>{$addon.name}</b> - <span>{$addon.productname}</span>
                                                </div>
                                                {if $addon.domainname}
                                                    <a href="{$addon.domainname}">{$addon.domainname}</a>
                                                {/if}
                                                <div class="wdes-phox-view-cart_item_qty">
                                                    {if $showAddonQtyOptions}
                                                        <div class="item-qty">
                                                            {if $addon.allowqty === 2}
                                                                <span
                                                                    class="wdes-phox-view-cart_item_qty_heading">{$LANG.orderForm.qty}</span>
                                                                <input type="number" name="addonqty[{$num}]" value="{$addon.qty}"
                                                                    class="form-control text-center" min="0" />
                                                                <button type="submit">
                                                                    {$LANG.orderForm.update}
                                                                </button>
                                                            {/if}
                                                        </div>
                                                    {/if}
                                                </div>
                                            </div>

                                            {* Pricing *}
                                            <div class="wdes-phox-view-cart_item_pricing">
                                                <span>{$addon.totaltoday}</span>
                                                <span class="cycle">{$addon.billingcyclefriendly}</span>
                                                {if $addon.setup}{$addon.setup->toPrefixed()} {$LANG.ordersetupfee}{/if}
                                                {if $addon.isProrated}<br />({$LANG.orderprorata} {$addon.prorataDate}){/if}
                                            </div>

                                            {* Actions *}
                                            <div class="wdes-phox-view-cart_item_actions">
                                                <a href="{$WEB_ROOT}/cart.php?a=confproduct&i={$num}">
                                                    <i class="fal fa-pencil-alt"></i>
                                                </a>
                                                <button type="button" class="btn-remove-from-cart"
                                                    onclick="removeItem('a','{$num}')">
                                                    <i class="fal fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    {/foreach}

                                    {foreach $domains as $num => $domain}
                                        <div class="wdes-phox-view-cart_item">
                                            {* Title *}
                                            <div class="wdes-phox-view-cart_item_title">
                                                <div class="wdes-phox-view-cart_item_title_block">
                                                    <b>{if $domain.type eq "register"}{$LANG.orderdomainregistration}{else}{$LANG.orderdomaintransfer}{/if}</b>
                                                </div>
                                                {if $domain.domain}
                                                    <a href="{$domain.domain}">{$domain.domain}</a>
                                                {/if}
                                                <div class="wdes-phox-view-cart_item_list">
                                                    <ul>
                                                        {if $domain.dnsmanagement}<li>{$LANG.domaindnsmanagement}</li>{/if}
                                                        {if $domain.emailforwarding}<li>{$LANG.domainemailforwarding}</li>{/if}
                                                        {if $domain.idprotection}<li>{$LANG.domainidprotection}</li>{/if}
                                                    </ul>
                                                </div>
                                            </div>

                                            {* Pricing *}
                                            <div class="wdes-phox-view-cart_item_pricing">
                                                {if count($domain.pricing) == 1 || $domain.type == 'transfer'}
                                                    <span name="{$domain.domain}Price">{$domain.price}</span>
                                                    <span class="cycle">{$domain.regperiod} {$domain.yearsLanguage}</span>
                                                    <span class="renewal cycle">
                                                        {if isset($domain.renewprice)}{lang key='domainrenewalprice'} <span
                                                            class="renewal-price cycle">{$domain.renewprice->toPrefixed()}{$domain.shortRenewalYearsLanguage}{/if}</span>
                                                    </span>
                                                {else}
                                                    <span name="{$domain.domain}Price">{$domain.price}</span>
                                                    <div class="dropdown wdes-phox-view-cart_item_pricing_dropdown">
                                                        <button class="btn btn-default btn-default btn-xs dropdown-toggle" type="button"
                                                            id="{$domain.domain}Pricing" name="{$domain.domain}Pricing"
                                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            {$domain.regperiod} {$domain.yearsLanguage}
                                                            <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu" aria-labelledby="{$domain.domain}Pricing">
                                                            {foreach $domain.pricing as $years => $price}
                                                                <li>
                                                                    <a href="#"
                                                                        onclick="selectDomainPeriodInCart('{$domain.domain}', '{$price.register}', {$years}, '{if $years == 1}{lang key='orderForm.year'}{else}{lang key='orderForm.years'}{/if}');return false;">
                                                                        {$years}
                                                                        {if $years == 1}{lang key='orderForm.year'}{else}{lang key='orderForm.years'}{/if}
                                                                        @ {$price.register}
                                                                    </a>
                                                                </li>
                                                            {/foreach}
                                                        </ul>
                                                    </div>
                                                    <span class="renewal cycle">
                                                        {lang key='domainrenewalprice'} <span
                                                            class="renewal-price cycle">{if isset($domain.renewprice)}{$domain.renewprice->toPrefixed()}{$domain.shortRenewalYearsLanguage}{/if}</span>
                                                    </span>
                                                {/if}
                                            </div>

                                            {* Actions *}
                                            <div class="wdes-phox-view-cart_item_actions">
                                                <a href="{$WEB_ROOT}/cart.php?a=confdomains" class="btn btn-link btn-xs">
                                                    <i class="fad fa-pencil-alt"></i>
                                                </a>
                                                <button type="button" class="btn-remove-from-cart"
                                                    onclick="removeItem('d','{$num}')">
                                                    <i class="fad fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    {/foreach}

                                    {foreach $renewalsByType['services'] as $num => $service}
                                        <div class="wdes-phox-view-cart_item">
                                            {* Title *}
                                            <div class="wdes-phox-view-cart_item_title">
                                                <div class="wdes-phox-view-cart_item_title_block">
                                                    <b>{lang key='renewService.titleAltSingular'}</b> - <span>{$service.name}</span>
                                                    <a href="{$service.domainName}">{$service.domainName}</a>
                                                </div>
                                            </div>

                                            {* Pricing *}
                                            <div class="wdes-phox-view-cart_item_pricing">
                                                <span>{$service.recurringBeforeTax}</span>
                                                <span class="cycle">{$service.billingCycle}</span>
                                            </div>

                                            {* Actions *}
                                            <div class="wdes-phox-view-cart_item_actions">
                                                <button type="button" class="btn-remove-from-cart"
                                                    onclick="removeItem('r','{$num}','domain')">
                                                    <i class="fad fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    {/foreach}

                                    {foreach $renewalsByType['addons'] as $num => $service}
                                        <div class="wdes-phox-view-cart_item">
                                            {* Title *}
                                            <div class="wdes-phox-view-cart_item_title">
                                                <div class="wdes-phox-view-cart_item_title_block">
                                                    <b>{lang key='renewServiceAddon.titleAltSingular'}</b> -
                                                    <span>{$service.name}</span>
                                                    <a href="{$service.domainName}">{$service.domainName}</a>
                                                </div>
                                            </div>

                                            {* Pricing *}
                                            <div class="wdes-phox-view-cart_item_pricing">
                                                <span>{$service.recurringBeforeTax}</span>
                                                <span class="cycle">{$service.billingCycle}</span>
                                            </div>

                                            {* Actions *}
                                            <div class="wdes-phox-view-cart_item_actions">
                                                <button type="button" class="btn-remove-from-cart"
                                                    onclick="removeItem('r','{$num}','addon')">
                                                    <i class="fad fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    {/foreach}

                                    {foreach $renewalsByType['domains'] as $num => $domain}
                                        <div class="wdes-phox-view-cart_item">
                                            {* Title *}
                                            <div class="wdes-phox-view-cart_item_title">
                                                <div class="wdes-phox-view-cart_item_title_block">
                                                    <b>{$LANG.domainrenewal}</b>
                                                </div>
                                                <a href="{$domain.domain}">{$domain.domain}</a>
                                                <div class="wdes-phox-view-cart_item_list">
                                                    <ul>
                                                        {if $domain.dnsmanagement}<li>{$LANG.domaindnsmanagement}</li>{/if}
                                                        {if $domain.emailforwarding}<li>{$LANG.domainemailforwarding}</li>{/if}
                                                        {if $domain.idprotection}<li>{$LANG.domainidprotection}</li>{/if}
                                                    </ul>
                                                </div>
                                            </div>

                                            {* Pricing *}
                                            <div class="wdes-phox-view-cart_item_pricing">
                                                <span>{$domain.price}</span>
                                                <span class="cycle">{$domain.regperiod} {$LANG.orderyears}</span>
                                            </div>

                                            {* Actions *}
                                            <div class="wdes-phox-view-cart_item_actions">
                                                <button type="button" class="btn-remove-from-cart"
                                                    onclick="removeItem('r','{$num}')">
                                                    <i class="fad fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                    {/foreach}

                                    {foreach $upgrades as $num => $upgrade}
                                        <div class="wdes-phox-view-cart_item">
                                            {* Title *}
                                            <div class="wdes-phox-view-cart_item_title">
                                                <div class="wdes-phox-view-cart_item_title_block">
                                                    <b>{$LANG.upgrade}</b>
                                                </div>
                                                <div class="item-group">
                                                    {if $upgrade->type == 'service'}
                                                        {$upgrade->originalProduct->productGroup->name}<br>{$upgrade->originalProduct->name}
                                                        => {$upgrade->newProduct->name}
                                                    {elseif $upgrade->type == 'addon'}
                                                        {$upgrade->originalAddon->name} => {$upgrade->newAddon->name}
                                                    {/if}
                                                </div>
                                                {if $upgrade->type == 'service'}
                                                    <a href="{$upgrade->service->domain}">{$upgrade->service->domain}</a>
                                                {/if}
                                                <div class="wdes-phox-view-cart_item_qty">
                                                    {if $showUpgradeQtyOptions}
                                                        <div class="item-qty">
                                                            {if $upgrade->allowMultipleQuantities}
                                                                <span
                                                                    class="wdes-phox-view-cart_item_qty_heading">{$LANG.orderForm.qty}</span>
                                                                <input type="number" name="upgradeqty[{$num}]" value="{$upgrade->qty}"
                                                                    class="form-control text-center" min="{$upgrade->minimumQuantity}" />
                                                                <button type="submit">
                                                                    {$LANG.orderForm.update}
                                                                </button>
                                                            {/if}
                                                        </div>
                                                    {/if}
                                                </div>
                                            </div>

                                            {* Pricing *}
                                            <div class="wdes-phox-view-cart_item_pricing">
                                                <span>{$upgrade->newRecurringAmount}</span>
                                                <span class="cycle">{$upgrade->localisedNewCycle}</span>
                                            </div>

                                            {* Actions *}
                                            <div class="wdes-phox-view-cart_item_actions">
                                                <button type="button" class="btn-remove-from-cart"
                                                    onclick="removeItem('u','{$num}')">
                                                    <i class="fad fa-times"></i>
                                                </button>
                                            </div>
                                        </div>
                                        {if $upgrade->totalDaysInCycle > 0}
                                            <div class="wdes-phox-view-cart_item">
                                                {* Title *}
                                                <div class="wdes-phox-view-cart_item_title">
                                                    <div class="wdes-phox-view-cart_item_title_block">
                                                        <b>{$LANG.upgradeCredit}</b> -
                                                        <span>{lang key="upgradeCreditDescription" daysRemaining=$upgrade->daysRemaining totalDays=$upgrade->totalDaysInCycle}</span>
                                                    </div>
                                                </div>

                                                {* Pricing *}
                                                <div class="wdes-phox-view-cart_item_pricing">
                                                    <span>-{$upgrade->creditAmount}</span>
                                                </div>
                                            </div>
                                        {/if}

                                    {/foreach}

                                    {if $cartitems == 0}
                                        <div class="view-cart-empty">
                                            {$LANG.cartempty}
                                        </div>
                                    {/if}

                                </div>

                                {if $cartitems > 0}
                                    <div class="empty-cart">
                                        <button type="button" class="btn btn-link btn-default btn-xs" id="btnEmptyCart">
                                            <i class="fas fa-trash-alt"></i>
                                            <span>{$LANG.emptycart}</span>
                                        </button>
                                    </div>
                                {/if}

                            </form>
                        </div>

                        {foreach $hookOutput as $output}
                            <div class="wdes-phox-hooks-output">
                                {$output}
                            </div>
                        {/foreach}

                        {foreach $gatewaysoutput as $gatewayoutput}
                            <div class="view-cart-gateway-checkout">
                                {$gatewayoutput}
                            </div>
                        {/foreach}

                        {* Promo Code *}
                        <div class="section">
                            <div class="section-header">
                                <h3 class="section-title">{$LANG.orderForm.applyPromoCode}</h3>
                            </div>
                            <div class="section-body">
                                <div class="panel">
                                    <div class="panel-body panel-form">
                                        {if $promotioncode}
                                            <div class="view-cart-promotion-code">
                                                <b class="main-color">{$promotioncode}</b> - {$promotiondescription}
                                            </div>
                                            <div class="text-center mt-2">
                                                <a href="{$WEB_ROOT}/cart.php?a=removepromo" class="btn btn-default btn-xs">
                                                    {$LANG.orderForm.removePromotionCode}
                                                </a>
                                            </div>
                                        {else}
                                            <form method="post" action="{$WEB_ROOT}/cart.php?a=view">
                                                <div class="wdes-phox-form-wrapper">
                                                    <input type="text" name="promocode" id="inputPromotionCode"
                                                        class="field form-control"
                                                        placeholder="{lang key="orderPromoCodePlaceholder"}" required="required">
                                                    <button type="submit" name="validatepromo" class="btn btn-primary"
                                                        value="{$LANG.orderpromovalidatebutton}">
                                                        {$LANG.orderpromovalidatebutton}
                                                    </button>
                                                </div>
                                            </form>
                                        {/if}
                                    </div>
                                </div>
                            </div>
                        </div>

                        {* Taxes *}
                        {if $taxenabled && !$loggedin}
                            <div class="section">
                                <div class="section-header">
                                    <h3 class="section-title">{$LANG.orderForm.estimateTaxes}</h3>
                                </div>
                                <div class="section-body">
                                    <div class="panel">
                                        <div class="panel-body panel-form">
                                            <form method="post" action="{$WEB_ROOT}/cart.php?a=setstateandcountry">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="inputState" class="control-label">{$LANG.orderForm.state}</label>
                                                            <input type="text" name="state" id="inputState"
                                                                value="{$clientsdetails.state}" class="form-control" {if $loggedin}
                                                                disabled="disabled" {/if} />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="inputCountry" class="control-label">{$LANG.orderForm.country}</label>
                                                            <select name="country" id="inputCountry" class="form-control">
                                                                {foreach $countries as $countrycode => $countrylabel}
                                                                    <option value="{$countrycode}"
                                                                        {if (!$country && $countrycode == $defaultcountry) || $countrycode eq $country}
                                                                        selected{/if}>
                                                                        {$countrylabel}
                                                                    </option>
                                                                {/foreach}
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group text-center">
                                                    <button type="submit" class="btn btn-default">
                                                        {$LANG.orderForm.updateTotals}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        {/if}

                    </div>
                    <div class="secondary-cart-sidebar" id="scrollingPanelContainer">

                        <div class="order-summary" id="orderSummary">
                            <div class="loader w-hidden" id="orderSummaryLoader">
                                <i class="fas fa-fw fa-sync fa-spin"></i>
                            </div>
                            <h2 class="font-size-30">{$LANG.ordersummary}</h2>
                            <div class="summary-container">

                                <div class="subtotal clearfix">
                                    <span class="pull-left float-left">{$LANG.ordersubtotal}</span>
                                    <span id="subtotal" class="pull-right float-right">{$subtotal}</span>
                                </div>
                                {if $promotioncode || $taxrate || $taxrate2}
                                    <div class="bordered-totals">
                                        {if $promotioncode}
                                            <div class="clearfix">
                                                <span class="pull-left float-left">{$promotiondescription}</span>
                                                <span id="discount" class="pull-right float-right">{$discount}</span>
                                            </div>
                                        {/if}
                                        {if $taxrate}
                                            <div class="clearfix">
                                                <span class="pull-left float-left">{$taxname} @ {$taxrate}%</span>
                                                <span id="taxTotal1" class="pull-right float-right">{$taxtotal}</span>
                                            </div>
                                        {/if}
                                        {if $taxrate2}
                                            <div class="clearfix">
                                                <span class="pull-left float-left">{$taxname2} @ {$taxrate2}%</span>
                                                <span id="taxTotal2" class="pull-right float-right">{$taxtotal2}</span>
                                            </div>
                                        {/if}
                                    </div>
                                {/if}
                                <div class="recurring-totals clearfix">
                                    <span class="pull-left float-left">{$LANG.orderForm.totals}</span>
                                    <span id="recurring" class="pull-right float-right recurring-charges">
                                        <span id="recurringMonthly" {if !$totalrecurringmonthly}style="display:none;" {/if}>
                                            <span class="cost">{$totalrecurringmonthly}</span>
                                            {$LANG.orderpaymenttermmonthly}<br />
                                        </span>
                                        <span id="recurringQuarterly" {if !$totalrecurringquarterly}style="display:none;"
                                            {/if}>
                                            <span class="cost">{$totalrecurringquarterly}</span>
                                            {$LANG.orderpaymenttermquarterly}<br />
                                        </span>
                                        <span id="recurringSemiAnnually"
                                            {if !$totalrecurringsemiannually}style="display:none;" {/if}>
                                            <span class="cost">{$totalrecurringsemiannually}</span>
                                            {$LANG.orderpaymenttermsemiannually}<br />
                                        </span>
                                        <span id="recurringAnnually" {if !$totalrecurringannually}style="display:none;"
                                            {/if}>
                                            <span class="cost">{$totalrecurringannually}</span>
                                            {$LANG.orderpaymenttermannually}<br />
                                        </span>
                                        <span id="recurringBiennially" {if !$totalrecurringbiennially}style="display:none;"
                                            {/if}>
                                            <span class="cost">{$totalrecurringbiennially}</span>
                                            {$LANG.orderpaymenttermbiennially}<br />
                                        </span>
                                        <span id="recurringTriennially"
                                            {if !$totalrecurringtriennially}style="display:none;" {/if}>
                                            <span class="cost">{$totalrecurringtriennially}</span>
                                            {$LANG.orderpaymenttermtriennially}<br />
                                        </span>
                                    </span>
                                </div>

                                <div class="total-due-today total-due-today-padded">
                                    <span id="totalDueToday" class="amt">{$total}</span>
                                    <span>{$LANG.ordertotalduetoday}</span>
                                </div>

                                <div class="express-checkout-buttons">
                                    {foreach $expressCheckoutButtons as $checkoutButton}
                                        {$checkoutButton}
                                        <div class="separator">
                                            - {$LANG.or|strtoupper} -
                                        </div>
                                    {/foreach}
                                </div>

                                <div class="text-right">
                                    <a href="{$WEB_ROOT}/cart.php?a=checkout&e=false"
                                        class="wdes-phox-cart_btn btn-checkout{if $cartitems == 0} disabled{/if}"
                                        id="checkout">
                                        {$LANG.orderForm.checkout}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form method="post" action="{$WEB_ROOT}/cart.php">
            <input type="hidden" name="a" value="remove" />
            <input type="hidden" name="r" value="" id="inputRemoveItemType" />
            <input type="hidden" name="i" value="" id="inputRemoveItemRef" />
            <input type="hidden" name="rt" value="" id="inputRemoveItemRenewalType">
            <div class="modal fade modal-remove-item" id="modalRemoveItem" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="float-right">
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="{lang key='orderForm.close'}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <h4 class="modal-title margin-bottom mb-3">
                                <i class="fas fa-times fa-3x"></i>
                                <span>{lang key='orderForm.removeItem'}</span>
                            </h4>
                            {lang key='cartremoveitemconfirm'}
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{lang key='no'}</button>
                            <button type="submit" class="btn btn-primary">{lang key='yes'}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <form method="post" action="{$WEB_ROOT}/cart.php">
            <input type="hidden" name="a" value="empty" />
            <div class="modal fade modal-remove-item" id="modalEmptyCart" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="float-right">
                                <button type="button" class="close" data-dismiss="modal"
                                    aria-label="{$LANG.orderForm.close}">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <h4 class="modal-title margin-bottom mb-3">
                                <i class="fas fa-trash-alt fa-3x"></i>
                                <span>{$LANG.emptycart}</span>
                            </h4>
                            {$LANG.cartemptyconfirm}
                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="button" class="btn btn-default" data-dismiss="modal">{$LANG.no}</button>
                            <button type="submit" class="btn btn-primary">{$LANG.yes}</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {include file="{$Phox['pages']['orderformPath']}/recommendations-modal.tpl"}
{/if}