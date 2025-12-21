{if file_exists("templates/$template/packages/overwrites/includes/active-products-services-item.tpl")}
    {include file="{$template}/packages/overwrites/includes/active-products-services-item.tpl"}
{else}
    <div class="div-service-item" data-href="clientarea.php?action=productdetails&id={$service->id}">
        <div class="div-service-name">
            <span class="font-weight-bold">
                <b>{$service->product->productGroup->name}</b> - {$service->product->name}
            </span>
            <span class="text-domain">{$service->domain}</span>
        </div>
        
        <div class="div-service-status">
            <span class="label label-placeholder">
                {$statusProperties[array_key_first($statusProperties)]['translation']}
            </span>
            <span class="label label-{$statusProperties[$service->domainStatus]['modifier']}"
                title="{$statusProperties[$service->domainStatus]['translation']}">
                {$statusProperties[$service->domainStatus]['translation']}
            </span>
        </div>
        
        {if !empty($buttonData)}
            <div class="div-service-buttons">
                <button type="button" class="btn btn-default dropdown-toggle wdes-service-dropdown-btn" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">{$LANG.manage}</button>
                <ul class="dropdown-menu">
                    {foreach $buttonData as $buttonDatum}
                        <li class="dropdown-item btn-custom-action{if !$buttonDatum['active']} disabled{/if}"
                            data-serviceid="{$buttonDatum['serviceid']}" data-identifier="{$buttonDatum['identifier']}"
                            data-active="{$buttonDatum['active']}" {if !$buttonDatum['active']}disabled="disabled" {/if}>
                            <span class="loading" style="display: none;">
                                <i class="fas fa-spinner fa-spin"></i>
                            </span>
                            {$buttonDatum['display']}
                        </li>
                    {/foreach}
                    <li class="dropdown-item">{$LANG.manage}</li>
                </ul>
            </div>
        {else}
            <button class="btn btn-default wdes-service-dropdown-btn">{$LANG.manage}</button>
        {/if}
    </div>
{/if}