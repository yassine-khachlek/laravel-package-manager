<?php

namespace Yk\LaravelPackageManager\App;

use Config;

class Vendor
{
    public static function all() {

        return array_map(function ($vendor) {
        	
            return basename($vendor);

        }, \File::directories(base_path(Config::get('vendor.yk.laravel-package-manager.package.path'))));

    }
}
