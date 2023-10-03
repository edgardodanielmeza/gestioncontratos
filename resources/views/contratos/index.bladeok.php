@extends('layouts.app')

@section('content')
<div class="container mx-auto  space-y-10">
    <h1 class=" text-white text-2xl font-bold mb-4  text-center ">Lista de Contratos</h1>

    <a href="{{ route('contratos.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4">Crear Contrato</a>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg  max-w-min mx-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                 <th scope="col" class="px-4 py-3">ID </th>
                 <th scope="col" class="px-4 py-3">Descripción</th>
                 <th scope="col" class="px-4 py-3">Tipo</th>
                 <th scope="col" class="px-4 py-3">Fecha Firma</th>
                 <th scope="col" class="px-4 py-3">Contratista</th>
                 <th scope="col" class="px-4 py-3">Año</th>
                 <th scope="col" class="px-4 py-3">Monto Total</th>
                 <th scope="col" class="px-4 py-3">Fecha Firma</th>
                 <th scope="col" class="px-4 py-3">Fecha ARTP</th>
                 <th scope="col" class="px-4 py-3">Fecha ARTD</th>
                 <th scope="col" class="px-4 py-3">Administrador</th>
                 <th scope="col" class="px-2 py-3">Acciones</th>
            </tr>
        </thead>
        <tbody>
       @foreach($contratos as $contrato)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td class="px-4 py-4">{{ $contrato->idContrataciones }}</td>
                <td class="px-4 py-4">{{ $contrato->descripcion }}</td>
                <td class="px-4 py-4">{{ $contrato->tipocontrato->descripcion }}</td>
                <td class="px-4 py-4"> {{ \Carbon\Carbon::parse($contrato->fechafirma)->format('d/m/y') }}</td>
                <td class="px-4 py-4">{{ $contrato->contratista->descripcion}}</td>
                <td class="px-4 py-4">{{ $contrato->anho }}</td>
                <td class="px-4 py-4 font-semibold text-gray-900 dark:text-white">{{  number_format($contrato->idmonto, 0, ',', '.') }}</td>
                <td class="px-4 py-4">{{ \Carbon\Carbon::parse($contrato->fechainicio)->format('d/m/y')  }}</td>
                <td class="px-4 py-4">{{\Carbon\Carbon::parse($contrato->fecha_ARTP)->format('d/m/y')   }}</td>
                <td class="px-4 py-4">{{ \Carbon\Carbon::parse($contrato->fecha_ARTD )->format('d/m/y') }}</td>
                 <td class="px-4 py-4">{{ $contrato->administrador->nombres}}</td>
                 <td class="px-2 py-4">
                    <a href="{{ route('contratos.show', $contrato->idcontrato) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded mx-1">Ver</a>
                    <a href="{{ route('contratos.edit', $contrato->idcontrato) }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded mx-1">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
