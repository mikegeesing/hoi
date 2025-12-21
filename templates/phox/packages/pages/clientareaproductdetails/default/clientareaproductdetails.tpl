{if $modulecustombuttonresult}
  {if $modulecustombuttonresult == "success"}
    {include file="$template/includes/alert.tpl" type="success" msg=$LANG.moduleactionsuccess textcenter=true idname="alertModuleCustomButtonSuccess"}
  {else}
    {include file="$template/includes/alert.tpl" type="error" msg=$LANG.moduleactionfailed|cat:' ':$modulecustombuttonresult textcenter=true idname="alertModuleCustomButtonFailed"}
  {/if}
{/if}

{if $pendingcancellation}
  {include file="$template/includes/alert.tpl" type="error" msg=$LANG.cancellationrequestedexplanation textcenter=true idname="alertPendingCancellation"}
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
  <div class="tab-pane fade in active" id="tabOverview">

    {if $tplOverviewTabOutput}
      {$tplOverviewTabOutput}
    {else}
      {* Product *}
      <div class="product-details clearfix">
        <div class="wdes-product-wrapper">
          {* Product Title *}
          <div class="wdes-product-title">
            <div class="wdes-product-title_icon">
              <i
                class="fad fa-{if $type eq "hostingaccount" || $type == "reselleraccount"}hdd{elseif $type eq "server"}server{else}archive{/if}"></i>
              <h2>{$product} - {$groupname}</h2>
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
                <span>{$regdate}</span>
              </li>

              {if $firstpaymentamount neq $recurringamount}
                <li>
                  <h4>{$LANG.firstpaymentamount}</h4>
                  <span>{$firstpaymentamount}</span>
                </li>
              {/if}

              {if $billingcycle != $LANG.orderpaymenttermonetime && $billingcycle != $LANG.orderfree}
                <li>
                  <h4>{$LANG.recurringamount}</h4>
                  <span>{$recurringamount}</span>
                </li>
              {/if}

              {if $quantitySupported && $quantity > 1}
                <li>
                  <h4>{lang key='quantity'}</h4>
                  <span>{$quantity}</span>
                </li>
              {/if}

              <li>
                <h4>{$LANG.orderbillingcycle}</h4>
                <span>{$billingcycle}</span>
              </li>

              <li>
                <h4>{$LANG.clientareahostingnextduedate}</h4>
                <span>{$nextduedate}</span>
              </li>

              <li>
                <h4>{$LANG.orderpaymentmethod}</h4>
                <span>{$paymentmethod}</span>
              </li>

              {if $suspendreason}
                <li>
                  <h4>{$LANG.suspendreason}</h4>
                  <span> {$suspendreason}</span>
                </li>
              {/if}
            </ul>
          </div>
        </div>
      </div>

      {* Hooks *}
      {foreach $hookOutput as $output}
        <div class="hooks-area wdes-hooks-area--product-details">
          {$output}
        </div>
      {/foreach}

      {* Information *}
      {if $domain || $moduleclientarea || $configurableoptions || $customfields || $lastupdate}
        <div class="panel panel-default">
          {* Navigation *}
          <div class="panel-nav">
            <ul class="nav nav-tabs">
              {* Domain *}
              {if $domain}
                <li class="active">
                  <a href="#domain" data-toggle="tab"><i class="fad fa-globe fa-fw"></i>
                    {if $type eq "server"}{$LANG.sslserverinfo}{elseif ($type eq "hostingaccount" || $type eq "reselleraccount") && $serverdata}{$LANG.hostingInfo}{else}{$LANG.clientareahostingdomain}{/if}</a>
                </li>
              {elseif $moduleclientarea}
                <li class="active">
                  <a href="#manage" data-toggle="tab"><i class="fad fa-globe fa-fw"></i> {$LANG.manage}</a>
                </li>
              {/if}

              {* Configure Options *}
              {if $configurableoptions}
                <li{if !$domain && !$moduleclientarea} class="active" {/if}>
                  <a href="#configoptions" data-toggle="tab"><i class="fad fa-cubes fa-fw"></i>
                    {$LANG.orderconfigpackage}</a>
                </li>
              {/if}

              {* Metrics *}
              {if $metricStats}
                <li{if !$domain && !$moduleclientarea && !$configurableoptions} class="active" {/if}>
                  <a href="#metrics" data-toggle="tab"><i class="fad fa-chart-line fa-fw"></i> {$LANG.metrics.title}</a>
                </li>
              {/if}

              {* Custom Fields *}
              {if $customfields}
                <li{if !$domain && !$moduleclientarea && !$metricStats && !$configurableoptions} class="active" {/if}>
                  <a href="#additionalinfo" data-toggle="tab"><i class="fad fa-info fa-fw"></i>
                    {$LANG.additionalInfo}</a>
                </li>
              {/if}

              {* Last Update *}
              {if $lastupdate}
                <li{if !$domain && !$moduleclientarea && !$configurableoptions && !$customfields} class="active"
                  {/if}>
                    <a href="#resourceusage" data-toggle="tab"><i class="fad fa-inbox fa-fw"></i>
                    {$LANG.resourceUsage}</a>
                </li>
              {/if}
            </ul>
          </div>

          {* Content *}
          <div class="tab-content">
            {if $domain}
              <div class="tab-pane fade in active" id="domain">
                <ul class="list-info">
                  {if $type eq "server"}
                    <li>
                      <span class="list-info-title">{$LANG.serverhostname}</span>
                      <span class="list-info-text">{$domain}</span>
                    </li>

                    {if $dedicatedip}
                      <li>
                        <span class="list-info-title">{$LANG.primaryIP}</span>
                        <span class="list-info-text">{$dedicatedip}</span>
                      </li>
                    {/if}

                    {if $assignedips}
                      <li>
                        <span class="list-info-title">{$LANG.assignedIPs}</span>
                        <span class="list-info-text">{$assignedips|nl2br}</span>
                      </li>
                    {/if}

                    {if $ns1 || $ns2}
                      <li>
                        <span class="list-info-title">{$LANG.domainnameservers}</span>
                        <span class="list-info-text"><span class="label label-info">{$ns1}</span> <span class="label label-info">{$ns2}</span></span>
                      </li>
                    {/if}

                  {else}
                    {if $domain}
                      <li>
                        <span class="list-info-title">{$LANG.orderdomain}</span>
                        <span class="list-info-text">{$domain}</span>
                      </li>
                    {/if}

                    {if $username}
                      <li>
                        <span class="list-info-title">{$LANG.serverusername}</span>
                        <span class="list-info-text">{$username}</span>
                      </li>
                    {/if}

                    {if $serverdata}
                      <li>
                        <span class="list-info-title">{$LANG.servername}</span>
                        <span class="list-info-text">{$serverdata.hostname}</span>
                      </li>

                      <li>
                        <span class="list-info-title">{$LANG.domainregisternsip}</span>
                        <span class="list-info-text">{$serverdata.ipaddress}</span>
                      </li>

                      {if $serverdata.nameserver1 || $serverdata.nameserver2 || $serverdata.nameserver3 || $serverdata.nameserver4 || $serverdata.nameserver5}
                        <li>
                          <span class="list-info-title">{$LANG.domainnameservers}</span>
                          <span class="list-info-text">
                            {if $serverdata.nameserver1}{$serverdata.nameserver1} ({$serverdata.nameserver1ip}) - {/if}
                            {if $serverdata.nameserver2}{$serverdata.nameserver2} ({$serverdata.nameserver2ip}) - {/if}
                            {if $serverdata.nameserver3}{$serverdata.nameserver3} ({$serverdata.nameserver3ip}) - {/if}
                            {if $serverdata.nameserver4}{$serverdata.nameserver4} ({$serverdata.nameserver4ip}) - {/if}
                            {if $serverdata.nameserver5}{$serverdata.nameserver5} ({$serverdata.nameserver5ip}){/if}
                          </span>
                        </li>
                      {/if}
                    {/if}

                    {if $domain && $sslStatus}
                      <li>
                        <span class="list-info-title">{$LANG.sslState.sslStatus}</span>
                        <span class="list-info-text">
                          <img src="{$sslStatus->getImagePath()}" width="12" data-type="service" data-domain="{$domain}"
                            data-showlabel="1" class="{$sslStatus->getClass()}" />
                          {if !$sslStatus->needsResync()}
                            {$sslStatus->getStatusDisplayLabel()}
                          {else}
                            {$LANG.loading}
                          {/if}
                        </span>
                      </li>

                      {if $sslStatus->isActive() || $sslStatus->needsResync()}
                        <li>
                          <span class="list-info-title">{$LANG.sslState.startDate}</span>
                          <span class="list-info-text">
                            {if !$sslStatus->needsResync() || $sslStatus->startDate}
                              {$sslStatus->startDate->toClientDateFormat()}
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
                      {/if}

                    {/if}

                    <li>
                      <span class="list-info-title">{$LANG.visitwebsite}</span>
                      <span class="list-info-text"><a href="http://{$domain}" target="_blank"><i class="fad fa-external-link"></i></a></span>
                    </li>

                    {if $domainId}
                      <li>
                        <span class="list-info-title">{$LANG.managedomain}</span>
                        <span class="list-info-text"><a href="clientarea.php?action=domaindetails&id={$domainId}" target="_blank"><i class="fad fa-cog"></i></a></span>
                      </li>
                    {/if}

                  {/if}

                  {if $moduleclientarea}
                    <li>
                      <span class="list-info-title">{$moduleclientarea}</span>
                    </li>
                  {/if}
                </ul>
              </div>

              {if $sslStatus}
                <div class="tab-pane fade" id="ssl-info">
                  {if $sslStatus->isActive()}
                    <div class="alert alert-success" role="alert">
                      {lang key='sslActive' expiry=$sslStatus->expiryDate->toClientDateFormat()}
                    </div>
                  {else}
                    <div class="alert alert-warning ssl-required" role="alert">
                      {lang key='sslRequired'}
                    </div>
                  {/if}
                </div>
              {/if}

            {elseif $moduleclientarea}
              <div class="tab-pane fade{if !$domain} in active{/if}" id="manage">
                {if $moduleclientarea}
                  <div class="text-center module-client-area">
                    {$moduleclientarea}
                  </div>
                {/if}
              </div>
            {/if}

            {if $configurableoptions}
              <div class="tab-pane fade{if !$domain && !$moduleclientarea} in active{/if}" id="configoptions">
                <ul class="list-info">
                  {foreach from=$configurableoptions item=configoption}
                    <li>
                      <span class="list-info-title">{$configoption.optionname}</span>
                      <span class="list-info-text">
                        {if $configoption.optiontype eq 3}
                          {if $configoption.selectedqty}
                            {$LANG.yes}
                          {else}
                            {$LANG.no}
                          {/if}
                        {elseif $configoption.optiontype eq 4}
                          {$configoption.selectedqty} x {$configoption.selectedoption}
                        {else}
                            {$configoption.selectedoption}
                        {/if}
                      </span>
                    </li>
                  {/foreach}
                </ul>
              </div>
            {/if}

            {if $metricStats}
              <div class="tab-pane fade{if !$domain && !$moduleclientarea && !$configurableoptions} in active{/if}" id="metrics">
                {include file="$template/clientareaproductusagebilling.tpl"}
              </div>
            {/if}

            {if $customfields}
              <div
                class="tab-pane fade{if !$domain && !$moduleclientarea && !$configurableoptions && !$metricStats} in active{/if}" id="additionalinfo">
                <ul class="list-info">
                  {foreach from=$customfields item=field}
                    <li>
                      <span class="list-info-title">{$field.name}</span>
                      <span>{$field.value}</span>
                    </li>
                  {/foreach}
                </ul>
              </div>
            {/if}

            {if $lastupdate}
              <div class="tab-pane fade text-center" id="resourceusage">
                <div class="col-sm-10 col-sm-offset-1">
                  <div class="col-sm-6">
                    <h4>{$LANG.diskSpace}</h4>
                    <input type="text" value="{$diskpercent|substr:0:-1}" class="dial-usage" data-width="100"
                      data-height="100" data-min="0" data-readOnly="true" />
                    <p>{$diskusage}MB / {$disklimit}MB</p>
                  </div>
                  <div class="col-sm-6">
                    <h4>{$LANG.bandwidth}</h4>
                    <input type="text" value="{$bwpercent|substr:0:-1}" class="dial-usage" data-width="100" data-height="100"
                      data-min="0" data-readOnly="true" />
                    <p>{$bwusage}MB / {$bwlimit}MB</p>
                  </div>
                </div>
                <div class="clearfix">
              </div>

              <p class="text-muted">{$LANG.clientarealastupdated}: {$lastupdate}</p>
              <script src="{$BASE_PATH_JS}/jquery.knob.js"></script>
              <script type="text/javascript">
                jQuery(function() {ldelim}
                jQuery(".dial-usage").knob({ldelim}'format':function (v) {ldelim} alert(v); {rdelim}{rdelim});
                {rdelim});
              </script>
            {/if}

          </div>

        </div>
      {/if}

      <script src="{$BASE_PATH_JS}/bootstrap-tabdrop.js"></script>
      <script type="text/javascript">
        jQuery('.nav-tabs-overflow').tabdrop();
      </script>

    {/if}

  </div>

  <div class="tab-pane fade in" id="tabDownloads">

    <h3>{$LANG.downloadstitle}</h3>

    {include file="$template/includes/alert.tpl" type="info" msg="{lang key="clientAreaProductDownloadsAvailable"}"
    textcenter=true}

    <div class="row">
      {foreach from=$downloads item=download}
        <div class="col-xs-6">
          <h4>{$download.title}</h4>
          <p>
            {$download.description}
          </p>
          <p>
            <a href="{$download.link}" class="btn btn-default"><i class="fad fa-download"></i> {$LANG.downloadname}</a>
          </p>
        </div>
      {/foreach}
    </div>

  </div>

  <div class="tab-pane fade in" id="tabAddons">

    <h3>{$LANG.clientareahostingaddons}</h3>

    {if $addonsavailable}
      <p>{lang key="clientAreaProductAddonsAvailable"}</p>
    {/if}

    <div class="row mt-spacer-4x">

      {foreach from=$addons item=addon}
        <div class="col-xs-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              {$addon.name}
              <div class="pull-right status-{$addon.rawstatus|strtolower}">{$addon.status}</div>
            </div>
            <div class="list-group">
              <div class="list-group-item">{$addon.pricing}</div>
                <div class="list-group-item">{$LANG.registered}: {$addon.regdate}</div>
                <div class="list-group-item">{$LANG.clientareahostingnextduedate}: {$addon.nextduedate}</div>
            </div>
            <div class="panel-footer">
              {$addon.managementActions}
            </div>
          </div>
        </div>

      {/foreach}
    </div>

  </div>
  
  <div class="tab-pane fade in" id="tabChangepw">

    <h3>{$LANG.serverchangepassword}</h3>


    {if $modulechangepwresult}

      {if $modulechangepwresult == "success"}

        {include file="$template/includes/alert.tpl" type="success" msg=$modulechangepasswordmessage textcenter=true}

      {elseif $modulechangepwresult == "error"}

        {include file="$template/includes/alert.tpl" type="error" msg=$modulechangepasswordmessage|strip_tags textcenter=true}

      {/if}

    {/if}

    <form class="form-horizontal using-password-strength" method="post"
      action="{$smarty.server.PHP_SELF}?action=productdetails#tabChangepw" role="form">
      <input type="hidden" name="id" value="{$id}" />
      <input type="hidden" name="modulechangepassword" value="true" />

      <div id="newPassword1" class="form-group has-feedback">
        <label for="inputNewPassword1" class="col-sm-4 control-label">{$LANG.newpassword}</label>
        <div class="col-sm-5">
          <input type="password" class="form-control" id="inputNewPassword1" name="newpw" autocomplete="off" />
          <span class="form-control-feedback glyphicon"></span>

          {include file="$template/includes/pwstrength.tpl"}
        </div>
        <div class="col-sm-3">
          <button type="button" class="btn btn-default generate-password"
            data-targetfields="inputNewPassword1,inputNewPassword2">
            {$LANG.generatePassword.btnLabel}
          </button>
        </div>
      </div>
      <div id="newPassword2" class="form-group has-feedback">
        <label for="inputNewPassword2" class="col-sm-4 control-label">{$LANG.confirmnewpassword}</label>
        <div class="col-sm-5">
          <input type="password" class="form-control" id="inputNewPassword2" name="confirmpw" autocomplete="off" />
          <span class="form-control-feedback glyphicon"></span>
          <div id="inputNewPassword2Msg">
          </div>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-6 col-sm-6">
          <input class="btn btn-primary" type="submit" value="{$LANG.clientareasavechanges}" />
          <input class="btn" type="reset" value="{$LANG.cancel}" />
        </div>
      </div>

    </form>

  </div>
</div>