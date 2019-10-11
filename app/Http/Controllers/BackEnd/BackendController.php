<?php


namespace App\Http\Controllers\BackEnd;


use App\Address;
use App\Http\Controllers\Controller;
use App\Http\Requests\createLocationRequest;
use App\Http\Requests\deleteLocationRequest;
use App\Http\Requests\updateLocationRequest;
use App\Restaurant;
use Facade\Ignition\Support\Packagist\Package;

class BackendController extends Controller
{
    /**
     * Listing for each location,  paginated
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $locations = Address::paginate(10);
        return view('backend.index', [
            'locations' => $locations
        ]);
    }

    /**
     * Show form for creating new location
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function new()
    {
        return view('backend.create');
    }

    /**
     * Save location in database
     *
     * Todo:  Remove duplication of code
     *
     * @param createLocationRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(createLocationRequest $request)
    {
        $restaurant = Restaurant::withTrashed()
            ->firstOrCreate([
                'name' => $request->restaurant_name
            ]);

        if ($restaurant->trashed()) {
            $restaurant->restore();
        }

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
            ->with('success', 'This location has been created');
    }

    /**
     *
     * Show form for editing location
     *
     * @param Address $address
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Address $address)
    {
        return view('backend.edit', [
            'address' => $address
        ]);
    }

    /**
     * Save updates to database
     *
     * Todo:  Remove duplication of code
     *
     * @param updateLocationRequest $request
     * @param Address $address
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(updateLocationRequest $request, Address $address)
    {
        $restaurant = Restaurant::withTrashed()
            ->firstOrCreate([
                'name' => $request->restaurant_name
            ]);

        if ($restaurant->trashed()) {
            $restaurant->restore();
        }

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

    /**
     * Show deletion confirmation UI
     *
     * @param Address $address
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function deleteConfirmation(Address $address)
    {
        return view('backend.delete-confirmation', [
            'address' => $address
        ]);
    }

    /**
     * Delete location
     *
     * @param deleteLocationRequest $request
     * @param Address $address
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(deleteLocationRequest $request, Address $address)
    {
        $address->delete();

        return redirect()
            ->route('backend.index', [
            'address' => $address
        ])
        ->with('success', 'This location has been deleted');

    }
}
