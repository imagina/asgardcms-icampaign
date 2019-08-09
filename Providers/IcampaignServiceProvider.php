<?php

namespace Modules\Icampaign\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Icampaign\Events\Handlers\RegisterIcampaignSidebar;

class IcampaignServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterIcampaignSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('campaigns', array_dot(trans('icampaign::campaigns')));
            $event->load('recipients', array_dot(trans('icampaign::recipients')));
            // append translations


        });
    }

    public function boot()
    {
        $this->publishConfig('icampaign', 'permissions');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Icampaign\Repositories\CampaignRepository',
            function () {
                $repository = new \Modules\Icampaign\Repositories\Eloquent\EloquentCampaignRepository(new \Modules\Icampaign\Entities\Campaign());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Icampaign\Repositories\Cache\CacheCampaignDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Icampaign\Repositories\RecipientRepository',
            function () {
                $repository = new \Modules\Icampaign\Repositories\Eloquent\EloquentRecipientRepository(new \Modules\Icampaign\Entities\Recipient());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Icampaign\Repositories\Cache\CacheRecipientDecorator($repository);
            }
        );
// add bindings


    }
}
