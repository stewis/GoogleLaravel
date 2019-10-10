@extends('layouts.default')

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="py-2 text-right">
                    <a href="" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add Resturant</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
@endpush
