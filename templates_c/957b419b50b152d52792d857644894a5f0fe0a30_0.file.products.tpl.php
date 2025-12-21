<?php
/* Smarty version 3.1.48, created on 2025-10-27 16:05:49
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/orderforms/Redcheap_Professional/products.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_68ff8a4d8e0af7_15490344',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '957b419b50b152d52792d857644894a5f0fe0a30' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/orderforms/Redcheap_Professional/products.tpl',
      1 => 1761561844,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:orderforms/Redcheap_Professional/common.tpl' => 1,
    'file:orderforms/Redcheap_Professional/sidebar-categories.tpl' => 1,
    'file:orderforms/Redcheap_Professional/sidebar-categories-collapsed.tpl' => 1,
    'file:orderforms/Redcheap_Professional/recommendations-modal.tpl' => 1,
  ),
),false)) {
function content_68ff8a4d8e0af7_15490344 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:orderforms/Redcheap_Professional/common.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<div id="order-standard_cart">
    <div class="row">
        <div class="cart-sidebar sidebar">
            <?php $_smarty_tpl->_subTemplateRender("file:orderforms/Redcheap_Professional/sidebar-categories.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        </div>
        <div class="cart-body">
         
            <div class="header-lined">
                <h2 class="font-size-22">
                    <?php if ($_smarty_tpl->tpl_vars['productGroup']->value['headline']) {?>
                        <?php echo $_smarty_tpl->tpl_vars['productGroup']->value['headline'];?>

                    <?php } else { ?>
                        <?php echo $_smarty_tpl->tpl_vars['productGroup']->value['name'];?>

                    <?php }?>
                </h2>
                <?php if ($_smarty_tpl->tpl_vars['productGroup']->value['tagline']) {?>
                    <p><?php echo $_smarty_tpl->tpl_vars['productGroup']->value['tagline'];?>
</p>
                <?php }?>
            </div>
            <?php if ($_smarty_tpl->tpl_vars['errormessage']->value) {?>
                <div class="alert alert-danger">
                    <?php echo $_smarty_tpl->tpl_vars['errormessage']->value;?>

                </div>
            <?php } elseif (!$_smarty_tpl->tpl_vars['productGroup']->value) {?>
                <div class="alert alert-info">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'orderForm.selectCategory'),$_smarty_tpl ) );?>

                </div>
            <?php }?>

           <?php $_smarty_tpl->_subTemplateRender("file:orderforms/Redcheap_Professional/sidebar-categories-collapsed.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

            <div class="products" id="products">
                <div class="row g-3 row-eq-height">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['products']->value, 'product', false, 'key');
$_smarty_tpl->tpl_vars['product']->iteration = 0;
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
$_smarty_tpl->tpl_vars['product']->iteration++;
$__foreach_product_0_saved = $_smarty_tpl->tpl_vars['product'];
?>
                        <?php $_smarty_tpl->_assignInScope('idPrefix', $_smarty_tpl->tpl_vars['product']->value['bid'] ? (("bundle").($_smarty_tpl->tpl_vars['product']->value['bid'])) : (("product").($_smarty_tpl->tpl_vars['product']->value['pid'])));?>
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="tt-single-product text-center px-3 py-5 my-3 tt-custom-radius clearfix" id="<?php echo $_smarty_tpl->tpl_vars['idPrefix']->value;?>
">
                            <?php if ($_smarty_tpl->tpl_vars['product']->value['isFeatured']) {?>
                                <div class="tt-featured-badge">
                                    <span class="badge"><?php echo mb_strtoupper($_smarty_tpl->tpl_vars['LANG']->value['featuredProduct'], 'UTF-8');?>
</span>
                                </div>
                            <?php }?>
                            <div class="tt-product-name">
                                <h5 id="<?php echo $_smarty_tpl->tpl_vars['idPrefix']->value;?>
-name"><?php echo $_smarty_tpl->tpl_vars['product']->value['name'];?>
</h5>
                            </div>
                            <div class="product-pricing tt-product-price mt-3" id="<?php echo $_smarty_tpl->tpl_vars['idPrefix']->value;?>
-price">
                                <span class="tt-cycle d-block text-muted">
                                    <?php if ($_smarty_tpl->tpl_vars['product']->value['bid']) {?>
                                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['bundledeal'];?>
<br />
                                        <?php if ($_smarty_tpl->tpl_vars['product']->value['displayprice']) {?>
                                            <span class="price"><?php echo $_smarty_tpl->tpl_vars['product']->value['displayprice'];?>
</span>
                                        <?php }?>
                                    <?php } else { ?>
                                    <?php if ($_smarty_tpl->tpl_vars['product']->value['pricing']['hasconfigoptions']) {?>
                                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['startingfrom'];?>

                                        <br />
                                    <?php }?>
                                </span>
                                    <span class="price"><?php echo $_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['price'];?>
</span>
                                    <br />
                                    <span class="text-muted mb-0 tt-cycle">
                                        <?php if ($_smarty_tpl->tpl_vars['product']->value['paytype'] == "free") {?>
                                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['freeText'];?>

                                        <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['paytype'] == "onetime") {?>
                                            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['oneTimeText'];?>

                                        <?php } else { ?>
                                            <?php if ($_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['cycle'] == "monthly") {?>
                                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpaymenttermmonthly'];?>

                                            <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['cycle'] == "quarterly") {?>
                                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpaymenttermquarterly'];?>

                                            <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['cycle'] == "semiannually") {?>
                                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpaymenttermsemiannually'];?>

                                            <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['cycle'] == "annually") {?>
                                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpaymenttermannually'];?>

                                            <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['cycle'] == "biennially") {?>
                                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpaymenttermbiennially'];?>

                                            <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['cycle'] == "triennially") {?>
                                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderpaymenttermtriennially'];?>

                                            <?php }?>
                                        <?php }?>
                                    </span>
                                    <br>
                                    <?php if ($_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['setupFee']) {?>
                                        <small class="text-muted d-inline-block bg-primary-light px-2 rounded mt-2"><strong><?php echo $_smarty_tpl->tpl_vars['product']->value['pricing']['minprice']['setupFee']->toPrefixed();?>
</strong> <?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordersetupfee'];?>
</small>
                                    <?php }?>
                                <?php }?>
                            </div>
                            <div>
                                <?php if ($_smarty_tpl->tpl_vars['product']->value['stockControlEnabled']) {?>
                                    <span class="qty text-muted small">
                                        <?php echo $_smarty_tpl->tpl_vars['product']->value['qty'];?>
 <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderavailable'];?>

                                    </span>
                                <?php }?>
                            </div>
                            <div class="product-desc py-3 tt-product-desc">
                                <?php if ($_smarty_tpl->tpl_vars['product']->value['featuresdesc']) {?>
                                    <div id="<?php echo $_smarty_tpl->tpl_vars['idPrefix']->value;?>
-description">
                                        <?php echo $_smarty_tpl->tpl_vars['product']->value['featuresdesc'];?>

                                    </div>
                                <?php }?>
                                <ul class="mb-0">
                                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['product']->value['features'], 'value', false, 'feature');
$_smarty_tpl->tpl_vars['value']->iteration = 0;
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['feature']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
$_smarty_tpl->tpl_vars['value']->iteration++;
$__foreach_value_1_saved = $_smarty_tpl->tpl_vars['value'];
?>
                                        <li id="<?php echo $_smarty_tpl->tpl_vars['idPrefix']->value;?>
-feature<?php echo $_smarty_tpl->tpl_vars['value']->iteration;?>
">
                                            <span class="feature-value"><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</span>
                                            <?php echo $_smarty_tpl->tpl_vars['feature']->value;?>

                                        </li>
                                    <?php
$_smarty_tpl->tpl_vars['value'] = $__foreach_value_1_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                </ul>
                            </div>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['product']->value['productUrl'];?>
" class="btn btn-primary btn-order-now" id="<?php echo $_smarty_tpl->tpl_vars['idPrefix']->value;?>
-order-button"<?php if ($_smarty_tpl->tpl_vars['product']->value['hasRecommendations']) {?> data-has-recommendations="1"<?php }?>>
                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordernowbutton'];?>

                            </a>
                        </div>
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['product']->iteration%3 == 0) {?>
                </div>
                <div class="row row-eq-height">
                    <?php }?>
                    <?php
$_smarty_tpl->tpl_vars['product'] = $__foreach_product_0_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </div>
            </div>

                        <?php if (count($_smarty_tpl->tpl_vars['productGroup']->value['features']) > 0) {?>
                <div class="row clearfix">
                    <div class="col-md-12">
                        <div class="tt-group-featured-wrap tt-custom-radius mt-4">
                            <h6 class="tt-group-head">
                                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['includedWithPlans'];?>

                            </h6>
                            <ul class="tt-group-features-list list-unstyled mb-0">
                                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['productGroup']->value['features'], 'features');
$_smarty_tpl->tpl_vars['features']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['features']->value) {
$_smarty_tpl->tpl_vars['features']->do_else = false;
?>
                                    <li><i class="fad fa-check"></i><?php echo $_smarty_tpl->tpl_vars['features']->value['feature'];?>
</li>
                                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php }?>
            
            <?php if ($_smarty_tpl->tpl_vars['group_product_feature_link']->value) {?>
                <?php $_smarty_tpl->_subTemplateRender("orderforms/Redcheap_Professional/".((string)$_smarty_tpl->tpl_vars['group_product_feature_link']->value), $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
            <?php }?>

        </div>
    </div>
</div>

<?php $_smarty_tpl->_subTemplateRender("file:orderforms/Redcheap_Professional/recommendations-modal.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
