@extends('layouts.backend')

@section('title')
    Admin New
@stop

@section('content')
    @parent
    <div class="container mt-4">
        <form method="post" action="{{ route('backend.location.create') }}">
            @include('backend.partials.form')
            <input type="submit" value="Save New" class="btn btn-primary" />
        </form>
    </div>
@endsection
