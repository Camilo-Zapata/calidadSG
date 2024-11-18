<?php

namespace App\Http\Controllers;

use App\Models\Verificacion;
use App\Models\Tema;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VerificacionController extends Controller
{
    public function index(Tema $tema)
    {
        return Inertia::render('Verificaciones/Index', [
            'tema' => $tema,
            'verificaciones' => $tema->verificaciones()->orderBy('fecha_verificacion', 'desc')->get(),
        ]);
    }

    public function store(Request $request, Tema $tema)
    {
        $validated = $request->validate([
            'fecha_verificacion' => 'required|date',
            'responsable' => 'required|string|max:255',
        ]);

        $tema->verificaciones()->create($validated);

        return redirect()->route('verificaciones.index', $tema->id);
    }

    public function destroy(Tema $tema, Verificacion $verificacion)
        {
            // Opcional: verifica que la verificación pertenece al tema
            if ($verificacion->tema_id !== $tema->id) {
                abort(404, 'La verificación no pertenece al tema especificado.');
            }

            $verificacion->delete();

            return to_route('verificaciones.index',$tema );
        }


        public function edit(Tema $tema, Verificacion $verificacion)
{
    return inertia('Verificaciones/Edit', [
        'tema' => $tema,
        'verificacion' => $verificacion
    ]);
}

public function update(Request $request, Tema $tema, Verificacion $verificacion)
{
    $validated = $request->validate([
        'fecha_verificacion' => 'required|string|max:255',
        'responsable' => 'required|string|max:255', // Ajusta los campos según tu modelo
    ]);

    $verificacion->update($validated);

    return to_route('verificaciones.index', $tema)->with('success', 'Verificación actualizada correctamente.');
}

}
