{if $inactive}
  {include file="$template/includes/alert.tpl" type="danger" msg=$LANG.affiliatesdisabled textcenter=true}
{else}

{include file="$template/includes/flashmessage.tpl"}

{* Tiles *}
<div class="section">
  <div class="tiles">
    <div class="tile">
      <div class="icon">
        <i class="fad fa-users"></i>
      </div>
      <div class="stat">{$visitors}</div>
      <div class="title">{$LANG.affiliatesclicks}</div>
    </div>
    <div class="tile">
      <div class="icon">
        <i class="fad fa-shopping-cart"></i>
      </div>
      <div class="stat">{$signups}</div>
      <div class="title">{$LANG.affiliatessignups}</div>
    </div>
    <div class="tile">
      <div class="icon">
        <i class="fad fa-chart-bar"></i>
      </div>
      <div class="stat">{$conversionrate}%</div>
      <div class="title">{$LANG.affiliatesconversionrate}</div>
    </div>
  </div>
</div>

{* Referral Link *}
<div class="section">
  <div class="panel panel-default panel-form">
    <div class="input-group align-center referral-links-box-group">
      <div class="input-group-addon referral-links-box">{$LANG.affiliatesreferallink}</div>
      {$referrallink} 
    </div>
  </div>
</div>

{* Info *}
<div class="section">
  <div class="row">
    {* Box *}
    <div class="col-md-4">
      <div class="affiliate-info-box">
        <h3>{$pendingcommissions}</h3>
        <h4>{$LANG.affiliatescommissionspending}</h4>
      </div>
    </div>

    {* Box *}
    <div class="col-md-4">
      {* Box *}
      <div class="affiliate-info-box">
        <h3>{$balance}</h3>
        <h4>{$LANG.affiliatescommissionsavailable}</h4>
      </div>
    </div>

    {* Box *}
    <div class="col-md-4">
      {* Box *}
      <div class="affiliate-info-box">
        <h3>{$withdrawn}</h3>
        <h4>{$LANG.affiliateswithdrawn}</h4>
      </div>
    </div>
  </div>
</div>

<div class="section">
  {if $withdrawrequestsent}
    <div class="alert alert-success">
      <p>{$LANG.affiliateswithdrawalrequestsuccessful}</p>
    </div>
    {else}
    <div class="text-center">
      <form method="POST" action="{$smarty.server.PHP_SELF}">
        <input type="hidden" name="action" value="withdrawrequest" />
        <button type="submit" class="btn btn-lg btn-primary{if !$withdrawlevel} disabled" disabled="disabled{/if}">
            <i class="fad fa-money-bill"></i> {$LANG.affiliatesrequestwithdrawal}
        </button>
      </form>
    </div>
    {if !$withdrawlevel}
    <div class="alert alert-info text-center mt-spacer-4x">
      {lang key="affiliateWithdrawalSummary" amountForWithdrawal=$affiliatePayoutMinimum}
    </div>
    {/if}
  {/if}
</div>

<div class="section">
    {include file="$template/includes/tablelist.tpl" tableName="AffiliatesList"}
    <script type="text/javascript">
      jQuery(document).ready(function() {
        var table = jQuery('#tableAffiliatesList').removeClass('hidden').DataTable();
              {if $orderby == 'regdate'}
              table.order(0, '{$sort}');
              {elseif $orderby == 'product'}
              table.order(1, '{$sort}');
              {elseif $orderby == 'amount'}
              table.order(2, '{$sort}');
              {elseif $orderby == 'status'}
              table.order(4, '{$sort}');
              {/if}
        table.draw();
        jQuery('#tableLoading').addClass('hidden');
      });
    </script>
    <div class="section-header">
      <h2 class="section-title">{$LANG.affiliatesreferals}</h2>
    </div>
    <div class="table-container clearfix">
      <table id="tableAffiliatesList" class="table table-list display responsive nowrap">
        <thead>
          <tr>
            <th>{$LANG.affiliatessignupdate}</th>
            <th>{$LANG.orderproduct}</th>
            <th>{$LANG.affiliatesamount}</th>
            <th>{$LANG.affiliatescommission}</th>
            <th>{$LANG.affiliatesstatus}</th>
          </tr>
        </thead>
        <tbody>
          {foreach from=$referrals item=referral}
          <tr class="text-center">
            <td><span class="hidden">{$referral.datets}</span>{$referral.date}</td>
            <td>{$referral.service}</td>
            <td data-order="{$referral.amountnum}">{$referral.amountdesc}</td>
            <td data-order="{$referral.commissionnum}">{$referral.commission}</td>
            <td><span class='label status status-{$referral.rawstatus|strtolower}'>{$referral.status}</span></td>
          </tr>
          {/foreach}
        </tbody>
      </table>
      <div class="text-center" id="tableLoading">
        <p><i class="fad fa-spinner fa-spin"></i> {$LANG.loading}</p>
      </div>
    </div>
</div>

{if $affiliatelinkscode}
  <div class="section">
    <div class="section-header">
      <h2 class="section-title">{$LANG.affiliateslinktous}</h2>
    </div>
    <div class="section-body">
    <div class="panel panel-default panel-form">
        <div class="panel-body">
        {$affiliatelinkscode}
        </div>
    </div></div>
  </div>
{/if}

{/if}