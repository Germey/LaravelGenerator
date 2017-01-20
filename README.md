#Laravel Generator

Laravel Generator modified from Infyom Generator by Germey.

## Introduction

Modified from [Infyom](http://labs.infyom.com/laravelgenerator/). Because the former package generator the Non-elegant config file like `config/infyom/laravel-generator.php`, so this package changed it to `config/generator.php`.

Besides, this package changed the command name from `infyom:command` to `generator:command`.

## Author

* Mitul Golakiya me@mitul.me
* Germey cqc@cuiqingcai.com

## Installation

Add following packages into your `composer.json`.

```json
"require": {
    "germey/generator": "~1.0",
    "laravelcollective/html": "^5.3.0",
    "doctrine/dbal": "~2.3"
}
```

If you want to generate a swagger annotations for your api documentation, you need to install following packages with it.

```json
"require": {
    "infyomlabs/swagger-generator": "dev-master",
    "jlapp/swaggervel": "dev-master"
}
```

Add following service providers into your providers array in `config/app.php`.

```php
Collective\Html\HtmlServiceProvider::class,
Laracasts\Flash\FlashServiceProvider::class,
Prettus\Repository\Providers\RepositoryServiceProvider::class,
Germey\Generator\GeneratorServiceProvider::class,
```

Add following alias to aliases array in `config/app.php`

```php
'Form'      => Collective\Html\FormFacade::class,
'Html'      => Collective\Html\HtmlFacade::class,
'Flash'     => Laracasts\Flash\Flash::class,
```

Run the following command:

```
php artisan vendor:publish
```

Open `app\Providers\RouteServiceProvider.php` and update `mapApiRoutes` method as following:

```php
Route::group([
    'middleware' => 'api',
    'namespace' => $this->namespace."\\API",
    'prefix' => 'api',
    'as' => 'api.',
], function ($router) {
    require base_path('routes/api.php');
});     
```

We have added `as` prefix to separate out named routes of api and web. Also its a better way to store api controllers in separate directory with separate namespace. so we have added `"\\API"` suffix in namespace.

## Commands Usage

The former docs: [Infyom](http://labs.infyom.com/laravelgenerator/docs/5.3/generator-commands)

Commands have been changed from `infyom:command` to `generator:command`.

For example:

```
php artisan infyom:rollback $MODEL_NAME $COMMAND_TYPE 
```

changed to 

```
php artisan generator:rollback $MODEL_NAME $COMMAND_TYPE 
```

Please remember replace all the `infyom` to `generator`.

