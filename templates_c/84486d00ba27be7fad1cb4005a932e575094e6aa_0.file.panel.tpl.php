<?php
/* Smarty version 3.1.48, created on 2025-10-28 21:14:44
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/six/includes/panel.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_6901243442d2d0_67132099',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '84486d00ba27be7fad1cb4005a932e575094e6aa' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/six/includes/panel.tpl',
      1 => 1748831468,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6901243442d2d0_67132099 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="panel panel-<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
">
    <?php if ((isset($_smarty_tpl->tpl_vars['headerTitle']->value))) {?>
        <div class="panel-heading">
            <h3 class="panel-title"><strong><?php echo $_smarty_tpl->tpl_vars['headerTitle']->value;?>
</strong></h3>
        </div>
    <?php }?>
    <?php if ((isset($_smarty_tpl->tpl_vars['bodyContent']->value))) {?>
        <div class="panel-body<?php if ((isset($_smarty_tpl->tpl_vars['bodyTextCenter']->value))) {?> text-center<?php }?>">
            <?php echo $_smarty_tpl->tpl_vars['bodyContent']->value;?>

        </div>
    <?php }?>
    <?php if ((isset($_smarty_tpl->tpl_vars['footerContent']->value))) {?>
        <div class="panel-footer<?php if ((isset($_smarty_tpl->tpl_vars['footerTextCenter']->value))) {?> text-center<?php }?>">
            <?php echo $_smarty_tpl->tpl_vars['footerContent']->value;?>

        </div>
    <?php }?>
</div>
<?php }
}
