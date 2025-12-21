<section id="reset" class="login-form">
    <div class="container rounded shadow p-4">
        <div class="row text-center">
            <div class="section-head gap-bottom center">
                <h2>Reset Your Password</h2>
            </div>
        </div>
       
       <div class="row justify-content-center">
      <div class="col-lg-5 col-12">
        <div class="login-content text-center">
          {if $loggedin && $innerTemplate}
                    {include file="$template/includes/alert.tpl" type="error" msg=$LANG.noPasswordResetWhenLoggedIn textcenter=true}
                {else}
                    {if $successMessage}
                        {include file="$template/includes/alert.tpl" type="success" msg=$successTitle textcenter=true}
                        <p>{$successMessage}</p>
                    {else}
                        {if $errorMessage}
                            {include file="$template/includes/alert.tpl" type="error" msg=$errorMessage textcenter=true}
                        {/if}
            
                        {if $innerTemplate}
                            {include file="$template/password-reset-$innerTemplate.tpl"}
                        {/if}
                    {/if}
                {/if}

          <div class="for-signup">
              <span>Create an acocunt?</span> <a class="fw-5" href="{$WEB_ROOT}/register.php">Register Now</a>
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

</style>