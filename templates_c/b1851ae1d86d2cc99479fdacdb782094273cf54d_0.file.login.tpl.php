<?php
/* Smarty version 3.1.48, created on 2025-10-27 12:10:35
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_68ff532bd91614_96380857',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b1851ae1d86d2cc99479fdacdb782094273cf54d' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/login.tpl',
      1 => 1761563432,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68ff532bd91614_96380857 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- banner start -->
<section id="login" class="login-form form-account-page p-4 <?php if ($_smarty_tpl->tpl_vars['linkableProviders']->value) {?> with-social<?php }?>">
    <div class="container">
        <div class="row text-center">
            <div class="section-head gap-bottom center">
                <h2>Login Your Account</h2>
            </div>
        </div>
       
       <div class="row justify-content-center">
      <div class="col-lg-5 col-12">
        <form class="inner-form"  method="post" action="<?php echo routePath('login-validate');?>
">
          <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/flashmessage.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
                    <div class="providerLinkingFeedback"></div>
        <div class="login-content text-center">
          <input class="form-control mb-3" type="email" name="username" class="input" id="inputEmail" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['enteremail'];?>
" autofocus="required">
          <input class="form-control mb-3" type="password" name="password" class="input" id="inputPassword" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareapassword'];?>
" autocomplete="off" required>

          <div class="row align-items-center">
              <div class="col-sm-6 col-12 text-start mb-0">
                <div class=" mb-2">
                  <input class="form-checkbox m-0" id="check" type="checkbox" name="rememberme">
                  <label class="" for="check" style="line-height: 1;"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['loginrememberme'];?>
</label>
                </div>
              </div>
              <div class="col-sm-6 col-12 mb-2">
                <span class="d-block text-md-end text-start"><a class="Forget-pass another-link" href="<?php echo routePath('password-reset-begin');?>
">Forgot Password</a></span>
              </div>

            </div>
            <?php if ($_smarty_tpl->tpl_vars['captcha']->value->isEnabled()) {?>
            <div class="text-center margin-bottom">
              <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/captcha.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
          </div>
          <?php }?>

          <div class="text-center justify-content-center d-flex">
            <button type="submit" class="btn-01 w-100 <?php echo $_smarty_tpl->tpl_vars['captcha']->value->getButtonClass($_smarty_tpl->tpl_vars['captchaForm']->value);?>
" id="login" value="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['loginbutton'];?>
">Log In</button></div>

          <div class="for-signup mt-3">
              <span>Create an acocunt?</span> <a class="fw-5" href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/register.php">Register Now</a>
            </div>
        </div>
      </form>
       <div class="w-100<?php if (!$_smarty_tpl->tpl_vars['linkableProviders']->value) {?> hidden<?php }?>">
                    <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/linkedaccounts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('linkContext'=>"login",'customFeedback'=>true), 0, true);
?>
                </div>
            </div>
      </div>
    </div>
    </div>
</section>

<style type="text/css">
section#main-body {
  
   padding: 0px 0; 
 
}
</style><?php }
}
