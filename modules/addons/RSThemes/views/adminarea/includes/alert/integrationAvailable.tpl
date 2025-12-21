<div class="alert alert--info alert--outline has-icon alert--border-left">
    <div class="alert__body">
        <h6>{$lang.alert.integration_available.title}</h6>
        <p>{$lang.alert.integration_available.desc}</p>
    </div>
    <div class="alert__actions">
        <form method="POST" action="{$helper->url('Template@loadSettings',['templateName'=>$template->getMainName()])}">
            <input type="hidden" name="integrationType" value="{$integrationType}"> 
            <button type="submit" class="btn btn--secondary btn--sm">{$lang.general.import}</button>
        </form>
        {if $integrationType == "cms"}
            <form method="POST" action="{$helper->url('Template@dissmissSettings',['templateName'=>$template->getMainName()])}" data-cms-integration-dismiss>
                <button data-cms-integration-dismiss-submit class="btn btn--default btn--outline btn--sm" type="submit">{$lang.general.dismiss}</button>
            </form>
        {/if}
    </div>
</div>