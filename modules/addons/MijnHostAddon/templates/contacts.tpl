{if $error}
    <div class="alert alert-danger">{$lang->get($error)}</div>
{/if}
<div class="card">
    <div class="card-body">
        <h3 class="card-title">{$lang->get('manageContactProfiles')}</h3>
        <form method="POST" action="index.php?m=MijnHostAddon&mha-controller=Contacts&mha-action=updateProfile">
            <div class="form-group row">
                <label for="manageProfilesSelect" class="col-sm-4 col-form-label">{$lang->get('contactProfile')}</label>
                <div class="col-md-7">
                    <select class="form-control" id="manageProfilesSelect" name="manageProfilesSelect">
                        {foreach $contactProfiles as $key => $profile}
                            <option value="{$key}">{$profile['alias']}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
            {foreach $contactProfiles as $key => $profile}
                <div class="manageProfilesNameserverProfile" id="manageProfilesNameserverProfile_{$key}" style="display: none;">
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">{$lang->get('contactProfileName')}</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="alias" value="{$profile['alias']}">
                        </div>
                    </div>
                    {if $profile['company']}
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">{$lang->get('company')}</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control mha-disabled" name="company" placeholder="{$lang->get('companyPlaceholder')}" value="{$profile['company']}">
                            </div>
                            <div class="col-md-3">
                                <input type="text" class="form-control" name="vatNumber" placeholder="{$lang->get('vatNumberPlaceholder')}" value="{$profile['vatNumber']}">
                            </div>
                        </div>
                    {/if}
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">{$lang->get('gender')}</label>
                        <div class="col-md-7">
                            <select class="form-control mha-disabled" name="gender">
                                <option {if $profile['gender'] == "M"}selected{/if}>{$lang->get('male')}</option>
                                <option {if $profile['gender'] == "F"}selected{/if}>{$lang->get('female')}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">{$lang->get('firstName')}</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control mha-disabled" name="firstName" value="{$profile['firstName']}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">{$lang->get('lastName')}</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control mha-disabled" name="lastName" value="{$profile['lastName']}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">{$lang->get('address')}</label>
                        <div class="col-md-3">
                            <input type="text" class="form-control" name="street" placeholder="{$lang->get('streetPlaceholder')}" value="{$profile['street']}">
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="streetNumber" placeholder="{$lang->get('streetNumberPlaceholder')}" value="{$profile['streetNumber']}">
                        </div>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="streetSuffix" placeholder="{$lang->get('streetSuffixPlaceholder')}" value="{$profile['streetSuffix']}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">{$lang->get('city')}</label>
                        <div class="col-md-2">
                            <input type="text" class="form-control" name="zipCode" placeholder="{$lang->get('zipCodePlaceholder')}" value="{$profile['zipCode']}">
                        </div>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="city" placeholder="{$lang->get('cityPlaceholder')}" value="{$profile['city']}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">{$lang->get('state')}</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="state" value="{$profile['state']}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">{$lang->get('country')}</label>
                        <div class="col-md-7">
                            <select name="country" class="form-control">
                                {foreach $countries as $key => $country}
                                    <option value="{$key}" {if $key == $profile['country']}selected{/if}>{$country}</option>
                                {/foreach}
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">{$lang->get('phoneNumber')}</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="phoneNumber" value="{$profile['phoneCountry']}{$profile['phoneArea']}{$profile['phoneNumber']}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">{$lang->get('email')}</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="email" value="{$profile['email']}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">{$lang->get('socialSecurityNumber')}</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="socialSecurityNumber" value="{$profile['socialSecurityNumber']}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">{$lang->get('passportNumber')}</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="passportNumber" value="{$profile['passportNumber']}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">{$lang->get('companyRegistrationNumber')}</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="companyRegistrationNumber" value="{$profile['companyRegistrationNumber']}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">{$lang->get('companyUrl')}</label>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="companyUrl" value="{$profile['companyUrl']}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-form-label">{$lang->get('birthDate')}</label>
                        <div class="col-md-7">
                            <input type="date" class="form-control" name="birthDate" value="{$profile['birthDate']}">
                        </div>
                    </div>
                </div>
            {/foreach}
            <div class="row">
                <div class="col-sm-8 offset-sm-4">
                    <button id="manageProfilesButton" type="submit" class="btn btn-primary">{$lang->get('updateContactProfile')}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h3 class="card-title">{$lang->get('createNewContactProfile')}</h3>
        <form method="POST" action="index.php?m=MijnHostAddon&mha-controller=Contacts&mha-action=createProfile">
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">{$lang->get('contactProfileName')}</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" name="alias">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">{$lang->get('company')}</label>
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="{$lang->get('companyPlaceholder')}" name="company">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="{$lang->get('vatNumberPlaceholder')}" name="vatNumber">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">{$lang->get('gender')}</label>
                <div class="col-md-7">
                    <select class="form-control" name="gender">
                        <option value="M">{$lang->get('male')}</option>
                        <option value="F">{$lang->get('female')}</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">{$lang->get('firstName')}</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" name="firstName">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">{$lang->get('lastName')}</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" name="lastName">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">{$lang->get('address')}</label>
                <div class="col-md-3">
                    <input type="text" class="form-control" placeholder="{$lang->get('streetPlaceholder')}" name="street">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="{$lang->get('streetNumberPlaceholder')}" name="streetNumber">
                </div>
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="{$lang->get('streetSuffixPlaceholder')}" name="streetSuffix">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">{$lang->get('city')}</label>
                <div class="col-md-2">
                    <input type="text" class="form-control" placeholder="{$lang->get('zipCodePlaceholder')}" name="zipCode">
                </div>
                <div class="col-md-5">
                    <input type="text" class="form-control" placeholder="{$lang->get('cityPlaceholder')}" name="city">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">{$lang->get('state')}</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" name="state">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">{$lang->get('country')}</label>
                <div class="col-md-7">
                    <select name="country" class="form-control">
                        {foreach $countries as $key => $country}
                            <option value="{$key}">{$country}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">{$lang->get('phoneNumber')}</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" name="phoneNumberCreate">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">{$lang->get('email')}</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" name="email">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">{$lang->get('socialSecurityNumber')}</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" name="socialSecurityNumber">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">{$lang->get('passportNumber')}</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" name="passportNumber">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">{$lang->get('companyRegistrationNumber')}</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" name="companyRegistrationNumber">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">{$lang->get('companyUrl')}</label>
                <div class="col-md-7">
                    <input type="text" class="form-control" name="companyUrl">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-4 col-form-label">{$lang->get('birthDate')}</label>
                <div class="col-md-7">
                    <input type="date" class="form-control" name="birthDate">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8 offset-sm-4">
                    <button id="manageProfilesButton" type="submit" class="btn btn-primary">{$lang->get('createContactProfile')}</button>
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
            $('#manageProfilesNameserverProfile_' + $(this).val() + ' input.mha-disabled').prop('disabled', true);
            $('#manageProfilesNameserverProfile_' + $(this).val() + ' select').prop('disabled', false);
            $('#manageProfilesNameserverProfile_' + $(this).val() + ' select.mha-disabled').prop('disabled', true);
        });

        $('.manageProfilesNameserverProfile').hide();
        $('.manageProfilesNameserverProfile input').prop('disabled', true);
        $('#manageProfilesNameserverProfile_' + $('#manageProfilesSelect').val()).show();
        $('#manageProfilesNameserverProfile_' + $('#manageProfilesSelect').val() + ' input').prop('disabled', false);
        $('#manageProfilesNameserverProfile_' + $('#manageProfilesSelect').val() + ' input.mha-disabled').prop('disabled', true);
        $('#manageProfilesNameserverProfile_' + $('#manageProfilesSelect').val() + ' select').prop('disabled', false);
        $('#manageProfilesNameserverProfile_' + $('#manageProfilesSelect').val() + ' select.mha-disabled').prop('disabled', true);
    });
</script>