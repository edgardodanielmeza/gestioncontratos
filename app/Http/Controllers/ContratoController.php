<?php

namespace App\Http\Controllers;


use App\Models\ContratoItem;
use Illuminate\Http\Request;
use App\Models\Contrato;
use App\Models\TipoContrato;
use App\Models\Administrador;
use App\Models\Contratista;
use App\Models\Fiscal;
use App\Models\ContratoFiscal;
use App\Models\Item;
use App\Models\ProvisionContrato;
use finfo;

class ContratoController extends Controller
{
    // public function index()
    // {
    //     $contratos = Contrato::all();

    //     return view('contratos.index', compact('contratos'));
    // }

    public function index(Request $request)
    {
        $search = $request->input('search');

        $contratos = Contrato::query()
            ->where('descripcion', 'LIKE', "%{$search}%")
            // Add more search criteria if needed
            ->paginate(10);

        return view('contratos.index', compact('contratos'));
    }





    public function mo()
    {
        return view('contratos.mo');
    }
    public function show($idcontrato)
    {
        $contrato = Contrato::find($idcontrato);

        return view('contratos.show', compact('contrato'));
    }

    public function create()
    {
        $tipocontrato = TipoContrato::all();
        // Obtener los administradores
        $administradores = Administrador::all();
        // Obtener los contratistas
        $contratistas = Contratista::all();
         // Obtener los fiscales
         $fiscales = Fiscal::all();
         $item = Item::all();

        return view('contratos.create', compact('tipocontrato', 'administradores', 'contratistas','fiscales','item'));
    }

    public function store(Request $request)
    {
            dd(json_decode( $request->contratoItems, true));

        // Validar los datos del formulario
        /*
        $request->validate([
            'descripcion' => 'required|string|max:100',
            'alias' => 'required|string|max:50',
            'idtipocontrato' => 'required|integer',
            'idadministrador' => 'required|integer',
            'fechafirma' => 'required|date',
            'idcontratista' => 'required|integer',
            'anho' => 'required|integer',
            'idContrataciones' => 'required|integer',
            'idmonto' => 'required|integer',
            'fechainicio' => 'required|date',

               'fecha_ARTP' => 'required|date',
            'fecha_ARTD' => 'required|date',

        ]);
         /**/

        // Crear un nuevo contrato
        $contrato = new Contrato();

        $contrato->descripcion = $request->descripcion;
        $contrato->idContrataciones = $request->idContrataciones;
        $contrato->idtipocontrato = $request->idtipocontrato;

        $contrato->fechafirma = $request->fechafirma;
        $contrato->anho = $request->anho;
        $contrato->idmonto = $request->idmonto;


        $contrato->alias = $request->alias;
        $contrato->idadministrador = $request->idadministrador;
        $contrato->idcontratista = $request->idcontratista;
        $contrato->fechainicio = $request->fechainicio;
        $contrato->idcontrato=1;

        if($request->fecha_ARTP)
                $contrato->fecha_ARTP = $request->fecha_ARTP;
        if($request->fecha_ARTD)
                $contrato->fecha_ARTD = $request->fecha_ARTD;


        // Guardar el contrato en la base de datos
         $contrato->save();

        // Crear registros en la tabla contratofiscal para asociar contratos y fiscales



        foreach ($request->fiscales as $fiscalId) {
            $contratofiscal = new  ContratoFiscal();
            $contratofiscal->idcontrato = $contrato->idcontrato;
            $contratofiscal->idfiscal = $fiscalId;
            $contratofiscal->save();


         }

      // Decodificar el JSON a un array asociativo
      $itemData = json_decode( $request->contratoItems, true);


    if ($itemData !== null) {
        // Iterar sobre los datos de los items
        foreach ($itemData as $item) {
            // Acceder a los campos de cada item
            $contratoItem = new ContratoItem();
            $contratoItem->idcontrato=$contrato->idcontrato;
            $contratoItem->iditem = $item['item'];
            $contratoItem->descripcion = $item['descripcionitem'];
            $contratoItem->precio = $item['precio'];
            $contratoItem->cantidad_minima = $item['cantidad_minima'];
            $contratoItem->cantidad_maxima = $item['cantidad_maxima'];
            // Guardar el contratoitem en la base de datos
            $contratoItem->save();
        }
    } else {
        echo "Error al decodificar el JSON.";
    }

        // Redireccionar a la página de detalle del contrato recién creado
        return redirect()->route('contratos.index')
                         ->with('success', 'Contrato creado exitosamente.');

    }

    public function edit($id)
    {
        // Obtener el contrato que se va a editar
        $contrato = Contrato::findOrFail($id);

        // Obtener los tipos de contrato para el dropdown
        $tipocontrato = TipoContrato::all();

        // Obtener los items para el dropdown
        $item = Item::all();

        // Obtener los fiscales para el dropdown
        $fiscales = Fiscal::all();

        $administradores = Administrador::all();
        // Obtener los contratistas
        $contratistas = Contratista::all();
        return view('contratos.edit', compact('contrato','tipocontrato', 'administradores', 'contratistas','fiscales','item'));
    }

    public function update(Request $request, $id)
    {


        // Validar los datos del formulario
        $request->validate([
            'descripcion' => 'required|string',
            // Agrega aquí las validaciones para los otros campos
        ]);

        // Obtener el contrato que se va a actualizar
        $contrato = Contrato::findOrFail($id);

        // Actualizar los campos del contrato
        $contrato->descripcion = $request->descripcion;
        $contrato->idContrataciones = $request->idContrataciones;
        $contrato->idtipocontrato = $request->idtipocontrato;

        $contrato->fechafirma = $request->fechafirma;
        $contrato->anho = $request->anho;
        $contrato->idmonto = $request->idmonto;


        $contrato->alias = $request->alias;
        $contrato->idadministrador = $request->idadministrador;
        $contrato->idcontratista = $request->idcontratista;
        $contrato->fechainicio = $request->fechainicio;


        if($request->fecha_ARTP)
                $contrato->fecha_ARTP = $request->fecha_ARTP;
        if($request->fecha_ARTD)
                $contrato->fecha_ARTD = $request->fecha_ARTD;



        // Agrega aquí la actualización de los otros campos

        // Guardar el contrato actualizado
        $contrato->save();
        ContratoFiscal::where('idcontrato', $contrato->idcontrato)->delete();
        foreach ($request->fiscales as $fiscalId) {
            $contratofiscal = new  ContratoFiscal();
            $contratofiscal->idcontrato = $contrato->idcontrato;
            $contratofiscal->idfiscal = $fiscalId;
            $contratofiscal->save();
         }
        if($request->contratoItems){
                // Actualizar los contrato items asociados
                $itemData = json_decode($request->input('contratoItems'), true);
                ContratoItem::where('idcontrato', $contrato->idcontrato)->delete();  // Eliminar los contratos items anteriores

                if ($itemData !== null) {
                    // Iterar sobre los datos de los items
                    foreach ($itemData as $item) {
                        // Acceder a los campos de cada item
                        $contratoItem = new ContratoItem();
                        $contratoItem->idcontrato=$contrato->idcontrato;
                        $contratoItem->iditem = $item['iditem'];
                        $contratoItem->descripcion = $item['descripcionitem'];
                        $contratoItem->precio = $item['precio'];
                        $contratoItem->cantidad_minima = $item['cantidad_minima'];
                        $contratoItem->cantidad_maxima = $item['cantidad_maxima'];
                        // Guardar el contratoitem en la base de datos
                        $contratoItem->save();
                    }
                }
            }
        // Redireccionar a la vista de detalles del contrato
        return redirect()->route('contratos.index');
    }



    public function evento($idcontrato)
    {
        $contrato = Contrato::find($idcontrato);

        return view('contratos.contratoevento', compact('contrato'));
    }


}
