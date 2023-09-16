<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $voitures = Car::all();
        return view('index', compact('voitures')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'marque' => 'required|max:255',
            'prix' => 'required',
        ]);
        $car = Car :: create($validatedData);
        return redirect('/cars')->with('success', 'Voiture créer avec succés');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $car = Car::findOrFail($id);
        return view('edit', compact('car')); 
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'marque'=>'required|max:255',
            'prix'=>'required'
        ]);
        Car::whereId($id)->update($validatedData);
        return redirect('/cars')->with('success', 'Voiture mise à jour avec succés'); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();
        return redirect('/cars')->with('success', 'Vouture supprimée avec succès');
    
    }
}
