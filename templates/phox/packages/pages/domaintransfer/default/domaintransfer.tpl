{include file="{$Phox['pages']['orderformPath']}/common.tpl"}

<div id="order-phox">

    <div class="header-lined">
        <h1 class="font-size-36">
            {lang key='orderForm.transferToUs'}
        </h1>
        <small>{lang key='orderForm.transferExtend'}*</small>
    </div>

    <div class="row">

        <div class="cart-body cart-body--full-width">
            <form method="post" action="{$WEB_ROOT}/cart.php" id="frmDomainTransfer">
                <input type="hidden" name="a" value="addDomainTransfer">
                <div class="panel card panel-default">
                    <div class="panel-body card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="domain" id="inputTransferDomain"
                                value="{$lookupTerm}"
                                placeholder="{lang key='yourdomainplaceholder'}.{lang key='yourtldplaceholder'}"
                                data-toggle="tooltip" data-placement="left" data-trigger="manual"
                                title="{lang key='orderForm.enterDomain'}" />
                        </div>
                        <div class="form-group relative">
                            <a data-toggle="tooltip" data-placement="left"
                                title="{lang key='orderForm.authCodeTooltip'}" class="pull-right float-right"><i
                                    class="fas fa-question-circle"></i> {lang key='orderForm.help'}</a>
                            <input type="text" class="form-control" name="epp" id="inputAuthCode"
                                placeholder="{lang key='orderForm.authCodePlaceholder'}" data-toggle="tooltip"
                                data-placement="left" data-trigger="manual" title="{lang key='orderForm.required'}" />
                        </div>
                        <div id="transferUnavailable" class="alert alert-warning slim-alert text-center w-hidden"></div>
                        {if $captcha->isEnabled() && !$captcha->recaptcha->isEnabled()}
                            <div class="captcha-container" id="captchaContainer">
                                <div class="default-captcha">
                                    <p>{lang key="cartSimpleCaptcha"}</p>
                                    <div>
                                        <img id="inputCaptchaImage" src="{$systemurl}includes/verifyimage.php" />
                                        <input id="inputCaptcha" type="text" name="code" maxlength="6"
                                            class="form-control input-sm" data-toggle="tooltip" data-placement="right"
                                            data-trigger="manual" title="{lang key='orderForm.required'}" />
                                    </div>
                                </div>
                            </div>
                        {elseif $captcha->isEnabled() && $captcha->recaptcha->isEnabled() && !$captcha->recaptcha->isInvisible()}
                            <div class="text-center">
                                <div class="form-group recaptcha-container" id="captchaContainer"></div>
                            </div>
                        {/if}

                        <button type="submit" id="btnTransferDomain"
                            class="btn btn-primary btn-transfer{$captcha->getButtonClass($captchaForm)}">
                            <span class="loader w-hidden" id="addTransferLoader">
                                <i class="fas fa-fw fa-spinner fa-spin"></i>
                            </span>
                            <span id="addToCart">{lang key="orderForm.addToCart"}</span>
                        </button>
                    </div>
                </div>
            </form>

            <p class="text-center small">* {lang key='orderForm.extendExclusions'}</p>
        </div>
    </div>
</div>