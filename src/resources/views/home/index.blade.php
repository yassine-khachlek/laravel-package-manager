@extends('layouts.app')

@section('content')

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
					@if( File::exists(base_path('vendor/'.$package.'/README.md')) )

						<a href="{{ route('packages.show', explode('/', $package)) }}" class="btn btn-primary btn-lg btn-block" role="button">Details</a>

					@endif
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>

@endsection