<?php
/* Smarty version 3.1.48, created on 2025-11-03 20:02:49
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/password-reset-container.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_6908fc5990f5f1_26511055',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '600cc3810a332954bd83f750ab38448a8f40071d' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/password-reset-container.tpl',
      1 => 1761561846,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6908fc5990f5f1_26511055 (Smarty_Internal_Template $_smarty_tpl) {
?><section id="reset" class="login-form">
    <div class="container rounded shadow p-4">
        <div class="row text-center">
            <div class="section-head gap-bottom center">
                <h2>Reset Your Password</h2>
            </div>
        </div>
       
       <div class="row justify-content-center">
      <div class="col-lg-5 col-12">
        <div class="login-content text-center">
          <?php if ($_smarty_tpl->tpl_vars['loggedin']->value && $_smarty_tpl->tpl_vars['innerTemplate']->value) {?>
                    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['noPasswordResetWhenLoggedIn'],'textcenter'=>true), 0, true);
?>
                <?php } else { ?>
                    <?php if ($_smarty_tpl->tpl_vars['successMessage']->value) {?>
                        <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"success",'msg'=>$_smarty_tpl->tpl_vars['successTitle']->value,'textcenter'=>true), 0, true);
?>
                        <p><?php echo $_smarty_tpl->tpl_vars['successMessage']->value;?>
</p>
                    <?php } else { ?>
                        <?php if ($_smarty_tpl->tpl_vars['errorMessage']->value) {?>
                            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'msg'=>$_smarty_tpl->tpl_vars['errorMessage']->value,'textcenter'=>true), 0, true);
?>
                        <?php }?>
            
                        <?php if ($_smarty_tpl->tpl_vars['innerTemplate']->value) {?>
                            <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/password-reset-".((string)$_smarty_tpl->tpl_vars['innerTemplate']->value).".tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                        <?php }?>
                    <?php }?>
                <?php }?>

          <div class="for-signup">
              <span>Create an acocunt?</span> <a class="fw-5" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/register.php">Register Now</a>
            </div>
        </div>
      </div>
    </div>
    </div>
</section>


<style>
    #main-body{
        padding: 0 !important;
    }
    .form-account-page .inner-form p {
	font-family: var(--font-theme-two);
	font-size: 16px;
	display: block;
	text-align: center;
	color: #7d7d7d;
  margin-bottom: 20px;
}

</style><?php }
}
