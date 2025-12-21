<?php
/* Smarty version 3.1.48, created on 2025-11-03 20:02:49
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/password-reset-email-prompt.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_6908fc59916f83_07979654',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '791e626f3ffadd0cf0257f3ba0f4d1ffe9878605' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/password-reset-email-prompt.tpl',
      1 => 1761561846,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6908fc59916f83_07979654 (Smarty_Internal_Template $_smarty_tpl) {
?><p class="mb-3"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwresetemailneeded'];?>
</p>

<form method="post" action="<?php echo routePath('password-reset-validate-email');?>
" role="form">
    <input type="hidden" name="action" value="reset" />

    
        <!-- <label class="label" for="inputEmail"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['loginemail'];?>
</label> -->
        <input type="email" name="email" class="form-control mb-3" id="inputEmail" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['enteremail'];?>
" autofocus>
 

    <?php if ($_smarty_tpl->tpl_vars['captcha']->value->isEnabled()) {?>
        <div class="text-center margin-bottom">
            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/captcha.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
        </div>
    <?php }?>

        <div class="text-center justify-content-center d-flex">
        <button type="submit" class="btn-01 w-100 <?php echo $_smarty_tpl->tpl_vars['captcha']->value->getButtonClass($_smarty_tpl->tpl_vars['captchaForm']->value);?>
 mb-3">
            <?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwresetsubmit'];?>

        </button>
    </div>
  
</form>
<?php }
}
