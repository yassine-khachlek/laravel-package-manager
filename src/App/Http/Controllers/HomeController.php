<?php

namespace Yk\LaravelPackageManager\App\Http\Controllers;

use Illuminate\Http\Request;
use Yk\LaravelPackageManager\App\Package;
use File;
use Config;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Yk/LaravelPackageManager::home.index', ['packages' => Package::all()]);
    }

    public function show($provider, $package)
    {
        return view('Yk/LaravelPackageManager::home.show', compact('provider', 'package'));
    }

    public function create()
    {
        return view('Yk/LaravelPackageManager::home.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'url' => 'required|url',
        ]);

        $this->download($request->url);

    }

    private function download($url) {

        \File::makeDirectory(storage_path('vendor/yk/laravel-package-manager'), 0755, true, true);

        file_put_contents(storage_path('vendor/yk/laravel-package-manager/tmp.zip'), fopen($url, 'r'));

        $zip = new \ZipArchive;

        if ($zip->open(storage_path('vendor/yk/laravel-package-manager/tmp.zip')) === TRUE) {

            $zip->extractTo(storage_path('vendor/yk/laravel-package-manager/tmp'));
            $zip->close();

            $list = \File::directories(storage_path('vendor/yk/laravel-package-manager/tmp'));

            foreach ($list as $folder) {

                $composer_json = \File::get($folder.'/composer.json');

                $composer_json = json_decode($composer_json);

                $result = \File::makeDirectory($composer_json->name, 0775, true, true);

                \File::copyDirectory($folder, base_path(\Config('vendor.yk.laravel-package-manager.package.path').'/'.$composer_json->name));
            }

        } else {

            echo 'failed';

        }

        \File::delete(storage_path('vendor/yk/laravel-package-manager/tmp.zip'));

        $success = \File::deleteDirectory(storage_path('vendor/yk/laravel-package-manager/tmp'));

        
        $this->registerAutoloadPsr(explode('/', $composer_json->name)[0], explode('/', $composer_json->name)[1]);

        $this->registerProvider(explode('/', $composer_json->name)[0], explode('/', $composer_json->name)[1]);

    }

    private function registerAutoloadPsr ($provider_name, $package_name) {

        $package_path = base_path(
            
            \Config('vendor.yk.laravel-package-manager.package.path').'/'.$provider_name.'/'.$package_name

        );

        $composer_json = json_decode(File::get(base_path('composer.json')));
        
        $composer_json->autoload->{"psr-4"}->{join('\\',
                    [studly_case($provider_name), studly_case($package_name)]
                ).'\\'} = str_replace(base_path().'/', '', $package_path.'/src/');

        File::put(base_path('composer.json'), json_encode($composer_json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

        $exitCode = \Artisan::call('optimize', [
            '--force' => true,
        ]);

    }

    private function registerProvider ($provider_name, $package_name) {

        $provider = join('\\',
                    [studly_case($provider_name), studly_case($package_name), studly_case($package_name).'ServiceProvider::class']
                );

        $config_app = include base_path('config/app.php');

        if ( ! in_array($provider, $config_app['providers'])) {
            $config_app['providers'][] = $provider;
        }

        File::put(base_path('config/app.php'), '<?php return ' . var_export($config_app, true) . ';');

    }
}
