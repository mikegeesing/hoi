<p class="mb-3">{$LANG.pwresetemailneeded}</p>

<form method="post" action="{routePath('password-reset-validate-email')}" role="form">
    <input type="hidden" name="action" value="reset" />

    
        <!-- <label class="label" for="inputEmail">{$LANG.loginemail}</label> -->
        <input type="email" name="email" class="form-control mb-3" id="inputEmail" placeholder="{$LANG.enteremail}" autofocus>
 

    {if $captcha->isEnabled()}
        <div class="text-center margin-bottom">
            {include file="$template/includes/captcha.tpl"}
        </div>
    {/if}

        <div class="text-center justify-content-center d-flex">
        <button type="submit" class="btn-01 w-100 {$captcha->getButtonClass($captchaForm)} mb-3">
            {$LANG.pwresetsubmit}
        </button>
    </div>
  
</form>
