<?php
/* Smarty version 3.1.48, created on 2025-12-21 16:08:32
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/contact.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_69481b80158d55_25442747',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '610aaa04a9a7f102333d05639434dac79c583934' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/contact.tpl',
      1 => 1766331717,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69481b80158d55_25442747 (Smarty_Internal_Template $_smarty_tpl) {
if ($_smarty_tpl->tpl_vars['sent']->value) {?> <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"success",'msg'=>$_smarty_tpl->tpl_vars['LANG']->value['contactsent'],'textcenter'=>true), 0, true);
?> <?php }?> <?php if ($_smarty_tpl->tpl_vars['errormessage']->value) {?> <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'errorshtml'=>$_smarty_tpl->tpl_vars['errormessage']->value), 0, true);
?> <?php }?> <?php if (!$_smarty_tpl->tpl_vars['sent']->value) {?>
<!-- banner start -->
<div class="banner-one">
  <div class="banner-section bottom-up">
    <div class="container">
      <div class="row align-items-center justify-content-between">
        <div class="col-lg-6">
          <div class="banner-heading">
            <h1>
              <span class="hrline"> Contact!</span> Stuur ons een bericht. We zijn hier.
            </h1>
            <ul class="banner-list mb-2">
              <li>Vind de sectie 'Contact met ons'</li>
              <li>Vul het formulier in</li>
              <li>Dien je vraag in</li>
              <li>Wacht op ons snelle antwoord</li>
            </ul>
            <div class="inline-btns mt-3">
              <a class="btn-01" onclick="document.getElementById('contact').scrollIntoView();">Bekijk plannen</a>
            </div>
          </div>
        </div>
        <div class="col-lg-5 d-none d-lg-block">
          <div class="text-center text-lg-end">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/32.svg" alt="Banner image" width="400">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="top-up-banner pb-4" id="contact">
  <div class="container upside rounded bg-white shadow p-4">
    <div class="row text-center">
      <div class="section-head gap-bottom center">
        <h2>Neem contact met ons op</h2>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-lg-8 ">
        <form method="post" action="contact.php" role="form" class="php-email-form form">
          <input type="hidden" name="action" value="send" />
          <div class="contact-form">
            <div class="row justify-content-between g-4">
              <div class="col-lg-6">
                <input class="input form-control" type="text" name="name" value="<?php echo $_smarty_tpl->tpl_vars['name']->value;?>
" id="inputName" placeholder="Voer naam in">
              </div>
              <div class="col-lg-6">
                <input class="input form-control" id="inputEmail" type="email" name="email" value="<?php echo $_smarty_tpl->tpl_vars['email']->value;?>
" placeholder="Voer e-mail in">
              </div>
              <div class="col-12">
                <input class="input form-control" type="subject" name="subject" value="<?php echo $_smarty_tpl->tpl_vars['subject']->value;?>
" id="inputSubject" placeholder="onderwerp">
              </div>
              <div class="col-12">
                <textarea class="input form-control" name="message" rows="7" style="height:unset;" id="inputMessage" placeholder="Voer bericht in"></textarea>
              </div> <?php if ($_smarty_tpl->tpl_vars['captcha']->value) {?> <div class="text-center margin-bottom col-12"> <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/captcha.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?> </div> <?php }?> <div class="col-12">
                <button class="btn-01 mt-4 <?php echo $_smarty_tpl->tpl_vars['captcha']->value->getButtonClass($_smarty_tpl->tpl_vars['captchaForm']->value);?>
" type="submit"> Submit Comment </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<section class="section-gap">
  <div class="container">
    <div class="row gy-4">
      <div class="col-lg-4 col-md-6 col-12">
        <div class="services-one">
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/home_address.png" alt="services icon">
          </div>
          <h4>Adres</h4>
          <p>Online Hoster, Nederland</p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="services-one">
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/mail.png" alt="services icon">
          </div>
          <h4>E-mail</h4>
          <p><a href="mailto:Sales@onlinehoster.nl">Sales@onlinehoster.nl</a> <br><a href="mailto:Support@onlinehoster.nl">Support@onlinehoster.nl</a> </p>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
        <div class="services-one">
          <div class="icon">
            <img src="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/templates/<?php echo $_smarty_tpl->tpl_vars['template']->value;?>
/custom/assets/images/helpdesk.png" alt="services icon">
          </div>
          <h4>Telefoon</h4>
          <p>Contacteer via e-mail <br>voor snel antwoord </p>
        </div>
      </div>
    </div>
  </div>
</section> <?php }?> <style>
  #main-body {
    background-color: #ffffff !important;
    padding: 0 !important;
  }

  label {
    font-weight: 500;
  }
</style><?php }
}
