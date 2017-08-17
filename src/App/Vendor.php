<?php

namespace Yk\LaravelPackageManager\App;

class Vendor
{
    public static function all() {

        return array_map(function ($vendor) {
        	
            return basename($vendor);

        }, \File::directories(base_path('vendor')));

    }
}
