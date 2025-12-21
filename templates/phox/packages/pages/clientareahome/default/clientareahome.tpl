{include file="$template/includes/flashmessage.tpl"}

{foreach from=$addons_html item=addon_html}
  <div class="wdes-phox-hooks-area-clientarea">
    {$addon_html}
  </div>
{/foreach}

<div class="tiles">
  <div class="tile" onclick="window.location='clientarea.php?action=services'">
    <a href="clientarea.php?action=services">
      <div class="icon"><i class="fad fa-cube"></i></div>
      <div class="stat">{$clientsstats.productsnumactive}</div>
      <div class="title">{$LANG.navservices}</div>
    </a>
  </div>
  {if $clientsstats.numdomains || $registerdomainenabled || $transferdomainenabled}
    <div class="tile" onclick="window.location='clientarea.php?action=domains'">
      <a href="clientarea.php?action=domains">
        <div class="icon"><i class="fad fa-globe"></i></div>
        <div class="stat">{$clientsstats.numactivedomains}</div>
        <div class="title">{$LANG.navdomains}</div>
      </a>
    </div>
  {elseif $condlinks.affiliates && $clientsstats.isAffiliate}
    <div class="tile" onclick="window.location='affiliates.php'">
      <a href="affiliates.php">
        <div class="icon"><i class="fad fa-shopping-cart"></i></div>
        <div class="stat">{$clientsstats.numaffiliatesignups}</div>
        <div class="title">{$LANG.affiliatessignups}</div>
      </a>
    </div>
  {else}
    <div class="tile" onclick="window.location='clientarea.php?action=quotes'">
      <a href="clientarea.php?action=quotes">
        <div class="icon"><i class="far fa-file-alt"></i></div>
        <div class="stat">{$clientsstats.numquotes}</div>
        <div class="title">{$LANG.quotes}</div>
      </a>
    </div>
  {/if}
  <div class="tile" onclick="window.location='supporttickets.php'">
    <a href="supporttickets.php">
      <div class="icon"><i class="fad fa-comments"></i></div>
      <div class="stat">{$clientsstats.numactivetickets}</div>
      <div class="title">{$LANG.navtickets}</div>
    </a>
  </div>
  <div class="tile" onclick="window.location='clientarea.php?action=invoices'">
    <a href="clientarea.php?action=invoices">
      <div class="icon"><i class="fad fa-credit-card"></i></div>
      <div class="stat">{$clientsstats.numunpaidinvoices}</div>
      <div class="title">{$LANG.navinvoices}</div>
    </a>
  </div>
</div>

{if $captchaError}
    <div class="alert alert-danger">
        {$captchaError}
    </div>
{/if}

<div class="client-home-panels">
  <div class="row">
    <div class="col-sm-12">

      {function name=outputHomePanels}
        <div menuItemName="{$item->getName()}" class="panel {if $item->getClass()} {$item->getClass()}{/if}"
          {if $item->getAttribute('id')} id="{$item->getAttribute('id')}" {/if}>
          <div class="panel-heading">
            <h3 class="panel-title">
              {$item->getLabel()}
              {if $item->hasIcon()}<i class="{$item->getIcon()}"></i>{/if}
              {if $item->hasBadge()}&nbsp;<span class="badge">{$item->getBadge()}</span>{/if}
            </h3>
          </div>
          {if $item->hasBodyHtml()}
            <div class="panel-body">
              {$item->getBodyHtml()}
            </div>
          {/if}
          {if $item->hasChildren()}
            <div class="list-group{if $item->getChildrenAttribute('class')} {$item->getChildrenAttribute('class')}{/if}">
              {foreach $item->getChildren() as $childItem}
                {if $childItem->getUri()}
                  <a menuItemName="{$childItem->getName()}" href="{$childItem->getUri()}"
                    class="list-group-item{if $childItem->getClass()} {$childItem->getClass()}{/if}{if $childItem->isCurrent()} active{/if}"
                    {if $childItem->getAttribute('dataToggleTab')} data-toggle="tab"
                      {/if}{if $childItem->getAttribute('target')} target="{$childItem->getAttribute('target')}" {/if}
                      id="{$childItem->getId()}">
                      {if $childItem->hasIcon()}<i class="{$childItem->getIcon()}"></i>&nbsp;{/if}
                      {$childItem->getLabel()}
                      {if $childItem->hasBadge()}&nbsp;<span class="badge">{$childItem->getBadge()}</span>{/if}
                    </a>
                  {else}
                    <div menuItemName="{$childItem->getName()}"
                      class="list-group-item{if $childItem->getClass()} {$childItem->getClass()}{/if}" id="{$childItem->getId()}">
                      {if $childItem->hasIcon()}<i class="{$childItem->getIcon()}"></i>&nbsp;{/if}
                      {$childItem->getLabel()}
                      {if $childItem->hasBadge()}&nbsp;<span class="badge">{$childItem->getBadge()}</span>{/if}
                    </div>
                  {/if}
                {/foreach}
              </div>
            {/if}
            <div class="panel-footer">
              {if $item->hasFooterHtml()}
                {$item->getFooterHtml()}
              {/if}
            </div>
          </div>
        {/function}

        {foreach $panels as $item}
          {if $item->getExtra('colspan')}
            {outputHomePanels}
            {assign "panels" $panels->removeChild($item->getName())}
          {/if}
        {/foreach}

      </div>
      <div class="col-sm-6">

        {foreach $panels as $item}
          {if $item@iteration is odd}
            {outputHomePanels}
          {/if}
        {/foreach}

      </div>
      <div class="col-sm-6">

        {foreach $panels as $item}
          {if $item@iteration is even}
            {outputHomePanels}
          {/if}
        {/foreach}

      </div>
    </div>
  </div>

  {include file="$template/wdes/js/functions.tpl"}