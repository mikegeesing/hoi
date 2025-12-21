<div class="card">
    <div class="card-body">
        <h3 class="card-title">{$lang->get('assignNameserverProfileToDomain')}</h3>
        <form method="POST" action="clientarea.php?action=domaindetails&id={$domainId}&modop=custom&a=Nameservers&mhr-action=assignProfile">
            <div class="form-group row">
                <label for="assignProfileSelect" class="col-sm-4 col-form-label">{$lang->get('nameserverProfile')}</label>
                <div class="col-md-7">
                    <select class="form-control" id="assignProfileSelect" name="assignProfileSelect">
                        <option value="current">{$lang->get('current')}</option>
                        {foreach $nameserversProfiles as $key => $profile}
                            <option value="{$key}">{$key}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
            <div class="assignProfileNameserverProfile" id="assignProfileNameserverProfile_current">
                {foreach $currentNameservers as $key => $nameserver}
                    <div class="form-group row">
                        <label for="assignProfileNameserverProfile_current_ns{$key + 1}" class="col-sm-4 col-form-label">{$lang->get('nameserver', ['key' => {$key + 1}])}</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" id="assignProfileNameserverProfile_current_ns{$key + 1}" value="{$nameserver}" disabled>
                        </div>
                    </div>
                {/foreach}
            </div>
            {foreach $nameserversProfiles as $key => $profile}
                <div class="assignProfileNameserverProfile" id="assignProfileNameserverProfile_{$key}" style="display: none;">
                    {foreach $profile as $keyNameserver => $nameserver}
                        <div class="form-group row">
                            <label for="assignProfileNameserverProfile_{$key}_ns{$keyNameserver + 1}" class="col-sm-4 col-form-label">{$lang->get('nameserver', ['key' => {$keyNameserver + 1}])}</label>
                            <div class="col-md-7">
                                <input type="text" class="form-control" id="assignProfileNameserverProfile_{$key}_ns{$keyNameserver + 1}" value="{$nameserver}" disabled>
                            </div>
                        </div>
                    {/foreach}
                </div>
            {/foreach}
            <div class="row">
                <div class="col-sm-8 offset-sm-4">
                    <button id="assignProfileButton" disabled type="submit" class="btn btn-primary">{$lang->get('assignNameserverProfile')}</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('#assignProfileSelect').on('change', function () {
            $('.assignProfileNameserverProfile').hide();
            $('#assignProfileNameserverProfile_' + $(this).val()).show();

            if($(this).val() === "current") {
                $('#assignProfileButton').prop('disabled', true);
            } else {
                $('#assignProfileButton').prop('disabled', false);
            }
        });
    });
</script>