{if $linkableProviders }
  <div class="section">
    <div class="section-header">
      <h2 class="section-title">{lang key='remoteAuthn.titleLinkedAccounts'}</h2>
    </div>
    <div class="section-body">
      <div class="panel panel-default panel-form">
        <div class="panel-body">
          {include file="$template/includes/linkedaccounts.tpl" linkContext="clientsecurity" }
          {include file="$template/includes/linkedaccounts.tpl" linkContext="linktable" }
        </div>
      </div>
    </div>
  </div>
{/if}

{if $showSsoSetting}
  <div class="section">
  <div class="section-header">
    <h2 class="section-title">{$LANG.sso.title}</h2>
  </div>
  <div class="section-body">
    <div class="panel panel-default panel-form">
      <div class="panel-body">
      
        <div class="mb-spacer-2x"><p>{$LANG.sso.summary}</p></div>

        <form id="frmSingleSignOn">
          <input type="hidden" name="token" value="{$token}" />
          <input type="hidden" name="action" value="security" />
          <input type="hidden" name="toggle_sso" value="1" />

          <div class="margin-10">
            <input type="checkbox" name="allow_sso" class="toggle-switch-success" id="inputAllowSso" {if $isSsoEnabled}
              checked{/if}>
            &nbsp;
            <span id="ssoStatusTextEnabled" {if !$isSsoEnabled} class="hidden" {/if}>
              {$LANG.sso.enabled}
            </span>
            <span id="ssoStatusTextDisabled" {if $isSsoEnabled} class="hidden" {/if}>
              {$LANG.sso.disabled}
            </span>
          </div>
        </form>
    
        <p>{$LANG.sso.disablenotice}</p>
      </div>
    </div>
  </div>
</div>
{/if}