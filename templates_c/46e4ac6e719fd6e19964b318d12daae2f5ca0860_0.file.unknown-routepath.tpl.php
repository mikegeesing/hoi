<?php
/* Smarty version 3.1.48, created on 2025-10-28 01:39:08
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/six/error/unknown-routepath.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_690010acf27404_61716590',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '46e4ac6e719fd6e19964b318d12daae2f5ca0860' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/six/error/unknown-routepath.tpl',
      1 => 1748831468,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690010acf27404_61716590 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="alert alert-danger">
    <strong><i class="fas fa-times-circle"></i> Sorry, but the previous page (<a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['referrer']->value, ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['referrer']->value, ENT_QUOTES, 'UTF-8', true);?>
</a>) provided an invalid page link.</strong>
</div>
<?php }
}
