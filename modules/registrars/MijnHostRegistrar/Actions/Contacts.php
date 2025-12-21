<?php

namespace ModulesGarden\MijnHostRegistrar\Actions;

use ModulesGarden\MijnHostRegistrar\API\Adapters\MijnHostAdapter;
use ModulesGarden\MijnHostRegistrar\API\Clients\MijnHostClient;
use ModulesGarden\MijnHostRegistrar\Helpers\Lang;

class Contacts extends AbstractAction
{
    function execute(): array
    {
        $action = $_GET['mhr-action'];

        if($action == 'assignProfile' && !empty($_POST['assignProfileOwnerSelect']) && !empty($_POST['assignProfileAdminSelect']) && !empty($_POST['assignProfileTechSelect']))
        {
            $this->assignProfile();
        }

        return $this->index();
    }

    protected function index(): array
    {
        $adapter = new MijnHostAdapter($this->params['ApiKey']);
        $client = new MijnHostClient($adapter);

        $domainInfo = $client->getDomain($this->params['domain_punycode']);

        $ownerContactId = $domainInfo->data->handles->owner->handle_id;
        $techContactId = $domainInfo->data->handles->tech->handle_id;
        $adminContactId = $domainInfo->data->handles->admin->handle_id;
        $billingContactId = $domainInfo->data->handles->billing->handle_id;

        $profilesInfo = $client->listProfilesContacts();

        $profiles = [];

        foreach($profilesInfo->data->profiles as $profile)
        {
            $profiles[$profile->id] = [
                'alias' => $profile->alias
            ];
        }

        return [
            'templatefile' => 'contacts',
            'vars' => [
                'lang' => new Lang(),
                'domainId' => $this->params['domainid'],
                'ownerContactId' => $ownerContactId,
                'techContactId' => $techContactId,
                'adminContactId' => $adminContactId,
                'billingContactId' => $billingContactId,
                'profiles' => $profiles,
            ]
        ];
    }

    protected function assignProfile()
    {
        $ownerProfile = $_POST['assignProfileOwnerSelect'];
        $adminProfile = $_POST['assignProfileAdminSelect'];
        $techProfile = $_POST['assignProfileTechSelect'];
        $billingProfile = $_POST['assignProfileBillingSelect'];

        $adapter = new MijnHostAdapter($this->params['ApiKey']);
        $client = new MijnHostClient($adapter);

        $client->updateDomain($this->params['domain_punycode'], [
            'profile' => [
                'owner' => (int) $ownerProfile,
                'admin' => (int) $adminProfile,
                'tech' => (int) $techProfile,
                'billing' => (int) $billingProfile,
            ]
        ]);

        header('Location: clientarea.php?action=domaindetails&id=' . $this->params['domainid'] . '&modop=custom&a=Contacts' . generate_token('link'));
        exit();
    }
}