{include file="{$Phox['pages']['orderformPath']}/common.tpl"}

<script>
    var _localLang = {
        'addToCart': '{$LANG.orderForm.addToCart|escape}',
        'addedToCartRemove': '{$LANG.orderForm.addedToCartRemove|escape}'
    }
</script>

<div id="order-phox">

    <div class="header-lined">
        <h1>{$LANG.orderconfigure}</h1>
        <small>{$LANG.orderForm.configureDesiredOptions}</small>
    </div>

    <div class="row">

        <div class="cart-body cart-body--full-width">

            {include file="{$Phox['pages']['orderformPath']}/sidebar-categories-collapsed.tpl"}

            <form id="frmConfigureProduct">
                <input type="hidden" name="configure" value="true" />
                <input type="hidden" name="i" value="{$i}" />

                <div class="row">
                    <div class="secondary-cart-body">

                        <div class="section section--product-info">
                            <div class="section-body">
                                <div class="panel panel-default panel-form">
                                    <div class="panel-body">
                                        <h2 class="section--product-info_title mt-0">{$productinfo.name}</h2>
                                        <div class="section--product-info_description">{$productinfo.description}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-danger w-hidden" role="alert" id="containerProductValidationErrors">
                            <p>{$LANG.orderForm.correctErrors}:</p>
                            <ul id="containerProductValidationErrorsList"></ul>
                        </div>

                        {if $pricing.type eq "recurring"}
                            {assign var='recurringCount' value=0} 
                            {foreach item=cl from=$pricing.cycles name=foo}
                                {assign var='recurringCount' value=$recurringCount + 1} 
                            {/foreach}
                            {if $pricing.monthly}
                                {assign var='mincycle' value="monthly"}
                                {assign var='minimalprice' value=$pricing.rawpricing.monthly}
                            {elseif $pricing.quarterly}
                                {assign var='mincycle' value="quarterly"}
                                {math assign="minimalprice" equation="y/3" y=$pricing.rawpricing.quarterly}
                            {elseif $pricing.semiannually}
                                {assign var='mincycle' value="semiannually"}
                                {math assign="minimalprice" equation="y/6" y=$pricing.rawpricing.semiannually} 
                            {elseif $pricing.annually}
                                {assign var='mincycle' value="annually"}
                                {math assign="minimalprice" equation="y/12" y=$pricing.rawpricing.annually} 
                            {elseif $pricing.biennially}
                                {assign var='mincycle' value="biennially"}
                                {math assign="minimalprice" equation="y/24" y=$pricing.rawpricing.biennially} 
                            {elseif $pricing.triennially}    
                                {assign var='mincycle' value="triennially"}
                                {math assign="minimalprice" equation="y/36" y=$pricing.rawpricing.triennially} 
                            {/if}
                            {if isset($WHMCSCurrency.format) && $WHMCSCurrency.format == 4}
                                {$minimalprice = $minimalprice|string_format:"%.0f"} 
                            {/if}
                            {if $minimalprice != "0.00" && $minimalprice != "0,00"}
                                {if $pricing.quarterly}
                                    {math assign="check_discount_quarterly" equation="100-((y/(x*3))*100)" x=$minimalprice y=$pricing.rawpricing.quarterly format="%.0f"}
                                {else}
                                    {assign var='check_discount_quarterly' value="0"}
                                {/if}
                                {if $pricing.semiannually}
                                    {math assign="check_discount_semiannually" equation="100-((y/(x*6))*100)" x=$minimalprice y=$pricing.rawpricing.semiannually format="%.0f"}
                                {else}
                                    {assign var='check_discount_semiannually' value="0"}
                                {/if}
                                {if $pricing.annually}
                                    {math assign="check_discount_annually" equation="100-((y/(x*12))*100)" x=$minimalprice y=$pricing.rawpricing.annually format="%.0f"}
                                {else}
                                    {assign var='check_discount_annually' value="0"}
                                {/if}
                                {if $pricing.biennially}
                                    {math assign="check_discount_biennially" equation="100-((y/(x*24))*100)" x=$minimalprice y=$pricing.rawpricing.biennially format="%.0f"}
                                {else}
                                    {assign var='check_discount_biennially' value="0"}    
                                {/if}
                                {if $pricing.triennially}
                                    {math assign="check_discount_triennially" equation="100-((y/(x*36))*100)" x=$minimalprice y=$pricing.rawpricing.triennially format="%.0f"}
                                {else}
                                    {assign var='check_discount_triennially' value="0"}      
                                {/if}
                                {if $check_discount_quarterly > 0 || $check_discount_semiannually > 0 || $check_discount_annually > 0 || $check_discount_biennially > 0 || $check_discount_triennially > 0}
                                    {assign var="show_discount" value=true}
                                {/if}  
                            {/if} 
                            <div class="section">
                                <div class="section-header">
                                    <h2 class="section-title">{$LANG.cartchoosecycle}</h2>
                                </div>
                                <div class="section-body">
                                    <div class="form-group form-group-billingcycle-wrapper">
                                        {if $pricing.monthly}
                                            <div class="form-check">
                                                <label class="form-check-label" for="billingcycleMonthly">
                                                    <input class="form-check-input" type="radio" name="billingcycle" id="billingcycleMonthly" value="monthly" {if $billingcycle eq "monthly"} checked{/if} onchange="updateConfigurableOptions({$i}, this.value); return false">
                                                    <div class="content-radio-item">
                                                        {$monthlyArrayLang = ["arabic", "turkish"]}                                                    
                                                        {if $pricing.monthly|strstr:$LANG.orderpaymentterm1month && (!$pricing.monthly|strstr:$LANG.orderpaymenttermmonthly || $language|in_array:$monthlyArrayLang)}                                                  
                                                            <h6>{$LANG.orderpaymenttermmonthly}</h6>
                                                            <h5>
                                                                {if $pricing.monthly|strstr:$LANG.orderfreedomainonly}{$freeDomainMonthly = true}{/if}           
                                                                {$pricing.monthly|replace:$LANG.orderpaymentterm1month:""|replace:"-":""|replace:" (`$LANG.orderfreedomainonly`)":""|replace:$WHMCSCurrency.suffix:" `$WHMCSCurrency.suffix`"}/{$LANG.pricingCycleShort.monthly}{if $freeDomainMonthly} ({$LANG.orderfreedomainonly}){/if}
                                                            </h5>
                                                        {else}
                                                            <h6>{$LANG.orderpaymenttermmonthly}</h6>
                                                            <h5>
                                                                {if $pricing.monthly|strstr:$LANG.orderfreedomainonly}{$freeDomainMonthly = true}{/if}
                                                                {$pricing.monthly|replace:$LANG.orderpaymenttermmonthly:""|replace:$WHMCSCurrency.suffix:" `$WHMCSCurrency.suffix`"|replace:" (`$LANG.orderfreedomainonly`)":""}{if $freeDomainMonthly} ({$LANG.orderfreedomainonly}){/if}  
                                                            </h5>
                                                        {/if}
                                                    </div>
                                                </label>
                                            </div>
                                        {/if}

                                        {if $pricing.quarterly}
                                            <div class="form-check">
                                                <label class="form-check-label" for="billingcycleQuarterly">
                                                    <input class="form-check-input" type="radio" name="billingcycle" id="billingcycleQuarterly" value="quarterly" {if $billingcycle eq "quarterly"} checked{/if} onchange="updateConfigurableOptions({$i}, this.value); return false">
                                                    <div class="content-radio-item">
                                                        {if $pricing.quarterly|strstr:$LANG.orderpaymentterm3month}
                                                            <h6>{$LANG.orderpaymenttermquarterly}</h6>
                                                            <h5>
                                                                {if $pricing.quarterly|strstr:$LANG.orderfreedomainonly}{$freeDomainQuarterly = true}{/if}
                                                                {if $display_billing_monthly_price == "on" && $pricing.rawpricing.qsetupfee != "0.00" && $pricing.rawpricing.qsetupfee != "0,00"}
                                                                    {$pricing.quarterly|replace:$LANG.orderpaymentterm3month:""|replace:"-":""|replace:" (`$LANG.orderfreedomainonly`)":""|replace:$WHMCSCurrency.suffix:" `$WHMCSCurrency.suffix`"|replace:" +":"/`$LANG.pricingCycleShort.monthly` +"}{if $freeDomainQuarterly}
                                                                    ({$LANG.orderfreedomainonly}){/if}
                                                                {else}
                                                                    {$pricing.quarterly|replace:$LANG.orderpaymentterm3month:""|replace:"-":""|replace:" (`$LANG.orderfreedomainonly`)":""|replace:$WHMCSCurrency.suffix:" `$WHMCSCurrency.suffix`"}{if $display_billing_monthly_price == "on"}/{$LANG.pricingCycleShort.monthly}{/if}{if $freeDomainQuarterly}
                                                                ({$LANG.orderfreedomainonly}){/if}
                                                                {/if}
                                                            </h5>
                                                        {else}
                                                            <h6>{$LANG.orderpaymenttermquarterly}</h6>
                                                            <h5>
                                                                {if $pricing.quarterly|strstr:$LANG.orderfreedomainonly}{$freeDomainQuarterly = true}{/if}
                                                                {$pricing.quarterly|replace:$LANG.orderpaymenttermquarterly:""|replace:$WHMCSCurrency.suffix:" `$WHMCSCurrency.suffix`"|replace:" (`$LANG.orderfreedomainonly`)":""}{if $freeDomainQuarterly} ({$LANG.orderfreedomainonly}){/if}  
                                                            </h5>
                                                        {/if}
    
                                                        {if $mincycle eq "quarterly"}
                                                            <p> - </p>
                                                        {else}
                                                            {if $minimalprice != "0.00" && $minimalprice != "0,00"}
                                                                {math assign="price_save" equation="100-((y/(x*3))*100)" x=$minimalprice y=$pricing.rawpricing.quarterly format="%.0f"}
                                                            {/if}
                                                            {if $price_save > 0}
                                                                <p class="discount">
                                                                    <span class="label discount-percent">
                                                                        Save {$price_save}%
                                                                    </span>
                                                                    {math assign="cycle_full_price" equation="x*3" x=$minimalprice format="%.2f"}
                                                                    <del>
                                                                        {if $display_billing_monthly_price == "on"}{formatCurrency($minimalprice)}{else}{formatCurrency($cycle_full_price)}{/if}
                                                                    </del>
                                                                </p>
                                                            {/if}
                                                        {/if}
                                                    </div>
                                                </label>
                                            </div>
                                        {/if}

                                        {if $pricing.semiannually}
                                            <div class="form-check">
                                                <label class="form-check-label" for="billingcycleSemiannually">
                                                    <input class="form-check-input" type="radio" name="billingcycle" id="billingcycleSemiannually" value="semiannually" {if $billingcycle eq "semiannually"} checked{/if} onchange="updateConfigurableOptions({$i}, this.value); return false">
                                                    <div class="content-radio-item">
                                                        {if $pricing.semiannually|strstr:$LANG.orderpaymentterm6month}
                                                            <h6>{$LANG.orderpaymenttermsemiannually}</h6>
                                                            <h5>
                                                                {if $display_billing_monthly_price == "on" && $pricing.rawpricing.ssetupfee != "0.00" && $pricing.rawpricing.ssetupfee != "0,00"}
                                                                    {$pricing.semiannually|replace:$LANG.orderpaymentterm6month:""|replace:"-":""|replace:" (`$LANG.orderfreedomainonly`)":""|replace:$WHMCSCurrency.suffix:" `$WHMCSCurrency.suffix`"|replace:" +":"/`$LANG.pricingCycleShort.monthly` +"}{if $freeDomainSemiannually}
                                                                    ({$LANG.orderfreedomainonly}){/if}
                                                                {else}
                                                                    {$pricing.semiannually|replace:$LANG.orderpaymentterm6month:""|replace:"-":""|replace:" (`$LANG.orderfreedomainonly`)":""|replace:$WHMCSCurrency.suffix:" `$WHMCSCurrency.suffix`"}{if $display_billing_monthly_price == "on"}/{$LANG.pricingCycleShort.monthly}{/if}{if $freeDomainSemiannually}
                                                                ({$LANG.orderfreedomainonly}){/if}
                                                                {/if}
                                                            </h5>
                                                        {else}
                                                            <h6>{$LANG.orderpaymenttermsemiannually}</h6>
                                                            <h5>
                                                                {if $pricing.semiannually|strstr:$LANG.orderfreedomainonly}{$freeDomainSemiannually = true}{/if}
                                                                {$pricing.semiannually|replace:$LANG.orderpaymenttermsemiannually:""|replace:$WHMCSCurrency.suffix:" `$WHMCSCurrency.suffix`"|replace:" (`$LANG.orderfreedomainonly`)":""}{if $freeDomainSemiannually} ({$LANG.orderfreedomainonly}){/if}  
                                                            </h5>
                                                        {/if}
                                                    
                                                        {if $mincycle eq "semiannually"}
                                                            <p> - </p>
                                                        {else}
                                                            {if $minimalprice != "0.00" && $minimalprice != "0,00"}     
                                                                {math assign="price_save" equation="100-((y/(x*6))*100)" x=$minimalprice y=$pricing.rawpricing.semiannually format="%.0f"}
                                                            {/if}
                                                            {if $price_save > 0}
                                                                <p class="discount">
                                                                    <span class="label discount-percent">
                                                                        Save {$price_save}%
                                                                    </span>
                                                                    {math assign="cycle_full_price" equation="x*6" x=$minimalprice format="%.2f"}
                                                                    <del>{if $display_billing_monthly_price == "on"}{formatCurrency($minimalprice)}{else}{formatCurrency($cycle_full_price)}{/if}</del>
                                                                </p>
                                                            {/if}
                                                        {/if}
                                                    </div>
                                                </label>
                                            </div>
                                        {/if}

                                        {if $pricing.annually}
                                            <div class="form-check">
                                                <label class="form-check-label" for="billingcycleAnnually">
                                                    <input class="form-check-input" type="radio" name="billingcycle" id="billingcycleAnnually" value="annually" {if $billingcycle eq "annually"} checked{/if} onchange="updateConfigurableOptions({$i}, this.value); return false">
                                                    <div class="content-radio-item">
                                                        {if $pricing.annually|strstr:$LANG.orderpaymentterm12month}
                                                            <h6>{$LANG.orderpaymenttermannually}</h6>
                                                            <h5>
                                                                {if $display_billing_monthly_price == "on" && $pricing.rawpricing.asetupfee != "0.00" && $pricing.rawpricing.asetupfee != "0,00"}
                                                                {$pricing.annually|replace:$LANG.orderpaymentterm12month:""|replace:"-":""|replace:" (`$LANG.orderfreedomainonly`)":""|replace:$WHMCSCurrency.suffix:" `$WHMCSCurrency.suffix`"|replace:" +":"/`$LANG.pricingCycleShort.monthly` +"}{if $freeDomainAnnually} ({$LANG.orderfreedomainonly}){/if}
                                                                {else}
                                                                {$pricing.annually|replace:$LANG.orderpaymentterm12month:""|replace:"-":""|replace:" (`$LANG.orderfreedomainonly`)":""|replace:$WHMCSCurrency.suffix:" `$WHMCSCurrency.suffix`"}{if $display_billing_monthly_price == "on"}/{$LANG.pricingCycleShort.monthly}{/if}{if $freeDomainAnnually} ({$LANG.orderfreedomainonly}){/if}
                                                                {/if} 
                                                            </h5>
                                                        {else}
                                                            <h6>{$LANG.orderpaymenttermannually}</h6>
                                                            <h5>
                                                                {if $pricing.cycles.annually|strstr:$LANG.orderfreedomainonly}{$freeDomainAnnually = true}{/if}
                                                                {$pricing.annually|replace:$LANG.orderpaymenttermannually:""|replace:$WHMCSCurrency.suffix:" `$WHMCSCurrency.suffix`"|replace:" (`$LANG.orderfreedomainonly`)":""}{if $freeDomainAnnually} ({$LANG.orderfreedomainonly}){/if}
                                                            </h5>
                                                        {/if}
                                                        
                                                        {if $mincycle eq "annually"}
                                                            <p> - </p>
                                                        {else}
                                                            {if $minimalprice != "0.00" && $minimalprice != "0,00"}     
                                                                {math assign="price_save" equation="100-((y/(x*12))*100)" x=$minimalprice y=$pricing.rawpricing.annually format="%.0f"}
                                                            {/if}
                                                            {if $price_save > 0}
                                                                <p class="discount"> 
                                                                    <span class="label discount-percent">
                                                                        Save {$price_save}%
                                                                    </span>
                                                                    {math assign="cycle_full_price" equation="x*12" x=$minimalprice format="%.2f"}
                                                                    <del>
                                                                        {if $display_billing_monthly_price == "on"}{formatCurrency($minimalprice)}{else}{formatCurrency($cycle_full_price)}{/if}
                                                                    </del>
                                                                </p>
                                                            {elseif $show_discount}
                                                                <p> - </p>
                                                            {/if}
                                                        {/if} 
                                                    </div>
                                                </label>
                                            </div>
                                        {/if}

                                        {if $pricing.biennially}
                                            <div class="form-check">
                                                <label class="form-check-label" for="billingcycleBiennially">
                                                    <input class="form-check-input" type="radio" name="billingcycle" id="billingcycleBiennially" value="biennially" {if $billingcycle eq "biennially"} checked{/if} onchange="updateConfigurableOptions({$i}, this.value); return false">
                                                    <div class="content-radio-item">
                                                        {if $pricing.biennially|strstr:$LANG.orderpaymentterm24month}
                                                            <h6>{$LANG.orderpaymenttermbiennially}</h6>
                                                            <h5>
                                                                {if $display_billing_monthly_price == "on" && $pricing.rawpricing.bsetupfee != "0.00" && $pricing.rawpricing.bsetupfee != "0,00"}
                                                                    {$pricing.biennially|replace:$LANG.orderpaymentterm24month:""|replace:"-":""|replace:" (`$LANG.orderfreedomainonly`)":""|replace:$WHMCSCurrency.suffix:" `$WHMCSCurrency.suffix`"|replace:" +":"/`$LANG.pricingCycleShort.monthly` +"}{if $freeDomainBiennially}
                                                                    ({$LANG.orderfreedomainonly}){/if}
                                                                {else}
                                                                    {$pricing.biennially|replace:$LANG.orderpaymentterm24month:""|replace:"-":""|replace:" (`$LANG.orderfreedomainonly`)":""|replace:$WHMCSCurrency.suffix:" `$WHMCSCurrency.suffix`"}{if $display_billing_monthly_price == "on"}/{$LANG.pricingCycleShort.monthly}{/if}{if $freeDomainBiennially}
                                                                ({$LANG.orderfreedomainonly}){/if}
                                                                {/if}
                                                            </h5>
                                                        {else}
                                                            <h6>{$LANG.orderpaymenttermbiennially}</h6>
                                                            <h5>
                                                                {if $pricing.biennially|strstr:$LANG.orderfreedomainonly}{$freeDomainBiennially = true}{/if}
                                                                {$pricing.biennially|replace:$LANG.orderpaymenttermbiennially:""|replace:$WHMCSCurrency.suffix:" `$WHMCSCurrency.suffix`"|replace:" (`$LANG.orderfreedomainonly`)":""}{if $freeDomainBiennially}
                                                                ({$LANG.orderfreedomainonly}){/if}
                                                            </h5>
                                                        {/if}

                                                        {if $mincycle eq "biennially"}
                                                            <p> - </p>
                                                        {else}
                                                            {if $minimalprice != "0.00" && $minimalprice != "0,00"}
                                                                {math assign="price_save" equation="100-((y/(x*24))*100)" x=$minimalprice y=$pricing.rawpricing.biennially format="%.0f"}
                                                            {/if}
                                                            {if $price_save > 0}
                                                                <p class="discount">
                                                                    <span class="label discount-percent">
                                                                        Save {$price_save}%
                                                                    </span>
                                                                    {math assign="cycle_full_price" equation="x*24" x=$minimalprice format="%.2f"}
                                                                    <del>
                                                                        {if $display_billing_monthly_price == "on"}{formatCurrency($minimalprice)}{else}{formatCurrency($cycle_full_price)}{/if}
                                                                    </del>
                                                                </p>
                                                            {/if}
                                                        {/if}
                                                    </div>
                                                </label>
                                            </div>
                                        {/if}
                                        {if $pricing.triennially}
                                            <div class="form-check">
                                                <label class="form-check-label" for="billingcycleTriennially">
                                                    <input class="form-check-input" type="radio" name="billingcycle" id="billingcycleTriennially" value="triennially" {if $billingcycle eq "triennially"} checked{/if} onchange="updateConfigurableOptions({$i}, this.value); return false">
                                                    <div class="content-radio-item">
                                                        {if $pricing.triennially|strstr:$LANG.orderpaymentterm36month}
                                                            <h6>{$LANG.orderpaymenttermtriennially}</h6>
                                                            <h5>
                                                                {if $display_billing_monthly_price == "on" && $pricing.rawpricing.tsetupfee != "0.00" && $pricing.rawpricing.tsetupfee != "0,00"}
                                                                    {$pricing.triennially|replace:$LANG.orderpaymentterm36month:""|replace:"-":""|replace:" (`$LANG.orderfreedomainonly`)":""|replace:$WHMCSCurrency.suffix:" `$WHMCSCurrency.suffix`"|replace:" +":"/`$LANG.pricingCycleShort.monthly` +"}{if $freeDomainTriennially} ({$LANG.orderfreedomainonly}){/if}
                                                                {else}
                                                                    {$pricing.triennially|replace:$LANG.orderpaymentterm36month:""|replace:"-":""|replace:" (`$LANG.orderfreedomainonly`)":""|replace:$WHMCSCurrency.suffix:" `$WHMCSCurrency.suffix`"}{if $display_billing_monthly_price == "on"}/{$LANG.pricingCycleShort.monthly}{/if}{if $freeDomainTriennially} ({$LANG.orderfreedomainonly}){/if}
                                                                {/if} 
                                                            </h5>
                                                        {else}
                                                            <h6>{$LANG.orderpaymenttermtriennially}</h6>
                                                            <h5>
                                                                {if $pricing.triennially|strstr:$LANG.orderfreedomainonly}{$freeDomainTriennially = true}{/if}
                                                                {$pricing.triennially|replace:$LANG.orderpaymenttermtriennially:""|replace:$WHMCSCurrency.suffix:" `$WHMCSCurrency.suffix`"|replace:" (`$LANG.orderfreedomainonly`)":""}{if $freeDomainTriennially} ({$LANG.orderfreedomainonly}){/if}    
                                                            </h5>
                                                        {/if}
            
                                                        {if $mincycle eq "triennially"}
                                                            <p> - </p>
                                                        {else}
                                                            {if $minimalprice != "0.00" && $minimalprice != "0,00"}     
                                                                {math assign="price_save" equation="100-((y/(x*36))*100)" x=$minimalprice y=$pricing.rawpricing.triennially format="%.0f"}                                                            
                                                            {/if}
                                                            {if $price_save > 0}
                                                                <p class="discount"> 
                                                                    <span class="label discount-percent">
                                                                        Save {$price_save}%
                                                                    </span>
                                                                    {math assign="cycle_full_price" equation="x*36" x=$minimalprice format="%.2f"}
                                                                    <del>
                                                                        {if $display_billing_monthly_price == "on"}{formatCurrency($minimalprice)}{else}{formatCurrency($cycle_full_price)}{/if}
                                                                    </del>
                                                                </p>
                                                            {/if}
                                                        {/if} 
                                                    </div>
                                                </label>
                                            </div>
                                        {/if}
                                    </div>
                                </div>
                            </div>
                        {/if}

                        {if count($metrics) > 0}
                            <div class="sub-heading">
                                <span class="primary-bg-color">{$LANG.metrics.title}</span>
                            </div>

                            <p>{$LANG.metrics.explanation}</p>

                            <ul>
                                {foreach $metrics as $metric}
                                    <li>
                                        {$metric.displayName}
                                        -
                                        {if count($metric.pricing) > 1}
                                            {$LANG.metrics.startingFrom} {$metric.lowestPrice} /
                                            {if $metric.unitName}{$metric.unitName}{else}{$LANG.metrics.unit}{/if}
                                            <button type="button" class="btn btn-default btn-sm" data-toggle="modal"
                                                data-target="#modalMetricPricing-{$metric.systemName}">
                                                {$LANG.metrics.viewPricing}
                                            </button>
                                        {elseif count($metric.pricing) == 1}
                                            {$metric.lowestPrice} /
                                            {if $metric.unitName}{$metric.unitName}{else}{$LANG.metrics.unit}{/if}
                                            {if $metric.includedQuantity > 0} ({$metric.includedQuantity}
                                            {$LANG.metrics.includedNotCounted}){/if}
                                        {/if}
                                        {include file="$template/usagebillingpricing.tpl"}
                                    </li>
                                {/foreach}
                            </ul>

                            <br>
                        {/if}

                        {if $productinfo.type eq "server"}
                            <div class="sub-heading">
                                <span class="primary-bg-color">{$LANG.cartconfigserver}</span>
                            </div>

                            <div class="field-container">

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputHostname">{$LANG.serverhostname}</label>
                                            <input type="text" name="hostname" class="form-control" id="inputHostname"
                                                value="{$server.hostname}" placeholder="servername.example.com">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputRootpw">{$LANG.serverrootpw}</label>
                                            <input type="password" name="rootpw" class="form-control" id="inputRootpw"
                                                value="{$server.rootpw}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputNs1prefix">{$LANG.serverns1prefix}</label>
                                            <input type="text" name="ns1prefix" class="form-control" id="inputNs1prefix"
                                                value="{$server.ns1prefix}" placeholder="ns1">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="inputNs2prefix">{$LANG.serverns2prefix}</label>
                                            <input type="text" name="ns2prefix" class="form-control" id="inputNs2prefix"
                                                value="{$server.ns2prefix}" placeholder="ns2">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        {/if}

                        {if $configurableoptions}
                            <div class="mb-4">
                                <h4 class="wdes-phox-addons-heading"> {$LANG.orderconfigpackage}</h4>
                                <div class="product-configurable-options" id="productConfigurableOptions">
                                    <div class="row">
                                        {foreach $configurableoptions as $num => $configoption}
                                            {if $configoption.optiontype eq 1}
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label
                                                            for="inputConfigOption{$configoption.id}">{$configoption.optionname}</label>
                                                        <select name="configoption[{$configoption.id}]"
                                                            id="inputConfigOption{$configoption.id}" class="form-control">
                                                            {foreach key=num2 item=options from=$configoption.options}
                                                                <option value="{$options.id}"
                                                                    {if $configoption.selectedvalue eq $options.id} selected="selected"
                                                                    {/if}>
                                                                    {$options.name}
                                                                </option>
                                                            {/foreach}
                                                        </select>
                                                    </div>
                                                </div>
                                            {elseif $configoption.optiontype eq 2}
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label
                                                            for="inputConfigOption{$configoption.id}">{$configoption.optionname}</label>
                                                        {foreach key=num2 item=options from=$configoption.options}
                                                            <br />
                                                            <label>
                                                                <input type="radio" name="configoption[{$configoption.id}]"
                                                                    value="{$options.id}"
                                                                    {if $configoption.selectedvalue eq $options.id} checked="checked"
                                                                    {/if} />
                                                                {if $options.name}
                                                                    {$options.name}
                                                                {else}
                                                                    {$LANG.enable}
                                                                {/if}
                                                            </label>
                                                        {/foreach}
                                                    </div>
                                                </div>
                                            {elseif $configoption.optiontype eq 3}
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label
                                                            for="inputConfigOption{$configoption.id}">{$configoption.optionname}</label>
                                                        <br />
                                                        <label>
                                                            <input type="checkbox" name="configoption[{$configoption.id}]"
                                                                id="inputConfigOption{$configoption.id}" value="1"
                                                                {if $configoption.selectedqty} checked{/if} />
                                                            {if $configoption.options.0.name}
                                                                {$configoption.options.0.name}
                                                            {else}
                                                                {$LANG.enable}
                                                            {/if}
                                                        </label>
                                                    </div>
                                                </div>
                                            {elseif $configoption.optiontype eq 4}
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label
                                                            for="inputConfigOption{$configoption.id}">{$configoption.optionname}</label>
                                                        {if $configoption.qtymaximum}
                                                            {if !$rangesliderincluded}
                                                                <script type="text/javascript" src="{$BASE_PATH_JS}/ion.rangeSlider.min.js">
                                                                </script>
                                                                <link href="{$BASE_PATH_CSS}/ion.rangeSlider.css" rel="stylesheet">
                                                                <link href="{$BASE_PATH_CSS}/ion.rangeSlider.skinModern.css"
                                                                    rel="stylesheet">
                                                                {assign var='rangesliderincluded' value=true}
                                                            {/if}
                                                            <input type="text" name="configoption[{$configoption.id}]"
                                                                value="{if $configoption.selectedqty}{$configoption.selectedqty}{else}{$configoption.qtyminimum}{/if}"
                                                                id="inputConfigOption{$configoption.id}" class="form-control" />
                                                            <script>
                                                                var sliderTimeoutId = null;
                                                                var sliderRangeDifference = {$configoption.qtymaximum} - {$configoption.qtyminimum};
                                                                // The largest size that looks nice on most screens.
                                                                var sliderStepThreshold = 25;
                                                                // Check if there are too many to display individually.
                                                                var setLargerMarkers = sliderRangeDifference > sliderStepThreshold;

                                                                jQuery("#inputConfigOption{$configoption.id}").ionRangeSlider({
                                                                min: {$configoption.qtyminimum},
                                                                max: {$configoption.qtymaximum},
                                                                grid: true,
                                                                    grid_snap: setLargerMarkers ? false : true,
                                                                    onChange: function() {
                                                                        if (sliderTimeoutId) {
                                                                            clearTimeout(sliderTimeoutId);
                                                                        }

                                                                        sliderTimeoutId = setTimeout(function() {
                                                                            sliderTimeoutId = null;
                                                                            recalctotals();
                                                                        }, 250);
                                                                    }
                                                                });
                                                            </script>
                                                        {else}
                                                            <div>
                                                                <input type="number" name="configoption[{$configoption.id}]"
                                                                    value="{if $configoption.selectedqty}{$configoption.selectedqty}{else}{$configoption.qtyminimum}{/if}"
                                                                    id="inputConfigOption{$configoption.id}"
                                                                    min="{$configoption.qtyminimum}" onchange="recalctotals()"
                                                                    onkeyup="recalctotals()" class="form-control form-control-qty" />
                                                                <span class="form-control-static form-control-static-inline">
                                                                    x {$configoption.options.0.name}
                                                                </span>
                                                            </div>
                                                        {/if}
                                                    </div>
                                                </div>
                                            {/if}
                                            {if $num % 2 != 0}
                                            </div>
                                            <div class="row">
                                            {/if}
                                        {/foreach}
                                    </div>
                                </div>
                            </div>

                        {/if}

                        {if $customfields}

                            <div class="sub-heading pb-1">
                                <span
                                    class="primary-bg-color">{$LANG.orderadditionalrequiredinfo}<br><i><small>{lang key='orderForm.requiredField'}</small></i></span>
                            </div>

                            <div class="field-container">
                                {foreach $customfields as $customfield}
                                    <div class="form-group">
                                        <label for="customfield{$customfield.id}">{$customfield.name}
                                            {$customfield.required}</label>
                                        {$customfield.input}
                                        {if $customfield.description}
                                            <span class="field-help-text">
                                                {$customfield.description}
                                            </span>
                                        {/if}
                                    </div>
                                {/foreach}
                            </div>

                        {/if}

                        {if $addons || count($addonsPromoOutput) > 0}

                            <div class="section" id="productAddonsContainer">
                                <div class="section-header">
                                    <h2 class="section-title">{$LANG.cartavailableaddons}</h2>
                                </div>
                                <div class="section-body">
                                    {foreach $addonsPromoOutput as $output}{$output}{/foreach}

                                    <div class="row addon-products">
                                        {foreach $addons as $addon}
                                            <div class="col-sm-{if count($addons) > 1}6{else}12{/if}">
                                                <div
                                                    class="panel card panel-default panel-addon{if $addon.status} panel-addon-selected{/if}">
                                                    <div class="panel-body card-body">
                                                        <label>
                                                            <input type="checkbox" name="addons[{$addon.id}]" {if $addon.status}
                                                                checked{/if} />
                                                            {$addon.name}
                                                        </label><br />
                                                        {$addon.description}
                                                    </div>
                                                    <div class="panel-price">
                                                        {$addon.pricing}
                                                    </div>
                                                </div>
                                            </div>
                                        {/foreach}
                                    </div>
                                </div>
                            </div>
                        {/if}

                        <div class="alert alert-warning info-text-sm">
                            <i class="fas fa-question-circle"></i>
                            {$LANG.orderForm.haveQuestionsContact} <a href="{$WEB_ROOT}/contact.php" target="_blank"
                                class="alert-link">{$LANG.orderForm.haveQuestionsClickHere}</a>
                        </div>

                    </div>
                    <div class="secondary-cart-sidebar" id="scrollingPanelContainer">

                        <div id="orderSummary">
                            <div class="order-summary">
                                <div class="loader" id="orderSummaryLoader">
                                    <i class="fas fa-fw fa-sync fa-spin"></i>
                                </div>
                                <h2 class="font-size-30">{$LANG.ordersummary}</h2>
                                <div class="summary-container" id="producttotal"></div>
                            </div>
                            <div class="text-center">
                                <button type="submit" id="btnCompleteProductConfig" class="btn btn-lg btn-primary-faded btn-add-to-cart">
                                    {$LANG.continue}
                                </button>
                            </div>
                        </div>

                    </div>

                </div>

            </form>
        </div>
    </div>
</div>

<script>
    recalctotals();
</script>
{include file="{$Phox['pages']['orderformPath']}/recommendations-modal.tpl"}