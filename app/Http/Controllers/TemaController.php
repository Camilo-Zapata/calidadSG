<?php

namespace App\Http\Controllers;

use App\Models\Tema;
use Illuminate\Http\Request;
use App\Http\Requests\Tema\StoreRequest;
use Inertia\Inertia;


class TemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tema = Tema::all();
        return Inertia::render('Tema/Index', compact('tema') );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Tema/Create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store( StoreRequest $request)

    {
        $data =  $request->validated();

        Tema::create($data);

        return to_route('tema.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tema $tema)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tema $tema)
    {
        return Inertia::render('Tema/Edit', compact('tema'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreRequest $request, Tema $tema)
{
    $data = $request->validated();

    $tema->update($data);

    return to_route('tema.edit', $tema);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tema $tema)
    {
        $tema->delete();
        return to_route('tema.index');
    }
}
