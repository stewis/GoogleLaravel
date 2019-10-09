@extends('layouts.backend')

@section('title')
    Admin
@stop

@section('content')
    @parent
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <tr>
                        <th>
                            Resturant
                        </th>
                        <th>
                            Address
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    @foreach($locations as $location)
                        <tr>
                            <td>
                                {{ $location->restaurant }}
                            </td>
                            <td>
                                {{ $location }}
                            </td>
                            <td class="text-right">
                                <a href="" class="btn-sm btn-primary">
                                    Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div>
            {{ $locations->links() }}
        </div>
    </div>
@endsection
