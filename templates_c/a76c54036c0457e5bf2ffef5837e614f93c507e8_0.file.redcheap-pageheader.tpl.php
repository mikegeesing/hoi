<?php
/* Smarty version 3.1.48, created on 2025-10-27 11:57:30
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/includes/redcheap-pageheader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_68ff501a01fce5_21373006',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a76c54036c0457e5bf2ffef5837e614f93c507e8' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/includes/redcheap-pageheader.tpl',
      1 => 1761561847,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68ff501a01fce5_21373006 (Smarty_Internal_Template $_smarty_tpl) {
if (!in_array($_smarty_tpl->tpl_vars['templatefile']->value,array('login','clientregister','password-reset-container','logout','store/ox/index','store/sitelockvpn/index','store/sitelock/index'))) {?>
<div class="banner-one">
    <div class="banner-section">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-8">
                    <div class="banner-heading text-center">
                        <h1><?php if ($_smarty_tpl->tpl_vars['clientareaaction']->value === '' && $_smarty_tpl->tpl_vars['clientareaaction']->value !== NULL) {?>
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"My Dashboard"),$_smarty_tpl ) );?>

        <?php } else { ?>
        <?php echo $_smarty_tpl->tpl_vars['displayTitle']->value;?>

        <?php }?></h1><?php if ($_smarty_tpl->tpl_vars['tagline']->value) {?>
                        <p><?php echo $_smarty_tpl->tpl_vars['tagline']->value;?>
</p>
                        <?php }?>
                        <ol class="d-inline-block bg-transparent list-inline py-0 pl-0 w-100 text-center mt-3">
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['breadcrumb']->value, 'item', true);
$_smarty_tpl->tpl_vars['item']->iteration = 0;
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
$_smarty_tpl->tpl_vars['item']->iteration++;
$_smarty_tpl->tpl_vars['item']->last = $_smarty_tpl->tpl_vars['item']->iteration === $_smarty_tpl->tpl_vars['item']->total;
$__foreach_item_4_saved = $_smarty_tpl->tpl_vars['item'];
?>
          <li class="list-inline-item color-body breadcrumb-item<?php if ($_smarty_tpl->tpl_vars['item']->last) {?> active<?php }?>"> <?php if (!$_smarty_tpl->tpl_vars['item']->last) {?><a href="<?php echo $_smarty_tpl->tpl_vars['item']->value['link'];?>
" class="color-primary"><?php }?>
            <?php echo $_smarty_tpl->tpl_vars['item']->value['label'];?>

            <?php if (!$_smarty_tpl->tpl_vars['item']->last) {?></a> <?php }?> </li>
          <?php
$_smarty_tpl->tpl_vars['item'] = $__foreach_item_4_saved;
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
         </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }?>


<?php }
}
