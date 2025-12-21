{if $successful}
  {include file="$template/includes/alert.tpl" type="success" msg=$LANG.changessavedsuccessfully textcenter=true}
{/if}

{if $errormessage}
  {include file="$template/includes/alert.tpl" type="error" errorshtml=$errormessage}
{/if}

{if in_array('state', $optionalFields)}
  <script>
    var stateNotRequired = true;
  </script>
{/if}

<script type="text/javascript" src="{$BASE_PATH_JS}/StatesDropdown.js"></script>

<form method="post" action="?action=details" role="form">
  {* Personal Information *}
  <div class="section">
    <div class="section-header">
      <h2 class="section-title">{$LANG.orderForm.personalInformation}</h2>
    </div>
    <div class="section-body">
      <div class="panel panel-default panel-form">
        <div class="panel-body">

          <div class="row">
            {* First Name *}
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputFirstName" class="control-label">{$LANG.clientareafirstname}</label>
                <input type="text" name="firstname" id="inputFirstName" value="{$clientfirstname}"
                  {if in_array('firstname', $uneditablefields)} disabled="disabled" {/if} class="form-control" />
              </div>
            </div>

            {* Last Name *}
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputLastName" class="control-label">{$LANG.clientarealastname}</label>
                <input type="text" name="lastname" id="inputLastName" value="{$clientlastname}"
                  {if in_array('lastname', $uneditablefields)} disabled="disabled" {/if} class="form-control" />
              </div>
            </div>
          </div>

          <div class="row">
            {* Email *}
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputEmail" class="control-label">{$LANG.clientareaemail}</label>
                <input type="email" name="email" id="inputEmail" value="{$clientemail}"
                  {if in_array('email', $uneditablefields)} disabled="disabled" {/if} class="form-control" />
              </div>
            </div>
            
            {* Phone Number *}
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputPhone" class="control-label">{$LANG.clientareaphonenumber}</label>
                <input type="tel" name="phonenumber" id="inputPhone" value="{$clientphonenumber}"
                  {if in_array('phonenumber',$uneditablefields)} disabled="" {/if} class="form-control" />
              </div>
            </div>
          </div>

          <div class="row">
            {* Languages *}
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputLanguage" class="col-form-label">{$LANG.clientarealanguage}</label>
                <select name="accountLanguage" id="inputAccountLanguage" class="form-control"
                  {if in_array('language', $uneditablefields)} disabled="disabled" {/if}>
                  <option value="">{lang key='default'}</option>
                  {foreach $languages as $language}
                    <option value="{$language}" {if $language eq $clientLanguage} selected="selected" {/if}>{$language|ucfirst}
                    </option>
                  {/foreach}
                </select>
              </div>
            </div>
          
          </div>

        </div> 
      </div>
    </div>
  </div>

  {* Billing Address *}
  <div class="section">
    <div class="section-header">
      <h2 class="section-title">{$LANG.billingAddress}</h2>
    </div>
    <div class="section-body">
      <div class="panel panel-default panel-form">
        <div class="panel-body">

          <div class="row">
            {* Company Name *}
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputCompanyName" class="control-label">{$LANG.clientareacompanyname}</label>
                <input type="text" name="companyname" id="inputCompanyName" value="{$clientcompanyname}"
                  {if in_array('companyname', $uneditablefields)} disabled="disabled" {/if} class="form-control" />
              </div>
            </div>

            {* Address 1 *}
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputAddress1" class="control-label">{$LANG.clientareaaddress1}</label>
                <input type="text" name="address1" id="inputAddress1" value="{$clientaddress1}"
                  {if in_array('address1', $uneditablefields)} disabled="disabled" {/if} class="form-control" />
              </div>
            </div>
          </div>

          <div class="row">
            {* Address 2 *}
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputAddress2" class="control-label">{$LANG.clientareaaddress2}</label>
                <input type="text" name="address2" id="inputAddress2" value="{$clientaddress2}"
                  {if in_array('address2', $uneditablefields)} disabled="disabled" {/if} class="form-control" />
              </div>
            </div>

            {* City *}
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputCity" class="control-label">{$LANG.clientareacity}</label>
                <input type="text" name="city" id="inputCity" value="{$clientcity}" {if in_array('city', $uneditablefields)}
                  disabled="disabled" {/if} class="form-control" />
              </div>
            </div>
          </div>

          <div class="row">
            {* Country *}
            <div class="col-md-6">
              <div class="form-group">
                <label class="control-label" for="country">{$LANG.clientareacountry}</label>
                {$clientcountriesdropdown}
              </div>
            </div>

            {* State *}
            <div class="col-md-3">
              <div class="form-group">
                <label for="inputState" class="control-label">{$LANG.clientareastate}</label>
                <input type="text" name="state" id="inputState" value="{$clientstate}"
                  {if in_array('state', $uneditablefields)} disabled="disabled" {/if} class="form-control" />
              </div>
            </div>

            {* Post Code *}
            <div class="col-md-3">
              <div class="form-group">
                <label for="inputPostcode" class="control-label">{$LANG.clientareapostcode}</label>
                <input type="text" name="postcode" id="inputPostcode" value="{$clientpostcode}"
                  {if in_array('postcode', $uneditablefields)} disabled="disabled" {/if} class="form-control" />
              </div>
            </div>
          </div>

          <div class="row">
            {* Payment Method *}
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputPaymentMethod" class="control-label">{$LANG.paymentmethod}</label>
                <select name="paymentmethod" id="inputPaymentMethod" class="form-control">
                  <option value="none">{$LANG.paymentmethoddefault}</option>
                  {foreach from=$paymentmethods item=method}
                    <option value="{$method.sysname}" {if $method.sysname eq $defaultpaymentmethod} selected="selected" {/if}>
                      {$method.name}</option>
                  {/foreach}
                </select>
              </div>
            </div>

            {* Billing Contact *}
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputBillingContact" class="control-label">{$LANG.defaultbillingcontact}</label>
                <select name="billingcid" id="inputBillingContact" class="form-control">
                  <option value="0">{$LANG.usedefaultcontact}</option>
                  {foreach from=$contacts item=contact}
                    <option value="{$contact.id}" {if $contact.id eq $billingcid} selected="selected" {/if}>{$contact.name}
                    </option>
                  {/foreach}
                </select>
              </div>
            </div>
        </div>

        <div class="row">
          {* Tax ID *}
          {if $showTaxIdField}
          <div class="col-md-6">
            <div class="form-group">
              <label for="inputTaxId" class="control-label">{lang key=$taxIdLabel}</label>
              <input type="text" name="tax_id" id="inputTaxId" class="form-control" value="{$clientTaxId}"
                {if in_array('tax_id', $uneditablefields)} disabled="disabled" {/if} />
            </div>
          </div>
          {/if}

          {* Custom Field *}
          {if $customfields}
            {foreach from=$customfields key=num item=customfield}
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label" for="customfield{$customfield.id}">{$customfield.name}</label>
                  <div class="control">
                    {$customfield.input} {$customfield.description}
                  </div>
                </div>
              </div>
            {/foreach}
          {/if}
        </div>

      </div>
    </div>
  </div>

  {* Email Preferences *}
  {if $emailPreferencesEnabled}
    <div class="section">
      <div class="section-header">
        <h2 class="section-title">{$LANG.clientareacontactsemails}</h2>
      </div>
      <div class="section-body">
        <div class="panel panel-default panel-form">
          <div class="panel-body">
            {foreach $emailPreferences as $emailType => $value}
              <div class="checkbox">
                  <label>
                      <input type="hidden" name="email_preferences[{$emailType}]" value="0">
                      <input class="icheck-control" type="checkbox" name="email_preferences[{$emailType}]" id="{$emailType}Emails" value="1"{if $value} checked="checked"{/if} />
                      {lang key="emailPreferences."|cat:$emailType}
                  </label>
              </div>    
            {/foreach}
          </div>
        </div>
      </div>
    </div>
  {/if}

  {* Marketing Email *}
  {if $showMarketingEmailOptIn}
    <div class="section">
      <div class="section-header">
        <h2 class="section-title">{lang key='emailMarketing.joinOurMailingList'}</h2>
      </div>
      <div class="section-body">
        <div class="panel panel-default panel-form">
          <div class="panel-body">
            <div class="mb-spacer-2x"><p>{$marketingEmailOptInMessage}</p></div>
            <label class="wdes-switch">
              <input type="checkbox" name="marketingoptin" value="1" {if $marketingEmailOptIn} checked{/if}
                class="no-icheck" data-size="small" data-on-text="{lang key='yes'}"
                data-off-text="{lang key='no'}">
              <span class="slider"></span>
            </label>
          </div>
        </div>
      </div>
    </div>
  {/if}

  <div class="form-group text-center mt-spacer-6x">
    <input class="btn btn-primary" type="submit" name="save" value="{$LANG.clientareasavechanges}" />
    <input class="btn btn-default" type="reset" value="{$LANG.cancel}" />
  </div>

</form>