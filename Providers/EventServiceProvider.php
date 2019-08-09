<?php


namespace Modules\Icampaign\Providers;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use Modules\Icampaign\Events\Handlers\EmitNotificationsListener;
use Modules\Icampaign\Events\EmitNotifications;

class EventServiceProvider extends ServiceProvider
{
  protected $listen = [
    EmitNotifications::class => [
      EmitNotificationsListener::class,
    ],
  ];
}
