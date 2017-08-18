@extends('layouts.app')

@section('content')

	<a href="{{ route('packages.index') }}" class="btn btn-primary btn-lg btn-block" role="button">Packages</a>

    <form class="form-horizontal" method="POST" action="{{ route('packages.store') }}">
    	{{ method_field('POST') }}
        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            <label for="url" class="col-md-12">Url</label>

            <div class="col-md-12">
                <input id="url" type="text" class="form-control" name="url" value="{{ old('url') }}" required autofocus>

                @if ($errors->has('url'))
                    <span class="help-block">
                        <strong>{{ $errors->first('url') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12 col-md-offset-0">
                <button type="submit" class="btn btn-primary btn-lg btn-block">
                    Install
                </button>
            </div>
        </div>
    </form>

@endsection
