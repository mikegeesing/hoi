{include file="$template/includes/flashmessage.tpl"}

<div class="panel panel-default">
    <ul class="panel-tabs nav nav-tabs">
        {if $linkableProviders}
            <li class="active">
                <a href="#linked-accounts" data-toggle="tab" aria-expanded="false">
                    <i class="fad fa-users"></i> {lang key='remoteAuthn.titleLinkedAccounts'} 
                </a>
            </li>
        {/if}
        {if $twoFactorAuthAvailable}
            <li {if !$linkableProviders}class="active"{/if}>
                <a href="#twofa" data-toggle="tab" aria-expanded="false">
                <i class="fad fa-shield"></i> {$LANG.twofactorauth} </a>
            </li>
        {/if}
        {if $securityQuestions->count() > 0}
            <li {if !$linkableProviders && !$twoFactorAuthAvailable}class="active"{/if}>
                <a href="#change-security-question"  data-toggle="tab" aria-expanded="false">
                    <i class="fad fa-user-shield"></i> {$LANG.clientareanavsecurityquestions} 
                </a>
            </li>
        {/if}
    </ul>
    <div class="panel-body tab-content">
        {if $linkableProviders}
            <div class="tab-pane active" id="linked-accounts">
                {include file="$template/includes/linkedaccounts.tpl" linkContext="clientsecurity" }
                <div class="table-container table-responsive">
                    {include file="$template/includes/linkedaccounts.tpl" linkContext="linktable" }
                </div>
            </div>
        {/if}

        {if $twoFactorAuthAvailable}
            <div class="tab-pane {if !$linkableProviders}active{/if}" id="twofa">
                <p class="twofa-config-link disable{if !$twoFactorAuthEnabled} hidden{/if}">
                    {$LANG.twofacurrently} <strong class="text-success">{$LANG.enabled|strtolower}</strong>
                </p>

                <p class="twofa-config-link enable{if $twoFactorAuthEnabled} hidden{/if}">
                    {$LANG.twofacurrently} <strong class="text-danger">{$LANG.disabled|strtolower}</strong>
                </p>

                <br />

                {if $twoFactorAuthRequired}
                    {include file="$template/includes/alert.tpl" type="info" icon="ls-info-circle" msg="{lang key="clientAreaSecurityTwoFactorAuthRequired"}"}
                {else}
                    {include file="$template/includes/alert.tpl" type="info" icon="ls-info-circle" msg="{lang key="clientAreaSecurityTwoFactorAuthRecommendation"}"}
                {/if}

                <a href="{routePath('account-security-two-factor-disable')}" class="btn btn-default open-modal twofa-config-link disable{if !$twoFactorAuthEnabled} hidden{/if}" data-modal-title="{$LANG.twofadisable}" data-modal-class="twofa-setup" data-btn-submit-label="{lang key='twofadisable'}" data-btn-submit-color="danger" data-btn-submit-id="btnDisable2FA">
                    {$LANG.twofadisableclickhere}
                </a>
                <a href="{routePath('account-security-two-factor-enable')}" class="btn btn-lg btn-primary open-modal twofa-config-link enable{if $twoFactorAuthEnabled} hidden{/if}" data-modal-title="{$LANG.twofaenable}" data-modal-class="twofa-setup" data-btn-submit-id="btnEnable2FA">
                    {$LANG.twofaenableclickhere}
                </a>
            </div>
        {/if}

        {if $securityQuestions->count() > 0}
            <div class="tab-pane {if !$linkableProviders && !$twoFactorAuthAvailable}active{/if}" id="change-security-question">
                <form method="post" action="{routePath('user-security-question')}">
                    {if $user->hasSecurityQuestion()}
                        <div class="form-group">
                            <label for="inputCurrentAns" class="control-label">{$user->getSecurityQuestion()}</label>
                            <input type="password" name="currentsecurityqans" id="inputCurrentAns" class="form-control" autocomplete="off" />
                        </div>
                    {/if}
                    <div class="form-group">
                        <label for="inputSecurityQid" class="control-label">{$LANG.clientareasecurityquestion}</label>
                        <select name="securityqid" id="inputSecurityQid" class="form-control">
                            {foreach $securityQuestions as $question}
                                <option value="{$question->id}">
                                    {$question->question}
                                </option>
                            {/foreach}
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="inputSecurityAns1" class="control-label">{$LANG.clientareasecurityanswer}</label>
                                <input type="password" name="securityqans" id="inputSecurityAns1" class="form-control" autocomplete="off" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="inputSecurityAns2" class="control-label">{$LANG.clientareasecurityconfanswer}</label>
                                <input type="password" name="securityqans2" id="inputSecurityAns2" class="form-control" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                    <div class="form-actions m-t-6">
                        <input class="btn btn-primary" type="submit" name="submit" value="{$LANG.clientareasavechanges}" />
                        <input class="btn btn-default" type="reset" value="{$LANG.cancel}" />
                    </div>
                </form>
            </div>
        {/if}
    </div>
</div>