<?php

return [
    'icampaign.campaigns' => [
        'index' => 'icampaign::campaigns.list resource',
        'create' => 'icampaign::campaigns.create resource',
        'edit' => 'icampaign::campaigns.edit resource',
        'destroy' => 'icampaign::campaigns.destroy resource',
    ],
    'icampaign.recipients' => [
        'index' => 'icampaign::recipients.list resource',
        'create' => 'icampaign::recipients.create resource',
        'edit' => 'icampaign::recipients.edit resource',
        'destroy' => 'icampaign::recipients.destroy resource',
    ],
// append


];
