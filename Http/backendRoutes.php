<?php

use Illuminate\Routing\Router;
/** @var Router $router */

$router->group(['prefix' =>'/icampaign'], function (Router $router) {
    $router->bind('campaign', function ($id) {
        return app('Modules\Icampaign\Repositories\CampaignRepository')->find($id);
    });
    $router->get('campaigns', [
        'as' => 'admin.icampaign.campaign.index',
        'uses' => 'CampaignController@index',
        'middleware' => 'can:icampaign.campaigns.index'
    ]);
    $router->get('campaigns/create', [
        'as' => 'admin.icampaign.campaign.create',
        'uses' => 'CampaignController@create',
        'middleware' => 'can:icampaign.campaigns.create'
    ]);
    $router->post('campaigns', [
        'as' => 'admin.icampaign.campaign.store',
        'uses' => 'CampaignController@store',
        'middleware' => 'can:icampaign.campaigns.create'
    ]);
    $router->get('campaigns/{campaign}/edit', [
        'as' => 'admin.icampaign.campaign.edit',
        'uses' => 'CampaignController@edit',
        'middleware' => 'can:icampaign.campaigns.edit'
    ]);
    $router->put('campaigns/{campaign}', [
        'as' => 'admin.icampaign.campaign.update',
        'uses' => 'CampaignController@update',
        'middleware' => 'can:icampaign.campaigns.edit'
    ]);
    $router->delete('campaigns/{campaign}', [
        'as' => 'admin.icampaign.campaign.destroy',
        'uses' => 'CampaignController@destroy',
        'middleware' => 'can:icampaign.campaigns.destroy'
    ]);
    $router->bind('recipient', function ($id) {
        return app('Modules\Icampaign\Repositories\RecipientRepository')->find($id);
    });
    $router->get('recipients', [
        'as' => 'admin.icampaign.recipient.index',
        'uses' => 'RecipientController@index',
        'middleware' => 'can:icampaign.recipients.index'
    ]);
    $router->get('recipients/create', [
        'as' => 'admin.icampaign.recipient.create',
        'uses' => 'RecipientController@create',
        'middleware' => 'can:icampaign.recipients.create'
    ]);
    $router->post('recipients', [
        'as' => 'admin.icampaign.recipient.store',
        'uses' => 'RecipientController@store',
        'middleware' => 'can:icampaign.recipients.create'
    ]);
    $router->get('recipients/{recipient}/edit', [
        'as' => 'admin.icampaign.recipient.edit',
        'uses' => 'RecipientController@edit',
        'middleware' => 'can:icampaign.recipients.edit'
    ]);
    $router->put('recipients/{recipient}', [
        'as' => 'admin.icampaign.recipient.update',
        'uses' => 'RecipientController@update',
        'middleware' => 'can:icampaign.recipients.edit'
    ]);
    $router->delete('recipients/{recipient}', [
        'as' => 'admin.icampaign.recipient.destroy',
        'uses' => 'RecipientController@destroy',
        'middleware' => 'can:icampaign.recipients.destroy'
    ]);
// append


});
