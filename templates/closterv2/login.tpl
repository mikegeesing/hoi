<!-- banner start -->
<section id="login" class="login-form form-account-page p-4 {if $linkableProviders} with-social{/if}">
    <div class="container">
        <div class="row text-center">
            <div class="section-head gap-bottom center">
                <h2>Log in op je account</h2>
            </div>
        </div>
       
       <div class="row justify-content-center">
      <div class="col-lg-5 col-12">
        <form class="inner-form"  method="post" action="{routePath('login-validate')}">
          {include file="$template/includes/flashmessage.tpl"}
                    <div class="providerLinkingFeedback"></div>
        <div class="login-content text-center">
          <input class="form-control mb-3" type="email" name="username" class="input" id="inputEmail" placeholder="{$LANG.enteremail}" autofocus="required">
          <input class="form-control mb-3" type="password" name="password" class="input" id="inputPassword" placeholder="{$LANG.clientareapassword}" autocomplete="off" required>

          <div class="row align-items-center">
              <div class="col-sm-6 col-12 text-start mb-0">
                <div class=" mb-2">
                  <input class="form-checkbox m-0" id="check" type="checkbox" name="rememberme">
                  <label class="" for="check" style="line-height: 1;">{$LANG.loginrememberme}</label>
                </div>
              </div>
              <div class="col-sm-6 col-12 mb-2">
                <span class="d-block text-md-end text-start"><a class="Forget-pass another-link" href="{routePath('password-reset-begin')}">Wachtwoord vergeten</a></span>
              </div>

            </div>
            {if $captcha->isEnabled()}
            <div class="text-center margin-bottom">
              {include file="$template/includes/captcha.tpl"}
          </div>
          {/if}

          <div class="text-center justify-content-center d-flex">
            <button type="submit" class="btn-01 w-100 {$captcha->getButtonClass($captchaForm)}" id="login" value="{$LANG.loginbutton}\">Inloggen</button></div>

          <div class="for-signup mt-3">
              <span>Account aanmaken?</span> <a class="fw-5" href="{$WEB_ROOT}/register.php\">Nu registreren</a>
            </div>
        </div>
      </form>
       <div class="w-100{if !$linkableProviders} hidden{/if}">
                    {include file="$template/includes/linkedaccounts.tpl" linkContext="login" customFeedback=true}
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
</style>