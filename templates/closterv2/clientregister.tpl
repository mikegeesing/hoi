{if in_array('state', $optionalFields)}
<script>
    var statesTab = 10;
    var stateNotRequired = true;
</script>
{/if}

<script type="text/javascript" src="{$BASE_PATH_JS}/StatesDropdown.js"></script>
<script type="text/javascript" src="{$BASE_PATH_JS}/PasswordStrength.js"></script>
<script>
    window.langPasswordStrength = "{$LANG.pwstrength}";
    window.langPasswordWeak = "{$LANG.pwstrengthweak}";
    window.langPasswordModerate = "{$LANG.pwstrengthmoderate}";
    window.langPasswordStrong = "{$LANG.pwstrengthstrong}";
    jQuery(document).ready(function () {
        jQuery("#inputNewPassword1").keyup(registerFormPasswordStrengthFeedback);
    });
</script>
{if $registrationDisabled}
{include file="$template/includes/alert.tpl" type="error" msg=$LANG.registerCreateAccount|cat:' <strong><a href="'|cat:"
        $WEB_ROOT"|cat:'/cart.php" class="alert-link">'|cat:$LANG.registerCreateAccountOrder|cat:'</a></strong>'}
{/if}

{if $errormessage}
{include file="$template/includes/alert.tpl" type="error" errorshtml=$errormessage}
{/if}

{if !$registrationDisabled}
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
            <form class="inner-form using-password-strength" method="post" action="{$smarty.server.PHP_SELF}" role="form" name="orderfrm"
            id="frmCheckout">
            <input type="hidden" name="register" value="true" />
              <div class="row" id="containerNewUserSignup">
                {include file="$template/includes/linkedaccounts.tpl" linkContext="registration"}

                <div class="col-md-6 col-12">
                  <label class="label" for="inputFirstName">First Name</label>
                  <input class="field input" type="text" name="firstname" id="inputFirstName"
                    placeholder="{$LANG.orderForm.firstName}" value="{$clientfirstname}" {if !in_array('firstname',
                    $optionalFields)}required{/if} autofocus>
                </div>

                <div class="col-md-6 col-12">
                  <label class="label" for="inputLastName">Last Name</label>
                  <input class="field input" name="lastname" id="inputLastName" placeholder="{$LANG.orderForm.lastName}"
                    value="{$clientlastname}" {if !in_array('lastname', $optionalFields)}required{/if}>
                </div>

                <div class="col-md-6 col-12">
                  <label class="label" for="inputEmail">Enter Email</label>
                  <input class="field input" type="email" name="email" id="inputEmail"
                    placeholder="{$LANG.orderForm.emailAddress}" value="{$clientemail}">
                </div>

                <div class="col-md-6 col-12">
                  <div class="prepend-icon mobilenumber">
                    <label class="label" for="inputPhone">Enter Phone No.</label>
                    <input class="field input" type="tel" name="phonenumber" id="inputPhone"
                      placeholder="{$LANG.orderForm.phoneNumber}" value="{$clientphonenumber}">
                  </div>
                </div>


                <div class="col-12">
                  <label class="label" for="inputCompanyName">Company Name</label>
                  <input class="field input" type="text" name="companyname" id="inputCompanyName"
                    placeholder="{$LANG.orderForm.companyName} ({$LANG.orderForm.optional})"
                    value="{$clientcompanyname}">
                </div>

                <div class="col-12">
                  <label class="label" for="inputCountry">Enter Country</label>
                  <select name="country" id="inputCountry" class="field input">
                    {foreach $clientcountries as $countryCode => $countryName}
                    <option value="{$countryCode}" {if (!$clientcountry && $countryCode eq $defaultCountry) ||
                      ($countryCode eq $clientcountry)} selected="selected" {/if}>
                      {$countryName}
                    </option>
                    {/foreach}
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
                    <input type="text" name="state" id="state" class="field input" placeholder="{$LANG.orderForm.state}"
                      value="{$clientstate}" {if !in_array('state', $optionalFields)}required{/if}>
                  </div>
                </div>

                <div class="col-md-6 col-12">
                  <label class="label" for="inputAddress1">Enter Address</label>
                  <input type="text" name="address1" id="inputAddress1" class="field input"
                    placeholder="{$LANG.orderForm.streetAddress}" value="{$clientaddress1}" {if !in_array('address1',
                    $optionalFields)}required{/if}>
                </div>

                <div class="col-md-6 col-12">
                  <label class="label" for="inputAddress2">Enter Street Address</label>
                  <input type="text" name="address2" id="inputAddress2" class="field input"
                    placeholder="{$LANG.orderForm.streetAddress2}" value="{$clientaddress2}">
                </div>

                <div class="col-md-6 col-12">
                  <label class="label" for="inputCity">Enter City</label>
                  <input type="text" name="city" id="inputCity" class="field input" placeholder="{$LANG.orderForm.city}"
                    value="{$clientcity}" {if !in_array('city', $optionalFields)}required{/if}>
                </div>

                

                <div class="col-12">
                  <label class="label" for="inputPostcode">Enter Zip Code</label>
                  <input class="field input" type="text" name="postcode" id="inputPostcode"
                    placeholder="{$LANG.orderForm.postcode}" value="{$clientpostcode}" {if !in_array('postcode',
                    $optionalFields)}required{/if}>
                </div>

                
                {if $showTaxIdField}
                <div class="col-12">
                  <label class="label" for="inputTaxId">Enter Taxid</label>
                  <input type="text" name="tax_id" id="inputTaxId" class="field input"
                    placeholder="{$taxLabel} ({$LANG.orderForm.optional})" value="{$clientTaxId}">
                </div>

                {/if}



                {if $customfields || $currencies}

                {if $customfields}
                {foreach $customfields as $customfield}
                <div class="col-12">
                  <label class="label" for="customfield{$customfield.id}">{$customfield.name}
                    {$customfield.required}</label>
                  <div class="control">
                    {$customfield.input}
                    {if $customfield.description}
                    <span class="field-help-text">{$customfield.description}</span>
                    {/if}
                  </div>
                </div>
                {/foreach}
                {/if}

                {if $customfields && count($customfields)%2 > 0 }
                <div class="clearfix"></div>
                {/if}

                {if $currencies}
                <div class="col-12">
                  <label class="label" for="inputCurrency">Enter Currency</label>
                  <select id="inputCurrency" name="currency" class="field input">
                    {foreach from=$currencies item=curr}
                    <option value="{$curr.id}" {if !$smarty.post.currency && $curr.default || $smarty.post.currency eq
                      $curr.id } selected{/if}>{$curr.code}</option>
                    {/foreach}
                  </select>
                </div>
                {/if}

                {/if}



              </div>




              <div id="containerNewUserSecurity" {if $remote_auth_prelinked && !$securityquestions } class="hidden"
                {/if}>

                <div id="containerPassword" class="row mt-3 {if $remote_auth_prelinked && $securityquestions} hidden{/if}">
                  <div id="passwdFeedback" style="display: none;" class="alert alert-info text-center w-100"></div>
                  <div class="col-md-6">
                    <label class="label" for="inputNewPassword1">Enter Password</label>
                    <input type="password" name="password" id="inputNewPassword1"
                      data-error-threshold="{$pwStrengthErrorThreshold}"
                      data-warning-threshold="{$pwStrengthWarningThreshold}" class="field input"
                      placeholder="{$LANG.clientareapassword}" autocomplete="off" {if $remote_auth_prelinked}
                      value="{$password}" {/if}>
                  </div>
                  <div class="col-md-6">

                    <label class="label" for="inputNewPassword2">Confirm Password</label>
                    <input type="password" name="password2" id="inputNewPassword2" class="field input"
                      placeholder="{$LANG.clientareaconfirmpassword}" autocomplete="off" {if $remote_auth_prelinked}
                      value="{$password}" {/if}>
                  </div>
                  <div class="col-md-12">

                    <button type="button" class="btn btn-primary btn-sm btn-xs-block generate-password"
                      data-targetfields="inputNewPassword1,inputNewPassword2">
                      {$LANG.generatePassword.btnLabel}
                    </button>
                  </div>
                  <div class="col-md-12">

                    <div class="password-strength-meter w-100 mt-3">
                      <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
                          aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="passwordStrengthMeterBar">
                        </div>
                      </div>
                      <p class="small text-muted" id="passwordStrengthTextLabel">{$LANG.pwstrength}:
                        {$LANG.pwstrengthenter}</p>
                    </div>
                  </div>
                </div>

                {if $securityquestions}


                <div class="col-md-6">

                  <label class="label" for="inputSecurityQId">Security Question</label>

                  <select name="securityqid" id="inputSecurityQId" class="field input">
                    <option value="">{$LANG.clientareasecurityquestion}</option>
                    {foreach $securityquestions as $question}
                    <option value="{$question.id}" {if $question.id eq $securityqid} selected{/if}>
                      {$question.question}
                    </option>
                    {/foreach}
                  </select>
                </div>
                <div class="col-md-6">


                  <label class="label" for="inputSecurityQAns">Enter Ans.</label>
                  <input type="password" name="securityqans" id="inputSecurityQAns" class="field input"
                    placeholder="{$LANG.clientareasecurityanswer}" autocomplete="off">
                </div>
                {/if}


              </div>

              {if $showMarketingEmailOptIn}
              <div class="col-12 px-0">
                <div class="marketing-email-optin">
                  <h6>{lang key='emailMarketing.joinOurMailingList'}</h6>
                  <p>{$marketingEmailOptInMessage}</p>
                  <input type="checkbox" name="marketingoptin" value="1" {if $marketingEmailOptIn} checked{/if}
                    class="no-icheck toggle-switch-success" data-size="small" data-on-text="{lang key='yes'}"
                    data-off-text="{lang key='no'}">
                </div>
              </div>
              {/if}

              {include file="$template/includes/captcha.tpl"}

              {if $accepttos}

              <div class="row align-items-center gy-2 gy-md-0">
                <div class="col-12">
                  <div class="d-flex align-items-center">
                    <input class="form-checkbox mt-0" type="checkbox" name="accepttos" id="accepttos">
                    <label class="mx-2 mb-0" style="line-height: 1;" for="accepttos">{$LANG.ordertosagreement} <a
                        href="{$tosurl}" target="_blank" style="color: var(--primary);">{$LANG.ordertos}</a></label>
                  </div>
                </div>

              </div>
              {/if}

              <button class="btn-01 w-100 text-center mt-3 {$captcha->getButtonClass($captchaForm)}" type="submit">
                Register Now </button>
              <span class="next-link text-start"><a href="{$WEB_ROOT}/login.php"><i class="ri-arrow-left-line"></i>
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
{/if}
