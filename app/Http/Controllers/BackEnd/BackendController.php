<?php


namespace App\Http\Controllers\BackEnd;


use App\Address;
use App\Http\Controllers\Controller;

class BackendController extends Controller
{
    public function index()
    {
        $locations = Address::paginate(10);
        return view('backend.index', [
            'locations' => $locations
        ]);
    }
}
