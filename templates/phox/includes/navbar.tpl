{if file_exists("templates/$template/packages/overwrites/includes/navbar.tpl")}
    {include file="{$template}/packages/overwrites/includes/navbar.tpl"}
{else}
    {foreach $navbar as $item}
        {if $item->isDisplayed()}
            <li menuItemName="{$item->getName()}"
                class="wdes-menu-item {if $item->hasChildren()}dropdown{/if}{if $item->getClass()} {$item->getClass()}{/if}" id="{$item->getId()}">
                {if $item->hasBodyHtml()}
                    {$item->getBodyHtml()}
                {else}
                    <a {if $item->hasChildren()}class="dropdown-toggle wdes-menu-item-link" data-toggle="dropdown" href="#" 
                    {else}class="wdes-menu-item-link" href="{$item->getUri()}"
                            {/if}{if $item->getAttribute('target')} target="{$item->getAttribute('target')}" {/if}>
                            {if $item->hasIcon()}<i class="{$item->getIcon()}"></i>{/if}
                            <span class="wdes-menu-item_content">{$item->getLabel()}</span>
                            {if $item->hasBadge()}&nbsp;<span class="badge">{$item->getBadge()}</span>{/if}
                            {if $item->hasChildren()}<i class="wdes-nav-menu-item_icon fas fa-chevron-down"></i>{/if}
                        </a>
                    {/if}
                    {if $item->hasChildren()}
                        <ul class="dropdown-menu">
                            {foreach $item->getChildren() as $childItem}
                                <li menuItemName="{$childItem->getName()}" {if $childItem->getClass()} class="{$childItem->getClass()}" {/if}
                                    id="{$childItem->getId()}">
                                    {if $childItem->hasBodyHtml()}
                                        {$childItem->getBodyHtml()}
                                    {else}
                                        <a href="{$childItem->getUri()}" {if $childItem->getAttribute('target')}
                                            target="{$childItem->getAttribute('target')}" {/if}>
                                            {if $childItem->hasIcon()}<i class="{$childItem->getIcon()}"></i>&nbsp;{/if}
                                            {$childItem->getLabel()}
                                            {if $childItem->hasBadge()}&nbsp;<span class="badge">{$childItem->getBadge()}</span>{/if}
                                        </a>
                                    {/if}
                                </li>
                            {/foreach}
                        </ul>
                    {/if}
                </li>
            {/if}
        {/foreach}
    {/if}