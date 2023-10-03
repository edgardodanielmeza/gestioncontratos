@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <h1 class="text-2xl font-bold mb-4">Lista de Contratos</h1>

    <a href="{{ route('contratos.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Crear Contrato</a>

    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Descripción</th>
                <th class="py-2 px-4 border-b">Alias</th>
                <th class="py-2 px-4 border-b">ID Tipo Contrato</th>
                <th class="py-2 px-4 border-b">ID Administrador</th>
                <th class="py-2 px-4 border-b">Fecha Firma</th>
                <th class="py-2 px-4 border-b">ID Contratista</th>
                <th class="py-2 px-4 border-b">Año</th>
                <th class="py-2 px-4 border-b">ID Contrataciones</th>
                <th class="py-2 px-4 border-b">ID Monto</th>
                <th class="py-2 px-4 border-b">Fecha Inicio</th>
                <th class="py-2 px-4 border-b">Fecha ARTP</th>
                <th class="py-2 px-4 border-b">Fecha ARTD</th>
                <th class="py-2 px-4 border-b">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contratos as $contrato)
            <tr>
                <td class="py-2 px-4 border-b">{{ $contrato->descripcion }}</td>
                <td class="py-2 px-4 border-b">{{ $contrato->alias }}</td>
                <td class="py-2 px-4 border-b">{{ $contrato->idtipocontrato }}</td>
                <td class="py-2 px-4 border-b">{{ $contrato->idadministrador }}</td>
                <td class="py-2 px-4 border-b">{{ $contrato->fechafirma }}</td>
                <td class="py-2 px-4 border-b">{{ $contrato->idcontratista }}</td>
                <td class="py-2 px-4 border-b">{{ $contrato->anho }}</td>
                <td class="py-2 px-4 border-b">{{ $contrato->idContrataciones }}</td>
                <td class="py-2 px-4 border-b">{{ $contrato->idmonto }}</td>
                <td class="py-2 px-4 border-b">{{ $contrato->fechainicio }}</td>
                <td class="py-2 px-4 border-b">{{ $contrato->fecha_ARTP }}</td>
                <td class="py-2 px-4 border-b">{{ $contrato->fecha_ARTD }}</td>
                <td class="py-2 px-4 border-b">
                    <a href="{{ route('contratos.index', $contrato->idcontrato) }}" class="text-blue-500 hover:underline">Ver</a>
                    <a href="{{ route('contratos.index', $contrato->idcontrato) }}" class="ml-2 text-green-500 hover:underline">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
