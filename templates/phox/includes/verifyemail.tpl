{if file_exists("templates/$template/packages/overwrites/includes/verifyemail.tpl")}
    {include file="{$template}/packages/overwrites/includes/verifyemail.tpl"}
{else}
    {if $showEmailVerificationBanner}
        <div class="email-verification">
            <div class="container">
                <div class="alert alert-warning" role="alert" data-dismiss="alert">
                    {* Content *}
                    <i class="fas fa-info-circle info-icon"></i>
                    {$LANG.verifyEmailAddress}

                    {* Resend Verification Email *}
                    <div class="pull-right">
                        <button id="btnResendVerificationEmail" class="btn btn-default btn-sm btn-resend-verify-email btn-action"
                            data-email-sent="{$LANG.emailSent}" data-error-msg="{$LANG.error}"
                            data-uri="{routePath('user-email-verification-resend')}">
                            <span class="loader hidden"><i class="fa fa-spinner fa-spin"></i></span>
                            {$LANG.resendEmail}
                        </button>

                        <button id="btnEmailVerificationClose" type="button" class="btn close"
                        data-uri="{routePath('dismiss-email-verification')}"><span
                            aria-hidden="true">&times;</span></button>
                    </div>

                </div>
            </div>
        </div>
    {/if}
{/if}