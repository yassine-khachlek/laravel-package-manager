<?php

namespace Yk\LaravelPackageManager\App\Http\Controllers;

use Illuminate\Http\Request;
use Yk\LaravelPackageManager\App\Package;

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
}
