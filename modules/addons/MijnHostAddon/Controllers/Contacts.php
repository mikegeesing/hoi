<?php

namespace ModulesGarden\MijnHostAddon\Controllers;

use ModulesGarden\MijnHostAddon\API\Adapters\MijnHostAdapter;
use ModulesGarden\MijnHostAddon\API\Clients\MijnHostClient;
use ModulesGarden\MijnHostAddon\Helpers\Lang;
use WHMCS\Utility\Country;

class Contacts extends AbstractController
{
    public function index(): array
    {
        $adapter = new MijnHostAdapter($this->params['apiKey']);
        $client = new MijnHostClient($adapter);

        $contactProfiles = $client->listProfilesContacts();

        $profiles = [];

        foreach($contactProfiles->data->profiles as $profile)
        {
            $contactProfile = $client->getProfileContacts($profile->id);

            $profiles[$contactProfile->data->id] = [
                'alias' => $contactProfile->data->alias,
                'company' => $contactProfile->data->company,
                'vatNumber' => $contactProfile->data->vat,
                'gender' => $contactProfile->data->gender,
                'firstName' => $contactProfile->data->firstname,
                'lastName' => $contactProfile->data->lastname,
                'street' => $contactProfile->data->street,
                'streetNumber' => $contactProfile->data->street_number,
                'streetSuffix' => $contactProfile->data->street_suffix,
                'zipCode' => $contactProfile->data->zipcode,
                'city' => $contactProfile->data->city,
                'state' => $contactProfile->data->state,
                'country' => $contactProfile->data->country,
                'phoneCountry' => $contactProfile->data->phone_country,
                'phoneArea' => $contactProfile->data->phone_area,
                'phoneNumber' => $contactProfile->data->phone_number,
                'email' => $contactProfile->data->email,
                'socialSecurityNumber' => $contactProfile->data->social_security_number,
                'passportNumber' => $contactProfile->data->passport_number,
                'companyRegistrationNumber' => $contactProfile->data->company_registration_number,
                'companyUrl' => $contactProfile->data->company_url,
                'birthDate' => $contactProfile->data->birth_date,
            ];
        }

        $countries = new Country();
        $countriesArray = $countries->getCountryNameArray();

        $lang = new Lang();

        $error = $_SESSION['MijnHost_Error'] ?? null;
        unset($_SESSION['MijnHost_Error']);

        return [
            'pagetitle' => 'Contacts',
            'breadcrumb' => [
                'clientarea.php' => 'Client Area',
                'index.php?m=MijnHostAddon&mha-controller=contacts' => $lang->get('primaryNavbarContactProfiles')
            ],
            'templatefile' => 'contacts',
            'requirelogin' => true,
            'vars' => [
                'lang' => $lang,
                'contactProfiles' => $profiles,
                'countries' => $countriesArray,
                'error' => $error,
            ]
        ];
    }

    public function createProfile()
    {
        $alias = $_POST['alias'];
        $company = $_POST['company'];
        $vatNumber = $_POST['vatNumber'];
        $gender = $_POST['gender'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $street = $_POST['street'];
        $streetNumber = $_POST['streetNumber'];
        $streetSuffix = $_POST['streetSuffix'];
        $zipCode = $_POST['zipCode'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $country = $_POST['countryCreate'];
        $countryPhoneNumber = '+' . $_POST['country-calling-code-phoneNumberCreate'];

        $areaPhoneNumber = "";
        $phoneNumber = "";

        $phoneNumberExploded = explode(" ", trim($_POST['phoneNumberCreate']));

        if(count($phoneNumberExploded) > 1)
        {
            $areaPhoneNumber = $phoneNumberExploded[0];
            unset($phoneNumberExploded[0]);

            $phoneNumber = implode('', $phoneNumberExploded);
        }
        else
        {
            $phoneNumber = implode("", $phoneNumberExploded);

            $areaPhoneNumber = substr($phoneNumber, 0, 1);
            $phoneNumber = substr($phoneNumber, 1);
        }

        $email = $_POST['email'];
        $socialSecurityNumber = $_POST['socialSecurityNumber'];
        $passportNumber = $_POST['passportNumber'];
        $companyRegistrationNumber = $_POST['companyRegistrationNumber'];
        $companyUrl = $_POST['companyUrl'];
        $birthDate = $_POST['birthDate'];

        $adapter = new MijnHostAdapter($this->params['apiKey']);
        $client = new MijnHostClient($adapter);

        try
        {
            $client->createProfileContact([
                'name' => $alias,
                'profile' => [
                    'company' => $company,
                    'vat' => $vatNumber,
                    'gender' => $gender,
                    'firstname' => $firstName,
                    'lastname' => $lastName,
                    'street' => $street,
                    'street_number' => $streetNumber,
                    'street_suffix' => $streetSuffix,
                    'zipcode' => $zipCode,
                    'city' => $city,
                    'state' => $state,
                    'country' => $country,
                    'phone_country' => $countryPhoneNumber,
                    'phone_area' => $areaPhoneNumber,
                    'phone_number' => $phoneNumber,
                    'email' => $email,
                    'social_security_number' => $socialSecurityNumber,
                    'passport_number' => $passportNumber,
                    'company_registration_number' => $companyRegistrationNumber,
                    'company_url' => $companyUrl,
                    'birth_date' => $birthDate
                ]
            ]);
        }
        catch(\Exception $e)
        {
            $_SESSION['MijnHost_Error'] = $e->getMessage();
        }

        header('Location: index.php?m=MijnHostAddon&mha-controller=Contacts');
        exit();
    }

    public function updateProfile()
    {
        $profileId = $_POST['manageProfilesSelect'];
        $alias = $_POST['alias'];
        $vatNumber = $_POST['vatNumber'];
        $street = $_POST['street'];
        $streetNumber = $_POST['streetNumber'];
        $streetSuffix = $_POST['streetSuffix'];
        $zipCode = $_POST['zipCode'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $country = $_POST['country'];
        $countryPhoneNumber = '+' . $_POST['country-calling-code-phoneNumber'];

        $areaPhoneNumber = "";
        $phoneNumber = "";

        $phoneNumberExploded = explode(" ", trim($_POST['phoneNumber']));

        if(count($phoneNumberExploded) > 1)
        {
            $areaPhoneNumber = $phoneNumberExploded[0];
            unset($phoneNumberExploded[0]);

            $phoneNumber = implode('', $phoneNumberExploded);
        }
        else
        {
            $phoneNumber = implode("", $phoneNumberExploded);

            $areaPhoneNumber = substr($phoneNumber, 0, 2);
            $phoneNumber = substr($phoneNumber, 2);
        }

        $email = $_POST['email'];
        $socialSecurityNumber = $_POST['socialSecurityNumber'];
        $passportNumber = $_POST['passportNumber'];
        $companyRegistrationNumber = $_POST['companyRegistrationNumber'];
        $companyUrl = $_POST['companyUrl'];
        $birthDate = $_POST['birthDate'];

        $adapter = new MijnHostAdapter($this->params['apiKey']);
        $client = new MijnHostClient($adapter);

        try
        {
            $client->updateProfileContact($profileId, [
                'name' => $alias,
                'profile' => [
                    'vat' => $vatNumber,
                    'street' => $street,
                    'street_number' => $streetNumber,
                    'street_suffix' => $streetSuffix,
                    'zipcode' => $zipCode,
                    'city' => $city,
                    'state' => $state,
                    'country' => $country,
                    'phone_country' => $countryPhoneNumber,
                    'phone_area' => $areaPhoneNumber,
                    'phone_number' => $phoneNumber,
                    'email' => $email,
                    'social_security_number' => $socialSecurityNumber,
                    'passport_number' => $passportNumber,
                    'company_registration_number' => $companyRegistrationNumber,
                    'company_url' => $companyUrl,
                    'birth_date' => $birthDate
                ]
            ]);
        }
        catch(\Exception $e)
        {
            $_SESSION['MijnHost_Error'] = $e->getMessage();
        }

        header('Location: index.php?m=MijnHostAddon&mha-controller=Contacts');
        exit();
    }
}