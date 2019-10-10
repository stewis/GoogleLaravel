<?php


namespace App\Http\Controllers\BackEnd;


use App\Address;
use App\Http\Controllers\Controller;
use App\Http\Requests\createLocationRequest;
use App\Http\Requests\updateLocationRequest;
use App\Restaurant;
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
        return view('backend.create');
    }

    public function create(createLocationRequest $request)
    {
        $restaurant = Restaurant::firstOrCreate([
            'name' => $request->restaurant_name
        ]);

        $address = new Address();
        $address->restaurant_id = $restaurant->id;
        $address->address1 = $request->address1;
        $address->address2 = $request->address2;
        $address->town = $request->town;
        $address->postcode = $request->postcode;
        $address->save();

        return redirect()
            ->route('backend.location.edit', [
                'address' => $address
            ])
            ->with('success', 'This location has been updated');
    }

    public function edit(Address $address)
    {
        return view('backend.edit', [
            'address' => $address
        ]);
    }

    public function update(updateLocationRequest $request, $address)
    {
        $restaurant = Restaurant::firstOrCreate([
            'name' => $request->restaurant_name
        ]);
        $address->restaurant_id = $restaurant->id;
        $address->address1 = $request->address1;
        $address->address2 = $request->address2;
        $address->town = $request->town;
        $address->postcode = $request->postcode;
        $address->save();

        return redirect()
            ->back()
            ->with('success', 'This location has been updated');
    }
}
