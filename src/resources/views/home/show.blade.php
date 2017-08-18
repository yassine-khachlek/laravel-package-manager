@extends('layouts.app')

@section('content')

	<a href="{{ route('packages.index') }}" class="btn btn-primary btn-lg btn-block" role="button">Packages</a>

	{{
		\Illuminate\Mail\Markdown::parse(File::get(base_path(Config('vendor.yk.laravel-package-manager.package.path').'/'.$provider.'/'.$package.'/README.md')))
	}}

@endsection