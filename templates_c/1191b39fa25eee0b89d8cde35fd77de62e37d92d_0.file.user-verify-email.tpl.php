<?php
/* Smarty version 3.1.48, created on 2025-10-28 21:06:41
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/six/user-verify-email.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_690122515a76d8_27918349',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1191b39fa25eee0b89d8cde35fd77de62e37d92d' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/six/user-verify-email.tpl',
      1 => 1748831468,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690122515a76d8_27918349 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="text-center">
    <?php if ($_smarty_tpl->tpl_vars['success']->value) {?>
        <h2>
            <i class="fas fa-check fa-2x text-success"></i><br>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"emailVerification.success"),$_smarty_tpl ) );?>

        </h2>
    <?php } elseif ($_smarty_tpl->tpl_vars['expired']->value) {?>
        <h2>
            <i class="far fa-clock fa-2x text-warning"></i><br>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"emailVerification.expired"),$_smarty_tpl ) );?>

        </h2>

        <?php if ($_smarty_tpl->tpl_vars['loggedin']->value) {?>
            <button class="btn btn-default btn-lg btn-resend-verify-email" data-email-sent="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['emailSent'];?>
" data-error-msg="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['error'];?>
" data-uri="<?php echo routePath('user-email-verification-resend');?>
">
                <?php echo $_smarty_tpl->tpl_vars['LANG']->value['resendEmail'];?>

            </button>
        <?php } else { ?>
            <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"emailVerification.loginToRequest"),$_smarty_tpl ) );?>
</p>
        <?php }?>
    <?php } else { ?>
        <h2>
            <i class="fas fa-times fa-2x text-danger"></i><br>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"emailVerification.notFound"),$_smarty_tpl ) );?>

        </h2>

        <?php if (!$_smarty_tpl->tpl_vars['loggedin']->value) {?>
            <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"emailVerification.loginToRequest"),$_smarty_tpl ) );?>
</p>
        <?php }?>
    <?php }?>

    <br><br>

    <a href="<?php echo routePath('login-index');?>
" class="btn btn-primary btn-lg">
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>"orderForm.continueToClientArea"),$_smarty_tpl ) );?>

        &nbsp;
        <i class="fa fa-arrow-right"></i>
    </a>

    <br><br><br><br>
</div>
<?php }
}
