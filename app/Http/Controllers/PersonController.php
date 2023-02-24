<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use App\Models\Person;
use App\Http\Requests\{PersonUpdateRequest, PersonRequest};

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'success' => 1,
            'persons' => Person::with('orders')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PersonRequest $request): JsonResponse
    {
        $person = Person::create($request->all());
        return response()->json([
            'success' => 1,
            'person' => $person
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person)
    {
        return response()->json([
            'success' => 1,
            'person' => $person->load('orders')
        ]);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(PersonUpdateRequest $request, Person $person)
    {
        $person->update($request->all());
        return response()->json([
            'success' => 1,
            'person' => $person
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Person $person)
    {
        $person->is_delete = true;
        $person->save();
        return response()->json([
            'success' => 1,
            'message' => 'Person deleted successfully'
        ]);
    }
}
