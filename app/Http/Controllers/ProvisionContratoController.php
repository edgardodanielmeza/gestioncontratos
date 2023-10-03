<?php

namespace App\Http\Controllers;

use App\Models\ProvisionContrato;
use App\Models\Contrato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use finfo;
class ProvisionContratoController extends Controller
{

    public function create( $id)
    {

        $contrato = Contrato::find($id);

        return view('provisiones.create', compact('contrato'));

    }



    public function edit( $id)
    {

        $contrato = Contrato::find($id);

        return view('provisiones.edit', compact('contrato'));

    }
    public function index(Request $request)
    {

        $search = $request->input('search');

        $contratos = Contrato::query()
            ->where('descripcion', 'LIKE', "%{$search}%")
            // Add more search criteria if needed
            ->paginate(10);

        return view('provisiones.index', compact('contratos'));

    }

    public function store(Request $request)
    {

        // Valida los datos enviados desde el formulario
        $validatedData = $request->validate([
            'itemID' => 'required',
            'idcontrato' => 'required',
            'cantidad_provision' => 'required|numeric',
            'fecha' => 'required|date',
        ]);

        // Crea una nueva instancia de la provisión y asigna los valores validados
        $provision = new ProvisionContrato([
            'iditem' => $validatedData['itemID'],
            'idcontrato' => $validatedData['idcontrato'],
            'cantidad_provision' => $validatedData['cantidad_provision'],
            'fecha' => $validatedData['fecha'],
        ]);

        // Guarda la provisión en la base de datos
        $provision->save();

        // Redirecciona a la página anterior (tal vez la página de detalles del contrato)
        return back()->with('success', 'Provisión guardada con éxito.');
    }

    public function destroy($id)
    {

            $provision = ProvisionContrato::findOrFail($id);

        
            $provision->delete();

            return back()->with('success', 'Provisión Eliminada éxito.');
    }


   }
