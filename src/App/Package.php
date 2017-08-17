<?php

namespace Yk\LaravelPackageManager\App;

use Yk\LaravelPackageManager\App\Vendor;

class Package
{
    public static function all() {

    	$packages = [];

        array_map(function($vendor) use (& $packages) {

			array_map(function ($package) use ($vendor, & $packages) {

                $packages[] = $vendor.'/'.basename($package);

            }, \File::directories(base_path('vendor/'.$vendor)));

        }, Vendor::all());

        asort($packages);

        return $packages;

    }
}
