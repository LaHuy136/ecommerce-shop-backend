<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.country.index', [
            'countries' => Country::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.country.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCountryRequest $request)
    {
        $countryAttributes = $request->validated();

        $country = Country::create($countryAttributes);

        if (! $country) {
            return back()->withErrors('Created country failed');
        }

        return redirect()
            ->route('admin.country.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        return view('admin.country.show', compact(
            'country'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        return view('admin.country.edit', compact(
            'country'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $data =  $request->validated();

        $country->update($data);

        return redirect()
            ->route('admin.country.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->deleteOrFail();

        return redirect()
            ->route('admin.country.index');
    }
}
