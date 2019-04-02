<?php


namespace Pranto\MultiLanguage;
use Illuminate\Support\ServiceProvider;
use Pranto\MultiLanguage\Middleware\ChangeLanguage;

class MultiLanguageServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/route/web.php');
//        $router = $this->app['router'];
//        $router->pushMiddlewareToGroup('web', ChangeLanguage::class);

    }


    public function register()
    {
//        $this->commands('create_languages_table');
    }

}