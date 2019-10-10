<?php


namespace App\Http\Controllers\BackEnd;


use App\Address;
use App\Http\Controllers\Controller;
use App\Http\Requests\updateLocationRequest;
use Facade\Ignition\Support\Packagist\Package;

class BackendController extends Controller
{
    public function index()
    {
        $locations = Address::paginate(10);
        return view('backend.index', [
            'locations' => $locations
        ]);
    }

    public function new()
    {

    }

    public function create()
    {

    }

    public function edit(Address $address)
    {
        return view('backend.edit', [
            'address' => $address
        ]);
    }

    public function update(updateLocationRequest $request, $address)
    {
        $address->restaurant->name = $request->restaurant_name;
        $address->address1 = $request->address1;
        $address->address2 = $request->address2;
        $address->town = $request->town;
        $address->postcode = $request->postcode;
        $address->save();

        return redirect()->back()->with('success', 'This location has been updated');
    }
}
