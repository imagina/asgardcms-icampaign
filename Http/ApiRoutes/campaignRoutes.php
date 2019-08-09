<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/campaigns'], function (Router $router) {
  $router->post('/', [
    'as' => 'api.icampaign.campaigns.create',
    'uses' => 'CampaignApiController@create',
  ]);
  $router->get('/', [
    'as' => 'api.icampaign.campaigns.index',
    'uses' => 'CampaignApiController@index',
  ]);
  $router->put('/{criteria}', [
    'as' => 'api.icampaign.campaigns.update',
    'uses' => 'CampaignApiController@update',
  ]);
  $router->delete('/{criteria}', [
    'as' => 'api.icampaign.campaigns.delete',
    'uses' => 'CampaignApiController@delete',
  ]);
  $router->get('/{criteria}', [
    'as' => 'api.icampaign.campaigns.show',
    'uses' => 'CampaignApiController@show',
  ]);
});
