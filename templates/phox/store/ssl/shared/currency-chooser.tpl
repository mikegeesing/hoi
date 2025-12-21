{if file_exists("templates/$template/packages/overwrites/store/ssl/shared/currency-chooser.tpl")}
    {include file="{$template}/packages/overwrites/store/ssl/shared/currency-chooser.tpl"}
{else}
    {if !$loggedin && $currencies}
        <div align="right">
            <form method="post" action="">
                <select name="currency" class="form-control currency-selector" onchange="submit()">
                    <option>{lang key="changeCurrency"} ({$activeCurrency.prefix} {$activeCurrency.code})</option>
                    {foreach $currencies as $currency}
                        <option value="{$currency['id']}">{$currency['prefix']} {$currency['code']}</option>
                    {/foreach}
                </select>
            </form>
        </div>
    {/if}
{/if}