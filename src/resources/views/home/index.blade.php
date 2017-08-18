@extends('layouts.app')

@section('content')

	<a href="{{ route('packages.create') }}" class="btn btn-primary btn-lg btn-block" role="button">Create</a>

	<table class="table">
		<thead>
			<tr>
				<th>#</th>
				<th>Name</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
		@foreach($packages as $package)
			<tr>
				<td>
					{{ $loop->iteration }}
				</td>
				<td>
					{{ $package }}
				</td>
				<td>
					@if( File::exists(base_path(Config('vendor.yk.laravel-package-manager.package.path').'/'.$package.'/README.md')) )

						<a href="{{ route('packages.show', explode('/', $package)) }}" class="btn btn-primary btn-lg btn-block" role="button">Details</a>

					@endif
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>

@endsection