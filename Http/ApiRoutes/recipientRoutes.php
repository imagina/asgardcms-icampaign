<?php

use Illuminate\Routing\Router;

$router->group(['prefix' => '/recipients' ], function (Router $router) {

  $router->post('/', [
    'as' => 'api.icampaign.recipients.create',
    'uses' => 'RecipientApiController@create',
  ]);
  $router->get('/', [
    'as' => 'api.icampaign.recipients.index',
    'uses' => 'RecipientApiController@index',
  ]);
  $router->put('/{criteria}', [
    'as' => 'api.icampaign.recipients.update',
    'uses' => 'RecipientApiController@update',
  ]);
  $router->delete('/{criteria}', [
    'as' => 'api.icampaign.recipients.delete',
    'uses' => 'RecipientApiController@delete',
  ]);
  $router->get('/{criteria}', [
    'as' => 'api.icampaign.recipients.show',
    'uses' => 'RecipientApiController@show',
  ]);

});
