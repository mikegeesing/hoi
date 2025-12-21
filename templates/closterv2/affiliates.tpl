{if $inactive}

    {include file="$template/includes/alert.tpl" type="danger" msg=$LANG.affiliatesdisabled textcenter=true}

{else}
    {include file="$template/includes/flashmessage.tpl"}
    <div class="row">

        <div class="col-sm-4">
            <div class="affiliate-stat affiliate-stat-green bg-danger-light mb-2">
                <i class="fas fa-users"></i>
                <span>{$visitors}</span>
                <small>{$LANG.affiliatesclicks}</small>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="affiliate-stat affiliate-stat-green bg-primary-lights mb-2">
                <i class="fas fa-shopping-cart"></i>
                <span>{$signups}</span>
                <small>{$LANG.affiliatessignups}</small>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="affiliate-stat affiliate-stat-green bg-success-light mb-2">
                <i class="far fa-chart-bar"></i>
                <span>{$conversionrate}%</span>
                <small>{$LANG.affiliatesconversionrate}</small>
            </div>
        </div>

    </div>

    <div class="card my-3">
        <div class="card-body">

            <h5 class="card-title">{$LANG.affiliatesreferallink}</h5>
            <input type="text" class="form-control py-2" readonly="readonly" value="{$referrallink}">

        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <table class="table table-bordered table-rounded">
                <tr>
                    <td class="text-right">{$LANG.affiliatescommissionspending}:</td>
                    <td><strong>{$pendingcommissions}</strong></td>
                </tr>
                <tr>
                    <td class="text-right">{$LANG.affiliatescommissionsavailable}:</td>
                    <td><strong>{$balance}</strong></td>
                </tr>
                <tr>
                    <td class="text-right">{$LANG.affiliateswithdrawn}:</td>
                    <td><strong>{$withdrawn}</strong></td>
                </tr>
            </table>
        </div>
    </div>

    {if $withdrawrequestsent}
        <div class="alert alert-success">
            <p>{$LANG.affiliateswithdrawalrequestsuccessful}</p>
        </div>
    {else}
        
            <div class="text-center">
            <form method="POST" action="{$smarty.server.PHP_SELF}">
                <input type="hidden" name="action" value="withdrawrequest" />
                <button type="submit" class="btn btn-lg btn-danger{if !$withdrawlevel} disabled" disabled="disabled{/if}">
                    <i class="fas fa-university"></i> {$LANG.affiliatesrequestwithdrawal}
                </button>
            </form>
        </div>
        
        {if !$withdrawlevel}
            <p class="text-muted fs-14">{lang key="affiliateWithdrawalSummary" amountForWithdrawal=$affiliatePayoutMinimum}</p>
        {/if}
    {/if}

    {include file="$template/includes/subheader.tpl" title=$LANG.affiliatesreferals}

    {include file="$template/includes/tablelist.tpl" tableName="AffiliatesList"}
    <script type="text/javascript">
        jQuery(document).ready( function ()
        {
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
    <div class="table-container clearfix dataTables_wrapper dt-bootstrap4 nao-footer">
        <table id="tableAffiliatesList" class="table table-list hidden dataTable no-footer">
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
            <p><i class="fas fa-spinner fa-spin"></i> {$LANG.loading}</p>
        </div>
    </div>

    {if $affiliatelinkscode}
        {include file="$template/includes/subheader.tpl" title=$LANG.affiliateslinktous}
        <div class="margin-bottom">
            {$affiliatelinkscode}
        </div>
    {/if}

{/if}
