<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
       /* Blade::directive('isadmin', function () {
            //0-superuser, 1-admin, 2-member
            // check if the user is administrator
            if (Auth::user()->access_code == '1') {
                return "<?php echo ".true." ?>";
            }
            return "<?php echo ".false." ?>";
        });

        Blade::directive('datetime', function ($expression) {
            return "<?php echo ".Auth::user()->access_code." ?>";
        });*/

       /* Blade::directive('isadmin', function () {
           // $res = 0;

            //0-superuser, 1-admin, 2-member
            // check if the user is administrator
            if (Auth::user()->access_code == '1') {
                //$res = 1;
                return "<?php if (1) { ?>";
            }

            return "<?php if (0) { ?>";
        });

        Blade::directive('endisadmin', function () {
            return "<?php } ?>";
        });*/


      //  Blade::directive('author', function ($expression) {
           /* return "<?php if (0) { ?>";*/
           // $isAuth = 0;
            // check if the user authenticated is teacher
           // dd();
            /*$s = str_replace('{{', '', $expression);
            $b =  str_replace('}}', '', $s);

            dd($b);*/
           /* $b = Auth::user()->access_code;*/
           // dd($b);
            /*if ($b == "1") {
                //$isAuth = 1;
               /* return "<?php if (1) { ?>";*/
             /*   return "1";
            } else { return "3";  }*/
          /*  return "<?php if (0) { ?>";*/
            /*return "<?php if (".$isAuth.") { ?>";*/
            /*return "<?php echo (".intval($isAuth).") ?>";*/
          /*  return $expression;*/
       /* return var_dump($expression);
        });
        Blade::directive('endauthor', function ($expression) {
            /*return "<?php } ?>";*/
        //});*/

    }
}
