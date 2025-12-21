<?php
/* Smarty version 3.1.48, created on 2025-11-01 13:45:21
  from '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/clientregister.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.48',
  'unifunc' => 'content_690600e1e78eb3_26392095',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f192bbecd99a6b1f204de4e410edd07390e4a96b' => 
    array (
      0 => '/home/onlineh/domains/onlinehoster.nl/public_html/templates/closterv2/clientregister.tpl',
      1 => 1761561846,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690600e1e78eb3_26392095 (Smarty_Internal_Template $_smarty_tpl) {
if (in_array('state',$_smarty_tpl->tpl_vars['optionalFields']->value)) {
echo '<script'; ?>
>
    var statesTab = 10;
    var stateNotRequired = true;
<?php echo '</script'; ?>
>
<?php }?>

<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_JS']->value;?>
/StatesDropdown.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['BASE_PATH_JS']->value;?>
/PasswordStrength.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    window.langPasswordStrength = "<?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwstrength'];?>
";
    window.langPasswordWeak = "<?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwstrengthweak'];?>
";
    window.langPasswordModerate = "<?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwstrengthmoderate'];?>
";
    window.langPasswordStrong = "<?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwstrengthstrong'];?>
";
    jQuery(document).ready(function () {
        jQuery("#inputNewPassword1").keyup(registerFormPasswordStrengthFeedback);
    });
<?php echo '</script'; ?>
>
<?php if ($_smarty_tpl->tpl_vars['registrationDisabled']->value) {
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'msg'=>((((($_smarty_tpl->tpl_vars['LANG']->value['registerCreateAccount']).(' <strong><a href="')).("
        ".((string)$_smarty_tpl->tpl_vars['WEB_ROOT']->value))).('/cart.php" class="alert-link">')).($_smarty_tpl->tpl_vars['LANG']->value['registerCreateAccountOrder'])).('</a></strong>')), 0, true);
}?>

<?php if ($_smarty_tpl->tpl_vars['errormessage']->value) {
$_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/alert.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'errorshtml'=>$_smarty_tpl->tpl_vars['errormessage']->value), 0, true);
}?>

<?php if (!$_smarty_tpl->tpl_vars['registrationDisabled']->value) {?>
<div id="registration">
  <!-- banner start -->
  <section class=" login-form">
    <div class="container p-4">
      <div class="row text-center">
        <div class="section-head gap-bottom center">
          <h2>Register your Account</h2>
        </div>
      </div>

      <div class="row justify-content-center">

        <div class="col-lg-8 col-12">
          <div class="login-content">
            <form class="inner-form using-password-strength" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>
" role="form" name="orderfrm"
            id="frmCheckout">
            <input type="hidden" name="register" value="true" />
              <div class="row" id="containerNewUserSignup">
                <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/linkedaccounts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('linkContext'=>"registration"), 0, true);
?>

                <div class="col-md-6 col-12">
                  <label class="label" for="inputFirstName">First Name</label>
                  <input class="field input" type="text" name="firstname" id="inputFirstName"
                    placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['firstName'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientfirstname']->value;?>
" <?php if (!in_array('firstname',$_smarty_tpl->tpl_vars['optionalFields']->value)) {?>required<?php }?> autofocus>
                </div>

                <div class="col-md-6 col-12">
                  <label class="label" for="inputLastName">Last Name</label>
                  <input class="field input" name="lastname" id="inputLastName" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['lastName'];?>
"
                    value="<?php echo $_smarty_tpl->tpl_vars['clientlastname']->value;?>
" <?php if (!in_array('lastname',$_smarty_tpl->tpl_vars['optionalFields']->value)) {?>required<?php }?>>
                </div>

                <div class="col-md-6 col-12">
                  <label class="label" for="inputEmail">Enter Email</label>
                  <input class="field input" type="email" name="email" id="inputEmail"
                    placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['emailAddress'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientemail']->value;?>
">
                </div>

                <div class="col-md-6 col-12">
                  <div class="prepend-icon mobilenumber">
                    <label class="label" for="inputPhone">Enter Phone No.</label>
                    <input class="field input" type="tel" name="phonenumber" id="inputPhone"
                      placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['phoneNumber'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientphonenumber']->value;?>
">
                  </div>
                </div>


                <div class="col-12">
                  <label class="label" for="inputCompanyName">Company Name</label>
                  <input class="field input" type="text" name="companyname" id="inputCompanyName"
                    placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['companyName'];?>
 (<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['optional'];?>
)"
                    value="<?php echo $_smarty_tpl->tpl_vars['clientcompanyname']->value;?>
">
                </div>

                <div class="col-12">
                  <label class="label" for="inputCountry">Enter Country</label>
                  <select name="country" id="inputCountry" class="field input">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['clientcountries']->value, 'countryName', false, 'countryCode');
$_smarty_tpl->tpl_vars['countryName']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['countryCode']->value => $_smarty_tpl->tpl_vars['countryName']->value) {
$_smarty_tpl->tpl_vars['countryName']->do_else = false;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['countryCode']->value;?>
" <?php if ((!$_smarty_tpl->tpl_vars['clientcountry']->value && $_smarty_tpl->tpl_vars['countryCode']->value == $_smarty_tpl->tpl_vars['defaultCountry']->value) || ($_smarty_tpl->tpl_vars['countryCode']->value == $_smarty_tpl->tpl_vars['clientcountry']->value)) {?> selected="selected" <?php }?>>
                      <?php echo $_smarty_tpl->tpl_vars['countryName']->value;?>

                    </option>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  </select>
                </div>

                <div class="col-md-6 col-12">
                  <div class="prepend-icon">
                    <label for="state" class="d-none label" id="inputStateIcon">
                      Enter State
                    </label>
                    <label for="stateinput" class="label" id="inputStateIcon">
                      Enter State
                    </label>
                    <input type="text" name="state" id="state" class="field input" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['state'];?>
"
                      value="<?php echo $_smarty_tpl->tpl_vars['clientstate']->value;?>
" <?php if (!in_array('state',$_smarty_tpl->tpl_vars['optionalFields']->value)) {?>required<?php }?>>
                  </div>
                </div>

                <div class="col-md-6 col-12">
                  <label class="label" for="inputAddress1">Enter Address</label>
                  <input type="text" name="address1" id="inputAddress1" class="field input"
                    placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['streetAddress'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientaddress1']->value;?>
" <?php if (!in_array('address1',$_smarty_tpl->tpl_vars['optionalFields']->value)) {?>required<?php }?>>
                </div>

                <div class="col-md-6 col-12">
                  <label class="label" for="inputAddress2">Enter Street Address</label>
                  <input type="text" name="address2" id="inputAddress2" class="field input"
                    placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['streetAddress2'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientaddress2']->value;?>
">
                </div>

                <div class="col-md-6 col-12">
                  <label class="label" for="inputCity">Enter City</label>
                  <input type="text" name="city" id="inputCity" class="field input" placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['city'];?>
"
                    value="<?php echo $_smarty_tpl->tpl_vars['clientcity']->value;?>
" <?php if (!in_array('city',$_smarty_tpl->tpl_vars['optionalFields']->value)) {?>required<?php }?>>
                </div>

                

                <div class="col-12">
                  <label class="label" for="inputPostcode">Enter Zip Code</label>
                  <input class="field input" type="text" name="postcode" id="inputPostcode"
                    placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['postcode'];?>
" value="<?php echo $_smarty_tpl->tpl_vars['clientpostcode']->value;?>
" <?php if (!in_array('postcode',$_smarty_tpl->tpl_vars['optionalFields']->value)) {?>required<?php }?>>
                </div>

                
                <?php if ($_smarty_tpl->tpl_vars['showTaxIdField']->value) {?>
                <div class="col-12">
                  <label class="label" for="inputTaxId">Enter Taxid</label>
                  <input type="text" name="tax_id" id="inputTaxId" class="field input"
                    placeholder="<?php echo $_smarty_tpl->tpl_vars['taxLabel']->value;?>
 (<?php echo $_smarty_tpl->tpl_vars['LANG']->value['orderForm']['optional'];?>
)" value="<?php echo $_smarty_tpl->tpl_vars['clientTaxId']->value;?>
">
                </div>

                <?php }?>



                <?php if ($_smarty_tpl->tpl_vars['customfields']->value || $_smarty_tpl->tpl_vars['currencies']->value) {?>

                <?php if ($_smarty_tpl->tpl_vars['customfields']->value) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customfields']->value, 'customfield');
$_smarty_tpl->tpl_vars['customfield']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['customfield']->value) {
$_smarty_tpl->tpl_vars['customfield']->do_else = false;
?>
                <div class="col-12">
                  <label class="label" for="customfield<?php echo $_smarty_tpl->tpl_vars['customfield']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['customfield']->value['name'];?>

                    <?php echo $_smarty_tpl->tpl_vars['customfield']->value['required'];?>
</label>
                  <div class="control">
                    <?php echo $_smarty_tpl->tpl_vars['customfield']->value['input'];?>

                    <?php if ($_smarty_tpl->tpl_vars['customfield']->value['description']) {?>
                    <span class="field-help-text"><?php echo $_smarty_tpl->tpl_vars['customfield']->value['description'];?>
</span>
                    <?php }?>
                  </div>
                </div>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['customfields']->value && count($_smarty_tpl->tpl_vars['customfields']->value)%2 > 0) {?>
                <div class="clearfix"></div>
                <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['currencies']->value) {?>
                <div class="col-12">
                  <label class="label" for="inputCurrency">Enter Currency</label>
                  <select id="inputCurrency" name="currency" class="field input">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['currencies']->value, 'curr');
$_smarty_tpl->tpl_vars['curr']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['curr']->value) {
$_smarty_tpl->tpl_vars['curr']->do_else = false;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['curr']->value['id'];?>
" <?php if (!$_POST['currency'] && $_smarty_tpl->tpl_vars['curr']->value['default'] || $_POST['currency'] == $_smarty_tpl->tpl_vars['curr']->value['id']) {?> selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['curr']->value['code'];?>
</option>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  </select>
                </div>
                <?php }?>

                <?php }?>



              </div>




              <div id="containerNewUserSecurity" <?php if ($_smarty_tpl->tpl_vars['remote_auth_prelinked']->value && !$_smarty_tpl->tpl_vars['securityquestions']->value) {?> class="hidden"
                <?php }?>>

                <div id="containerPassword" class="row mt-3 <?php if ($_smarty_tpl->tpl_vars['remote_auth_prelinked']->value && $_smarty_tpl->tpl_vars['securityquestions']->value) {?> hidden<?php }?>">
                  <div id="passwdFeedback" style="display: none;" class="alert alert-info text-center w-100"></div>
                  <div class="col-md-6">
                    <label class="label" for="inputNewPassword1">Enter Password</label>
                    <input type="password" name="password" id="inputNewPassword1"
                      data-error-threshold="<?php echo $_smarty_tpl->tpl_vars['pwStrengthErrorThreshold']->value;?>
"
                      data-warning-threshold="<?php echo $_smarty_tpl->tpl_vars['pwStrengthWarningThreshold']->value;?>
" class="field input"
                      placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareapassword'];?>
" autocomplete="off" <?php if ($_smarty_tpl->tpl_vars['remote_auth_prelinked']->value) {?>
                      value="<?php echo $_smarty_tpl->tpl_vars['password']->value;?>
" <?php }?>>
                  </div>
                  <div class="col-md-6">

                    <label class="label" for="inputNewPassword2">Confirm Password</label>
                    <input type="password" name="password2" id="inputNewPassword2" class="field input"
                      placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareaconfirmpassword'];?>
" autocomplete="off" <?php if ($_smarty_tpl->tpl_vars['remote_auth_prelinked']->value) {?>
                      value="<?php echo $_smarty_tpl->tpl_vars['password']->value;?>
" <?php }?>>
                  </div>
                  <div class="col-md-12">

                    <button type="button" class="btn btn-primary btn-sm btn-xs-block generate-password"
                      data-targetfields="inputNewPassword1,inputNewPassword2">
                      <?php echo $_smarty_tpl->tpl_vars['LANG']->value['generatePassword']['btnLabel'];?>

                    </button>
                  </div>
                  <div class="col-md-12">

                    <div class="password-strength-meter w-100 mt-3">
                      <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
                          aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="passwordStrengthMeterBar">
                        </div>
                      </div>
                      <p class="small text-muted" id="passwordStrengthTextLabel"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwstrength'];?>
:
                        <?php echo $_smarty_tpl->tpl_vars['LANG']->value['pwstrengthenter'];?>
</p>
                    </div>
                  </div>
                </div>

                <?php if ($_smarty_tpl->tpl_vars['securityquestions']->value) {?>


                <div class="col-md-6">

                  <label class="label" for="inputSecurityQId">Security Question</label>

                  <select name="securityqid" id="inputSecurityQId" class="field input">
                    <option value=""><?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareasecurityquestion'];?>
</option>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['securityquestions']->value, 'question');
$_smarty_tpl->tpl_vars['question']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['question']->value) {
$_smarty_tpl->tpl_vars['question']->do_else = false;
?>
                    <option value="<?php echo $_smarty_tpl->tpl_vars['question']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['question']->value['id'] == $_smarty_tpl->tpl_vars['securityqid']->value) {?> selected<?php }?>>
                      <?php echo $_smarty_tpl->tpl_vars['question']->value['question'];?>

                    </option>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  </select>
                </div>
                <div class="col-md-6">


                  <label class="label" for="inputSecurityQAns">Enter Ans.</label>
                  <input type="password" name="securityqans" id="inputSecurityQAns" class="field input"
                    placeholder="<?php echo $_smarty_tpl->tpl_vars['LANG']->value['clientareasecurityanswer'];?>
" autocomplete="off">
                </div>
                <?php }?>


              </div>

              <?php if ($_smarty_tpl->tpl_vars['showMarketingEmailOptIn']->value) {?>
              <div class="col-12 px-0">
                <div class="marketing-email-optin">
                  <h6><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'emailMarketing.joinOurMailingList'),$_smarty_tpl ) );?>
</h6>
                  <p><?php echo $_smarty_tpl->tpl_vars['marketingEmailOptInMessage']->value;?>
</p>
                  <input type="checkbox" name="marketingoptin" value="1" <?php if ($_smarty_tpl->tpl_vars['marketingEmailOptIn']->value) {?> checked<?php }?>
                    class="no-icheck toggle-switch-success" data-size="small" data-on-text="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'yes'),$_smarty_tpl ) );?>
"
                    data-off-text="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['lang'][0], array( array('key'=>'no'),$_smarty_tpl ) );?>
">
                </div>
              </div>
              <?php }?>

              <?php $_smarty_tpl->_subTemplateRender(((string)$_smarty_tpl->tpl_vars['template']->value)."/includes/captcha.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>

              <?php if ($_smarty_tpl->tpl_vars['accepttos']->value) {?>

              <div class="row align-items-center gy-2 gy-md-0">
                <div class="col-12">
                  <div class="d-flex align-items-center">
                    <input class="form-checkbox mt-0" type="checkbox" name="accepttos" id="accepttos">
                    <label class="mx-2 mb-0" style="line-height: 1;" for="accepttos"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordertosagreement'];?>
 <a
                        href="<?php echo $_smarty_tpl->tpl_vars['tosurl']->value;?>
" target="_blank" style="color: var(--primary);"><?php echo $_smarty_tpl->tpl_vars['LANG']->value['ordertos'];?>
</a></label>
                  </div>
                </div>

              </div>
              <?php }?>

              <button class="btn-01 w-100 text-center mt-3 <?php echo $_smarty_tpl->tpl_vars['captcha']->value->getButtonClass($_smarty_tpl->tpl_vars['captchaForm']->value);?>
" type="submit">
                Register Now </button>
              <span class="next-link text-start"><a href="<?php echo $_smarty_tpl->tpl_vars['WEB_ROOT']->value;?>
/login.php"><i class="ri-arrow-left-line"></i>
                  Back</a></span>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<style>
  #main-body {
    padding: 0 !important;
  }

  #registration {
    padding: 0 !important;
  }

  #registration .label{
    padding: 0;
    margin-bottom: 5px;
    display: block;
    text-align: start;
  }

  #registration select.field{
    padding: 10px 15px;
  }

  .highlight:after {
    content: unset;
  }
</style>
<?php }
}
}
