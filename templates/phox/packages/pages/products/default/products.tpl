{include file="{$Phox['pages']['orderformPath']}/common.tpl"}

<div id="order-phox">

  <div class="header-lined">
    <h1>
      {if $productGroup.headline}
        {$productGroup.headline}
      {else}
        {$productGroup.name}
      {/if}
    </h1>
    {if $productGroup.tagline}
      <p>{$productGroup.tagline}</p>
    {/if}
  </div>
  {if $errormessage}
    <div class="alert alert-danger">
      {$errormessage}
    </div>
  {elseif !$productGroup}
    <div class="alert alert-info">
      {lang key='orderForm.selectCategory'}
    </div>
  {/if}

  <div class="row">
    <div class="cart-sidebar">
      {include file="{$Phox['pages']['orderformPath']}/sidebar-categories.tpl"}
    </div>
    <div class="cart-body wdes-phox-cart-body">

      {include file="{$Phox['pages']['orderformPath']}/sidebar-categories-collapsed.tpl"}

      <div class="products" id="products">
        <div class="wdes-phox-products-list">
          {foreach $products as $key => $product}
            {$idPrefix = ($product.bid) ? ("bundle"|cat:$product.bid) : ("product"|cat:$product.pid)}
            <div class="wdes-phox-products-list_item product clearfix {if $product.isFeatured}featured-product{/if}"
              id="{$idPrefix}">
              {if $product.isFeatured}<span class="featured-product-label d-flex align-center gap-5"><i
                    class="fad fa-star"></i>
                {$LANG.featuredProduct}</span>{/if}
              <header>
                <span class="product-name" id="{$idPrefix}-name">{$product.name}</span>
                {if $product.stockControlEnabled}
                  <span class="qty">
                    {$product.qty} {$LANG.orderavailable}
                  </span>
                {/if}
                <div class="product-pricing" id="{$idPrefix}-price">
                  {if $product.bid}
                    {$LANG.bundledeal}<br />
                    {if $product.displayprice}
                      <span class="price">{$product.displayprice}</span>
                    {/if}
                  {else}
                    {if $product.pricing.hasconfigoptions}
                      {$LANG.startingfrom}
                      <br />
                    {/if}
                    <span class="price">{$product.pricing.minprice.price}</span>
                    <br />
                    {if $product.pricing.minprice.cycle eq "monthly"}
                      {$LANG.orderpaymenttermmonthly}
                    {elseif $product.pricing.minprice.cycle eq "quarterly"}
                      {$LANG.orderpaymenttermquarterly}
                    {elseif $product.pricing.minprice.cycle eq "semiannually"}
                      {$LANG.orderpaymenttermsemiannually}
                    {elseif $product.pricing.minprice.cycle eq "annually"}
                      {$LANG.orderpaymenttermannually}
                    {elseif $product.pricing.minprice.cycle eq "biennially"}
                      {$LANG.orderpaymenttermbiennially}
                    {elseif $product.pricing.minprice.cycle eq "triennially"}
                      {$LANG.orderpaymenttermtriennially}
                    {/if}
                    <br>
                    {if $product.pricing.minprice.setupFee}
                      <small>{$product.pricing.minprice.setupFee->toPrefixed()} {$LANG.ordersetupfee}</small>
                    {/if}
                  {/if}
                </div>
              </header>
              <div class="product-desc">
                {if $product.featuresdesc}
                  <p id="{$idPrefix}-description">
                    {$product.featuresdesc}
                  </p>
                {/if}
                <ul>
                  {foreach $product.features as $feature => $value}
                    <li id="{$idPrefix}-feature{$value@iteration}">
                      <span class="feature-value">{$value}</span>
                      {$feature}
                    </li>
                  {/foreach}
                </ul>
              </div>
              <footer>
                <a href="{$product.productUrl}" class="btn btn-lg btn-primary btn-order-now" id="{$idPrefix}-order-button"
                  {if $product.hasRecommendations} data-has-recommendations="1" {/if}>
                  {$LANG.ordernowbutton}
                </a>
              </footer>
            </div>

          {/foreach}
        </div>
      </div>

      {if $productGroup}  
        {if count($productGroup.features) > 0}
            <div class="section mt-spacer-6x">
                <div class="section-header">
                    <h2 class="section-title">{$LANG.orderForm.includedWithPlans}</h2>
                </div>
                <div class="section-body">
                    <div class="panel panel-form">
                        <div class="panel-body">
                            <ul class="list-features list-info list-features--group">
                                {foreach $productGroup.features as $features}
                                    <li><i class="fas fa-check"></i><span>{$features.feature}<span></li>
                                {/foreach}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        {/if}
      {/if} 

    </div>
  </div>
</div>
{include file="{$Phox['pages']['orderformPath']}/recommendations-modal.tpl"}