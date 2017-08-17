<?php

namespace Yk\LaravelPackageManager\App;

use Config;
use Yk\LaravelPackageManager\App\Vendor;

class Package
{
    public static function all() {

    	$packages = [];

        array_map(function($vendor) use (& $packages) {

			array_map(function ($package) use ($vendor, & $packages) {

                $packages[] = $vendor.'/'.basename($package);

            }, \File::directories(base_path(Config::get('vendor.yk.laravel-package-manager.package.path').'/'.$vendor)));

        }, Vendor::all());

        asort($packages);

        return $packages;

    }
}
