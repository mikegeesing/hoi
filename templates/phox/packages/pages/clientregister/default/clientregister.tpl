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
  jQuery(document).ready(function() {
    jQuery("#inputNewPassword1").keyup(registerFormPasswordStrengthFeedback);
  });
</script>

{if !$registrationDisabled}
  <div class="wdes-wrap-account-page">

    {assign var="showLogo" value=$Phox['pages']['global-settings']['show-logo']['value']}
    {if $showLogo != true}
      <header class="wdes-wrap-account-page_header">
        {include file="$template/packages/includes/logo.tpl"}
      </header>
    {/if}

    <footer class="wdes-wrap-account-page_footer">
      <div id="wdes-carousel-announcements" class="wdes-announcements-carousel carousel slide" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          {assign var="counter" value=0}
          {foreach $announcements as $announcement}
            <div class="{if $counter == 0}active{/if} item wdes-account-page-announcement-single">
              <div class="wdes-account-page-announcement-single_date"><i class="far fa-calendar"></i> {$announcement.date}
              </div>
              <h2 class="wdes-account-page-announcement-single_title">{$announcement.title}</h2>
              <p class="wdes-account-page-announcement-single_description">{$announcement.excerpt}</p>
              <a href="{routePath('announcement-view', $announcement.id, $announcement.urlfriendlytitle)}"
                class="btn wdes-account-page-announcement-single_btn">{$LANG.learnmore}</a>
            </div>
            {assign var="counter" value=$counter+1}
          {/foreach}
        </div>
        <!-- Indicators -->
        <ol class="carousel-indicators">
          {assign var="counter" value=0}
          {foreach $announcements as $announcement}
            <li class="{if $counter == 0}active{/if}" data-target="#wdes-carousel-announcements" data-slide-to="{$counter}">
            </li>
            {assign var="counter" value=$counter+1}
          {/foreach}
        </ol>
      </div>
    </footer>

    <main class="wdes-wrap-account-page_main">
      <article class="wdes-wrap-account-page_main_article">
        {* Heading *}
        <div class="wdes-wrap-account-page_main-article_heading">
          {include file="$template/includes/pageheader.tpl" title=$LANG.clientregistertitle}
        </div>

        {if $registrationDisabled}
          {include file="$template/includes/alert.tpl" type="error" msg=$LANG.registerCreateAccount|cat:' <strong><a href="'|cat:"$WEB_ROOT"|cat:'/cart.php" class="alert-link">'|cat:$LANG.registerCreateAccountOrder|cat:'</a></strong>'}
        {/if}

        {if $errormessage}
          {include file="$template/includes/alert.tpl" type="error" errorshtml=$errormessage}
        {/if}

        {* Form *}
        <div id="registration" class="wdes-wrap-account-page_main-article_form">
          <form method="post" class="using-password-strength" action="{$smarty.server.PHP_SELF}" role="form"
            name="orderfrm" id="frmCheckout">
            <input type="hidden" name="register" value="true" />

            <div id="containerNewUserSignup">

              {include file="$template/includes/linkedaccounts.tpl" linkContext="registration"}

              <div class="sub-heading">
                <span>{$LANG.orderForm.personalInformation}</span>
              </div>

              <div class="form-group">
                <label for="inputFirstName">
                  {$LANG.orderForm.firstName}
                </label>
                <input type="text" name="firstname" id="inputFirstName" class="field form-control"
                  value="{$clientfirstname}" {if !in_array('firstname', $optionalFields)}required{/if} autofocus>
              </div>

              <div class="form-group">
                <label for="inputLastName">
                  {$LANG.orderForm.lastName}
                </label>
                <input type="text" name="lastname" id="inputLastName" class="field form-control" value="{$clientlastname}"
                  {if !in_array('lastname', $optionalFields)}required{/if}>
              </div>

              <div class="form-group">
                <label for="inputEmail">
                  {$LANG.orderForm.emailAddress}
                </label>
                <input type="email" name="email" id="inputEmail" class="field form-control" value="{$clientemail}">
              </div>

              <div class="form-group">
                <label for="inputPhone">
                  {$LANG.orderForm.phoneNumber}
                </label>
                <input type="tel" name="phonenumber" id="inputPhone" class="field" value="{$clientphonenumber}">
              </div>

              <div class="sub-heading mt-3">
                <span>{$LANG.orderForm.billingAddress}</span>
              </div>

              <div class="form-group">
                <label for="inputCompanyName">
                  {$LANG.orderForm.companyName} ({$LANG.orderForm.optional})
                </label>
                <input type="text" name="companyname" id="inputCompanyName" class="field" value="{$clientcompanyname}">
              </div>

              <div class="form-group">
                <label for="inputAddress1">
                  {$LANG.orderForm.streetAddress}
                </label>
                <input type="text" name="address1" id="inputAddress1" class="field form-control" value="{$clientaddress1}"
                  {if !in_array('address1', $optionalFields)}required{/if}>
              </div>

              <div class="form-group">
                <label for="inputAddress2">
                  {$LANG.orderForm.streetAddress2}
                </label>
                <input type="text" name="address2" id="inputAddress2" class="field" value="{$clientaddress2}">
              </div>

              <div class="form-group">
                <label for="inputCity">
                  {$LANG.orderForm.city}
                </label>
                <input type="text" name="city" id="inputCity" class="field form-control" value="{$clientcity}"
                  {if !in_array('city', $optionalFields)}required{/if}>
              </div>

              <div class="form-group">
                <label for="state" for="state">
                  {$LANG.orderForm.state}
                </label>
                <input type="text" name="state" id="state" class="field form-control" value="{$clientstate}"
                  {if !in_array('state', $optionalFields)}required{/if}>
              </div>

              <div class="form-group">
                <label for="inputPostcode">
                  {$LANG.orderForm.postcode}
                </label>
                <input type="text" name="postcode" id="inputPostcode" class="field form-control" value="{$clientpostcode}"
                  {if !in_array('postcode', $optionalFields)}required{/if}>
              </div>

              <div class="form-group">
                <label for="inputCountry" id="inputCountryIcon">
                  {$LANG.clientareacountry}
                </label>
                <select name="country" id="inputCountry" class="field form-control">
                  {foreach $clientcountries as $countryCode => $countryName}
                    <option value="{$countryCode}"
                      {if (!$clientcountry && $countryCode eq $defaultCountry) || ($countryCode eq $clientcountry)}
                      selected="selected" {/if}>
                      {$countryName}
                    </option>
                  {/foreach}
                </select>
              </div>

              {if $showTaxIdField}
                <div class="form-group">
                  <label for="inputTaxId">
                    {$taxLabel} ({$LANG.orderForm.optional})
                  </label>
                  <input type="text" name="tax_id" id="inputTaxId" class="field" value="{$clientTaxId}">
                </div>
              {/if}

              {if $customfields || $currencies}
                <div class="sub-heading mt-3">
                  <span>{$LANG.orderadditionalrequiredinfo}</span>
                </div>

                {if $customfields}
                  {foreach $customfields as $customfield}
                    <div class="form-group">
                      <label for="customfield{$customfield.id}">{$customfield.name} {$customfield.required}</label>
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
                  <div class="form-group">
                    <label for="inputCurrency">
                      {$LANG.choosecurrency}
                    </label>
                    <select id="inputCurrency" name="currency" class="field form-control">
                      {foreach from=$currencies item=curr}
                        <option value="{$curr.id}"
                          {if !$smarty.post.currency && $curr.default || $smarty.post.currency eq $curr.id } selected{/if}>
                          {$curr.code}</option>
                      {/foreach}
                    </select>
                  </div>
                {/if}

              {/if}
            </div>
            <div id="containerNewUserSecurity" {if $remote_auth_prelinked && !$securityquestions } class="hidden" {/if}>

              <div class="sub-heading mt-3">
                <span>{$LANG.orderForm.accountSecurity}</span>
              </div>
              <div id="containerPassword" class="{if $remote_auth_prelinked && $securityquestions} hidden{/if}">
                <div id="passwdFeedback" style="display: none;" class="alert alert-info text-center col-sm-12"></div>

                <div class="form-group">
                  <label for="inputNewPassword1">
                    {$LANG.clientareapassword}
                  </label>
                  <input type="password" name="password" id="inputNewPassword1"
                    data-error-threshold="{$pwStrengthErrorThreshold}"
                    data-warning-threshold="{$pwStrengthWarningThreshold}" class="field" autocomplete="off"
                    {if $remote_auth_prelinked} value="{$password}" {/if}>
                </div>

                <div class="form-group">
                  <label for="inputNewPassword2">
                    {$LANG.clientareaconfirmpassword}
                  </label>
                  <input type="password" name="password2" id="inputNewPassword2" class="field" autocomplete="off"
                    {if $remote_auth_prelinked} value="{$password}" {/if}>
                </div>

                <div class="form-group">
                  <button type="button" class="btn btn-default btn-sm btn-xs-block generate-password"
                    data-targetfields="inputNewPassword1,inputNewPassword2">
                    {$LANG.generatePassword.btnLabel}
                  </button>
                </div>

                <div class="password-strength-meter">
                  <div class="progress">
                    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar"
                      aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="passwordStrengthMeterBar">
                    </div>
                  </div>
                  <p class="text-center small text-muted" id="passwordStrengthTextLabel">{$LANG.pwstrength}:
                    {$LANG.pwstrengthenter}</p>
                </div>
              </div>
              {if $securityquestions}
                <div class="form-group">
                  <select name="securityqid" id="inputSecurityQId" class="field form-control">
                    <option value="">{$LANG.clientareasecurityquestion}</option>
                    {foreach $securityquestions as $question}
                      <option value="{$question.id}" {if $question.id eq $securityqid} selected{/if}>
                        {$question.question}
                      </option>
                    {/foreach}
                  </select>
                </div>
                <div class="form-group">
                  <label for="inputSecurityQAns">
                    {$LANG.clientareasecurityanswer}
                  </label>
                  <input type="password" name="securityqans" id="inputSecurityQAns" class="field form-control"
                    autocomplete="off">
                </div>
              {/if}
            </div>

            {if $showMarketingEmailOptIn}
              <div class="sub-heading mt-3">
                <span>{lang key='emailMarketing.joinOurMailingList'}</span>
              </div>
              <div class="marketing-email-optin">
                <p>{$marketingEmailOptInMessage}</p>
                <input type="checkbox" name="marketingoptin" value="1" {if $marketingEmailOptIn} checked{/if}
                  class="no-icheck toggle-switch-success" data-size="small" data-on-text="{lang key='yes'}"
                  data-off-text="{lang key='no'}">
              </div>
            {/if}

            {include file="$template/includes/captcha.tpl"}

            {if $accepttos}
              <div class="tospanel">
                <label class="checkbox">
                  <input type="checkbox" name="accepttos" class="accepttos">
                  {$LANG.ordertosagreement} {" "} <a href="{$tosurl}" target="_blank">{$LANG.ordertos}</a>
                </label>
              </div>
            {/if}
            <input
              class="wdes-wrap-account-page_main-article_form_action btn btn-primary{$captcha->getButtonClass($captchaForm)}"
              type="submit" value="{$LANG.clientregistertitle}" />
          </form>
        </div>

        {* Quick Actions *}
        <div class="wdes-wrap-account-page_main-article_form_actions">
          <div class="d-flex align-center justify-space">
            {if !$phoxRegistrationDisabled}
              <div class="d-flex align-center gap-5 wdes-register">
                <span><a href="{$WEB_ROOT}/clientarea.php">{$LANG.store.login}</a></span>
                <span>- <a href="{routePath('password-reset-begin')}">{$LANG.pwreset}</a></span>
              </div>
            {/if}

            {* Languages *}
            {if $languagechangeenabled && count($locales) > 1}
              <div class="dropdown">
                <button class="wdes-wrap-account-page_main-article_form_actions_language" id="languageChooser" type="button"
                  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="far fa-globe"></i>
                  {$activeLocale.localisedName}
                  <span class="far fa-chevron-down"></span>
                </button>
                <ul class="dropdown-menu wdes-wrap-account-page_main-article_form_actions_language_menu"
                  aria-labelledby="languageChooser">
                  {foreach $locales as $locale}
                    <li>
                      <a href="{$currentpagelinkback}language={$locale.language}">{$locale.localisedName}</a>
                    </li>
                  {/foreach}
                </ul>
              </div>
            {/if}
          </div>
        </div>
      </article>
    </main>

  </div>

{/if}