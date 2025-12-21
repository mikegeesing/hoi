{if $registrarcustombuttonresult=="success"}
    {include file="$template/includes/alert.tpl" type="success" msg=$LANG.moduleactionsuccess textcenter=true}
{elseif $registrarcustombuttonresult}
    {include file="$template/includes/alert.tpl" type="error" msg=$LANG.moduleactionfailed textcenter=true}
{/if}

{if $unpaidInvoice}
    <div class="alert alert-{if $unpaidInvoiceOverdue}danger{else}warning{/if}" id="alert{if $unpaidInvoiceOverdue}Overdue{else}Unpaid{/if}Invoice">
        <div class="pull-right">
            <a href="viewinvoice.php?id={$unpaidInvoice}" class="btn btn-xs btn-default">
                {lang key='payInvoice'}
            </a>
        </div>
        {$unpaidInvoiceMessage}
    </div>
{/if}

<div class="tab-content margin-bottom">
    <div class="tab-pane fade in active" id="tabOverview">

        {if $alerts}
            {foreach $alerts as $alert}
                {include file="$template/includes/alert.tpl" type=$alert.type msg="<strong>{$alert.title}</strong><br>{$alert.description}" textcenter=true}
            {/foreach}
        {/if}

        {if $systemStatus != 'Active'}
            <div class="alert alert-warning text-center" role="alert">
                {$LANG.domainCannotBeManagedUnlessActive}
            </div>
        {/if}

        <h3 class="card-title">{$LANG.overview}</h3>

        <div class="card tt-custom-card">
            <div class="card-body tt-overview">
                {if $lockstatus eq "unlocked"}
            {capture name="domainUnlockedMsg"}<strong>{$LANG.domaincurrentlyunlocked}</strong><br />{$LANG.domaincurrentlyunlockedexp}{/capture}
            {include file="$template/includes/alert.tpl" type="error" msg=$smarty.capture.domainUnlockedMsg}
        {/if}

        <div class="row mb-3">
            <div class="col-lg-6">
                <h5>{$LANG.clientareahostingdomain}:</h5> <a href="http://{$domain}" target="_blank">{$domain}</a>
            </div>
            <div class="col-lg-6">
                <h5>{$LANG.firstpaymentamount}:</h5> <span>{$firstpaymentamount}</span>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-6">
                <h5>{$LANG.clientareahostingregdate}:</h5> <span>{$registrationdate}</span>
            </div>
            <div class="col-lg-6">
                <h5>{$LANG.recurringamount}:</h5> {$recurringamount} {$LANG.every} {$registrationperiod} {$LANG.orderyears}
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-6">
                <h5>{$LANG.clientareahostingnextduedate}:</h5> {$nextduedate}
            </div>
            <div class="col-lg-6">
                <h5>{$LANG.orderpaymentmethod}:</h5> {$paymentmethod}
            </div>
        </div>

        
        <div class="row mb-3">
            <div class="col-12">
                <h5>{$LANG.clientareastatus}:</h5> {$status}
            </div>
        </div>

        {if $sslStatus}
            <div class="row mb-3">
                <div class="col-lg-6{if $sslStatus->isInactive()} ssl-inactive{/if}">
                    <h4><strong>{$LANG.sslState.sslStatus}</strong></h4> <img src="{$sslStatus->getImagePath()}" width="16" data-type="domain" data-domain="{$domain}" data-showlabel="1" class="{$sslStatus->getClass()}"/>
                    <span id="statusDisplayLabel">
                        {if !$sslStatus->needsResync()}
                            {$sslStatus->getStatusDisplayLabel()}
                        {else}
                            {$LANG.loading}
                        {/if}
                    </span>
                </div>
                {if $sslStatus->isActive() || $sslStatus->needsResync()}
                    <div class="col-lg-6">
                        <h4>{$LANG.sslState.startDate}</h4>
                        <span id="ssl-startdate">
                            {if !$sslStatus->needsResync() || $sslStatus->startDate}
                                {$sslStatus->startDate->toClientDateFormat()}
                            {else}
                                {$LANG.loading}
                            {/if}
                        </span>
                    </div>
                {/if}
            </div>
            {if $sslStatus->isActive() || $sslStatus->needsResync()}
                <div class="row mb-3">
                    <div class="col-lg-6">
                        <h5>{$LANG.sslState.issuerName}</h5>
                        <span id="ssl-issuer">
                            {if !$sslStatus->needsResync() || $sslStatus->issuerName}
                                {$sslStatus->issuerName}
                            {else}
                                {$LANG.loading}
                            {/if}
                        </span>
                    </div>
                    <div class="col-lg-6">
                        <h5>{$LANG.sslState.expiryDate}</h5>
                        <span id="ssl-expirydate">
                            {if !$sslStatus->needsResync() || $sslStatus->expiryDate}
                                {$sslStatus->expiryDate->toClientDateFormat()}
                            {else}
                                {$LANG.loading}
                            {/if}
                        </span>
                    </div>
                </div>
            {/if}
        {/if}

        {if $registrarclientarea}
            <div class="moduleoutput">
                {$registrarclientarea|replace:'modulebutton':'btn'}
            </div>
        {/if}

        {foreach $hookOutput as $output}
            <div>
                {$output}
            </div>
        {/foreach}

            </div>
        </div> 

        <br />

        {if $canDomainBeManaged
            and (
                $managementoptions.nameservers or
                $managementoptions.contacts or
                $managementoptions.locking or
                $renew)}
                {* No reason to show this section if nothing can be done here! *}

            <div class="bg-light p-3 rounded" style="border: 2px dashed var(--border-color);">
                <h5 class="card-title">{$LANG.doToday}</h5>

            <ul>
                {if $systemStatus == 'Active' && $managementoptions.nameservers}
                    <li>
                        <a class="tabControlLink tt-read-more" data-toggle="tab" href="#tabNameservers">
                            {$LANG.changeDomainNS} <i class="fad fa-arrow-right"></i>
                        </a>
                    </li>
                {/if}
                {if $systemStatus == 'Active' && $managementoptions.contacts}
                    <li>
                        <a class="tt-read-more" href="clientarea.php?action=domaincontacts&domainid={$domainid}">
                            {$LANG.updateWhoisContact} <i class="fad fa-arrow-right"></i>
                        </a>
                    </li>
                {/if}
                {if $systemStatus == 'Active' && $managementoptions.locking}
                    <li>
                        <a class="tabControlLink tt-read-more" data-toggle="tab" href="#tabReglock">
                            {$LANG.changeRegLock} <i class="fad fa-arrow-right"></i>
                        </a>
                    </li>
                {/if}
                {if $renew}
                    <li>
                        <a class="tt-read-more" href="{routePath('domain-renewal', $domain)}">
                            {lang key='domainrenew'} <i class="fad fa-arrow-right"></i>
                        </a>
                    </li>
                {/if}
            </ul>
            </div>

            <br />

        {/if}

    </div>
    <div class="tab-pane fade" id="tabAutorenew">

        <h3 class="card-title">{$LANG.domainsautorenew}</h3>

        <div class="card tt-custom-card">
            <div class="card-body tt-overview">
                {if $changeAutoRenewStatusSuccessful}
            {include file="$template/includes/alert.tpl" type="success" msg=$LANG.changessavedsuccessfully textcenter=true}
        {/if}

        {include file="$template/includes/alert.tpl" type="info" msg=$LANG.domainrenewexp}

        <br />

        <h6 class="text-center">{$LANG.domainautorenewstatus}: <span class="label label-{if $autorenew}success{else}danger{/if}">{if $autorenew}{$LANG.domainsautorenewenabled}{else}{$LANG.domainsautorenewdisabled}{/if}</span></h6>

        <br />
        <br />

        <form method="post" action="{$smarty.server.PHP_SELF}?action=domaindetails#tabAutorenew">
            <input type="hidden" name="id" value="{$domainid}">
            <input type="hidden" name="sub" value="autorenew" />
            {if $autorenew}
                <input type="hidden" name="autorenew" value="disable">
                <p class="text-center">
                    <input type="submit" class="btn btn-lg btn-danger" value="{$LANG.domainsautorenewdisable}" />
                </p>
            {else}
                <input type="hidden" name="autorenew" value="enable">
                <p class="text-center">
                    <input type="submit" class="btn btn-lg btn-success" value="{$LANG.domainsautorenewenable}" />
                </p>
            {/if}
        </form>
            </div>
        </div>

        

    </div>
    <div class="tab-pane fade" id="tabNameservers">

        <h3 class="card-title">{$LANG.domainnameservers}</h3>

        <div class="card tt-custom-card">
            <div class="card-body tt-overview">
                
        {if $nameservererror}
        {include file="$template/includes/alert.tpl" type="error" msg=$nameservererror textcenter=true}
    {/if}
    {if $subaction eq "savens"}
        {if $updatesuccess}
            {include file="$template/includes/alert.tpl" type="success" msg=$LANG.changessavedsuccessfully textcenter=true}
        {elseif $error}
            {include file="$template/includes/alert.tpl" type="error" msg=$error textcenter=true}
        {/if}
    {/if}

    {include file="$template/includes/alert.tpl" type="info" msg=$LANG.domainnsexp}

    <form class="form-horizontal" role="form" method="post" action="{$smarty.server.PHP_SELF}?action=domaindetails#tabNameservers">
        <input type="hidden" name="id" value="{$domainid}" />
        <input type="hidden" name="sub" value="savens" />
        <div class="radio">
            <label>
                <input type="radio" name="nschoice" value="default" onclick="disableFields('domnsinputs',true)"{if $defaultns} checked{/if} /> {$LANG.nschoicedefault}
            </label>
        </div>
        <div class="radio">
            <label>
                <input type="radio" name="nschoice" value="custom" onclick="disableFields('domnsinputs',false)"{if !$defaultns} checked{/if} /> {$LANG.nschoicecustom}
            </label>
        </div>
        <br />
        {for $num=1 to 5}
            <div class="form-group">
                <label for="inputNs{$num}" class="col-sm-4 control-label">{$LANG.clientareanameserver} {$num}</label>
                <div class="col-sm-7">
                    <input type="text" name="ns{$num}" class="form-control domnsinputs" id="inputNs{$num}" value="{$nameservers[$num].value}" />
                </div>
            </div>
        {/for}
        <p class="text-center">
            <input type="submit" class="btn btn-primary" value="{$LANG.changenameservers}" />
        </p>
    </form>
                </div>

                </div>


    </div>
    <div class="tab-pane fade" id="tabReglock">

        <h3 class="card-title">{$LANG.domainregistrarlock}</h3>

        <div class="card tt-custom-card">
            <div class="card-body tt-overview">
                {if $subaction eq "savereglock"}
            {if $updatesuccess}
                {include file="$template/includes/alert.tpl" type="success" msg=$LANG.changessavedsuccessfully textcenter=true}
            {elseif $error}
                {include file="$template/includes/alert.tpl" type="error" msg=$error textcenter=true}
            {/if}
        {/if}

        {include file="$template/includes/alert.tpl" type="info" msg=$LANG.domainlockingexp}

        <br />

        <h6 class="text-center">{$LANG.domainreglockstatus}: <span class="label label-{if $lockstatus == "locked"}success{else}danger{/if}">{if $lockstatus == "locked"}{$LANG.domainsautorenewenabled}{else}{$LANG.domainsautorenewdisabled}{/if}</span></h6>

        <br />
        <br />

        <form method="post" action="{$smarty.server.PHP_SELF}?action=domaindetails#tabReglock">
            <input type="hidden" name="id" value="{$domainid}">
            <input type="hidden" name="sub" value="savereglock" />
            {if $lockstatus=="locked"}
                <p class="text-center">
                    <input type="submit" class="btn btn-lg btn-danger" value="{$LANG.domainreglockdisable}" />
                </p>
            {else}
                <p class="text-center">
                    <input type="submit" class="btn btn-lg btn-success" name="reglock" value="{$LANG.domainreglockenable}" />
                </p>
            {/if}
        </form>
                </div>

                </div>

        

    </div>
    <div class="tab-pane fade" id="tabRelease">

        <h3 class="card-title">{$LANG.domainrelease}</h3>

        <div class="card tt-custom-card">
            <div class="card-body tt-overview">
                {if $releaseDomainSuccessful}
            {include file="$template/includes/alert.tpl" type="success" msg="{lang key='changessavedsuccessfully'}" textcenter="true"}
        {elseif !empty($error)}
            {include file="$template/includes/alert.tpl" type="error" msg="$error" textcenter="true"}
        {/if}

        {include file="$template/includes/alert.tpl" type="info" msg=$LANG.domainreleasedescription}

        <form class="form-horizontal" role="form" method="post" action="{$smarty.server.PHP_SELF}?action=domaindetails#tabRelease">
            <input type="hidden" name="sub" value="releasedomain">
            <input type="hidden" name="id" value="{$domainid}">

            <div class="form-group">
                <label for="inputReleaseTag" class="col-xs-4 control-label">{$LANG.domainreleasetag}</label>
                <div class="col-xs-6 col-sm-5">
                    <input type="text" class="form-control" id="inputReleaseTag" name="transtag" />
                </div>
            </div>

            <p class="text-center">
                <input type="submit" value="{$LANG.domainrelease}" class="btn btn-primary" />
            </p>
        </form>
                </div>
                </div>

        

    </div>
    <div class="tab-pane fade" id="tabAddons">

        <h3 class="card-title">{$LANG.domainaddons}</h3>

        <div class="card tt-custom-card">
            <div class="card-body tt-overview">
                <p>
                    {$LANG.domainaddonsinfo}
                </p>
        
                {if $addons.idprotection}
                    <div class="row margin-bottom">
                        <div class="col-xs-3 col-md-2 text-center">
                            <i class="fas fa-shield-alt fa-3x"></i>
                        </div>
                        <div class="col-xs-9 col-md-10">
                            <strong>{$LANG.domainidprotection}</strong><br />
                            {$LANG.domainaddonsidprotectioninfo}<br />
                            <form action="clientarea.php?action=domainaddons" method="post">
                                <input type="hidden" name="id" value="{$domainid}"/>
                                {if $addonstatus.idprotection}
                                    <input type="hidden" name="disable" value="idprotect"/>
                                    <input type="submit" value="{$LANG.disable}" class="btn btn-danger"/>
                                {else}
                                    <input type="hidden" name="buy" value="idprotect"/>
                                    <input type="submit" value="{$LANG.domainaddonsbuynow} {$addonspricing.idprotection}" class="btn btn-success"/>
                                {/if}
                            </form>
                        </div>
                    </div>
                {/if}
                {if $addons.dnsmanagement}
                    <div class="row margin-bottom">
                        <div class="col-xs-3 col-md-2 text-center">
                            <i class="fas fa-cloud fa-3x"></i>
                        </div>
                        <div class="col-xs-9 col-md-10">
                            <strong>{$LANG.domainaddonsdnsmanagement}</strong><br />
                            {$LANG.domainaddonsdnsmanagementinfo}<br />
                            <form action="clientarea.php?action=domainaddons" method="post">
                                <input type="hidden" name="id" value="{$domainid}"/>
                                {if $addonstatus.dnsmanagement}
                                    <input type="hidden" name="disable" value="dnsmanagement"/>
                                    <a class="btn btn-success" href="clientarea.php?action=domaindns&domainid={$domainid}">{$LANG.manage}</a> <input type="submit" value="{$LANG.disable}" class="btn btn-danger"/>
                                {else}
                                    <input type="hidden" name="buy" value="dnsmanagement"/>
                                    <input type="submit" value="{$LANG.domainaddonsbuynow} {$addonspricing.dnsmanagement}" class="btn btn-success"/>
                                {/if}
                            </form>
                        </div>
                    </div>
                {/if}
                {if $addons.emailforwarding}
                    <div class="row margin-bottom">
                        <div class="col-xs-3 col-md-2 text-center">
                            <i class="fas fa-envelope fa-3x">&nbsp;</i><i class="fas fa-share fa-2x"></i>
                        </div>
                        <div class="col-xs-9 col-md-10">
                            <strong>{$LANG.domainemailforwarding}</strong><br />
                            {$LANG.domainaddonsemailforwardinginfo}<br />
                            <form action="clientarea.php?action=domainaddons" method="post">
                                <input type="hidden" name="id" value="{$domainid}"/>
                                {if $addonstatus.emailforwarding}
                                    <input type="hidden" name="disable" value="emailfwd"/>
                                    <a class="btn btn-success" href="clientarea.php?action=domainemailforwarding&domainid={$domainid}">{$LANG.manage}</a> <input type="submit" value="{$LANG.disable}" class="btn btn-danger"/>
                                {else}
                                    <input type="hidden" name="buy" value="emailfwd"/>
                                    <input type="submit" value="{$LANG.domainaddonsbuynow} {$addonspricing.emailforwarding}" class="btn btn-success"/>
                                {/if}
                            </form>
                        </div>
                    </div>
                {/if}
                </div>
                </div>

        
    </div>
</div>

