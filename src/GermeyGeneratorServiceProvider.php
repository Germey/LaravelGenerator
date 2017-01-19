<?php

namespace Germey\Generator;

use Illuminate\Support\ServiceProvider;
use Germey\Generator\Commands\API\APIControllerGeneratorCommand;
use Germey\Generator\Commands\API\APIGeneratorCommand;
use Germey\Generator\Commands\API\APIRequestsGeneratorCommand;
use Germey\Generator\Commands\API\TestsGeneratorCommand;
use Germey\Generator\Commands\APIScaffoldGeneratorCommand;
use Germey\Generator\Commands\Common\MigrationGeneratorCommand;
use Germey\Generator\Commands\Common\ModelGeneratorCommand;
use Germey\Generator\Commands\Common\RepositoryGeneratorCommand;
use Germey\Generator\Commands\Publish\GeneratorPublishCommand;
use Germey\Generator\Commands\Publish\LayoutPublishCommand;
use Germey\Generator\Commands\Publish\PublishTemplateCommand;
use Germey\Generator\Commands\Publish\VueJsLayoutPublishCommand;
use Germey\Generator\Commands\RollbackGeneratorCommand;
use Germey\Generator\Commands\Scaffold\ControllerGeneratorCommand;
use Germey\Generator\Commands\Scaffold\RequestsGeneratorCommand;
use Germey\Generator\Commands\Scaffold\ScaffoldGeneratorCommand;
use Germey\Generator\Commands\Scaffold\ViewsGeneratorCommand;
use Germey\Generator\Commands\VueJs\VueJsGeneratorCommand;

class GermeyGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__.'/../config/generator.php';

        $this->publishes([
            $configPath => config_path('generator.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('generator.publish', function ($app) {
            return new GeneratorPublishCommand();
        });

        $this->app->singleton('generator.api', function ($app) {
            return new APIGeneratorCommand();
        });

        $this->app->singleton('generator.scaffold', function ($app) {
            return new ScaffoldGeneratorCommand();
        });

        $this->app->singleton('generator.publish.layout', function ($app) {
            return new LayoutPublishCommand();
        });

        $this->app->singleton('generator.publish.templates', function ($app) {
            return new PublishTemplateCommand();
        });

        $this->app->singleton('generator.api_scaffold', function ($app) {
            return new APIScaffoldGeneratorCommand();
        });

        $this->app->singleton('generator.migration', function ($app) {
            return new MigrationGeneratorCommand();
        });

        $this->app->singleton('generator.model', function ($app) {
            return new ModelGeneratorCommand();
        });

        $this->app->singleton('generator.repository', function ($app) {
            return new RepositoryGeneratorCommand();
        });

        $this->app->singleton('generator.api.controller', function ($app) {
            return new APIControllerGeneratorCommand();
        });

        $this->app->singleton('generator.api.requests', function ($app) {
            return new APIRequestsGeneratorCommand();
        });

        $this->app->singleton('generator.api.tests', function ($app) {
            return new TestsGeneratorCommand();
        });

        $this->app->singleton('generator.scaffold.controller', function ($app) {
            return new ControllerGeneratorCommand();
        });

        $this->app->singleton('generator.scaffold.requests', function ($app) {
            return new RequestsGeneratorCommand();
        });

        $this->app->singleton('generator.scaffold.views', function ($app) {
            return new ViewsGeneratorCommand();
        });

        $this->app->singleton('generator.rollback', function ($app) {
            return new RollbackGeneratorCommand();
        });

        $this->app->singleton('generator.vuejs', function ($app) {
            return new VueJsGeneratorCommand();
        });
        $this->app->singleton('generator.publish.vuejs', function ($app) {
            return new VueJsLayoutPublishCommand();
        });

        $this->commands([
            'generator.publish',
            'generator.api',
            'generator.scaffold',
            'generator.api_scaffold',
            'generator.publish.layout',
            'generator.publish.templates',
            'generator.migration',
            'generator.model',
            'generator.repository',
            'generator.api.controller',
            'generator.api.requests',
            'generator.api.tests',
            'generator.scaffold.controller',
            'generator.scaffold.requests',
            'generator.scaffold.views',
            'generator.rollback',
            'generator.vuejs',
            'generator.publish.vuejs',
        ]);
    }
}
