<div class="section">
    <div class="section-header">
        <h2 class="section-title">{$clientsstats.numunpaidinvoices} {$LANG.clientHomePanels.unpaidInvoices}</h2>
    </div>
    <div class="section-body">
        <div class="panel panel-default">
            <div class="panel-body">
                <form method="post" action="clientarea.php?action=masspay" class="form-horizontal">
                    <input type="hidden" name="geninvoice" value="true" />
            
                    <table class="table table-native">
                        <thead>
                            <tr>
                                <th>{$LANG.invoicesdescription}</th>
                                <th>{$LANG.invoicesamount}</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$invoiceitems key=invid item=invoiceitem}
                                <tr>
                                    <td colspan="2" class="masspay-invoice-id">
                                        {$LANG.invoicenumber} {if $invoiceitem.0.invoicenum}{$invoiceitem.0.invoicenum}{else}{$invid}{/if}
                                        <input type="hidden" name="invoiceids[]" value="{$invid}" />
                                    </td>
                                </tr>
                                {foreach from=$invoiceitem item=item}
                                    <tr class="masspay-invoice-detail">
                                        <td>{$item.description}</td>
                                        <td>{$item.amount}</td>
                                    </tr>
                                {/foreach}
                            {foreachelse}
                                <tr>
                                    <td colspan="6" align="center">{$LANG.norecordsfound}</td>
                                </tr>
                            {/foreach}
                            <tr class="masspay-total">
                                <td class="text-right">{$LANG.invoicessubtotal}:</td>
                                <td>{$subtotal}</td>
                            </tr>
                            {if $tax}
                                <tr class="masspay-total">
                                    <td class="text-right">{$taxrate1}% {$taxname1}:</td>
                                    <td>{$tax}</td>
                                </tr>
                            {/if}
                            {if $tax2}
                                <tr class="masspay-total">
                                    <td class="text-right">{$taxrate2}% {$taxname2}:</td>
                                    <td>{$tax2}</td>
                                </tr>
                            {/if}
                            {if $credit}
                                <tr class="masspay-total">
                                    <td class="text-right">{$LANG.invoicescredit}:</td>
                                    <td>{$credit}</td>
                                </tr>
                            {/if}
                            {if $partialpayments}
                                <tr class="masspay-total">
                                    <td class="text-right">{$LANG.invoicespartialpayments}:</td>
                                    <td>{$partialpayments}</td>
                                </tr>
                            {/if}
                            <tr class="masspay-total">
                                <td class="text-right">{$LANG.invoicestotaldue}:</td>
                                <td>{$total}</td>
                            </tr>
                        </tbody>
                    </table>
            
                    <div class="masspay-payment-gateway">
                        <label for="paymentmethod" class="control-label">{$LANG.masspaymentselectgateway}:</label>
                        <div class="d-flex align-center gap-10 flex-1">
                            <select name="paymentmethod" id="paymentmethod" class="form-control">
                                {foreach from=$gateways item=gateway}
                                    <option value="{$gateway.sysname}">{$gateway.name}</option>
                                {/foreach}
                            </select>
                            <input type="submit" value="{$LANG.masspaymakepayment}" class="btn btn-primary btn-block" id="btnMassPayMakePayment" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>