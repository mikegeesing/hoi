<?php
/* Smarty version 3.1.48, created on 2025-10-28 22:19:08
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/six/clientareadomaingetepp.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_6901334c653302_00242285',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '72090955d05d4d94f5efbfc82910ec387272d5a9' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/six/clientareadomaingetepp.tpl',
      1 => 1748831468,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6901334c653302_00242285 (Smarty_Internal_Template $_smarty_tpl) {
?><h3><?php echo $_smarty_tpl->tpl_vars['LANG']->value['domaingeteppcode'];?>
</h3>

<p>
    <?php echo $_smarty_tpl->tpl_vars['LANG']->value['domaingeteppcodeexplanation'];?>

</p>

<br />

<?php if ($_smarty_tpl->tpl_vars['error']->value) {?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'msg'=>($_smarty_tpl->tpl_vars['LANG']->value['domaingeteppcodefailure']).(" ".((string)$_smarty_tpl->tpl_vars['error']->value))), 0, true);
} elseif ($_smarty_tpl->tpl_vars['eppcode']->value) {?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"warning",'msg'=>($_smarty_tpl->tpl_vars['LANG']->value['domaingeteppcodeis']).(" ".((string)$_smarty_tpl->tpl_vars['eppcode']->value))), 0, true);
} else { ?>
    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"warning",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['domaingeteppcodeemailconfirmation']), 0, true);
}
}
}
