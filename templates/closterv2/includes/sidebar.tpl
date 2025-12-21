{foreach $sidebar as $item}
<div class="sidebar">
    <div menuItemName="{$item->getName()}" class="card card-sidebar mb-3 {if $item->getClass()}{$item->getClass()}{else}card-sidebar mb-3{/if}{if $item->getExtra('mobileSelect') and $item->hasChildren()} hidden-sm hidden-xs{/if}"{if $item->getAttribute('id')} id="{$item->getAttribute('id')}"{/if}>
        <div class="card-header">
            <h3 class="card-title mb-0">
                {if $item->hasIcon()}<i class="{$item->getIcon()}"></i>&nbsp;{/if}
                {$item->getLabel()}
                {if $item->hasBadge()}&nbsp;<span class="badge">{$item->getBadge()}</span>{/if}
                <i class="fas fa-chevron-up card-minimise pull-right"></i>
            </h3>
        </div>
        {if $item->hasBodyHtml()}
            <div class="collapsable-card-body">
            <div class="card-body">
                {$item->getBodyHtml()}
            </div>
        </div>
        {/if}
        {if $item->hasChildren()}
        <div class="collapsable-card-body ">
            <div class="list-group list-group-flush d-md-flex{if $item->getChildrenAttribute('class')} {$item->getChildrenAttribute('class')}{/if}">
                {foreach $item->getChildren() as $childItem}
                    {if $childItem->getUri()}
                        <a menuItemName="{$childItem->getName()}"
                           href="{$childItem->getUri()}"
                           class="list-group-item list-group-item-action{if $childItem->isDisabled()} disabled{/if}{if $childItem->getClass()} {$childItem->getClass()}{/if}{if $childItem->isCurrent()} active{/if}"
                           {if $childItem->getAttribute('dataToggleTab')}
                               data-toggle="tab"
                           {/if}
                           {assign "customActionData" $childItem->getAttribute('dataCustomAction')}
                           {if is_array($customActionData)}
                               data-active="{$customActionData['active']}"
                               data-identifier="{$customActionData['identifier']}"
                               data-serviceid="{$customActionData['serviceid']}"
                           {/if}
                           {if $childItem->getAttribute('target')}
                               target="{$childItem->getAttribute('target')}"
                           {/if}
                           id="{$childItem->getId()}"
                        >
                            {if $childItem->hasBadge()}<span class="badge">{$childItem->getBadge()}</span>{/if}
                            {if is_array($customActionData)}<span class="loading" style="display: none;"><i class="fas fa-spinner fa-spin"></i></span>{/if}
                            {if $childItem->hasIcon()}<i class="{$childItem->getIcon()} sidebar-menu-item-icon"></i>{/if}
                            {$childItem->getLabel()}
                        </a>
                    {else}
                        <div menuItemName="{$childItem->getName()}" class="list-group-item list-group-item-action{if $childItem->getClass()} {$childItem->getClass()}{/if}" id="{$childItem->getId()}">
                            {if $childItem->hasBadge()}<span class="badge">{$childItem->getBadge()}</span>{/if}
                            {if $childItem->hasIcon()}<i class="{$childItem->getIcon()}"></i>&nbsp;{/if}
                            {$childItem->getLabel()}
                        </div>
                    {/if}
                {/foreach}
            </div>
        </div>     
        {/if}
        {if $item->hasFooterHtml()}
            <div class="card-footer clearfix">
                {$item->getFooterHtml()}
            </div>
        {/if}
    </div>
</div>
    {if $item->getExtra('mobileSelect') and $item->hasChildren()}
        {* Mobile Select only supports dropdown menus *}
        <div class="sidevar">
        <div class="card hidden-lg hidden-md {if $item->getClass()}{$item->getClass()}{else}card-default{/if}"{if $item->getAttribute('id')} id="{$item->getAttribute('id')}"{/if}>
            <div class="card-header">
                <h3 class="card-title mb-0">
                    {if $item->hasIcon()}<i class="{$item->getIcon()}"></i>&nbsp;{/if}
                    {$item->getLabel()}
                    {if $item->hasBadge()}&nbsp;<span class="badge">{$item->getBadge()}</span>{/if}
                </h3>
            </div>
            <div class="collapsable-card-body">
            <div class="card-body">
                <form role="form">
                    <select class="form-control" onchange="selectChangeNavigate(this)">
                        {foreach $item->getChildren() as $childItem}
                            <option menuItemName="{$childItem->getName()}" value="{$childItem->getUri()}" class="list-group-item" {if $childItem->isCurrent()}selected="selected"{/if}>
                                {$childItem->getLabel()}
                                {if $childItem->hasBadge()}({$childItem->getBadge()}){/if}
                            </option>
                        {/foreach}
                    </select>
                </form>
            </div>
        </div>
            {if $item->hasFooterHtml()}
                <div class="card-footer">
                    {$item->getFooterHtml()}
                </div>
            {/if}
        </div>
    </div>
    {/if}
{/foreach}
