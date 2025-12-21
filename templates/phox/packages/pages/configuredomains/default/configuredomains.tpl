{include file="{$Phox['pages']['orderformPath']}/common.tpl"}

<script>
    var _localLang = {
        'addToCart': '{$LANG.orderForm.addToCart|escape}',
        'addedToCartRemove': '{$LANG.orderForm.addedToCartRemove|escape}'
    }
</script>

<div id="order-phox">

    <div class="header-lined">
        <h1 class="font-size-36">{$LANG.cartdomainsconfig}</h1>
        <small>{$LANG.orderForm.reviewDomainAndAddons}</small>
    </div>

    <div class="row">

        <div class="cart-body cart-body--full-width">

            {include file="{$Phox['pages']['orderformPath']}/sidebar-categories-collapsed.tpl"}

            <form method="post" action="{$smarty.server.PHP_SELF}?a=confdomains" id="frmConfigureDomains">
                <input type="hidden" name="update" value="true" />

                {if $errormessage}
                    <div class="alert alert-danger" role="alert">
                        <p>{$LANG.orderForm.correctErrors}:</p>
                        <ul>
                            {$errormessage}
                        </ul>
                    </div>
                {/if}

                {foreach $domains as $num => $domain}
                    <div class="section section--domain-info">
                        <div class="section-body">
                            <div class="panel panel-default panel-form">
                                <div class="panel-body">
                                    {* Title *}
                                    <div class="domain-info-wrapper">
                                        <div class="domain-info-title">
                                            <h2>{$domain.domain}</h2>
                                            {* Meta *}
                                            <ul class="domain-info-meta">
                                                <li>
                                                    {if $domain.hosting}
                                                        <span class="label label-success"><i class="fas fa-check"></i> {$LANG.cartdomainshashosting}</span>
                                                    {else}
                                                        <a href="{$WEB_ROOT}/cart.php" class="label label-danger"><i class="fas fa-times"></i> {$LANG.cartdomainsnohosting}</a>
                                                    {/if}
                                                </li>

                                                <li>{$LANG.orderregperiod}: {$domain.regperiod} {$LANG.orderyears}</li>
                                            </ul>
                                        </div>
                                    </div>

                                    {if $domain.eppenabled}
                                        <div class="form-group prepend-icon">
                                            <input type="text" name="epp[{$num}]" id="inputEppcode{$num}" value="{$domain.eppvalue}"
                                                class="field" placeholder="{$LANG.domaineppcode}" />
                                            <label for="inputEppcode{$num}" class="field-icon">
                                                <i class="fas fa-lock"></i>
                                            </label>
                                            <span class="field-help-text">
                                                {$LANG.domaineppcodedesc}
                                            </span>
                                        </div>
                                    {/if}


                                    {if $domain.dnsmanagement || $domain.emailforwarding || $domain.idprotection}
                                        <div class="row addon-products">

                                            {if $domain.dnsmanagement}
                                                <div class="col-sm-{math equation="12 / numAddons" numAddons=$domain.addonsCount}">
                                                    <div class="panel panel-default panel-addon{if $domain.dnsmanagementselected} panel-addon-selected{/if}">
                                                        <div class="panel-body">
                                                            <button type="button" class="panel-addon-info-btn" data-toggle="tooltip" data-placement="top" title="{$LANG.domainaddonsdnsmanagementinfo}">
                                                                <i class='fas fa-info-circle'></i>
                                                            </button>
                                                            <label>
                                                                <input type="checkbox" name="dnsmanagement[{$num}]" {if $domain.dnsmanagementselected} checked{/if} />
                                                                <div>
                                                                    <h4>{$LANG.domaindnsmanagement}</h4>
                                                                    <div class="price-addon">{$domain.dnsmanagementprice} / {$domain.regperiod} {$LANG.orderyears}</div>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            {/if}

                                            {if $domain.idprotection}
                                                <div class="col-sm-{math equation="12 / numAddons" numAddons=$domain.addonsCount}">
                                                    <div
                                                        class="panel panel-default panel-addon{if $domain.idprotectionselected} panel-addon-selected{/if}">
                                                        <div class="panel-body">
                                                            <button type="button" class="panel-addon-info-btn" data-toggle="tooltip" data-placement="top" title="{$LANG.domainaddonsidprotectioninfo}">
                                                                <i class='fas fa-info-circle'></i>
                                                            </button>
                                                            <label>
                                                                <input type="checkbox" name="idprotection[{$num}]" {if $domain.idprotectionselected} checked{/if} />
                                                                <div>
                                                                    <h4>{$LANG.domainidprotection}</h4>
                                                                    <div class="price-addon">{$domain.idprotectionprice} / {$domain.regperiod} {$LANG.orderyears}</div>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            {/if}

                                            {if $domain.emailforwarding}
                                                <div class="col-sm-{math equation="12 / numAddons" numAddons=$domain.addonsCount}">
                                                    <div
                                                        class="panel panel-default panel-addon{if $domain.emailforwardingselected} panel-addon-selected{/if}">
                                                        <div class="panel-body">
                                                            <button type="button" class="panel-addon-info-btn" data-toggle="tooltip" data-placement="top" title="{$LANG.domainaddonsemailforwardinginfo}">
                                                                <i class='fas fa-info-circle'></i>
                                                            </button>
                                                            <label>
                                                                <input type="checkbox" name="emailforwarding[{$num}]" {if $domain.emailforwardingselected} checked{/if} />
                                                                <div>
                                                                    <h4>{$LANG.domainemailforwarding}</h4>
                                                                    <div class="price-addon">{$domain.emailforwardingprice} / {$domain.regperiod} {$LANG.orderyears}</div>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            {/if}

                                        </div>
                                    {/if}
                                    {foreach from=$domain.fields key=domainfieldname item=domainfield}
                                        <div class="form-group row">
                                            <div class="col-sm-4 text-right">{$domainfieldname}:</div>
                                            <div class="col-sm-8">{$domainfield}</div>
                                        </div>
                                    {/foreach}
                                </div>
                            </div>
                        </div>
                    </div>
                {/foreach}

                {if $atleastonenohosting}
                    <div class="section">
                        <div class="section-header">
                            <h2 class="section-title">{$LANG.domainnameservers}</h2>
                            <p class="section-description">{$LANG.cartnameserversdesc}</p>
                        </div>
                        <div class="section-body">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="inputNs1">{$LANG.domainnameserver1}</label>
                                        <input type="text" class="form-control" id="inputNs1" name="domainns1"
                                            value="{$domainns1}" />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="inputNs2">{$LANG.domainnameserver2}</label>
                                        <input type="text" class="form-control" id="inputNs2" name="domainns2"
                                            value="{$domainns2}" />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="inputNs3">{$LANG.domainnameserver3}</label>
                                        <input type="text" class="form-control" id="inputNs3" name="domainns3"
                                            value="{$domainns3}" />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="inputNs1">{$LANG.domainnameserver4}</label>
                                        <input type="text" class="form-control" id="inputNs4" name="domainns4"
                                            value="{$domainns4}" />
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="inputNs5">{$LANG.domainnameserver5}</label>
                                        <input type="text" class="form-control" id="inputNs5" name="domainns5"
                                            value="{$domainns5}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>
                {/if}

                <div class="text-center pt-4">
                    <button type="submit" class="btn btn-primary btn-lg">
                        {$LANG.continue}
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

{include file="{$Phox['pages']['orderformPath']}/recommendations-modal.tpl"}