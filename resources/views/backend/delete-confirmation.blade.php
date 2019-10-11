@extends('layouts.backend')

@section('title')
    Admin Edit - {{ $address }}
@stop

@section('content')
    @parent
    <div class="container mt-4">
        <form method="post" action="{{ route('backend.location.delete.confirm', [
            'address' => $address
        ]) }}">

            {!! csrf_field() !!}

            <div class="alert alert-danger">
                <div class="row">
                    <div class="col-12">
                        <p>
                            This will delete the following location:
                        </p>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-md-3">
                        Restaurant:
                    </div>
                    <div class="col-12 col-md-7 font-weight-bold">
                        {{ $address->restaurant->name }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-md-3">
                        Address1:
                    </div>
                    <div class="col-12 col-md-7 font-weight-bold">
                        {{ $address->address1 }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-md-3">
                        Address2:
                    </div>
                    <div class="col-12 col-md-7 font-weight-bold">
                        {{ $address->address2 }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-md-3">
                        Town:
                    </div>
                    <div class="col-12 col-md-7 font-weight-bold">
                        {{ $address->town }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12 col-md-3">
                        Postcode:
                    </div>
                    <div class="col-12 col-md-7 font-weight-bold">
                        {{ $address->postcode }}
                    </div>
                </div>

                <div class="row">
                    <div class="offset-md-3 col-12 col-md-7">
                        <input type="submit" value="Delete Location" class="btn btn-danger" />
                        <a href="{{ route('backend.index') }}" class="btn btn-primary">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
