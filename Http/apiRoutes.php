<?php

use Illuminate\Routing\Router;

  $router->group(['prefix' => '/icampaign/v1'], function (Router $router) {

  // Campaigns Routes
  require('ApiRoutes/campaignRoutes.php');

  // Recipients Routes
  require('ApiRoutes/recipientRoutes.php');
});
