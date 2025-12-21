{if $registrarcustombuttonresult=="success"}
  {include file="$template/includes/alert.tpl" type="success" msg=$LANG.moduleactionsuccess textcenter=true}
{elseif $registrarcustombuttonresult}
  {include file="$template/includes/alert.tpl" type="error" msg=$LANG.moduleactionfailed textcenter=true}
{/if}

{if $unpaidInvoice}
  <div class="alert alert-{if $unpaidInvoiceOverdue}danger{else}warning{/if}"
    id="alert{if $unpaidInvoiceOverdue}Overdue{else}Unpaid{/if}Invoice">
    <div class="pull-right">
      <a href="viewinvoice.php?id={$unpaidInvoice}" class="btn btn-xs btn-default">
        {lang key='payInvoice'}
      </a>
    </div>
    {$unpaidInvoiceMessage}
  </div>
{/if}

<div class="tab-content margin-bottom">
  {* Tab Overview *}
  <div class="tab-pane fade in active" id="tabOverview">

    {if $alerts}
      {foreach $alerts as $alert}
        {include file="$template/includes/alert.tpl" type=$alert.type msg="<strong>{$alert.title}</strong><br>{$alert.description}"
        textcenter=true}
      {/foreach}
    {/if}

    {if $systemStatus != 'Active'}
      <div class="alert alert-warning text-center" role="alert">
        {$LANG.domainCannotBeManagedUnlessActive}
      </div>
    {/if}

    {* Product *}
    <div class="product-details clearfix">
      <div class="wdes-product-wrapper">
        {* Product Title *}
        <div class="wdes-product-title">
          <div class="wdes-product-title_icon">
            <i class="fad fa-globe"></i>
            <h2><a href="http://{$domain}" target="_blank">{$domain}</a></h2>
          </div>
        </div>

        {* Product Info *}
        <div class="wdes-product-info">
          <ul>
            <li>
              <h4>{$LANG.clientareastatus}</h4>
              <span class="status-{$rawstatus|strtolower}">{$status}</span>
            </li>

            <li>
              <h4>{$LANG.clientareahostingregdate}</h4>
              <span>{$registrationdate}</span>
            </li>

            <li>
              <h4>{$LANG.clientareahostingnextduedate}</h4>
              <span>{$nextduedate}</span>
            </li>

            <li>
              <h4>{$LANG.firstpaymentamount}</h4>
              <span>{$firstpaymentamount}</span>
            </li>

            <li>
              <h4>{$LANG.recurringamount}</h4>
              <span>{$recurringamount} {$LANG.every} {$registrationperiod} {$LANG.orderyears}</span>
            </li>

            <li>
              <h4>{$LANG.orderpaymentmethod}</h4>
              <span>{$paymentmethod}</span>
            </li>
          </ul>
        </div>
      </div>
    </div>   

    {if $lockstatus eq "unlocked"}
      {capture name="domainUnlockedMsg"}<strong>{$LANG.domaincurrentlyunlocked}</strong><br />{$LANG.domaincurrentlyunlockedexp}{/capture}
      {include file="$template/includes/alert.tpl" type="error" msg=$smarty.capture.domainUnlockedMsg}
    {/if}

    {if $sslStatus}
      <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">{$LANG.store.ssl.title}</h3>
        </div>
        <ul class="list-info">
          <li class="{if $sslStatus->isInactive()} ssl-inactive{/if}">
            <span class="list-info-title">{$LANG.sslState.sslStatus}</span>
            <span class="list-info-text"> 
              <img src="{$sslStatus->getImagePath()}" width="16" height="16" data-type="domain" data-domain="{$domain}" data-showlabel="1" class="{$sslStatus->getClass()}" />
              <span id="statusDisplayLabel">
                {if !$sslStatus->needsResync()}
                  {$sslStatus->getStatusDisplayLabel()}
                {else}
                  {$LANG.loading}
                {/if}
              </span>
            </span>
          </li>

          {if $sslStatus->isActive() || $sslStatus->needsResync()}
            <li>
              <span class="list-info-title">{$LANG.sslState.startDate}</span>
              <span class="list-info-text" id="ssl-startdate">
                {if !$sslStatus->needsResync() || $sslStatus->startDate}
                  {$sslStatus->startDate->toClientDateFormat()}
                {else}
                  {$LANG.loading}
                {/if}
              </span>
            </li>
            
            <li>
              <span class="list-info-title">{$LANG.sslState.issuerName}</span>
              <span class="list-info-text" id="ssl-issuer">
                {if !$sslStatus->needsResync() || $sslStatus->issuerName}
                  {$sslStatus->issuerName}
                {else}
                  {$LANG.loading}
                {/if}
              </span>
            </li>

            <li>
              <span class="list-info-title">{$LANG.sslState.expiryDate}</span>
              <span class="list-info-text" id="ssl-expirydate">
                {if !$sslStatus->needsResync() || $sslStatus->expiryDate}
                  {$sslStatus->expiryDate->toClientDateFormat()}
                {else}
                  {$LANG.loading}
                {/if}
              </span>
            </li>
          {/if} 
        </ul>
      </div>
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

    <br />

    {if $canDomainBeManaged
    and (
    $managementoptions.nameservers or
    $managementoptions.contacts or
    $managementoptions.locking or
    $renew)}
      {* No reason to show this section if nothing can be done here! *}

      <div class="panel">
        <div class="panel-heading">
          <h5 class="panel-title">{$LANG.doToday}</h5>
        </div>
        <ul class="list-group list-group-v">
          {if $systemStatus == 'Active' && $managementoptions.nameservers}
          <li class="list-group-item">
            <a class="tabControlLink" data-toggle="tab" href="#tabNameservers">
              <i class="fas fa-arrow-alt-to-right"></i>{$LANG.changeDomainNS}
            </a>
          </li>
          {/if}

          {if $systemStatus == 'Active' && $managementoptions.contacts}
            <li class="list-group-item">
              <a href="clientarea.php?action=domaincontacts&domainid={$domainid}">
                <i class="fas fa-user"></i>{$LANG.updateWhoisContact}
              </a>
            </li>
          {/if}

          {if $systemStatus == 'Active' && $managementoptions.locking}
            <li class="list-group-item">
              <a class="tabControlLink" data-toggle="tab" href="#tabReglock">
                <i class="fas fa-lock"></i>{$LANG.changeRegLock}
              </a>
            </li>
          {/if}

          {if $renew}
            <li class="list-group-item">
              <a class="d-flex align-center gap-10" href="{routePath('domain-renewal', $domain)}">
                <i class="fas fa-sync"></i> {$LANG.domainrenew}
              </a>
            </li>
          {/if}
        </ul>
      </div>
    {/if}
  </div>

  {* Auto Renew *}
  <div class="tab-pane fade" id="tabAutorenew">
    <div class="section">
      <div class="section-header">
          <h2 class="section-title">{$LANG.domainsautorenew}</h2>
          <p class="section-description">{$LANG.domainrenewexp}</p>
      </div>
      <div class="section-body">
        {if $changeAutoRenewStatusSuccessful}
          {include file="$template/includes/alert.tpl" type="success" additionalClasses="alert-primary" msg=$LANG.changessavedsuccessfully}
        {/if}
        <div class="panel panel-form">
          <div class="panel-body">
            <div class="d-flex align-center gap-10">
              {$LANG.domainautorenewstatus}
              <span class="label label-{if $autorenew}success{else}danger{/if}">{if $autorenew}{$LANG.domainsautorenewenabled}{else}{$LANG.domainsautorenewdisabled}{/if}</span>
            </div>
          </div>
        </div>

        <form method="post" action="{$smarty.server.PHP_SELF}?action=domaindetails#tabAutorenew">
          <input type="hidden" name="id" value="{$domainid}">
          <input type="hidden" name="sub" value="autorenew" />
          {if $autorenew}
            <input type="hidden" name="autorenew" value="disable">
            <input type="submit" class="btn btn-danger" value="{$LANG.domainsautorenewdisable}" />
          {else}
            <input type="hidden" name="autorenew" value="enable">
            <input type="submit" class="btn btn-success" value="{$LANG.domainsautorenewenable}" />
          {/if}
        </form>

      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="tabNameservers">
    <div class="section">
      <div class="section-header">
          <h2 class="section-title">{$LANG.domainnameservers}</h2>
          <p class="section-description">{$LANG.domainnsexp}</p>
      </div>
      <div class="section-body">
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
    
        <div class="wdes-phox-block">
          <form class="form-horizontal" role="form" method="post"
            action="{$smarty.server.PHP_SELF}?action=domaindetails#tabNameservers">
            <input type="hidden" name="id" value="{$domainid}" />
            <input type="hidden" name="sub" value="savens" />
            <div class="radio">
              <label>
                <input type="radio" name="nschoice" value="default" onclick="disableFields('domnsinputs',true)"
                  {if $defaultns} checked{/if} /> {$LANG.nschoicedefault}
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" name="nschoice" value="custom" onclick="disableFields('domnsinputs',false)"
                  {if !$defaultns} checked{/if} /> {$LANG.nschoicecustom}
              </label>
            </div>
            <br />
            {for $num=1 to 5}
              <div class="form-group">
                <label for="inputNs{$num}" class="col-sm-4 control-label">{$LANG.clientareanameserver} {$num}</label>
                <div class="col-sm-7">
                  <input type="text" name="ns{$num}" class="form-control domnsinputs" id="inputNs{$num}"
                    value="{$nameservers[$num].value}" />
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
  </div>

  <div class="tab-pane fade" id="tabReglock">
    <div class="section">
      <div class="section-header">
          <h2 class="section-title">{$LANG.domainregistrarlock}</h2>
          <p class="section-description">{$LANG.domainlockingexp}</p>
      </div>
      <div class="section-body">
        {if $subaction eq "savereglock"}
          {if $updatesuccess}
            {include file="$template/includes/alert.tpl" type="success" msg=$LANG.changessavedsuccessfully textcenter=true}
          {elseif $error}
            {include file="$template/includes/alert.tpl" type="error" msg=$error textcenter=true}
          {/if}
        {/if}
    
        <br />
    
        <div class="wdes-phox-block">
          <h2 class="d-flex align-center gap-10">{$LANG.domainreglockstatus}: <span
              class="label label-{if $lockstatus == "locked"}success{else}danger{/if}">{if $lockstatus == "locked"}{$LANG.domainsautorenewenabled}{else}{$LANG.domainsautorenewdisabled}{/if}</span>
          </h2>
          <br />
          <form method="post" action="{$smarty.server.PHP_SELF}?action=domaindetails#tabReglock">
            <input type="hidden" name="id" value="{$domainid}">
            <input type="hidden" name="sub" value="savereglock" />
            {if $lockstatus=="locked"}
              <input type="submit" class="btn btn-lg btn-danger" value="{$LANG.domainreglockdisable}" />
            {else}
              <input type="submit" class="btn btn-lg btn-success" name="reglock" value="{$LANG.domainreglockenable}" />
            {/if}
          </form>
  
        </div>
      </div>
    </div>
  </div>

  <div class="tab-pane fade" id="tabRelease">

    <h3>{$LANG.domainrelease}</h3>

    {if $releaseDomainSuccessful}
      {include file="$template/includes/alert.tpl" type="success" msg="{lang key='changessavedsuccessfully'}"
      textcenter="true"}
    {elseif !empty($error)}
      {include file="$template/includes/alert.tpl" type="error" msg="$error" textcenter="true"}
    {/if}

    {include file="$template/includes/alert.tpl" type="info" msg=$LANG.domainreleasedescription}

    <form class="form-horizontal" role="form" method="post"
      action="{$smarty.server.PHP_SELF}?action=domaindetails#tabRelease">
      <input type="hidden" name="sub" value="releasedomain">
      <input type="hidden" name="id" value="{$domainid}">

      <div class="form-group">
        <label for="inputReleaseTag" class="col-xs-4 control-label">{$LANG.domainreleasetag}</label>
        <div class="col-xs-6 col-sm-6">
          <input type="text" class="form-control" id="inputReleaseTag" name="transtag" />
        </div>
      </div>

      <p class="text-center">
        <input type="submit" value="{$LANG.domainrelease}" class="btn btn-primary" />
      </p>
    </form>

  </div>

  {* Addons *}
  <div class="tab-pane fade" id="tabAddons">
    <div class="section">
      <div class="section-header">
        <h2 class="section-title">{$LANG.domainaddons}</h2>
        <p class="section-description">{$LANG.domainaddonsinfo}</p>
      </div>
      <div class="section-body">
        <div class="row margin-bottom">
          {if $addons.idprotection}
            <div class="col-md-6">
              <div class="wdes-phox-block wdes-phox-block-domain-addon-block-wrapper">
                <div class="wdes-phox-block-domain-addon-block">
                  <i class="fad fa-shield-alt fa-3x"></i>
                  <strong>{$LANG.domainidprotection}</strong><br />
                  {$LANG.domainaddonsidprotectioninfo}<br />
                  <form action="clientarea.php?action=domainaddons" method="post">
                    <input type="hidden" name="id" value="{$domainid}" />
                    {if $addonstatus.idprotection}
                      <input type="hidden" name="disable" value="idprotect" />
                      <input type="submit" value="{$LANG.disable}" class="btn btn-danger" />
                    {else}
                      <input type="hidden" name="buy" value="idprotect" />
                      <input type="submit" value="{$LANG.domainaddonsbuynow} {$addonspricing.idprotection}"
                        class="btn btn-primary" />
                    {/if}
                  </form>
                </div>
              </div>
            </div>
          {/if}

          {if $addons.dnsmanagement}
            <div class="col-md-6">
              <div class="wdes-phox-block wdes-phox-block-domain-addon-block-wrapper">
                <div class="wdes-phox-block-domain-addon-block">
                  <i class="fad fa-cloud fa-3x"></i>
                  <strong>{$LANG.domainaddonsdnsmanagement}</strong><br />
                  {$LANG.domainaddonsdnsmanagementinfo}<br />
                  <form action="clientarea.php?action=domainaddons" method="post">
                    <input type="hidden" name="id" value="{$domainid}" />
                    {if $addonstatus.dnsmanagement}
                      <input type="hidden" name="disable" value="dnsmanagement" />
                      <a class="btn btn-success" href="clientarea.php?action=domaindns&domainid={$domainid}">{$LANG.manage}</a>
                      <input type="submit" value="{$LANG.disable}" class="btn btn-danger" />
                    {else}
                      <input type="hidden" name="buy" value="dnsmanagement" />
                      <input type="submit" value="{$LANG.domainaddonsbuynow} {$addonspricing.dnsmanagement}"
                        class="btn btn-primary" />
                    {/if}
                  </form>
                </div>
              </div>
            </div>
          {/if}
        </div>

        <div class="row">
          {if $addons.emailforwarding}
            <div class="col-md-6">
              <div class="wdes-phox-block">
                <div class="wdes-phox-block-domain-addon-block">
                  <i class="fad fa-envelope fa-3x">&nbsp;</i><i class="fad fa-share fa-2x"></i>
                  <strong>{$LANG.domainemailforwarding}</strong><br />
                  {$LANG.domainaddonsemailforwardinginfo}<br />
                  <form action="clientarea.php?action=domainaddons" method="post">
                    <input type="hidden" name="id" value="{$domainid}" />
                    {if $addonstatus.emailforwarding}
                      <input type="hidden" name="disable" value="emailfwd" />
                      <a class="btn btn-success"
                        href="clientarea.php?action=domainemailforwarding&domainid={$domainid}">{$LANG.manage}</a> <input
                        type="submit" value="{$LANG.disable}" class="btn btn-danger" />
                    {else}
                      <input type="hidden" name="buy" value="emailfwd" />
                      <input type="submit" value="{$LANG.domainaddonsbuynow} {$addonspricing.emailforwarding}"
                        class="btn btn-primary" />
                    {/if}
                  </form>
                </div>
              </div>
            </div>
          {/if}
        </div>
      </div>
    </div>
  </div>
</div>