<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegistroEvento;
use App\Models\Contrato;

class RegistroEventosController extends Controller
{
    //
    public function index(Request $request)
    {
        $search = $request->input('search');

        $contratos = Contrato::query()
            ->where('descripcion', 'LIKE', "%{$search}%")
            // Add more search criteria if needed
            ->paginate(10);

        return view('contratos.index', compact('contratos'));
    }


    public function create()
    {
        // Puedes implementar lógica para crear un nuevo evento
        return view('eventos.create');
    }

    public function store(Request $request)
    {
        // Valida los datos enviados desde el formulario
        $validatedData = $request->validate([
            'idcontrato' => 'required|integer',
            'evento' => 'required|max:100',
            'descripcion' => 'required',
        ]);

        // Crea un nuevo registro de evento y asigna los valores validados
        $evento = RegistroEvento::create([
            'idcontrato' => $validatedData['idcontrato'],
            'evento' => $validatedData['evento'],
            'descripcion' => $validatedData['descripcion'],
        ]);

        return redirect()->route('eventos.index')->with('success', 'Evento registrado con éxito.');
    }

    public function show($id)
    {
        $evento = RegistroEvento::findOrFail($id);
        return view('eventos.show', compact('evento'));
    }

    public function edit($id)
    {
        $evento = RegistroEvento::findOrFail($id);
        return view('eventos.edit', compact('evento'));
    }

    public function update(Request $request, $id)
    {
        // Valida los datos enviados desde el formulario
        $validatedData = $request->validate([
            'idcontrato' => 'required|integer',
            'evento' => 'required|max:100',
            'descripcion' => 'required',
        ]);

        $evento = RegistroEvento::findOrFail($id);
        $evento->update($validatedData);

        return redirect()->route('eventos.index')->with('success', 'Evento actualizado con éxito.');
    }

    public function destroy($id)
    {
        $evento = RegistroEvento::findOrFail($id);
        $evento->delete();

        return redirect()->route('eventos.index')->with('success', 'Evento eliminado con éxito.');
    }
}
