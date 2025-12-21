<div class="card">
    <div class="card-body">
        <h3 class="card-title">{$lang->get('assignContactProfilesToDomain')}</h3>
        <form method="POST" action="clientarea.php?action=domaindetails&id={$domainId}&modop=custom&a=Contacts&mhr-action=assignProfile">
            <div class="form-group row">
                <label for="assignProfileOwnerSelect" class="col-sm-4 col-form-label">{$lang->get('ownerProfile')}</label>
                <div class="col-md-7">
                    <select class="form-control" id="assignProfileOwnerSelect" name="assignProfileOwnerSelect">
                        {foreach $profiles as $key => $profile}
                            <option value="{$key}" {if $key == $ownerContactId}selected{/if}>{$profile['alias']}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="assignProfileAdminSelect" class="col-sm-4 col-form-label">{$lang->get('adminProfile')}</label>
                <div class="col-md-7">
                    <select class="form-control" id="assignProfileAdminSelect" name="assignProfileAdminSelect">
                        {foreach $profiles as $key => $profile}
                            <option value="{$key}" {if $key == $adminContactId}selected{/if}>{$profile['alias']}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="assignProfileTechSelect" class="col-sm-4 col-form-label">{$lang->get('techProfile')}</label>
                <div class="col-md-7">
                    <select class="form-control" id="assignProfileTechSelect" name="assignProfileTechSelect">
                        {foreach $profiles as $key => $profile}
                            <option value="{$key}" {if $key == $techContactId}selected{/if}>{$profile['alias']}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="assignProfileBillingSelect" class="col-sm-4 col-form-label">{$lang->get('billingProfile')}</label>
                <div class="col-md-7">
                    <select class="form-control" id="assignProfileBillingSelect" name="assignProfileBillingSelect">
                        {foreach $profiles as $key => $profile}
                            <option value="{$key}" {if $key == $billingContactId}selected{/if}>{$profile['alias']}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 offset-sm-4">
                    <button id="assignProfileButton" type="submit" class="btn btn-primary">{$lang->get('assignContactProfile')}</button>
                </div>
            </div>
        </form>
    </div>
</div>