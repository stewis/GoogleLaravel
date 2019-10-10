@extends('layouts.backend')

@section('title')
    Admin Edit - {{ $address }}
@stop

@section('content')
    @parent
    <div class="container mt-4">
        <form method="post" action="{{ route('backend.location.update', [
            'address' => $address
        ]) }}">
            @include('backend.partials.form')
            <input type="submit" value="Save Changes" class="btn btn-primary" />
        </form>
    </div>
@endsection
