<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'status' => 200,
            'data' => Country::latest('created_at')
                ->paginate(5)
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $name = $request->validate([
            'name' => ['required', 'string']
        ]);

        $country = Country::create($name);

        return response()->json([
            'status' => 200,
            'message' => 'Created country successfully',
            'data' => $country
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $country = Country::findOrFail($id);

        return response()->json([
            'status' => 200,
            'data' => $country
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $country = Country::findOrFail($id);

        $name = $request->validate([
            'name' => [
                'required',
                ' string',
                Rule::unique('countries', 'name')->ignore($id)
            ]
        ]);

        $country->update($name);

        return response()->json([
            'status' => 200,
            'message' => 'Updated country successfully',
            'data' => $country
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        $country->destroy($country->id);

        return response()->json([
            'status' => 200,
            'message' => 'Deleted country successfully'
        ], 200);
    }
}
