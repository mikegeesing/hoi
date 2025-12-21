{include file="{$Phox['pages']['orderformPath']}/common.tpl"}

<div id="order-phox">

    <div class="header-lined">
        <h1 class="font-size-36">{$LANG.cartproductaddons}</h1>
    </div>

    <div class="row">
        <div class="cart-body cart-body--full-width">

            {if count($addons) == 0}
                <div id="noAddons" class="alert alert-warning text-center" role="alert">
                    {$LANG.cartproductaddonsnone}
                </div>
                <p class="text-center">
                    <a href="{$WEB_ROOT}/clientarea.php" class="btn btn-default">
                        <i class="fas fa-arrow-circle-left"></i>
                        {$LANG.orderForm.returnToClientArea}
                    </a>
                </p>
            {/if}

            <div class="products">
                <div class="wdes-phox-products-list">
                    {foreach $addons as $num => $addon}
                        <div class="wdes-phox-products-list_item product clearfix" id="product{$num}">
                            <form method="post" action="{$smarty.server.PHP_SELF}?a=add" class="d-flex flex-column h-100">
                                <input type="hidden" name="aid" value="{$addon.id}" />
                                <header>
                                    <span class="product-name">{$addon.name}</span>
                                    <div class="product-pricing">
                                        {if $addon.free}
                                            {$LANG.orderfree}
                                        {else}
                                            <span class="price">{$addon.recurringamount}</span> <br> {$addon.billingcycle}
                                            {if $addon.setupfee}<br />+ {$addon.setupfee} {$LANG.ordersetupfee}{/if}
                                        {/if}
                                    </div>
                                </header>
                                <div class="product-desc product-desc-full-width">
                                    <p>{$addon.description|nl2br}</p>
                                    <div class="form-group">
                                        <select name="productid" id="inputProductId{$num}" class="field form-control">
                                            {foreach $addon.productids as $product}
                                                <option value="{$product.id}">
                                                    {$product.product}{if $product.domain} - {$product.domain}{/if}
                                                </option>
                                            {/foreach}
                                        </select>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                                <footer>
                                    <button type="submit" class="btn btn-primary btn-order-now">
                                        {$LANG.ordernowbutton}
                                    </button>
                                </footer>
                            </form>
                        </div>
                    {/foreach}
                </div>
            </div>
        </div>
    </div>
</div>