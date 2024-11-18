<?php

namespace App\Http\Controllers;

use App\Models\Asistente;
use Illuminate\Http\Request;
use App\Models\Tema;

use Inertia\Inertia;


class AsistenteController extends Controller
{
    public function index(Tema $tema)
    {

        $tema = Tema::all();
        $asistente = Asistente::all();

        return Inertia::render('Asistentes/Index', compact('tema','asistente') );


    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'confirmado' => 'required|boolean',
            'tema_id' => 'required|exists:temas,id',
        ]);

        try {
            $tema = Tema::findOrFail($validated['tema_id']);

            $tema->asistentes()->create($validated);

            return  to_route('asistentes.index');

        } catch (\Exception $e) {
            return  to_route('asistentes.index');
        }
    }


    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'nombre' => 'required|string|max:255',
        'cargo' => 'required|string|max:255',
        'confirmado' => 'required|boolean',
        'tema_id' => 'required|exists:temas,id',
    ]);

    try {
        $asistente = Asistente::findOrFail($id);
        $asistente->update($validated); // Actualizar los datos del asistente

        // Obtener la lista actualizada de asistentes
        $tema = $asistente->tema;
        $asistentes = $tema->asistentes;

        return response()->json([
            'success' => true,
            'asistentes' => $asistentes, // Lista actualizada
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error al actualizar el asistente',
        ], 500);
    }
}






    public function destroy(Asistente $asistente)
    {
        $asistente->delete();

        return  to_route('asistentes.index');    }
}
