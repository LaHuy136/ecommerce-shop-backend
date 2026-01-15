<?php

namespace App\Http\Controllers\Admin;

use App\Models\Country;
use App\Http\Requests\Admin\Countries\StoreCountryRequest;
use App\Http\Requests\Admin\Countries\UpdateCountryRequest;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.countries.index', [
            'countries' => Country::orderBy('id', 'asc')
                ->latest()
                ->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.countries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCountryRequest $request)
    {
        $countryAttributes = $request->validated();

        Country::create($countryAttributes);

        return redirect()
            ->route('admin.countries')
            ->with(
                'success',
                'Created country successfully'
            );;
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        return view('admin.countries.show', compact(
            'country'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        return view('admin.countries.edit', compact(
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
            ->route('admin.countries')
            ->with(
                'success',
                'Updated country successfully'
            );;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->deleteOrFail();

        return redirect()
            ->route('admin.countries')
            ->with(
                'success',
                'Deleted country successfully'
            );;
    }
}
