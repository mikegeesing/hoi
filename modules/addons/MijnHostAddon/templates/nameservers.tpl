{if $error}
    <div class="alert alert-danger">{$lang->get($error)}</div>
{/if}
<div class="card">
    <div class="card-body">
        <h3 class="card-title">{$lang->get('manageNameserverProfiles')}</h3>
        <form method="POST" action="index.php?m=MijnHostAddon&mha-controller=Nameservers&mha-action=updateNameserverProfile">
            <div class="form-group row">
                <label for="manageProfilesSelect" class="col-sm-4 col-form-label">{$lang->get('nameserverProfile')}</label>
                <div class="col-md-7">
                    <select class="form-control" id="manageProfilesSelect" name="manageProfilesSelect">
                        {foreach $nameserverProfiles as $key => $profile}
                            <option value="{$key}">{$key}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
            {foreach $nameserverProfiles as $key => $profile}
                <div class="manageProfilesNameserverProfile" id="manageProfilesNameserverProfile_{$key}" style="display: none;">
                    {foreach $profile as $keyNameserver => $nameserver}
                        <div class="form-group row">
                            <label for="manageProfilesNameserverProfile_{$key}_ns{$keyNameserver + 1}" class="col-sm-4 col-form-label">{$lang->get('nameserver', ['key' => {$keyNameserver + 1}])}</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" name="updateProfileNameservers[]" id="manageProfilesNameserverProfile_{$key}_ns{$keyNameserver + 1}" value="{$nameserver}">
                            </div>
                        </div>
                    {/foreach}
                </div>
            {/foreach}
            <div class="row">
                <div class="col-sm-8 offset-sm-4">
                    <button id="manageProfilesButton" type="submit" class="btn btn-primary">{$lang->get('updateNameserverProfile')}</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <h3 class="card-title">{$lang->get('createNewNameserverProfile')}</h3>
        <form method="POST" action="index.php?m=MijnHostAddon&mha-controller=Nameservers&mha-action=createNameserverProfile">
            <div class="form-group row">
                <label for="createNewProfileProfileName" class="col-sm-4 col-form-label">{$lang->get('nameserverProfileName')}</label>
                <div class="col-md-7">
                    <input id="createNewProfileProfileName" name="createNewProfileProfileName" type="text" class="form-control" value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="createNewProfileNameserver1" class="col-sm-4 col-form-label">{$lang->get('nameserver', ['key' => 1])}</label>
                <div class="col-md-7">
                    <input id="createNewProfileNameserver1" name="createNewProfileNameservers[]" type="text" class="form-control" value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="createNewProfileNameserver2" class="col-sm-4 col-form-label">{$lang->get('nameserver', ['key' => 2])}</label>
                <div class="col-md-7">
                    <input id="createNewProfileNameserver2" name="createNewProfileNameservers[]" type="text" class="form-control" value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="createNewProfileNameserver3" class="col-sm-4 col-form-label">{$lang->get('nameserver', ['key' => 3])}</label>
                <div class="col-md-7">
                    <input id="createNewProfileNameserver3" name="createNewProfileNameservers[]" type="text" class="form-control" value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="createNewProfileNameserver4" class="col-sm-4 col-form-label">{$lang->get('nameserver', ['key' => 4])}</label>
                <div class="col-md-7">
                    <input id="createNewProfileNameserver4" name="createNewProfileNameservers[]" type="text" class="form-control" value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="createNewProfileNameserver5" class="col-sm-4 col-form-label">{$lang->get('nameserver', ['key' => 5])}</label>
                <div class="col-md-7">
                    <input id="createNewProfileNameserver5" name="createNewProfileNameservers[]" type="text" class="form-control" value="">
                </div>
            </div>
            <div class="form-group row">
                <label for="createNewProfileNameserver6" class="col-sm-4 col-form-label">{$lang->get('nameserver', ['key' => 6])}</label>
                <div class="col-md-7">
                    <input id="createNewProfileNameserver6" name="createNewProfileNameservers[]" type="text" class="form-control" value="">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 offset-sm-4">
                    <button id="createNewProfileButton" type="submit" class="btn btn-primary">{$lang->get('createNameserverProfile')}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#manageProfilesSelect').on('change', function () {
            $('.manageProfilesNameserverProfile').hide();
            $('.manageProfilesNameserverProfile input').prop('disabled', true);
            $('#manageProfilesNameserverProfile_' + $(this).val()).show();
            $('#manageProfilesNameserverProfile_' + $(this).val() + ' input').prop('disabled', false);
        });

        $('.manageProfilesNameserverProfile').hide();
        $('.manageProfilesNameserverProfile input').prop('disabled', true);
        $('#manageProfilesNameserverProfile_' + $('#manageProfilesSelect').val()).show();
        $('#manageProfilesNameserverProfile_' + $('#manageProfilesSelect').val() + ' input').prop('disabled', false);
    });
</script>

